<?php echo head(array('bodyid' => 'home')); ?>

<div class="row"><!--start sliderrow-->
    <div class="col-md-offset-1 col-md-10 col-md-offset-1">  
        <div id="ri-grid" class="ri-grid ri-grid-size-2 ri-shadow">
            <img class="ri-loading-image" src="images/loading.gif"/>
            <ul>
                <?php $items = get_random_featured_items('100', true); ?>

                <?php if ($items): ?>
                      
                <?php foreach ($items as $item): ?>
                <?php
                $title = metadata($item, array('Dublin Core', 'Title'));
                $description = metadata($item, array('Dublin Core', 'Description'), array('snippet' => 150));
                ?>   
                <li><?php if (metadata($item, 'has thumbnail')) {
                        echo link_to_item(
                            item_image('square_thumbnail', array('class' => ''), 0, $item),
                            array('class' => 'image'), 'show', $item
                        );
                    }
                    ?></li>
                <?php endforeach; ?>
                 <?php endif; ?>   

                
            </ul>
        </div>
    </div>
</div>


<div class="row home-features" id="home-tagline"> <!-- start tagline -->
    <div class="col-md-12">
        <h1 id="tagline">A Digital Archive of Historical LGBT T-Shirts</h1>

    </div>
</div>


<div class="row home-features"> <!-- start about & tag cloud -->
    <div class="col-md-4 home-stories"> <!--about-->
        <?php if ((get_theme_option('Display Featured Exhibit') !== '0')
            && plugin_is_active('ExhibitBuilder')
            && function_exists('exhibit_builder_display_random_featured_exhibit')): ?>
        <!-- Featured Exhibit -->
            <?php echo exhibit_builder_display_random_featured_exhibit(); ?>
        <?php endif; ?> 
    </div><!-- end about-->
    
    <div class="col-md-4 home-themes"> <!--tag cloud -->
    <h2 id="tagcloud"><?php echo __('Themes'); ?></h2>
        <?php echo tag_cloud(get_recent_tags(10), '/items/browse', 9); ?>
    </div>
    <div class="col-md-4 home-map">
    <h2>Map</h2>
    </div>
</div>

<div class="row home-features"> <!-- start featured exhibit and recent items -->
    <div class="col-md-8"> <!--feat exhibit-->
        <?php if ((get_theme_option('Display Featured Exhibit') !== '0')
            && plugin_is_active('ExhibitBuilder')
            && function_exists('exhibit_builder_display_random_featured_exhibit')): ?>
        <!-- Featured Exhibit -->
            <?php echo exhibit_builder_display_random_featured_exhibit(); ?>
        <?php endif; ?>    
    </div><!-- end feat exhibit-->
    
    <div class="col-md-4"> <!--recent items -->

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
                    <?php if($desc = metadata('item', array('Dublin Core', 'Description'), array('snippet' => 150))): ?>
                    <div class="item-description"><?php echo $desc; ?><?php echo link_to_item('see more', (array('class' => 'show'))); ?></div>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
            <?php else: ?>
            <p><?php echo __('No recent items available.'); ?></p>
            <?php endif; ?>
            <p class="view-items-link"><a href="<?php echo html_escape(url('items')); ?>"><?php echo __('View All Items'); ?></a></p>
        </div><!--end recent-items -->
    </div>
</div>






<?php echo foot(); ?>