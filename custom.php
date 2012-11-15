<?php

/*
 * @copyright Garrick S. Bodine, 2012
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 */

// basically, this is just the Omeka simple_search minus the hardcoded fieldset and some added Bootstrap classes: 
function bootstrap_simple_search($buttonText = null, $formProperties=array('id'=>'simple-search'), $uri = null) {
    if (!$buttonText) {
        $buttonText = __('Search');
    }

    if (!$uri) {
        $uri = apply_filters('simple_search_default_uri', uri('items/browse'));
    }

    $searchQuery = array_key_exists('search', $_GET) ? $_GET['search'] : '';
    $formProperties['action'] = $uri;
    $formProperties['method'] = 'get';
    $html  = '<form ' . _tag_attributes($formProperties) . '><div class="input-append">';
    $html .= __v()->formText('search', $searchQuery, array('name'=>'search','class'=>'span2 search-query'));
    $html .= __v()->formSubmit('submit_search', $buttonText, array('class'=>'btn'));

    $parsedUri = parse_url($uri);
    if (array_key_exists('query', $parsedUri)) {
        parse_str($parsedUri['query'], $getParams);
        foreach($getParams as $getParamName => $getParamValue) {
            $html .= __v()->formHidden($getParamName, $getParamValue);
        }
    }

    $html .= '</div></form>';
    return $html;
}

function site_item_citation($item=null) {
    // this will likely be moved into Crowd-Ed, but this will allow for the configuration via the theme configurator :)
    if(!$item) {
        $item = get_current_item();
    }

    $creator    = trim(strip_formatting(item('Dublin Core', 'Creator', array(), $item)));
    $title      = trim(strip_formatting(item('Dublin Core', 'Title', array(), $item)));
    $siteTitle  = trim(strip_formatting(settings('site_title')));
    $itemId     = item('id', null, array(), $item);
    $accessDate = date('F j, Y');
    $uri        = html_escape(abs_item_uri($item));
    $siteEditor = trim(strip_formatting(get_theme_option('Site Editor')));
    $siteLocation = trim(strip_formatting(get_theme_option('Site Location')));
    $siteInstitution = trim(strip_formatting(get_theme_option('Site Institution')));

    $itemDate = date_format(date_create($item->added),'Y');
    
    $cite = '';
    if ($creator) {
        $cite .= "$creator, ";
    }
    if ($title) {
        $cite .= "&#8220;$title.&#8221; ";
    }
    if ($siteTitle) {
        $cite .= "<em>$siteTitle</em>. ";
    }
    if ($siteEditor) {
        $cite .= "Eds. $siteEditor. ";
    }
    if ($siteLocation) {
        $cite .= "$siteLocation";
    }
    if ($siteLocation && $siteInstitution) {
        $cite .= ": ";
    }
    if ($siteInstitution) {
        $cite .= "$siteInstitution";
    }
    if ($siteInstitution && $itemDate) {
        $cite .= ", ";
    }
    if ($itemDate) {
        $cite .= " $itemDate";
    }
    $cite .= ". accessed $accessDate, ";
    $cite .= "$uri.";

    return apply_filters('item_citation', $cite, $item);

}
?>
