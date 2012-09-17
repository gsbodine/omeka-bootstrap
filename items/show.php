<?php head(array('title' => item('Dublin Core', 'Title'), 'bodyid'=>'items','bodyclass' => 'show')); ?>
<div id="primary">
    <div class="pagination pagination-centered">
        <ul>
            <li id="previous-item" class="previous"><?php echo link_to_previous_item(); ?></li>
        </ul>
        <ul>
            <li id="next-item" class="next"><?php echo link_to_next_item(); ?></li>
        </ul>	
    </div>
    
    <div class="row">
        <div class="span12">
            <div class="page-header"><h1><?php echo item('Dublin Core', 'Title'); ?></h1></div>
        </div>
    </div>
    <div class="row">
        <div class="span6">
            <div class="row">
                <div class="span2">
                    <?php //echo custom_show_item_metadata(); ?>
                <!-- Date Information -->    
                    <h5><i class="icon-calendar"></i> Date: </h5>
                    <?php if ($itemDate = item('Dublin Core','Date')): // TODO: create a date format function...?>
                        <div class="lead"><?php echo $itemDate; ?></div>
                    <?php else: ?>
                        <div class="lead">None recorded.</div>
                    <?php endif; ?>
                </div>
                <div class="span2">
                    <!-- Recipient -->
                    <h5><i class="icon-"></i> Author: </h5>
                    <div class="lead">
                    <?php if ($itemCreator = item('Dublin Core','Creator')): // TODO: create a date format function...?>
                        <?php echo $itemCreator; ?>
                    <?php else: ?>
                        None recorded.
                    <?php endif; ?>
                    </div>
                </div>
                <div class="span2">
                    <!-- Recipient -->
                    <?php if ($itemRecipient): // TODO: create a date format function...?>
                        <h5><i class="icon-"></i> Recipient: </h5>
                        <div class="lead">
                            <?php echo $itemRecipient; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- If the item belongs to a collection, the following creates a link to that collection. -->
            <?php if (item_belongs_to_collection()): ?>
            <div id="collection" class="element">
                <h3><?php echo __('Collection'); ?></h3>
                <div class="element-text"><p><?php echo link_to_collection_for_item(); ?></p></div>
            </div>
            <?php endif; ?>
                
            <!-- The following prints a list of all tags associated with the item -->
            <div><i class="icon-tags"></i> <strong>Current Tags</strong></div>
            <div class="tags well well-small">
                <?php if (item_tags_as_string() != null) {
                    echo item_tags_as_string(); }
                    else {
                    echo 'No tags recorded for this item.'; 
                    }
                ?>
            </div>
            <?php echo plugin_append_to_items_show(); ?>
        
            <!-- The following prints a citation for this item. -->
            <div id="item-citation" class="element">
                <h3><?php echo __('Citation'); ?></h3>
                <div class="element-text"><?php echo item_citation(); ?></div>
            </div>
        </div>
        <!-- The following returns all of the files associated with an item. -->
        <div id="itemfiles" class="span6">
            <!-- <h3><?php echo __('Files'); ?></h3> -->
            <div class="element-text"><?php echo display_files_for_item(
                array('imageSize'=>'fullsize','linkToFile'=>true,'linkToMetadata'=>false),//options
                array('class'=>'file-image'), //wrapperAttributes
                null); 
        ?></div>
        </div>
    </div>
    <div class="row">
        <div class="span12">
            <div class="pagination pagination-centered">
                <ul>
                    <li id="previous-item" class="previous"><?php echo link_to_previous_item(); ?></li>
                </ul>
                <ul>
                    <li id="next-item" class="next"><?php echo link_to_next_item(); ?></li>
                </ul>
            </div>
        </div>
    </div>
        
</div><!-- end primary -->

<?php foot(); ?>
