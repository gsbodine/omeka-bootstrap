<?php
$carousel = get_theme_option('display_items_carousel');
if ($carousel) {
    queue_css_file(array(
        'vendor/owl-carousel/owl.carousel',
        'vendor/owl-carousel/owl.transitions',
        'owl.theme',
    ));
    queue_js_file('vendor/owl-carousel/owl.carousel.min');
}

$pageTitle = __('Browse Items');
echo head(array(
    'title' => $pageTitle,
    'bodyclass' => 'items browse',
));
?>
<div id="primary">
    <div class="row page-header">
        <div class="col-xs-12">
        <h1><span class="glyphicon glyphicon-list"></span> <?php echo $pageTitle;?> <small><?php echo __('(%s items total)', $total_results); ?></small></h1>
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
<?php
    if ($total_results > 1):
        $sortLinks[__('Title')] = 'Dublin Core,Title';
        $sortLinks[__('Creator')] = 'Dublin Core,Creator';
        $sortLinks[__('Date Added')] = 'added';
    ?>
    <div class="row">
        <div class="col-xs-12">
            <div id="sort-links" class="pull-right">
                <span class="sort-label label label-default"><?php echo __('Sort by:'); ?></span>
                    <?php
                        echo bootstrap_browse_sort_links($sortLinks, array(
                            'list_attr' => array('id' => 'sort-links-list', 'class' => 'btn-group', 'role' => 'group', 'aria-label' => __('Sort by:')),
                            'link_attr' => array('class' => 'btn btn-default btn-sm'),
                        ));
                    ?>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php if ($carousel): ?>
    <div class="row">
        <div class="col-lg-offset-2 col-lg-8">
            <div id="owl-carousel" class="owl-carousel">
                <?php foreach(loop('items') as $item): ?>
                <div class="item">
                <div class="carousel-img" style="text-align: center">
                <?php if (metadata($item, 'has thumbnail')): ?>
                    <?php echo link_to_item(item_image('thumbnail', array('class' => 'img-responsive img-polaroid')), null, null, $item); ?>
                <?php else: ?>
                    <div class="image none"></div>
                 <?php endif; ?>
                    </div>
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
        </div>
    </div>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $("#owl-carousel").owlCarousel( {
            items: <?php echo count($items); ?>,
            singleItem: true,
            autoPlay: true,
            slideSpeed: 400,
            paginationSpeed: 1000,
            stopOnHover: false,
            transitionStyle: "fade"
        });
    });
</script>
<?php else: ?>
<?php foreach(loop('items') as $item): ?>
    <div class="item">
        <div class="row">
            <div class="col-sm-2">
                <div class="item-img">
            <?php if (metadata($item, 'has thumbnail')): ?>
                    <?php echo link_to_item(item_image('thumbnail', array('class' => 'image img-responsive'))); ?>
            <?php else: ?>
                    <div class="image none"></div>
            <?php endif; ?>
                </div>
            </div>
            <div class="col-sm-7">
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
            <div class="col-sm-3">
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
 </div> <?php // end primary. ?>

<?php echo foot();
