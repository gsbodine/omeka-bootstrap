<?php echo head(array(
    'title' => metadata('item', array('Dublin Core', 'Title')),
    'bodyclass' => 'items show',
)); ?>
<h1><?php echo metadata('item', array('Dublin Core', 'Title')); ?></h1>
<div id="primary">
    <div class="row">
        <div class="col-sm-6 col-md-6">
            <?php if ((get_theme_option('Item FileGallery') == 0) && metadata('item', 'has files')): ?>
            <?php echo files_for_item(
                array(
                    'imageSize' => 'fullsize',
                    'linkToFile' => true,
                    'imgAttributes' => array('class' => 'img-responsive'),
                ), //options
                array('class' => 'file-image')); ?>
            <?php endif; ?>
        </div>
        <div class="col-sm-6 col-md-6">
            <?php echo all_element_texts('item'); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <?php fire_plugin_hook('public_items_show', array('view' => $this, 'item' => $item)); ?>
        </div>
    </div>
</div><!-- end primary -->

<aside id="sidebar">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <!-- The following returns all of the files associated with an item. -->
            <?php if ((get_theme_option('Item FileGallery') == 1) && metadata('item', 'has files')): ?>
            <div id="itemfiles" class="element">
                <h2><?php echo __('Files'); ?></h2>
                <?php echo item_image_gallery(); ?>
            </div>
            <?php endif; ?>

            <!-- If the item belongs to a collection, the following creates a link to that collection. -->
            <?php if (metadata('item', 'Collection Name')): ?>
            <div id="collection" class="element">
                <h2><?php echo __('Collection'); ?></h2>
                <div class="element-text"><p><?php echo link_to_collection_for_item(); ?></p></div>
            </div>
            <?php endif; ?>

            <!-- The following prints a list of all tags associated with the item -->
            <?php if (metadata('item', 'has tags')): ?>
            <div id="item-tags" class="element">
                <h2><?php echo __('Tags'); ?></h2>
                <div class="element-text"><?php echo tag_string('item'); ?></div>
            </div>
            <?php endif;?>

            <!-- The following prints a citation for this item. -->
            <div id="item-citation" class="element">
                <h2><?php echo __('Citation'); ?></h2>
                <div class="element-text"><?php echo metadata('item', 'citation', array('no_escape' => true)); ?></div>
            </div>
        </div>
    </div>
</aside>

<ul class="item-pagination navigation pager">
    <li id="previous-item" class="previous"><?php echo link_to_previous_item_show(); ?></li>
    <li id="next-item" class="next"><?php echo link_to_next_item_show(); ?></li>
</ul>

<?php echo foot(); ?>
