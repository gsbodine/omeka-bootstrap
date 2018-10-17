<?php
// For improved geolocation (https://github.com/Daniel-KM/Omeka-plugin-Geolocation).

queue_css_file('geolocation-items-map');

$center = array();
if (isset($item)) {
    $radius = isset($params['geolocation-radius']) ? $params['geolocation-radius'] : get_option('geolocation_default_radius');
    $unit = get_option('geolocation_use_metric_distances') ? __('kilometers') :__('miles');
    $title = __('Browse Items around Item "%s" (%d total, %s %s radius)', link_to_item(null, array(), 'show', $item), $totalItems, $radius, $unit);
    $center['latitude'] = (double) $location->latitude;
    $center['longitude'] = (double) $location->longitude;
    $center['zoomLevel'] = (double) get_option('geolocation_default_zoom_level');
}
else {
    $title = __('Browse Items on the Map (%s total)', $totalItems);
}

echo head(array('title' => $title, 'bodyclass' => 'map browse'));
?>

<div id="primary">
    <div class="row page-header">
        <div class="col-xs-12">
            <h1><span class="glyphicon glyphicon-globe"></span> <?php echo $title; ?></h1>
        </div>
    </div>

<nav class="items-nav navigation secondary-nav">
    <?php echo public_nav_items()->setUlClass('nav nav-pills'); ?>
</nav>

<?php
echo item_search_filters();
echo pagination_links();
?>

<div class="row">
    <div id="geolocation-browse" class="col-xs-12">
    <?php
    $accessible_markup = get_option('geolocation_accessible_markup');
    if ($accessible_markup):
        $tabular_url = absolute_url('geolocation/map/tabular');
    ?>
    <figure aria-describedat="<?php echo $tabular_url;?>">
    <?php endif;

    echo $this->googleMap('map_browse', array('list' => 'map-links', 'params' => $params), array(), $center);
    ?>
    <div id="map-links"><h2><?php echo __('Find An Item on the Map'); ?></h2></div>
    <?php if ($accessible_markup):?>
    <figcaption class="element-invisible"><?php echo __('Map with geographic locations of items.'); ?>
        <a href="<?php echo $tabular_url;?>"><?php echo __('View as text'); ?></a>
    </figcaption>
    </figure>
    <?php endif; ?>
    </div>
</div>
    <?php if (get_option('geolocation_browse_append_search')): ?>
<div class="row">
    <div class="col-xs-12">
        <h2><?php echo __('Filter items on the map'); ?></h2>
    <div id="search_block">
        <?php echo items_search_form(array('id'=>'search'), $_SERVER['REQUEST_URI']); ?>
    </div>
    </div>
</div>
    <?php endif; ?>
</div><?php // end primary. ?>
<?php echo foot();
