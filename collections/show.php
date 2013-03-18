<?php 
    echo head(array('title' => html_escape($collection->name),
            'bodyid'=>'collections',
            'bodyclass' => 'show')
    ); 
?>

<div id="primary" class="show">
    
    <div class="row" id="collection-title">
        <div class="span12">
            <h1 class="page-header"><?php echo metadata('collection',array('Dublin Core','Title')); ?><br /><small><?php echo $collection->totalItems(); ?> item<?php if ($collection->totalItems() != 1)  echo 's';  ?> in collection</small></h1>
        </div>
    </div>
    <div class="row">
        <div id="collection-description" class="span8">
            <div class="lead"><?php echo text_to_paragraphs(metadata('collection', array('Dublin Core', 'Description'))); ?></div>
        </div>
        <div class="span4">
            <?php if ($collection->hasContributor()): ?>
        	<div class="element">
                <h4>Collector(s)</h4>
            	    <div class="element-text">
                        <p><?php echo metadata('collection',array('Dublin Core', 'Contributor'), array('delimiter'=>', ')); ?></p>
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
        <?php foreach(loop('items') as $item): ?>
        <div class="span3">
            <div class="well" style="text-align:center;">
                <div><?php echo link_to_item(	item_image('square_thumbnail',$props=array('class'=>'img-rounded img-polaroid'))); ?></div>
                <br />
                <p><small><strong><?php echo metadata('item',array('Dublin Core','Title')); ?></strong></small></p>
            </div>
        </div>
        <?php endforeach ?>
    </div>
    <div class="row">
        <div class="span12">
            <p class="view-items-link-browse lead" style="text-align:center"><?php echo link_to_items_in_collection('Browse all items in the collection', $collection); ?></p>
        
        </div>
    </div>
    <!-- end collection-description -->
    <div class="row">
        <div class="span12">
            <?php fire_plugin_hook('public_collection_show'); ?>
        </div>
    </div>
    
</div><!-- end primary -->

<?php echo foot(); ?>