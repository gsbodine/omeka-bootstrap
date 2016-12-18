<?php
/**
 * @copyright See readme.
 * @copyright Garrick S. Bodine, 2012
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 */

//Twitter and Facebook are external links with an icon, that Zend can't manage.
// When uncommented, this filter works fine, but without icons.
// add_filter(Omeka_Navigation::PUBLIC_NAVIGATION_MAIN_FILTER_NAME, 'themeFilterPublicNavigationMain');
// Useless, because the secondary nav is a simple menu.
// add_filter(public_navigation_items, 'themeFilterPublicNavigationItems');

function themeFilterPublicNavigationMain($nav)
{
    $navBootstrap = array(
        'Twitter' => get_theme_option('Link Twitter'),
        'Facebook' => get_theme_option('Link Facebook'),
    );
    $navBootstrap = array_filter($navBootstrap);
    foreach ($navBootstrap as $label => $uri) {
        $nav[] = array(
            'label' => $label,
            'uri' => $uri,
        );
    }
    return $nav;
}

/**
 * Create the bootstrap menu.
 *
 * @note Bootstrap 3 doesn't support more that one level of sub-menus.
 *
 * @todo Use standard Zend methods or a custom helper and manage all icons.
 *
 * @param Zend_View_Helper_Navigation_Menu $nav
 * @param boolean $options See default below.
 * @return Zend_View_Helper_Navigation_Menu|string The nav or the html
 * representation of the nav when external links are added.
 */
function bootstrap_nav(Zend_View_Helper_Navigation_Menu $nav, $options = array())
{
    // Default values from Zend_View_Helper_Navigation_Menu. Specific values for
    // bootstrap are ulClass, parent class, render parent class and partial.
    $defaultOptions = array(
        'ulClass' => 'nav navbar-nav',
        'innerIndent' => '    ',
        'minDepth' => null,
        'maxDepth' => null,
        'onlyActiveBranch' => false,
        'expandSiblingNodesOfActiveBranch' => false,
        'ulId' => null,
        'addPageClassToLi' => false,
        'activeClass' => 'active',
        'parentClass' => 'dropdown',
        'renderParentClass' => true,
        'partial' => 'common/menu.php',
        // This is a non-standard option.
        'addExternalLinks' => false,
    );
    $options = array_merge($defaultOptions, $options);

    $nav->setUlClass($options['ulClass']);
    $nav->setInnerIndent($options['innerIndent']);
    $nav->setMinDepth($options['minDepth']);
    $nav->setMaxDepth($options['maxDepth']);
    $nav->setOnlyActiveBranch($options['onlyActiveBranch']);
    $nav->setExpandSiblingNodesOfActiveBranch($options['expandSiblingNodesOfActiveBranch']);
    $nav->setUlId($options['ulId']);
    $nav->addPageClassToLi($options['addPageClassToLi']);
    $nav->setActiveClass($options['activeClass']);
    $nav->setParentClass($options['parentClass']);
    $nav->setRenderParentClass($options['renderParentClass']);
    $nav->setPartial($options['partial']);

    // External links are links with icons, currently not managed fully.

    // When there are right menus at right and external links, this special
    // function should be used instead the simple second part of the navbar.
    if ($options['addExternalLinks']) {
        return bootstrapAddExternalLinks($nav);
    }
    return $nav;
}

/**
 * Add Twitter and Facebook links, if any, to a nav.
 *
 * Twitter and Facebook are external links with an icon, that Zend can't manage,
 * so the links are added directly.
 *
 * @param Zend_View_Helper_Navigation_Menu|string $nav
 * @return string The html representation of the nav.
 */
function bootstrapAddExternalLinks($nav)
{
    $navBootstrap = array(
        'twitter' => get_theme_option('Link Twitter'),
        'facebook' => get_theme_option('Link Facebook'),
    );
    $externalLinks = '';
    $baseLink = '<li><a href="%s" target="__blank" class="navbar-link"><span class="fa fa-lg fa-%s"></span></a></li>';

    $navBootstrap = array_filter($navBootstrap);
    foreach ($navBootstrap as $label => $uri) {
        $externalLinks .= sprintf($baseLink, $uri, $label);
    }

    if (!is_string($nav)) {
        $nav = $nav->__toString();
    }
    if ($externalLinks) {
        $nav = substr($nav, 0, strlen($nav) - 5) . $externalLinks . '</ul>';
    }
    return $nav;
}

// basically, this is just the Omeka simple_search minus the hardcoded fieldset and some added Bootstrap classes:
function bootstrap_simple_search($buttonText = null, $formProperties = array('id' => 'simple-search'), $uri = null)
{
    if (!$buttonText) {
        $buttonText = __('Search');
    }

    if (!$uri) {
        $uri = apply_filters('simple_search_default_uri', url('items/browse'));
    }

    $searchQuery = array_key_exists('search', $_GET) ? $_GET['search'] : '';
    $formProperties['action'] = $uri;
    $formProperties['method'] = 'get';
    $html  = '<form ' . tag_attributes($formProperties) . '><div class="input-group">';
    $html .= get_view()->formText('search', $searchQuery, array('name' => 'search', 'class' => 'input-md'));
    $html .= get_view()->formSubmit('submit_search', $buttonText, array('class' => 'btn btn-default'));

    $parsedUri = parse_url($uri);
    if (array_key_exists('query', $parsedUri)) {
        parse_str($parsedUri['query'], $getParams);
        foreach($getParams as $getParamName => $getParamValue) {
            $html .= get_view()->formHidden($getParamName, $getParamValue);
        }
    }

    $html .= '</div></form>';
    return $html;
}

/**
 * Wrapper of browse_sort_links() to manage classes of list of links for sorting
 * displayed records.
 *
 * @uses browse_sort_links()
 * @param array $links The links to sort the headings. Should correspond to
 *  the metadata displayed.
 * @param array $wrapperTags The tags and attributes to use for the browse headings
 * - 'list_tag' The HTML tag to use for the containing list
 * - 'link_tag' The HTML tag to use for each list item (the browse headings)
 * - 'list_attr' Attributes to apply to the containing list tag
 * - 'link_attr' Attributes to apply to the list item tag
 *
 * @return string
 */
function bootstrap_browse_sort_links($links, $wrapperTags = array())
{
    $sortLinks = browse_sort_links($links, $wrapperTags);
    return str_replace(
        array(
            'class="sorting asc" class="',
            'class="sorting desc" class="',
        ),
        array(
            'class="sorting asc ',
            'class="sorting desc ',
        ),
        $sortLinks);
}

/**
 * Helper to build the grid rotator.
 *
 * @return string
 */
function displayGridRotator($items)
{
    if (empty($items)) {
        return '';
    }
    ?>
    <div class="row"><!--start sliderrow-->
        <div class="col-md-offset-1 col-md-10 col-md-offset-1">
            <div id="ri-grid" class="ri-grid ri-grid-size-2 ri-shadow">
                <img class="ri-loading-image" src="<?php echo src('images/grid-rotator/loading.gif'); ?>"/>
                <ul>
                    <?php
                    // The grid rotator needs at least a number of items equal to
                    // the number of rows and columns (3 x 8, (see globals.js), so
                    // the grid is completed with previous items until ok.
                    $number = 3 * 8;
                    $itemUrls = array();
                    foreach ($items as $item) {
                        $itemUrls[] = link_to_item(
                            item_image('square_thumbnail', array('class' => ''), 0, $item),
                            array('class' => 'image'), 'show', $item);
                    }
                    $missing = $number - count($items);
                    if ($missing > 0 && $missing < $number) {
                        $loop = ceil($number / count($items));
                        $urls = $itemUrls;
                        for ($i = 0; $i < $loop; $i++) {
                            $itemUrls = array_merge($itemUrls, $urls);
                        }
                    }
                    shuffle($itemUrls);
                    echo '<li>' . implode('</li><li>', $itemUrls) . '</li>';
                    ?>
                </ul>
            </div>
        </div>
    </div>
<?php
}

/**
 * Hack to wrap flash inside a bootstrap class.
 *
 * @uses flash()
 * @param string $bsColor The bootstrap color.
 * @return string
 */
function bootstrap_flash($bsColor = 'primary')
{
    $flash = flash();
    if ($flash) {
        $flash = str_replace('<div id="flash">', '<div id="flash" class="bs-callout bs-callout-' . $bsColor . '">', $flash);
    }
    return $flash;
}
