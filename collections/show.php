<?php 
    head(array('title' => html_escape($collection->name),
            'bodyid'=>'collections',
            'bodyclass' => 'show')
    ); 
?>

<div id="primary" class="show">
    
    <div class="row" id="collection-title">
        <div class="span12">
            <h1 class="page-header"><?php echo collection('Name'); ?><br /><small><?php echo total_items_in_collection(); ?> item<?php if (total_items_in_collection() != 1)  echo 's';  ?> in collection</small></h1>
        </div>
    </div>
    <div class="row">
        <div id="collection-description" class="span8">
            <div class="lead"><?php echo nls2p(collection('Description')); ?></div>
        </div>
        <div class="span4">
            <?php if (collection_has_collectors()): ?>
        	<div class="element">
                <h4>Collector(s)</h4>
            	    <div class="element-text">
                        <p><?php echo collection('Collectors', array('delimiter'=>', ')); ?></p>
                    </div>
            <?php endif; ?>
         </div>
         </div>
    </div>
    <div class="row">
        <div class="span12">
            <hr />
        </div>
    </div>
    <div class="row">
        <?php while (loop_items_in_collection(4)): ?>
        <div class="span3">
            <div class="well" style="text-align:center;">
                <div><?php echo link_to_item(item_square_thumbnail($props=array('class'=>'img-rounded img-polaroid'))); ?></div>
                <br />
                <p><small><strong><?php echo item('Dublin Core','Title'); ?></strong></small></p>
            </div>
        </div>
        <?php endwhile ?>
    </div>
    <div class="row">
        <div class="span12">
            <p class="view-items-link-browse lead" style="text-align:center"><?php echo link_to_browse_items('Browse all items in the collection', array('collection' => collection('id'))); ?></p>
        
        </div>
    </div>
    <!-- end collection-description -->
    <div class="row">
        <div class="span12">
            <?php echo plugin_append_to_collections_show(); ?>
        </div>
    </div>
    
</div><!-- end primary -->

<?php foot(); ?>