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
    <a href="http://www.wearinggayhistory.com/geolocation/map/browse" <img src='http://localhost:8888/wgh/themes/WearingGayHistoryTheme/images/mapimg.jpg' style="width:325px;"/>
    </div>
</div>









<?php echo foot(); ?>