<?php head(array('title'=>'Browse Collections','bodyid'=>'collections','bodyclass' => 'browse')); ?>
<div id="primary">
    <div class="row">
        <div class="span12">
             <h1 class="page-header">Collections</h1>
        </div>
    </div>
    <?php if (!pagination_links() == ''): ?>
    <div class="row">
        <div class="pagination pagination-centered"><?php echo pagination_links(); ?></div>
    </div>
    <?php endif ?>
    <div class="row">
	<div class="span12">
            <div class="row">
            <?php while (loop_collections()): ?>
            <div class="span6">
                <div class="row">
                    <div class="span6"><h2><?php echo link_to_collection(); ?></h2></div>
                    <div class="span4">
                        
                        <div class="element">
                            <div class="collection-description">
                                <?php echo nls2p(collection('Description', array('snippet'=>150))); ?>
                            </div>
                        </div>
                    </div>
                    <div class="span2">
                        <?php if (collection_has_collectors()): ?>
                        <div class="element well well-small">
                        <p><i class="icon-user"></i> <strong>Collector(s)</strong></p>
                            <div class="element-text">
                            <p><?php echo collection('Collectors', array('delimiter'=>', ')); ?></p>
                            </div>
                        </div>            	   
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="span6">
                        <?php echo plugin_append_to_collections_browse_each(); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="span6">
                        <p class="view-items-link-browse"><?php echo link_to_browse_items('View the items in this collection', array('collection' => collection('id'))); ?></p>
                    </div>
                </div>
            </div>
       <!-- end class="collection" -->
	<?php endwhile; ?> 
        </div>
        <div class="row">	
            <?php echo plugin_append_to_collections_browse(); ?>
        </div>
    </div>
</div><!-- end primary -->
			
<?php foot(); ?>