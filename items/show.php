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
            <!-- Item Description -->
            <div class="row">
                <div class="span6">
                    <?php if ($itemDescription = item('Dublin Core','Description')): ?>
                        <p class="lead"><?php echo $itemDescription; ?></p>
                    <?php else: ?>
                        <h4>Description</h4>
                        <p class="alert"><strong>Sorry!</strong> No description recorded.</p>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Item Collection Information (if available) -->
            <?php if (item_belongs_to_collection()): ?>
            <div class="row"><div class="span6">
                <div id="collection" class="element">
                    <h4 style="display:inline"><?php echo __('Collection'); ?>: </h4>
                    <h4 style="display:inline"><?php echo link_to_collection_for_item(); ?></h4>
                </div>
            </div></div>
            <?php endif; ?>
            
            <div class="row"><div class="span6"><hr /></div></div>
            
            <div class="row">
                <div class="span2">
                <!-- Item Date Information -->    
                    <h4><i class="icon-calendar icon-large"></i> Date: </h5>
                    <?php if ($itemDate = item('Dublin Core','Date')): // TODO: create a date format function...?>
                        <div class="lead"><?php echo $itemDate; ?></div>
                    <?php else: ?>
                        <div class="lead">None recorded.</div>
                    <?php endif; ?>
                </div>
                <div class="span2">
                <!-- Item Creator Information -->
                    <h4><i class="icon-user icon-large"></i> Author: </h4>
                    <div class="lead">
                    <?php if ($itemCreator = item('Dublin Core','Creator')): // TODO: create a date format function...?>
                        <?php echo $itemCreator; ?>
                    <?php else: ?>
                        None recorded.
                    <?php endif; ?>
                    </div>
                </div>
                <div class="span2">
                <!-- Item Recipient Information (if available) -->
                    <?php if ($itemRecipient = item('Item Type Metadata','Recipient')): // TODO: create a date format function...?>
                        <h4><i class="icon-envelope icon-large"></i> Recipient: </h4>
                        <div class="lead">
                            <?php echo $itemRecipient; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- If the item belongs to a collection, the following creates a link to that collection. -->
            
                
            <!-- The following prints a list of all tags associated with the item -->
            <div class="row"><div class="span6">
                <hr />
                <h4><i class="icon-tags icon-large"></i> Tags</h4>
                <div class="tags well well-small">
                    <div><strong>Current Tags</strong></div>
                    <?php if (item_tags_as_string() != null) {
                        echo item_tags_as_string(); }
                        else {
                        echo 'No tags recorded for this item.'; 
                        }
                    ?>
                </div>
            </div></div>
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
