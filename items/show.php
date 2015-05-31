<?php echo head(array(
    'title' => metadata('item', array('Dublin Core', 'Title')),
    'bodyclass' => 'items show',
)); ?>
<div id="container">
    <div class="row">
        <div class="col-md-12">
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
    <div class="row">
        <div class="col-md-12">
            <?php echo flash(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="page-header"><h1><?php echo metadata($item,array('Dublin Core', 'Title')); ?></h1></div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <!-- Item Description -->
            <div class="row">
                <div class="col-md-12">
                    <h4><i class="fa fa-thumb-tack fa-lg"></i> Description: </h4>
                    <?php if ($itemDescription = metadata($item,array('Dublin Core','Description'))): ?>
                        <p class="lead"><?php echo $itemDescription; ?></p>
                    <?php else: ?>
                        <h4>Description</h4>
                        <p class="alert"><strong>Sorry!</strong> No description recorded yet.</p>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Item Collection Information (if available) -->
            <?php if (get_collection_for_item($item)): ?>
            <div class="row"><div class="col-md-12">
                <div id="collection" class="element">
                    <h4 style="display:inline"><?php echo __('Collection'); ?>: </h4>
                    <h4 style="display:inline"><?php echo link_to_collection_for_item(); ?></h4>
                </div>
            </div></div>
            <?php endif; ?>
            
            <div class="row"><div class="col-md-12"><hr /></div></div>
            
            <div class="row">
                <div class="col-md-4">
                <!-- Item Date Information -->    
                    <h4><i class="fa fa-calendar fa-lg"></i> Date: </h5>
                    <?php if ($itemDate = metadata($item,array('Dublin Core','Date'))): // TODO: create a date format function...?>
                        <div><?php echo $itemDate; ?></div>
                    <?php else: ?>
                        <div>None recorded.</div>
                    <?php endif; ?>
                </div>
                <div class="col-md-4">
                <!-- Item Creator Information -->
                    <h4><i class="fa fa-user fa-lg"></i> Author: </h4>
                    <div>
                    <?php if ($itemCreator = metadata($item,array('Dublin Core','Creator'))): ?>
                        <?php echo $itemCreator; ?>
                    <?php else: ?>
                        None recorded.
                    <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-4">
                <!-- Item Recipient Information (if available) -->
                  <h4><i class="fa fa-archive fa-lg"></i> Source: </h4>
                    <div>
                    <?php if ($itemCreator = metadata($item,array('Dublin Core','Source'))): ?>
                        <?php echo $itemCreator; ?>
                    <?php else: ?>
                        None recorded.
                    <?php endif; ?>
                    </div>
                    
                </div>
            </div>
            
            <!-- If the item belongs to a collection, the following creates a link to that collection. -->
            
                
            <!-- The following prints a list of all tags associated with the item -->
            <div class="row">
                <div class="col-md-12">
                    <hr />
                    <h4><i class="fa fa-tags fa-large"></i> Tags</h4>
                    <div class="tags well well-small">
                        <?php if (tag_string($item) != null) {
                            echo tag_string($item); }
                            else {
                            echo 'No tags recorded for this item.'; 
                            }
                        ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <hr />
                    <!-- The following prints a citation for this item. -->
                    <h4><i class="fa fa-retweet fa-lg"></i> <?php echo __('Citation'); ?></h4>
                    <div class="element-text"><?php echo metadata($item,'citation',array('no_escape' => true)); ?></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?php fire_plugin_hook('public_items_show', array('view' => $this, 'item' => $item)); ?>
                </div>
            </div>
        </div>
        <!-- The following returns all of the files associated with an item. -->
        <div id="itemfiles" class="col-md-6">
            <!-- <h3><?php echo __('Files'); ?></h3> -->
            
           
            <div class="element-text"><?php echo files_for_item(
                array('imageSize'=>'fullsize','linkToFile'=>true,'linkToMetadata'=>false),//options
                array('class'=>'file-image'),
                null); 
        ?></div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <nav class="pager">
                <ul>
                    <li id="previous-item" class="previous"><?php echo link_to_previous_item_show(); ?></li>
                </ul>
                <ul>
                    <li id="next-item" class="next"><?php echo link_to_next_item_show(); ?></li>
                </ul>
        </div>
    </div>
        
</div>
<!-- end primary -->

<?php echo foot(); ?>