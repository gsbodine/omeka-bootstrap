<?php
/**
 * Helper to render a menu for bootsrap.
 *
 * @note Bootstrap 3 doesn't support more that one level of sub-menus.
 *
 * Adapted from Zend_View_Helper_Navigation_Menu::_renderMenu()
 *
 * Differences:
 * - add a span with icon for dropdown.
 * - add a class for ul ul,
 * - set custom html attribs to page
 *
 * @todo Convert into a standard helper.
 *
 * @url https://framework.zend.com/manual/1.12/en/zend.view.helpers.html
 * @url http://www.haclong.org/en/content/creating-menu-zend-navigation.html
 *
 * Not managed: prefixForId.
 */

$container = $this->container;
$nav = $this->navigation();
$menu = $nav->menu();

$ulClass = $menu->getUlClass();
$indent = $menu->getIndent();
$innerIndent = $menu->getInnerIndent();
$minDepth = $menu->getMinDepth();
$maxDepth = $menu->getMaxDepth();
$onlyActive = $menu->getOnlyActiveBranch();
$expandSibs = $menu->getExpandSiblingNodesOfActiveBranch();
$ulId = $menu->getUlId();
$addPageClassToLi = $menu->getAddPageClassToLi();
$activeClass = $menu->getActiveClass();
$parentClass = $menu->getParentClass();
$renderParentClass = $menu->getRenderParentClass();

$customHtmlAttribs = array(
    'class' => 'dropdown-toggle',
    'data-toggle' => 'dropdown',
    'role' => 'button',
    'aria-haspopup' => 'true',
    'aria-expanded' => 'false',
);

$ulUlClass = 'dropdown-menu';
$spanDropdown = '<span class="caret"></span>';

$html = '';

if (!function_exists('_navHtmlAttribs')) {

/**
 * Converts an associative array to a string of tag attributes.
 *
 * Copy of the protected method Zend_View_Helper_Navigation_Menu::_htmlAttribs()
 * and parent methods Zend_View_Helper_HtmlElement::_htmlAttribs() and ::_normalizeId()
 *
 * @param  array $attribs  an array where each key-value pair is converted
 *                         to an attribute name and value
 * @return string          an attribute string
 */
function _navHtmlAttribs($attribs)
{
    // filter out null values and empty string values
    foreach ($attribs as $key => $value) {
        if ($value === null || (is_string($value) && !strlen($value))) {
            unset($attribs[$key]);
        }
    }

    $xhtml = '';
    $view = get_view();
    foreach ((array) $attribs as $key => $val) {
        $key = $view->escape($key);

        if (('on' == substr($key, 0, 2)) || ('constraints' == $key)) {
            // Don't escape event attributes; _do_ substitute double quotes with singles
            if (!is_scalar($val)) {
                // non-scalar data should be cast to JSON first
                require_once 'Zend/Json.php';
                $val = Zend_Json::encode($val);
            }
            // Escape single quotes inside event attribute values.
            // This will create html, where the attribute value has
            // single quotes around it, and escaped single quotes or
            // non-escaped double quotes inside of it
            $val = str_replace('\'', '&#39;', $val);
        } else {
            if (is_array($val)) {
                $val = implode(' ', $val);
            }
            $val = $view->escape($val);
        }

        if ('id' == $key) {
            $value = $val;
            if (strstr($value, '[')) {
                if ('[]' == substr($value, -2)) {
                    $value = substr($value, 0, strlen($value) - 2);
                }
                $value = trim($value, ']');
                $value = str_replace('][', '-', $value);
                $value = str_replace('[', '-', $value);
            }
            $val = $value;
        }

        if (strpos($val, '"') !== false) {
            $xhtml .= " $key='$val'";
        } else {
            $xhtml .= " $key=\"$val\"";
        }

    }
    return $xhtml;
}

// End functions.
}

// find deepest active
if ($found = $nav->findActive($container, $minDepth, $maxDepth)) {
    $foundPage = $found['page'];
    $foundDepth = $found['depth'];
} else {
    $foundPage = null;
}

// create iterator
$iterator = new RecursiveIteratorIterator($container,
                    RecursiveIteratorIterator::SELF_FIRST);
if (is_int($maxDepth)) {
    $iterator->setMaxDepth($maxDepth);
}

// iterate container
$prevDepth = -1;
foreach ($iterator as $page) {
    $depth = $iterator->getDepth();
    $isActive = $page->isActive(true);
    if ($depth < $minDepth || !$nav->accept($page)) {
        // page is below minDepth or not accepted by acl/visibilty
        continue;
    } else if ($expandSibs && $depth > $minDepth) {
        // page is not active itself, but might be in the active branch
        $accept = false;
        if ($foundPage) {
            if ($foundPage->hasPage($page)) {
                // accept if page is a direct child of the active page
                $accept = true;
            } else if ($page->getParent()->isActive(true)) {
                // page is a sibling of the active branch...
                $accept = true;
            }
        }
        if (!$isActive && !$accept) {
            continue;
        }
    } else if ($onlyActive && !$isActive) {
        // page is not active itself, but might be in the active branch
        $accept = false;
        if ($foundPage) {
            if ($foundPage->hasPage($page)) {
                // accept if page is a direct child of the active page
                $accept = true;
            } else if ($foundPage->getParent()->hasPage($page)) {
                // page is a sibling of the active page...
                if (!$foundPage->hasPages() ||
                    is_int($maxDepth) && $foundDepth + 1 > $maxDepth) {
                    // accept if active page has no children, or the
                    // children are too deep to be rendered
                    $accept = true;
                }
            }
        }

        if (!$accept) {
            continue;
        }
    }

    // make sure indentation is correct
    $depth   -= $minDepth;
    $myIndent = $indent . str_repeat($innerIndent, $depth * 2);

    if ($depth > $prevDepth) {
        $attribs = array();

        // start new ul tag
        if (0 == $depth) {
            $attribs = array(
                'class' => $ulClass,
                'id'    => $ulId,
            );
        }
        // Add a class for sub-menus.
        else {
            $attribs = array(
                'class' => $ulUlClass,
            );
        }

        // We don't need a prefix for the menu ID (backup)
//                $skipValue = $nav->_skipPrefixForId;
        $nav->skipPrefixForId();

        $html .= $myIndent . '<ul'
                            . _navHtmlAttribs($attribs)
                            . '>'
                            . $nav->getEOL();

        // Reset prefix for IDs
//                $this->_skipPrefixForId = $skipValue;
    } else if ($prevDepth > $depth) {
        // close li/ul tags until we're at current depth
        for ($i = $prevDepth; $i > $depth; $i--) {
            $ind   = $indent . str_repeat($innerIndent, $i * 2);
            $html .= $ind . $innerIndent . '</li>' . $nav->getEOL();
            $html .= $ind . '</ul>' . $nav->getEOL();
        }
        // close previous li tag
        $html .= $myIndent . $innerIndent . '</li>' . $nav->getEOL();
    } else {
        // close previous li tag
        $html .= $myIndent . $innerIndent . '</li>' . $nav->getEOL();
    }

    // render li tag and page
    $liClasses = array();
    // Is page active?
    if ($isActive) {
        $liClasses[] = $activeClass;
    }
    // Add CSS class from page to LI?
    if ($addPageClassToLi) {
        $liClasses[] = $page->getClass();
    }
    // Add CSS class for parents to LI?
    $addSpanDropdown = false;
    if ($renderParentClass && $page->hasChildren()) {
        // Check max depth
        if ((is_int($maxDepth) && ($depth + 1 < $maxDepth))
            || !is_int($maxDepth)
        ) {
            $liClasses[] = $parentClass;
            $page->setCustomHtmlAttribs($customHtmlAttribs);
            $addSpanDropdown = true;
        }
    }

    $html .= $myIndent . $innerIndent . '<li'
            . _navHtmlAttribs(array('class' => implode(' ', $liClasses)))
            . '>' . $nav->getEOL()
            . $myIndent . str_repeat($innerIndent, 2)
            // TODO Add a type of page in order to set a link with an icon.
            . ($addSpanDropdown
                ? str_replace('</a>', $spanDropdown . '</a>', $nav->htmlify($page))
                : $nav->htmlify($page))
            . $nav->getEOL();

    // store as previous depth for next iteration
    $prevDepth = $depth;
}

if ($html) {
    // done iterating container; close open ul/li tags
    for ($i = $prevDepth+1; $i > 0; $i--) {
        $myIndent = $indent . str_repeat($innerIndent . $innerIndent, $i - 1);
        $html    .= $myIndent . $innerIndent . '</li>' . $nav->getEOL()
                    . $myIndent . '</ul>' . $nav->getEOL();
    }
    $html = rtrim($html, $nav->getEOL());
}

// return $html;
echo $html;
