<div class="row">
    <div class="col-md-6">
        <!-- Item Description -->
        <div class="row">
            <div class="col-xs-12">
                <h4><span class="fa fa-thumb-tack fa-lg"></span> <?php echo __('Description'); ?></h4>
                <?php if ($itemDescription = metadata($item,array('Dublin Core','Description'))): ?>
                    <p class="lead"><?php echo $itemDescription; ?></p>
                <?php else: ?>
                    <p class="alert"><strong><?php echo __('Sorry!'); ?></strong> <?php echo __('No description recorded yet.'); ?></p>
                <?php endif; ?>
            </div>
        </div>

        <!-- If the item belongs to a collection, the following creates a link to that collection. -->
        <?php if (get_collection_for_item($item)): ?>
        <div class="row"><div class="col-xs-12">
            <hr />
            <div id="collection">
                <h4 style="display:inline"><span class="glyphicon glyphicon-book"></span> <?php echo __('Collection'); ?>: </h4>
                <h4 style="display:inline"><?php echo link_to_collection_for_item(); ?></h4>
            </div>
        </div></div>
        <?php endif; ?>

        <div class="row">
            <div class="col-xs-12">
            <hr />
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
            <!-- Item Date Information -->
                <h4><span class="fa fa-calendar fa-lg"></span> <?php echo __('Date'); ?></h4>
                <?php if ($itemDate = metadata($item,array('Dublin Core','Date'))): // TODO: create a date format function or filter...?>
                    <div><?php echo $itemDate; ?></div>
                <?php else: ?>
                    <div><?php echo __('None recorded'); ?></div>
                <?php endif; ?>
            </div>
            <div class="col-md-4">
            <!-- Item Creator Information -->
                <h4><span class="fa fa-user fa-lg"></span> <?php echo __('Creator'); ?></h4>
                <div>
                <?php if ($itemCreator = metadata($item, array('Dublin Core', 'Creator'))): ?>
                    <?php echo $itemCreator; ?>
                <?php else: ?>
                    <?php echo __('None recorded'); ?>
                <?php endif; ?>
                </div>
            </div>
            <div class="col-md-4">
            <!-- Item Recipient Information (if available) -->
              <h4><span class="fa fa-archive fa-lg"></span> <?php echo __('Source'); ?></h4>
                <div>
                <?php if ($itemCreator = metadata($item,array('Dublin Core','Source'))): ?>
                    <?php echo $itemCreator; ?>
                <?php else: ?>
                    <?php echo __('None recorded'); ?>
                <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="row"><hr />
            <!-- Subject -->
            <div class="col-md-4">
                 <h4><span class="fa fa-book fa-lg"></span><?php echo __(' Subject'); ?></h4>
                <?php if ($itemCreator = metadata($item,array('Dublin Core','Subject'))): ?>
                    <?php echo $itemCreator; ?>
                <?php else: ?>
                    <?php echo __('None recorded'); ?>
                <?php endif; ?>
            </div>
            <!-- Identifier -->
            <div class="col-md-4">
                <h4><span class="fa fa-bookmark fa-lg"></span><?php echo __(' Identifier'); ?></h4>
                <?php if ($itemCreator = metadata($item,array('Dublin Core','Identifier'))): ?>
                    <?php echo $itemCreator; ?>
                <?php else: ?>
                    <?php echo __('None recorded'); ?>
                <?php endif; ?>
            </div>
            <!-- Contributor -->
            <div class="col-md-4">
                <h4><span class="fa fa-university fa-lg"></span><?php echo __(' Contributor'); ?></h4>
                <?php if ($itemCreator = metadata($item,array('Dublin Core','Contributor'))): ?>
                    <?php echo $itemCreator; ?>
                <?php else: ?>
                    <?php echo __('None recorded'); ?>
                <?php endif; ?>
            </div>
        </div>
        <!-- If the item belongs to a collection, the following creates a link to that collection. -->

        <!-- The following prints a list of all tags associated with the item -->
        <div class="row">
            <div class="col-xs-12">
                <hr />
                <h4><span class="fa fa-tags fa-large"></span> Tags</h4>
                <div class="tags well well-small">
                    <?php if (tag_string($item) != null) {
                        echo tag_string($item); }
                        else {
                        echo __('No tags recorded for this item.');
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Rights -->
                <div class="col-xs-12"><hr />
                    <h4><span class="fa fa-copyright fa-lg"></span><?php echo __(' Rights'); ?></h4>
                    <?php if ($itemCreator = metadata($item,array('Dublin Core','Rights'))): ?>
                        <?php echo $itemCreator; ?>
                    <?php else: ?>
                        <?php echo __('None recorded'); ?>
                    <?php endif; ?>
                </div>
        </div>
         <div class="row">
            <div class="col-xs-12">
                <hr />
                <!-- The following prints a citation for this item. -->
                <h4><span class="fa fa-retweet fa-lg"></span> <?php echo __('Citation'); ?></h4>
                <div class="element-text"><?php echo metadata($item,'citation',array('no_escape' => true)); ?></div>
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
        <!-- <h3><?php echo __('Files'); ?></h3> -->
        <div class="element-text"><?php echo files_for_item(
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
