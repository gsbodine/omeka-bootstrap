<?php head(array('bodyid'=>'home')); ?>
    <div id="primary">
    <?php if (get_theme_option('Homepage Text')): ?>
        <div class="row">
            <div class="span12">
                <p class="lead"><?php echo get_theme_option('Homepage Text'); ?></p>
            </div>
        </div>
    <?php endif; ?>
        
    <div class="row">
    <?php if (get_theme_option('Display Featured Item') !== '0'): ?>
        <div class="span6">
            <!-- Featured Item -->
            <div id="featured-item" class="well">
                <?php echo display_random_featured_item(); ?>
            </div><!--end featured-item-->
        </div>
    <?php else: ?>
        <div class="span6"></div>
    <?php endif; ?>
        
    <?php if (get_theme_option('Display Featured Collection') !== '0'): ?>
        <div class="span6">   
            <!-- Featured Collection -->
            <div id="featured-collection" class="well">
                <?php echo display_random_featured_collection(); ?>
            </div><!-- end featured collection -->
        </div>
    <?php else: ?>
        <div class="span6"></div>
    <?php endif; ?>
    </div><!-- end row -->
   
    <?php if ((get_theme_option('Display Featured Exhibit') !== '0')
                    && plugin_is_active('ExhibitBuilder')
                    && function_exists('exhibit_builder_display_random_featured_exhibit')): ?>
    <div class="row">
        <div class="span12"><hr /></div>   
    </div>
    <div class="row">
        <div class="span12">
            <!-- Featured Exhibit -->
            <?php echo exhibit_builder_display_random_featured_exhibit(); ?>
        </div>
        </div>
    <?php endif; ?>
    </div><!-- end primary -->

    <div id="secondary">
        <div id="recent-items">
        <?php
        $homepageRecentItems = (int)get_theme_option('Homepage Recent Items');
        if ($homepageRecentItems > 0) { set_items_for_loop(recent_items($homepageRecentItems)); }
        if (has_items_for_loop()):
        ?>
        <div class="row">
            <div class="span12"><hr /></div>   
        </div>
            
        <div class="row">
            <div class="span12">
                <h2><?php echo __('Recently Added Items'); ?></h2>
            </div>
        </div>   
        <div class="row-fluid">
            <ul class="thumbnails">
            <?php while (loop_items()): ?>
                <li class="span4">
                    <div class="thumbnail" style="padding-left:1em;padding-right:1em;text-align:center;">
                        <h3><?php echo link_to_item(); ?></h3>
                        <?php if(item_has_thumbnail()): ?>
                            <div class="item-img">
                                <?php echo link_to_item(item_thumbnail($props=array('class'=>'img-rounded','style'=>'margin:1em'))); ?>
                            </div>
                        <?php endif; ?>
                        <?php if($desc = item('Dublin Core', 'Description', array('snippet'=>150))): ?>
                                <p style="text-align: left"><?php echo $desc; ?><?php echo link_to_item('see more',(array('class'=>'show'))) ?></p>
                        <?php endif; ?>
                    </div>
                </li>
            <?php endwhile; ?>
            </ul>
        </div><!-- end row -->
        <?php endif; ?>
        </div>
        </div>

    </div><!-- end secondary -->
</div>

<?php foot(); ?>