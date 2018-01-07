<?php
/**
 * @copyright See readme.
 * @copyright Garrick S. Bodine, 2012
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 */

$this->addHelperPath(
    __DIR__
        . DIRECTORY_SEPARATOR . 'libraries'
        . DIRECTORY_SEPARATOR . 'Twitter'
        . DIRECTORY_SEPARATOR . 'View'
        . DIRECTORY_SEPARATOR . 'Helper',
    'Twitter_View_Helper_');

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
        'partial' => 'libraries'
            . DIRECTORY_SEPARATOR . 'Twitter'
            . DIRECTORY_SEPARATOR . 'Partial'
            . DIRECTORY_SEPARATOR . 'NavigationMenu.php',
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

/**
 * Set bootstrap decorators to a form.
 *
 * @todo Uses a bootstrap form directly via a config of Zend / Omeka or overwrite all form and element classes.
 *
 * @param Zend_Form $form
 * @param string $formType "inline" or "horizontal". In Bootstrap, default is
 * vertical (basic).
 * @return Zend_Form
 */
function bootstrap_form(Zend_Form $form, $formType = 'basic')
{
    if ($form instanceof Omeka_Form) {
        // TODO Manage special Omeka elements?
        // Omeka_Form_Element_SessionCsrfToken;
        // Omeka_Form_Element_Input;
        // Omeka_Form_DisplayGroup;
        $form->setAutoApplyOmekaStyles(false);
    }
    require_once 'libraries'
        . DIRECTORY_SEPARATOR . 'Twitter'
        . DIRECTORY_SEPARATOR . 'Form'
        . DIRECTORY_SEPARATOR . 'Redecorate.php';
    return Twitter_Form_Redecorate::redecorate($form, $formType);
}

/**
 * Returns a breadcrumb for a given page (without the home page).
 *-
 * @see simple_pages_display_breadcrumbs()
 * @uses public_url(), html_escape()
 * @param integer|null The id of the page.  If null, it uses the current simple page.
 * @return array
 */
function bootstrap_breadcrumb_simple_page($pageId = null)
{
    $breadcrumbs = array();

    $db = get_db();
    if (empty($pageId)) {
        $page = get_current_record('simple_pages_page', false);
    } else {
        $page = get_record_by_id('SimplePagesPage', $pageId);
    }

    if ($page) {
        $ancestorPages = $db->getTable('SimplePagesPage')->findAncestorPages($page->id);
        $bPages = array_merge(array($page), $ancestorPages);

        // make sure all of the ancestors and the current page are published
        foreach($bPages as $bPage) {
            if (!$bPage->is_published) {
                return array();
            }
        }

        // find the page links
        $pageLinks = array();
        foreach($bPages as $bPage) {
            if ($bPage->id == $page->id) {
                $pageLinks[] = html_escape($bPage->title);
            } else {
                $pageLinks[] = '<a href="' . public_url($bPage->slug) .  '">' . html_escape($bPage->title) . '</a>';
            }
        }
        $pageLinks[] = '<a href="'. public_url('') . '">' . __('Home') . '</a>';

        // Remove the home page, because it is added separately.
        array_pop($pageLinks);
        $breadcrumbs = array_reverse($pageLinks);
    }

    return $breadcrumbs;
}

/**
 * Return a trail of parent pages, ending in the current page's name.
 *
 * @see exhibit_builder_page_trail()
 * @param ExhibitPage|null $exhibitPage The page to print the trail to.
 * @param boolean|false $linkCurrent Whether or not to create a hyperlink for the provided exhibit page too.
 * @return array
 */
function bootstrap_breadcrumb_exhibit_page($exhibitPage = null, $linkCurrent = false)
{
    if (!$exhibitPage) {
        $exhibitPage = get_current_record('exhibit_page');
    }
    $exhibit = get_record_by_id('Exhibit', $exhibitPage->exhibit_id);

    $currentPage = $exhibitPage;
    $parents = array();
    while ($currentPage->parent_id) {
        $currentPage = $currentPage->getParent();
        array_unshift($parents, $currentPage);
    }

    $breadcrumbs = array();
    foreach ($parents as $parent) {
        $text = metadata($parent, 'title');
        $breadcrumbs[] = exhibit_builder_link_to_exhibit($exhibit, $text, array(), $parent);
        release_object($parent);
    }

    $breadcrumbs[] = $linkCurrent ? exhibit_builder_link_to_exhibit($exhibit, metadata($exhibitPage, 'title'), array(), $exhibitPage) : metadata($exhibitPage, 'title');
    return $breadcrumbs;
}


/**
 * Get HTML for all files assigned to an item.
 *
 * @package Original: Omeka\Function\View\Item
 * @param array $options
 * @param array $wrapperAttributes
 * @param Item|null $item Check for this specific item record (current item if null).
 * @return string HTML
 */
function custom_files_for_item($options = array(), $wrapperAttributes = array('class' => 'item-file'), $item = null)
{
    if (!$item) {
        $item = get_current_record('item');
    }
    return custom_file_markup($item->Files, $options, $wrapperAttributes);
}

/**
 * Get HTML for a set of files.
 *
 * @package Original: Omeka\Function\View\File
 * @uses Omeka_View_Helper_FileMarkup::fileMarkup()
 * @param File $files A file record or an array of File records to display.
 * @param array $props Properties to customize display for different file types.
 * @param array $wrapperAttributes Attributes HTML attributes for the div that
 * wraps each displayed file. If empty or null, this will not wrap the displayed
 * file in a div.
 * @return string HTML
 */
function custom_file_markup($files, array $props = array(), $wrapperAttributes = array('class' => 'item-file'))
{
    if (!is_array($files)) {
        $files = array($files);
    }
    $helper = new Omeka_View_Helper_FileMarkup;
    $output = '';
    foreach ($files as $file) {
        $filename = metadata($file, 'original_filename');
        //$description = metadata($file, 'description'); //theme doesn't currently show/link to file description data
        $wrapperAttributes['aria-describedby'] = $filename;
        $output .= '<figure>';
        $output .= $helper->fileMarkup($file, $props, $wrapperAttributes);
        $output .= '<figcaption id="'.$filename.'">'.$filename.'</figcaption>';
        $output .= '</figure>';
    }
    return $output;
}

function related_exhibit_page($item) {
    //https://forum.omeka.org/t/linking-to-exhibit-from-item-page-using-custom-php-in-a-theme/2821/6
    $db = get_db();

    $select = "SELECT ep.* FROM {$db->prefix}exhibit_pages AS ep
    INNER JOIN {$db->prefix}exhibit_page_blocks AS epb ON epb.page_id = ep.id
    INNER JOIN {$db->prefix}exhibit_block_attachments AS epba ON epba.block_id = epb.id
    WHERE epba.item_id = ?";

    $exhibits = $db->getTable("ExhibitPage")->fetchObjects($select,array($item->id));

    if(!empty($exhibits)) {
        #foreach($exhibits as $exhibit) {
        #    echo '<div style="float:right;"><h3><a href="'.exhibit_builder_exhibit_uri($exhibit).'">Biography</a></h3></div>';
        #}
        return $exhibits[0];
    }
}
