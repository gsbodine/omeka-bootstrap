<?php echo head(array('bodyid' => 'home')); ?>

<div class="row"><!--start sliderrow-->
    <div class="col-md-12">  
        <div class="slider-pro " id="my-slider">
            <div class="sp-slides">
                <?php $items = get_random_featured_items('5', true); ?>

                <?php if ($items): ?>
                      
                <?php foreach ($items as $item): ?>
                <?php
                $title = metadata($item, array('Dublin Core', 'Title'));
                $description = metadata($item, array('Dublin Core', 'Description'), array('snippet' => 150));
                ?>   
                <div class="sp-slide">
                    <!-- Get the image -->
                    <?php if (metadata($item, 'has thumbnail')) {
                        echo link_to_item(
                            item_image('fullsize', array('class' => 'sp-image'), 0, $item),
                            array('class' => 'image'), 'show', $item
                        );
                    }
                    ?>
                </div> <!--close sp-slide -->
                <?php endforeach; ?>
                    <div class="sp-thumbnails">
                    <?php foreach ($items as $item2): ?>  
                    <?php
                     $title2 = metadata($item2, array('Dublin Core', 'Title'));
                    $description2 = metadata($item2, array('Dublin Core', 'Description'), array('snippet' => 150));
                    ?>

                    <div class="sp-thumbnail">
                        <div class="sp-thumnail-title"><?php echo link_to($item2, 'show', strip_formatting($title2)); ?></div>
                        <?php if ($description2): ?>
                        <div class="sp-thumbnail-description"><?php echo $description2; ?></div>
                    </div>
                            
                     <?php endif; ?>   
                    <?php endforeach; ?>

                <?php else: ?>
                    <p><?php echo __('No featured items are available.'); ?></p>
                <?php endif; ?>
                 </div>
            </div> <!-- close sp-slides -->
        </div> <!-- close slider-pro -->
    </div>      
</div> <!--end slider row-->


<div class="row home-features"> <!-- start tagline -->
    <div class="col-md-12">
        <h1 id="tagline">"If you want to have clean ideas, change them as often as your shirt."  -Francis Picabia</h1>

    </div>
</div>


<div class="row home-features"> <!-- start about & tag cloud -->
    <div class="col-md-8"> <!--about-->
        <?php if (get_theme_option('Homepage Text')): ?>
            <p><?php echo get_theme_option('Homepage Text'); ?></p>
        <?php endif; ?>
        <?php fire_plugin_hook('public_content_top', array('view' => $this)); ?>
    </div><!-- end about-->
    
    <div class="col-md-4"> <!--tag cloud -->
    <h2><?php echo __('Tag Cloud'); ?></h2>
        <?php echo tag_cloud(get_recent_tags(10), '/items/browse'); ?>
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
