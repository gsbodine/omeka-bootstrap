<?php
$pageTitle = __('Browse Items');
echo head(array(
    'title' => $pageTitle,
    'bodyclass' => 'items browse',
));
?>
<div id="primary">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="page-header">
                <h1><span class="glyphicon glyphicon-list"></span> <?php echo $pageTitle;?> <small><?php echo __('(%s items total)', $total_results); ?></small></h1>
            </div>
        </div>
    </div>
    <nav class="items-nav navigation secondary-nav">
        <?php echo public_nav_items()->setUlClass('nav nav-pills'); ?>
    </nav>
<?php if ($searchFilters = item_search_filters()): ?>
    <div class="bs-callout bs-callout-info">
        <?php echo $searchFilters; ?>
    </div>
<?php endif; ?>
<?php if ($paginationLinks = pagination_links()): ?>
    <div id="pagination-top">
        <?php echo $paginationLinks; ?>
    </div>
<?php endif; ?>
<?php if (get_theme_option('Display Items Carousel')): ?>
    <div class="row">
        <div class="col-lg-offset-2 col-sm-8 col-md-8">
            <div id="itemsCarousel" class="carousel slide">
                <div class="carousel-inner">
                <?php foreach(loop('items') as $item): ?>
                    <div class="item">
                    <?php if (metadata($item, 'has thumbnail')): ?>
                        <div class="carousel-img" style="text-align: center">
                            <?php echo link_to_item(item_image('thumbnail', array('class' => 'img-responsive img-polaroid')), null, null, $item); ?>
                        </div>
                    <?php endif; ?>
                        <div class="carousel-caption">
                            <h4><?php echo link_to_item(metadata('item', array('Dublin Core', 'Title')), array('class' => 'permalink')); ?></h4>
                            <?php if ($description = metadata('item', array('Dublin Core', 'Description'), array('snippet' => 250))): ?>
                                <p class="item-description">
                                    <?php echo $description; ?>
                                </p>
                            <?php elseif ($text = metadata('item', array('Item Type Metadata', 'Text'), array('snippet' => 250))): ?>
                                <div class="item-description">
                                    <?php echo $text; ?>
                                </div>
                            <?php endif; ?>
                            <?php if (metadata('item', 'has tags')): ?>
                                <div class="browse-item-tags"><p><strong><?php echo __('Tags'); ?>:</strong>
                                    <?php echo tag_string('items'); ?></p>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php fire_plugin_hook('public_items_browse_each', array('view'  =>  $this, 'item' => $item)); ?>
                    </div>
                <?php endforeach; ?>
                </div>
            <a class="carousel-control left" href="#itemsCarousel" data-slide="prev">‹</a>
            <a class="carousel-control right" href="#itemsCarousel" data-slide="next">›</a>
            </div>
        </div>
    </div>
<?php else: ?>
<?php foreach(loop('items') as $item): ?>
    <div class="item">
        <div class="row">
            <div class="col-sm-2 col-md-2">
            <?php if (metadata($item, 'has thumbnail')): ?>
                <div class="item-img">
                    <?php echo link_to_item(item_image('thumbnail', array('class' => 'image img-responsive'))); ?>
                </div>
            <?php else: ?>
                <div class="item-img">
                    <div class="image none"></div>
                </div>
            <?php endif; ?>
            </div>
            <div class="col-sm-7 col-md-7">
                <div class="item-title">
                    <h3><?php echo link_to_item(metadata('item', array('Dublin Core', 'Title')), array('class' => 'permalink', 'snippet' => 250)); ?></h3>
                </div>
                <?php if ($text = metadata('item', array('Item Type Metadata', 'Text'), array('snippet' => 250))): ?>
                <div class="item-description">
                    <p><?php echo $text; ?></p>
                </div>
                <?php elseif ($description = metadata('item',array('Dublin Core', 'Description'), array('snippet' => 250))): ?>
                <div class="item-description">
                    <?php echo $description; ?>
                </div>
                <?php endif; ?>
                <?php if (get_collection_for_item($item)): ?>
                <div><strong><?php echo __('Collection'); ?></strong></div>
                <div class="element-text"><?php echo link_to_collection_for_item(); ?></div>
                <?php endif; ?>
                <?php /* <div>
                    <h5><?php echo __('Citation'); ?></h5>
                    <p class="citation"><?php echo item_citation(); ?></p>
                </div> */ ?>
            </div>
            <div class="col-sm-3 col-md-3">
                <?php if (metadata($item,'has tags')): ?>
                <div class="browse-items-tags well well-sm">
                    <p><i class="fa fa-tag"></i> <strong><?php echo __('Tags'); ?></strong></p>
                    <?php echo tag_string($item); ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <hr />
    </div>
<?php fire_plugin_hook('public_items_browse_each', array('view'  =>  $this, 'item' => $item)); ?>
<?php endforeach; ?>
<?php endif; ?>
<?php if ($paginationLinks): ?>
    <div id="pagination-bottom">
        <?php echo $paginationLinks; ?>
    </div>
<?php endif; ?>
    <?php fire_plugin_hook('public_items_browse', array('items' => $items, 'view' => $this)); ?>
 </div> <!-- end primary. -->
<?php echo foot();
