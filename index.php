<?php echo head(array('bodyid' => 'home')); ?>

<?php
if (get_theme_option('Display Grid Rotator')):
    $items = get_random_featured_items('100', true);
    displayGridRotator($items);
endif;
?>

<?php $homepageText = get_theme_option('Homepage Text'); ?>
<div class="row home-features" id="home-tagline"> <!-- start tagline -->
    <div class="col-md-12">
        <h1 id="tagline"><?php echo option('site_title'); ?></h1>
        <?php echo $homepageText; ?>
    </div>
</div>

<div class="row home-features"> <?php // start about & tag cloud ?>
    <div class="col-md-4 col-sm-12 home-stories"> <!--about-->
        <?php if (get_theme_option('Display Featured Exhibit')
            && plugin_is_active('ExhibitBuilder')
            && function_exists('exhibit_builder_display_random_featured_exhibit')): ?>
        <?php // Featured Exhibit ?>
            <?php echo exhibit_builder_display_random_featured_exhibit(); ?>
        <?php endif; ?>
    </div><?php // end about ?>

    <div class="col-md-4 col-sm-12 home-themes"><?php // tag cloud ?>
    <h2 id="tagcloud"><?php echo __('Themes'); ?></h2>
        <?php echo tag_cloud(get_recent_tags(15), '/items/browse', 9); ?>
        <a style="margin-left:10px;" href="<?php echo url('items/tags'); ?>" class="btn btn-default">View More</a>
    </div>
    <?php if (plugin_is_active('Geolocation')): ?>
    <div class="col-md-4 col-sm-12 home-map">
    <h2>Map</h2>
    <a href="<?php echo url('geolocation/map/browse'); ?>"> <?php echo __('Display Geolocation Map.'); ?></a>
    </div>
    <?php endif; ?>
</div>

<div class="row home-features">
    <div class="col-md-4 col-sm-12 home-items">
        <?php if (get_theme_option('Display Featured Item')): ?>
        <div id="featured-item">
            <h2><?php echo __('Featured Item'); ?></h2>
            <?php echo random_featured_items(1); ?>
        </div>
        <?php endif; ?>
    </div>
    <div class="col-md-4 col-sm-12 home-collection">
    <?php if (get_theme_option('Display Featured Collection')): ?>
        <div id="featured-collection">
            <h2><?php echo __('Featured Collection'); ?></h2>
            <?php echo random_featured_collection(); ?>
        </div>
    <?php endif; ?>
    </div>
    <div class="col-md-4 col-sm-12 home-recents">
    <?php
        $recentItems = (integer) get_theme_option('Homepage Recent Items');
        if ($recentItems): ?>
        <div id="recent-items">
            <h2><?php echo __('Recently Added Items'); ?></h2>
            <?php echo recent_items($recentItems); ?>
            <p class="view-items-link"><a href="<?php echo html_escape(url('items')); ?>"><?php echo __('View All Items'); ?></a></p>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php fire_plugin_hook('public_home', array('view' => $this)); ?>

<?php echo foot();
