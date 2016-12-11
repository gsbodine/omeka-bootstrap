<?php echo head(array('bodyid' => 'home')); ?>

<?php if (get_theme_option('Display Grid Rotator')): ?>
<div class="row"><!--start sliderrow-->
    <div class="col-md-offset-1 col-md-10 col-md-offset-1">
        <div id="ri-grid" class="ri-grid ri-grid-size-2 ri-shadow">
            <img class="ri-loading-image" src="<?php echo src('images/loading.gif'); ?>"/>
            <ul>
                <?php $items = get_random_featured_items('100', true); ?>
                <?php foreach ($items as $item): ?>
                <li><?php
                    echo link_to_item(
                        item_image('square_thumbnail', array('class' => ''), 0, $item),
                        array('class' => 'image'), 'show', $item); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>
<?php endif; ?>

<div class="row home-features" id="home-tagline"> <!-- start tagline -->
    <div class="col-md-12">
        <h1 id="tagline"><?php echo option('site_title'); ?></h1>
    </div>
</div>

<div class="row home-features"> <!-- start about & tag cloud -->
    <div class="col-md-4 col-sm-12 home-stories"> <!--about-->
        <?php if ((get_theme_option('Display Featured Exhibit') !== '0')
            && plugin_is_active('ExhibitBuilder')
            && function_exists('exhibit_builder_display_random_featured_exhibit')): ?>
        <!-- Featured Exhibit -->
            <?php echo exhibit_builder_display_random_featured_exhibit(); ?>
        <?php endif; ?>
    </div><!-- end about-->

    <div class="col-md-4 col-sm-12 home-themes"> <!--tag cloud -->
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
<?php echo foot();
