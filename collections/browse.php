<?php
$title = __('Browse Collections');
echo head(array(
    'title' => $title,
    'bodyclass' => 'collections browse',
)); ?>
<div id="primary">
    <div class="row page-header">
        <div class="col-xs-12">
            <h1><?php echo $title; ?></h1>
        </div>
    </div>
    <?php if ($pagination_links = pagination_links()): ?>
    <div class="row">
        <div class="pagination pagination-centered"><?php echo $pagination_links; ?></div>
    </div>
    <?php endif ?>
    <div class="row">
    <?php foreach(loop('collections') as $collection): ?>
        <div class="col-sm-6">
            <div class="row">
                <h2><?php echo link_to_collection(); ?></h2>
                <div class="element">
                    <div class="collection-description">
                        <?php echo text_to_paragraphs(metadata('collection', array('Dublin Core', 'Description'), array('snippet' => 150))); ?>
                    </div>
                </div>
            </div>
            <?php if (metadata('collection',array('Dublin Core', 'Contributor'))): ?>
            <div class="row">
                <div class="col-xs-offset-1 col-xs-10">
                    <div class="element well well-sm well-md well-lg">
                        <p><span class="glyphicon glyphicon-user"></span> <strong><?php echo __('Collector(s)'); ?></strong></p>
                        <div class="element-text">
                            <p><?php echo metadata('collection',array('Dublin Core', 'Contributor')); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <div class="row">
                <?php fire_plugin_hook('public_collections_browse_each', array('view' => $this, 'collection' => $collection)); ?>
            </div>
            <div class="row">
                <div class="col-xs-offset-1 col-xs-10">
	                <p class="view-items-link-browse pull-right"><?php echo link_to_items_in_collection($text = 'View the items in this collection'); ?></p>
                </div>
            </div>
        </div>
    <!-- end class="collection" -->
    <?php endforeach; ?>
    </div>
    <div class="row">
        <?php fire_plugin_hook('public_collections_browse', array('collections' => $collections, 'view' => $this)); ?>
    </div>
</div><?php // end primary. ?>
<?php echo foot();
