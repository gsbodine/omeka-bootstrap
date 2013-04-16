<?php 
    echo head(array('title' => metadata($item,array('Dublin Core', 'Title')), 'bodyid'=>'items','bodyclass' => 'show')); 
    $item = $this->item;
    ?>
<div id="primary">
    <div class="row">
        <div class="span8">
            <div class="pagination pagination-centered" style="margin-top:0;margin-bottom:0;">
                <ul>
                    <li id="previous-item" class="previous"><?php echo link_to_previous_item_show(); ?></li>
                </ul>
                <ul>
                    <li id="next-item" class="next"><?php echo link_to_next_item_show(); ?></li>
                </ul>
            </div>
        </div>
        <div class="span4">
            <div class="pull-right">
                <a href="/items/show/<?php echo $this->itemEditing()->getRandomUneditedItem($this->_db)->id; ?>"><span class="btn btn-success"><i class="icon-edit"></i> Show me a random, unedited document</span></a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="span12">
            <?php echo flash(); ?>
        </div>
    </div>
    <div class="row">
        <div class="span12">
            <div class="page-header"><h1><?php echo metadata($item,array('Dublin Core', 'Title')); ?></h1></div>
        </div>
    </div>
    <div class="row">
        <div class="span6">
            <!-- Item Description -->
            <div class="row">
                <div class="span6">
                    <?php if ($itemDescription = metadata($item,array('Dublin Core','Description'))): ?>
                        <p class="lead"><?php echo $itemDescription; ?></p>
                    <?php else: ?>
                        <h4>Description</h4>
                        <p class="alert"><strong>Sorry!</strong> No description recorded yet. <?php echo $this->participateLinks()->createParticipateLink($item," Provide a description!","icon-edit"); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Item Collection Information (if available) -->
            <?php if (get_collection_for_item($item)): ?>
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
                    <h4><i class="icon-calendar"></i> Date: </h5>
                    <?php if ($itemDate = metadata($item,array('Dublin Core','Date'))): // TODO: create a date format function...?>
                        <div><?php echo $itemDate; ?></div>
                    <?php else: ?>
                        <div>None recorded.</div>
                    <?php endif; ?>
                </div>
                <div class="span2">
                <!-- Item Creator Information -->
                    <h4><i class="icon-user"></i> Author(s): </h4>
                    <div>
                    <?php if ($itemCreator = metadata($item,array('Dublin Core','Creator'),'all')): ?>
                        <?php foreach ($itemCreator as $author) {
                            echo $author . '<br />';
                        } ?>
                    <?php else: ?>
                        None recorded.
                    <?php endif; ?>
                    </div>
                </div>
                <div class="span2">
                <!-- Item Recipient Information (if available) -->
                    <?php 
                        $itemRecipients = metadata($item,array('Item Type Metadata','Recipient'),'all');
                        if (count($itemRecipients) > 0) {
                            echo '<h4><i class="icon-envelope"></i> Recipient: </h4><div>';
                            foreach ($itemRecipients as $itemRecipient) {
                                echo $itemRecipient . '<br />'; 
                            }
                            echo '</div>';
                        }
                    ?>
                </div>
            </div>
                
            <!-- The following prints a list of all tags associated with the item -->
            <div class="row">
                <div class="span6">
                    <hr />
                    <h4><i class="icon-tags"></i> Tags</h4>
                    <div class="tags well well-small">
                        <?php if (tag_string($item) != null) {
                            echo tag_string($item); }
                            else {
                                echo 'No tags recorded for this item. ';
                                echo $this->participateLinks()->createParticipateLink($item,"Tag me!","icon-tag"); 
                            }
                        ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="span6">
                    <hr />
                    <!-- The following prints a citation for this item. -->
                    <h4><i class="icon-share"></i> <?php echo __('Citation'); ?></h4>
                    <div class="element-text"><?php echo metadata($item,'citation',array('no_escape' => true)); ?></div>
                </div>
            </div>
            <div class="row">
                <div class="span6">
                    <?php fire_plugin_hook('public_items_show', array('view' => $this, 'item' => $item)); ?>
                </div>
            </div>
        </div>
        <!-- The following returns all of the files associated with an item. -->
        <div id="itemfiles" class="span6">
            <!-- <h3><?php echo __('Files'); ?></h3> -->
            <p class="lead" style="text-align:center;">Item Identification #: <?php echo metadata($item,array('Dublin Core','Identifier')); ?></p>
           
            <div class="element-text"><?php echo files_for_item(
                array('imageSize'=>'fullsize','linkToFile'=>true,'linkToMetadata'=>false),//options
                array('class'=>'file-image'),
                null); 
        ?></div>
        </div>
    </div>
    <div class="row">
        <div class="span12">
            <div class="pagination pagination-centered">
                <ul>
                    <li id="previous-item" class="previous"><?php echo link_to_previous_item_show(); ?></li>
                </ul>
                <ul>
                    <li id="next-item" class="next"><?php echo link_to_next_item_show(); ?></li>
                </ul>
            </div>
        </div>
    </div>
        
</div>
<!-- end primary -->

<?php echo foot(); ?>
