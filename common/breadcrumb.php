<nav id='nav-info'>
<?php
// TODO Use Zend nav breadcrumbs (but the depth is low in Omeka).

// The home page has a special breadcrumb.
if (is_current_url('/')):
    $totalCollections = total_records('Collection');
    $totalItems = total_records('Item');
    $totalFiles = total_records('File'); ?>
    <div id="bread-info" class="breadcrumb">
        <span id="total-records">
    <?php
    echo __('%s shares %s files and %s items in %s collections.',
        '<em>' . option('site_title') . '</em>',
        '<strong>' . $totalFiles . '</strong>',
        '<strong>' . $totalItems . '</strong>',
        '<strong>' . $totalCollections . '</strong>');
    ?>
        </span>
    </div>

<?php else:
    // $divider = '<span class="divider">&gt;</span> ';
    $divider = '';

    if (empty($mode) || !in_array($mode, array(
        // Set [records]/browse before a collection or an item.
        'browse',
        // Set [collections] before an item, else browse.
        'collection',
        // Set [item type] before an item, else browse.
        'type',
        // Set the record directly after home, except for file.
        'directly',
    ))) {
        $mode = 'browse';
    }

    $request = Zend_Controller_Front::getInstance()->getRequest();
    $params = $request->getParams();
    $module = isset($params['module']) ? $params['module'] : 'default';
    $controller = isset($params['controller']) ? $params['controller'] : 'index';
    $action = isset($params['action']) ? $params['action'] : 'index';
    // print_r(['params' => $params, ['title' => isset($title) ? $title : '', 'module' => $module, 'controller' => $controller, 'action' => $action]]);

    $breadcrumbs = array();
    $breadcrumbs[] = link_to_home_page(__('Home'));

    // An exception used to simplify the build of the breadcrumb.
    if (plugin_is_active('GuestUser') && $module == 'default' && $controller == 'users') {
        $module = 'guest-user';
        $controller = 'user';
    }

    switch ($module):
        case 'default':

            switch ($controller):

                case 'items':
                    switch ($action):
                        case 'show':
                            $item = get_current_record('item');
                            if ($mode == 'collection') {
                                $collection = $item->getCollection();
                                if (empty($collection)) {
                                    $breadcrumbs[] = link_to_items_browse(__('Browse'));
                                } else {
                                    $breadcrumbs[] = link_to('collections', 'browse', __('Collections'));
                                    $breadcrumbs[] = link_to_collection_for_item($collection->getProperty('display_title'));
                                }
                            } elseif ($mode == 'type') {
                                $itemType = $item->getItemType();
                                if (empty($itemType)) {
                                    $breadcrumbs[] = link_to_items_browse(__('Browse'));
                                } else {
                                    $breadcrumbs[] = link_to_items_with_item_type(Inflector::pluralize($itemType->name), array(), 'browse', $itemType);
                                }
                            } elseif ($mode == 'browse') {
                                $breadcrumbs[] = link_to_items_browse(__('Browse'));
                            }
                            $breadcrumbs[] = $title ?: metadata($item, array('Dublin Core', 'Title'));
                            break;
                        case 'browse':
                        case 'index':
                            $breadcrumbs[] = link_to_items_browse(__('Browse'));
                            $breadcrumbs[] =__('Items');
                            break;
                        case 'search':
                            $breadcrumbs[] = link_to_items_browse(__('Browse'));
                            $breadcrumbs[] = __('Search');
                            break;
                    endswitch;
                    break;

                case 'collections':
                    switch ($action):
                        case 'show':
                            if ($mode != 'directly') {
                                $breadcrumbs[] = link_to('collections', 'browse', __('Collections'));
                            }
                            $breadcrumbs[] = $title ?: metadata('collection', array('Dublin Core', 'Title'));
                            break;
                        case 'browse':
                        case 'index':
                            $breadcrumbs[] = link_to_items_browse(__('Browse'));
                            $breadcrumbs[] = __('Collections');
                            break;
                    endswitch;
                    break;

                case 'files':
                    $file = get_current_record('file');
                    $item = $file->getItem();
                    // TODO Merge with the "item" case.
                    if ($mode == 'collection') {
                        $collection = $item->getCollection();
                        if (empty($collection)) {
                            $breadcrumbs[] = link_to_items_browse(__('Browse'));
                        } else {
                            $breadcrumbs[] = link_to('collections', 'browse', __('Collections'));
                            $breadcrumbs[] = link_to_collection_for_item($collection->getProperty('display_title'));
                        }
                    } elseif ($mode == 'type') {
                        $itemType = $item->getItemType();
                        if (empty($itemType)) {
                            $breadcrumbs[] = link_to_items_browse(__('Browse'));
                        } else {
                            $breadcrumbs[] = link_to_items_with_item_type(Inflector::pluralize($itemType->name), array(), 'browse', $itemType);
                        }
                    } elseif ($mode == 'browse') {
                        $breadcrumbs[] = link_to_items_browse(__('Browse'));
                    }
                    $breadcrumbs[] = link_to_item(null, array(), 'show', $item);
                    $breadcrumbs[] = $title ?: $file->original_filename;
                    break;

                case 'search':
                    $breadcrumbs[] = link_to_items_browse(__('Browse'));
                    $breadcrumbs[] = link_to_item_search();
                    $breadcrumbs[] = __('Results');
                    break;

                case 'users':
                    switch ($action):
                        case 'login':
                            $breadcrumbs[] = __('Login');
                            break;
                        case 'activate':
                            $breadcrumbs[] = __('Activate');
                            break;
                        case 'forgot-password':
                            $breadcrumbs[] = '<a href="' . url('users/login') . '">' .  __('Login') . '</a>';
                            $breadcrumbs[] = __('Forgot Password');
                            break;
                    endswitch;
                    break;

            endswitch;
            break;

        case 'simple-pages':
            $breadcrumbs = array_merge($breadcrumbs, bootstrap_breadcrumb_simple_page());
            break;

        case 'exhibit-builder':
            switch ($controller):

                case 'exhibits':
                    switch ($action):
                        case 'browse':
                        case 'index':
                            $breadcrumbs[] = __('Exhibits');
                            break;
                        case 'tags':
                            $breadcrumbs[] = link_to('exhibits', 'browse', __('Exhibits'));
                            $breadcrumbs[] = __('Browse by Tag');
                            break;
                        case 'summary':
                            $breadcrumbs[] = link_to('exhibits', 'browse', __('Exhibits'));
                            $breadcrumbs[] = exhibit_builder_link_to_exhibit();
                            $breadcrumbs[] = __('Summary');
                            break;
                        case 'show':
                            $breadcrumbs[] = link_to('exhibits', 'browse', __('Exhibits'));
                            $breadcrumbs[] = exhibit_builder_link_to_exhibit();
                            $breadcrumbs = array_merge($breadcrumbs, bootstrap_breadcrumb_exhibit_page());
                            break;
                        case 'show-item':
                            if (!isset($item) || !$item) {
                                $item = get_current_record('item');
                            }
                            $breadcrumbs[] = link_to('exhibits', 'browse', __('Exhibits'));
                            $breadcrumbs[] = exhibit_builder_link_to_exhibit();
                            // Appends hierarchical links of all parent exhibit pages for current item to the breadcrumb array
                            $breadcrumbs   = array_merge($breadcrumbs, bootstrap_breadcrumb_exhibit_page(related_exhibit_page($item), true));
                            // Gets us the Item name text for the last part of the breadcrumb trail, removes hyperlink (strip_tags) to item
                            $breadcrumbs[] = strip_tags(exhibit_builder_link_to_exhibit_item());
                            break;
                    endswitch;
                    break;

                case 'items':
                    $breadcrumbs[] = link_to('exhibits', 'browse', __('Exhibits'));
                    $breadcrumbs[] = __('Browse Items');
                    break;

            endswitch;
            break;

        case 'reference':
            switch ($action):
                case 'browse':
                case 'index':
                    $breadcrumbs[] = link_to_items_browse(__('Browse'));
                    $breadcrumbs[] = __('References');
                    break;
                case 'list':
                    $breadcrumbs[] = link_to_items_browse(__('Browse'));
                    $breadcrumbs[] = '<a href="' . WEB_ROOT . '/references' . '">' . __('References') . '</a>';
                    $breadcrumbs[] = __('List of references');
                    break;
            endswitch;
            break;

        case 'neatline-time':
        case 'timeline':
            switch ($action):
                case 'browse':
                case 'index':
                    $breadcrumbs[] = link_to_items_browse(__('Browse'));
                    $breadcrumbs[] = __('Timelines');
                    break;
                case 'show':
                    $breadcrumbs[] = link_to_items_browse(__('Browse'));
                    // TODO Currently, timelines is not a standard record.
                    // $breadcrumbs[] = link_to('neatline-time', 'browse', __('All timelines'));
                    $breadcrumbs[] = '<a href="' . WEB_ROOT . '/neatline-time' . '">' . __('Timelines') . '</a>';
                    $breadcrumbs[] = $title;
                    break;
            endswitch;
            break;

        case 'geolocation':
            $breadcrumbs[] = link_to_items_browse(__('Browse'));
            $breadcrumbs[] = $title;
            break;

        case 'guest-user':
            if (plugin_is_active('Contribution')) {
                $breadcrumbs[] = '<a href="' . contribution_contribute_url() . '">' . __('Contribute') . '</a>';
            }
            switch ($action):
                case 'login':
                    $breadcrumbs[] = get_option('guest_user_login_text') ?: __('Login');
                    break;
                case 'activate':
                    $breadcrumbs[] = __('Activate');
                    break;
                case 'forgot-password':
                    $breadcrumbs[] = '<a href="' . url('guest-user/user/login') . '">' . get_option('guest_user_login_text') ?: __('Login') . '</a>';
                    $breadcrumbs[] = __('Forgot Password');
                    break;
                case 'me':
                    $breadcrumbs[] = __('My Account');
                    break;
                case 'update-account':
                    $breadcrumbs[] = '<a href="' . url('guest-user/user/me') . '">' . __('My Account') . '</a>';
                    $breadcrumbs[] = __('Update Account');
                    break;
                case 'register':
                    $breadcrumbs[] = get_option('guest_user_register_text') ?: __('Register');
                    break;
                case 'confirm':
                    $breadcrumbs[] = __('Confirm');
                    break;
            endswitch;
            break;

        case 'contribution':
            if ($action == 'contribute' || $action == 'index'):
                $breadcrumbs[] =__('Contribute');
            else:
                $breadcrumbs[] = '<a href="' . contribution_contribute_url() . '">' . __('Contribute') . '</a>';
                switch ($action):
                    case 'edit':
                        $breadcrumbs[] = __('Edit Contribution');
                        break;
                    case 'thankyou':
                        $breadcrumbs[] = __('Thank You!');
                        break;
                    case 'my-contributions':
                        $breadcrumbs[] = __('My Contributions');
                        break;
                    case 'terms':
                        $breadcrumbs[] = __('Terms');
                        break;
                endswitch;
            endif;
            break;

        case 'simple-contact':
        case 'simple-contact-form':
            if ($action == 'thankyou') {
                $breadcrumbs[] = '<a href="' . url('/contact') . '">' . __('Contact Us') . '</a>';
                $breadcrumbs[] = __('Thank You!');
            } else {
                $breadcrumbs[] = __('Contact Us');
            }
            break;

    endswitch;

    $last = array_pop($breadcrumbs);
?>
    <ol id="breadcrumbs" class="breadcrumb">
        <?php
        if ($breadcrumbs):
            echo '<li>' . implode($divider . '</li><li>', $breadcrumbs) . $divider . '</li>';
        endif;
        echo '<li class="active">' . $last . '</li>';
        ?>
    </ol>
<?php endif;?>
</nav>
