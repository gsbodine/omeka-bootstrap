<?php
$pageTitle = __('Browse Items');
echo head(array('title'=>$pageTitle,'bodyid'=>'items','bodyclass' => 'browse'));
?>

<!-- <div id="primary"> -->
    <div class="row">
        <div class="span12">
            <div class="page-header">
                <h1><?php echo $pageTitle;?> <small><?php echo __('(%s items total)', $total_results); ?></small></h1>
            </div>
        </div>
    </div>
    <div class="nav nav-tabs" id="secondary-nav">
        <?php echo public_nav_items()->setUlClass('nav nav-pills'); ?>
    </div>

    <div id="pagination-top" class="pagination pagination-centered">
        <?php echo pagination_links(); ?>
    </div>

    
<?php if (get_theme_option('Display Items Carousel') == '1'): ?>
    <div class="row">
        <div class="span8 offset2">
            <div id="itemsCarousel" class="carousel slide">
                <div class="carousel-inner">
                    <?php foreach(loop('items') as $item): ?>
                        <div class="item">
                        <?php if (item_has_thumbnail()): ?>
                            <div class="carousel-img" style="text-align: center">
                                <?php echo link_to_item(item_image('thumbnail',$props=array('class'=>'img-polaroid')),null,null,$item); ?>
                            </div>
                        <?php endif; ?>
                            <div class="carousel-caption">
                                <h4><?php echo link_to_item(item('Dublin Core', 'Title'), array('class'=>'permalink')); ?></h4>
                                <?php if ($description = item('Dublin Core', 'Description', array('snippet'=>250))): ?>
                                    <p class="item-description">
                                        <?php echo $description; ?>
                                    </p>
                                <?php elseif ($text = item('Item Type Metadata', 'Text', array('snippet'=>250))): ?>
                                    <div class="item-description">
                                        <?php echo $text; ?>
                                    </div>
                                <?php endif; ?>
                                <?php if (item_has_tags()): ?>
                                    <div class="browse-item-tags"><p><strong><?php echo __('Tags'); ?>:</strong>
                                        <?php echo item_tags_as_string(); ?></p>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <?php echo plugin_append_to_items_browse_each(); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <a class="carousel-control left" href="#itemsCarousel" data-slide="prev">&lsaquo;</a>
            <a class="carousel-control right" href="#itemsCarousel" data-slide="next">&rsaquo;</a>
            </div>
        </div>
    </div>
<?php else: ?>
<?php foreach(loop('items') as $item): ?>
<div class="item row">
<div class="span12">
    <div class="row">
        <div class="span2">
            <?php if (metadata($item, 'has thumbnail')): ?>
                <div class="item-img">
                <?php echo link_to_item(item_image('thumbnail')); ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="span7">
            <div class="item-title">
                <h3><?php echo link_to_item(metadata('item', array('Dublin Core', 'Title')), array('class'=>'permalink')); ?></h3>
            </div>
            <?php if ($text = metadata('item', array('Item Type Metadata', 'Text'))): ?>
                <div class="item-description">
                    <p><?php echo $text; ?></p>
                </div>
            <?php elseif ($description = metadata('item',array('Dublin Core', 'Description'))): ?>
                <div class="item-description">
                    <?php echo $description; ?>
                </div>
            <?php endif; ?>
            
            <?php if (get_collection_for_item($item)): ?>
                <p><div><strong><?php echo __('Collection'); ?></strong></div>
                <div class="element-text"><?php echo link_to_collection_for_item(); ?></div></p>
            <?php endif; ?>
            
            <!-- <div>
                <h5>Citation</h5>
                <p class="citation"><?php //echo item_citation(); ?></p>
            </div> -->
        </div>
        <div class="span3">
            <?php if (metadata($item,'has tags')): ?>
                <div class="browse-items-tags well well-small">
                    <p><i class="icon-tags"></i> <strong>Tags</strong></p>
                    <?php echo tag_string($item); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <hr />
</div>
</div>
<?php fire_plugin_hook('public_items_browse_each', array('view' => $this, 'item' =>$item)); ?>
<?php endforeach; ?>
<?php endif; ?>
    <div id="pagination-bottom" class="pagination pagination-centered">
        <?php echo pagination_links(); ?>
    </div>

    <?php fire_plugin_hook('public_items_browse', array('items'=>$items, 'view' => $this)); ?>

<!-- </div>end primary -->

<?php echo foot(); ?>
