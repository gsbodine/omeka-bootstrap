<?php
/**
 * @copyright Garrick S. Bodine, 2012
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 */

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

function filterPublicNavigationMain($nav)
{
    //$nav[] = array('class' => 'nav');
    return $nav;
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
