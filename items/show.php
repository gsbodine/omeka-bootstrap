<?php
$pageTitle = metadata($item, array('Dublin Core', 'Title'));
echo head(array(
    'title' => $pageTitle,
    'bodyclass' => 'items show',
));
?>
<div id="primary">
    <div class="row form-group">
        <div class="col-xs-12">
            <nav class="pager">
                <ul>
                    <li id="previous-item" class="previous"><?php echo link_to_previous_item_show(); ?></li>
                </ul>
                <ul>
                    <li id="next-item" class="next"><?php echo link_to_next_item_show(); ?></li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="row page-header">
        <div class="col-xs-12">
            <h1><span class="glyphicon glyphicon-book"></span> <?php echo $pageTitle; ?></h1>
        </div>
    </div>
<?php if ($selectedMetadata = get_theme_option('Display Preselected Metadata')):
    echo common('show-selected-metadata', array('item' => $item));
else:
    // TODO Limit fields to display.
    // $fieldsToDisplay = get_theme_option('Display Dublin Core Fields');
?>
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-xs-12">
                    <?php echo all_element_texts($item); ?>
                </div>
            </div>

            <!-- If the item belongs to a collection, the following creates a link to that collection. -->
            <?php if (get_collection_for_item($item)): ?>
            <div class="row">
                <div class="col-xs-12">
                    <hr />
                    <div id="collection">
                        <h4 style="display:inline"><span class="glyphicon glyphicon-book"></span> <?php echo __('Collection'); ?>: </h4>
                        <h4 style="display:inline"><?php echo link_to_collection_for_item(); ?></h4>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- The following prints a list of all tags associated with the item -->
            <?php // if (metadata($item, 'has tags')): ?>
            <div class="row">
                <div class="col-xs-12">
                    <hr />
                    <h4><span class="fa fa-tags fa-large"></span> <?php echo __('Tags'); ?></h4>
                    <div class="tags well well-small">
                        <?php if (tag_string($item) != null):
                                echo tag_string($item);
                            else:
                                echo __('No tags recorded for this item.');
                            endif;
                        ?>
                    </div>
                </div>
            </div>
            <?php // endif; ?>
            <!-- The following prints a citation for this item. -->
            <div class="row">
                <div class="col-xs-12">
                    <hr />
                    <h4><span class="fa fa-retweet fa-lg"></span> <?php echo __('Citation'); ?></h4>
                    <div class="element-text"><?php echo metadata($item,'citation',array('no_escape' => true)); ?></div>
                </div>
            </div>
            <div class="row">
                <div id="item-output-formats" class="col-xs-12">
                    <hr />
                    <h4><span class="glyphicon glyphicon-export"></span> <?php echo __('Output Formats'); ?></h4>
                    <div class="element-text"><?php echo output_format_list(); ?></div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <hr />
                    <?php fire_plugin_hook('public_items_show', array('view' => $this, 'item' => $item)); ?>
                </div>
            </div>
        </div>
        <!-- The following returns all of the files associated with an item. -->
        <div id="itemfiles" class="col-md-6">
            <?php if (metadata($item, 'has files')): ?>
            <h3><?php echo metadata($item, 'file_count') == 1 ? __('File') : __('Files'); ?></h3>
            <div class="element-text"><?php echo custom_files_for_item(
                // This might be easier for future customization: https://omeka.org/codex/Display_Specific_Metadata_for_an_Item_File
                //options
                array(
                    'imageSize' => 'fullsize',
                    'linkToFile' => true,
                    'linkToMetadata'=>false,
                    'imgAttributes' => array('class' => 'img-responsive'),
                ),
                // wrapper
                array('class' => 'file-image'),
                null);
            ?></div>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>
    <br />
    <div class="row form-group">
        <div class="col-xs-12">
            <nav class="pager">
                <ul>
                    <li id="previous-item" class="previous"><?php echo link_to_previous_item_show(); ?></li>
                </ul>
                <ul>
                    <li id="next-item" class="next"><?php echo link_to_next_item_show(); ?></li>
                </ul>
            </nav>
        </div>
    </div>
</div><?php //end primary ?>
<?php echo foot();
