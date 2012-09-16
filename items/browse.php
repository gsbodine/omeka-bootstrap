<?php
$pageTitle = __('Browse Items');
head(array('title'=>$pageTitle,'bodyid'=>'items','bodyclass' => 'browse'));
?>

<!-- <div id="primary"> -->
    <div class="row">
        <div class="span12">
            <div class="page-header">
                <h1><?php echo $pageTitle;?> <small><?php echo __('(%s items total)', total_results()); ?></small></h1>
            </div>
        </div>
    </div>
    <ul class="nav nav-tabs" id="secondary-nav">
        <?php echo custom_nav_items(); ?>
    </ul>

    <div id="pagination-top" class="pagination pagination-centered">
        <?php echo pagination_links(); ?>
    </div>

    
<?php if (get_theme_option('Display Items Carousel') == '1'): ?>
    <div class="row"><div class="span8 offset2">
    <div id="itemsCarousel" class="carousel slide">
        <div class="carousel-inner">
    <?php while (loop_items()): ?>
            <div class="item">
                <?php if (item_has_thumbnail()): ?>
                <div class="carousel-img" style="text-align: center">
                    <?php echo link_to_item(item_thumbnail($props=array('class'=>'img-polaroid'))); ?>
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
                    <div class="tags"><p><strong><?php echo __('Tags'); ?>:</strong>
                        <?php echo item_tags_as_string(); ?></p>
                    </div>
                    <?php endif; ?>
                </div>
                <?php echo plugin_append_to_items_browse_each(); ?>
                </div>
        <?php endwhile; ?>
        </div>
        <a class="carousel-control left" href="#itemsCarousel" data-slide="prev">&lsaquo;</a>
        <a class="carousel-control right" href="#itemsCarousel" data-slide="next">&rsaquo;</a>
    </div>
    </div></div>
<?php else: ?>
    <?php while (loop_items()): ?>
<div class="item row">
<div class="span12">
    <div class="row">
        <div class="item-meta span12">
            <h2><?php echo link_to_item(item('Dublin Core', 'Title'), array('class'=>'permalink')); ?></h2>
        </div>
    </div>
    <div class="row">
        <div class="span3">
            <?php if (item_has_thumbnail()): ?>
                <div class="item-img">
                <?php echo link_to_item(item_square_thumbnail()); ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="span6">
            <?php if ($text = item('Item Type Metadata', 'Text', array('snippet'=>250))): ?>
                <div class="item-description">
                    <p><?php echo $text; ?></p>
                </div>
            <?php elseif ($description = item('Dublin Core', 'Description', array('snippet'=>250))): ?>
                <div class="item-description">
                    <?php echo $description; ?>
                </div>
            <?php endif; ?>
            <div>
                <h5>Citation</h5>
                <p class="citation"><?php echo item_citation(); ?></p>
            </div>
        </div>
        <div class="span3">
            <?php if (item_has_tags()): ?>
                <div class="tags well well-small">
                    <p><i class="icon-tags"></i> <strong>Tags</strong></p>
                    <?php echo item_tags_as_string(); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <hr />
</div>
</div>
<?php echo plugin_append_to_items_browse_each(); ?>
    <?php endwhile; ?>
<?php endif; ?>
    <div id="pagination-bottom" class="pagination pagination-centered">
        <?php echo pagination_links(); ?>
    </div>

    <?php echo plugin_append_to_items_browse(); ?>

<!-- </div>end primary -->

<?php foot(); ?>
