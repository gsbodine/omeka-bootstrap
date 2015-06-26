<?php echo head(array('bodyid' => 'home')); ?>

<aside id="intro" role="introduction">
    <p><?php echo option('description'); ?></p>
</aside>

<div class="row">
    <div class="col-sm-12 col-md-12">
        <?php if (get_theme_option('Homepage Text')): ?>
        <p><?php echo get_theme_option('Homepage Text'); ?></p>
        <?php endif; ?>
        <?php fire_plugin_hook('public_content_top', array('view' => $this)); ?>
    </div>
</div>


<div class="row" id="featured-row">
    <div class="col-sm-4 col-md-4" >

        <?php if (get_theme_option('Display Featured Item') !== '0'): ?>
        <!-- Featured Item -->
        <div id="featured-item">
            <h2><?php echo __('Featured Item'); ?></h2>
            <?php echo random_featured_items(1); ?>
        </div><!--end featured-item-->
        <?php endif; ?>
    </div>
    <div class="col-sm-4 col-md-4">
        <?php if ((get_theme_option('Display Featured Exhibit') !== '0')
                && plugin_is_active('ExhibitBuilder')
                && function_exists('exhibit_builder_display_random_featured_exhibit')): ?>
        <!-- Featured Exhibit -->
        <?php echo exhibit_builder_display_random_featured_exhibit(); ?>
        <?php endif; ?>
    </div>
    <div class="col-sm-4 col-md-4">
        <div id="recent-items">
            <h2><?php echo __('Recently Added Items'); ?></h2>
            <?php
                $homepageRecentItems = (int)get_theme_option('Homepage Recent Items') ? get_theme_option('Homepage Recent Items') : '3';
                set_loop_records('items', get_recent_items($homepageRecentItems));
                if (has_loop_records('items')):
            ?>
            <div class="items-list">
                <?php foreach (loop('items') as $item): ?>
                <div class="item">
                    <h3><?php echo link_to_item(); ?></h3>
                    <?php if (metadata('item', 'has thumbnail')): ?>
                    <div class="item-img">
                        <?php echo link_to_item(item_image('square_thumbnail', array('class' => 'img-responsive'))); ?>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
            <?php else: ?>
            <p><?php echo __('No recent items available.'); ?></p>
            <?php endif; ?>            
        </div><!--end recent-items -->
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <?php fire_plugin_hook('public_home', array('view' => $this)); ?>
    </div>
</div>
<?php echo foot(); ?>
