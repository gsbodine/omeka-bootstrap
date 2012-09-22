<?php head(array('title' => html_escape($collection->name),'bodyid'=>'collections','bodyclass' => 'show')); ?>

<div id="primary" class="show">
    
    <div id="collection-title">

	    <h1><?php echo collection('Name'); ?></h1>
    
    </div>

    <p class="view-items-link-browse"><?php echo link_to_browse_items('View all items', array('collection' => collection('id'))); ?></p>

    <div id="collection-description" class="element">
        <h2>Description</h2>
        <div class="element-text"><?php echo nls2p(collection('Description')); ?></div>
        <?php if (collection_has_collectors()): ?>
        	<div class="element">
                <h3>Collector(s)</h3>
            	    <div class="element-text">
                    <p><?php echo collection('Collectors', array('delimiter'=>', ')); ?></p>
			</div>
        </div>            	   
		<?php endif; ?>
    </div>
    <!-- end collection-description -->
    
    <?php echo plugin_append_to_collections_show(); ?>

</div><!-- end primary -->

<?php foot(); ?>