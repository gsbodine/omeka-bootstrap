<?php
$pageTitle = __('Browse Collections');
echo head(array(
    'title' => $pageTitle,
    'bodyclass' => 'collections browse',
));
?>
<div id="primary">
    <div class="row page-header">
        <div class="col-xs-12">
            <h1><?php echo $pageTitle; ?> <?php echo __('(%s total)', $total_results); ?></h1>
        </div>
    </div>
    <?php if ($pagination_links = pagination_links()): ?>
    <div class="row">
        <div class="pagination pagination-centered"><?php echo $pagination_links; ?></div>
    </div>
    <?php endif; ?>
    <?php
    if ($total_results > 1):
        $sortLinks[__('Title')] = 'Dublin Core,Title';
        $sortLinks[__('Date Added')] = 'added';
    ?>
    <div class="row">
        <div class="col-xs-12">
            <div id="sort-links" class="input-group input-group-sm btn-group">
                <span class="input-group-addon"><?php echo __('Sort by:'); ?></span>
                <div class="input-group">
                    <?php
                        echo bootstrap_browse_sort_links($sortLinks, array(
                            'list_tag'  => 'div',
                            'list_attr' => array('class' => 'input-group-btn'),
                            'link_tag'  => 'span',
                            'link_attr' => array('class' => 'btn btn-default btn-sm', 'role' => 'button')
                        ));
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <div class="row">
    <?php foreach(loop('collections') as $collection): ?>
        <div class="col-sm-6 col-lg-4">
            <div class="row">
                <div class="col-sm-4">
                    <div class="collection-img">
                        <?php
                            $collectionImage = record_image('collection', 'square_thumbnail', array('class' => 'img-responsive'));
                            $noFile = '<img src="' . img('no-file.png') . '" class="img-rounded img-responsive img-thumbnail" alt="' . __('No file') . '" />';
                            if ($collectionImage):
                                echo link_to_collection($collectionImage, array('class' => 'image'));
                            else:
                                echo link_to_collection($noFile, array('class' => 'image none'));
                            endif;
                        ?>
                    </div>
                </div>
                <div class="col-sm-8">
                    <h2><?php echo link_to_collection(); ?></h2>
                    <?php if (metadata('collection',array('Dublin Core', 'Contributor'))): ?>
                    <div class="element well well-sm well-md well-lg">
                        <p><span class="glyphicon glyphicon-user"></span> <strong><?php echo __('Collector(s)'); ?></strong></p>
                        <div class="element-text">
                            <p><?php echo metadata('collection',array('Dublin Core', 'Contributor')); ?></p>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8 col-sm-offset-4">
                    <div class="element">
                        <div class="collection-description">
                            <?php echo text_to_paragraphs(metadata('collection', array('Dublin Core', 'Description'), array('snippet' => 150))); ?>
                        </div>
                    </div>
                    <div>
                        <?php fire_plugin_hook('public_collections_browse_each', array('view' => $this, 'collection' => $collection)); ?>
                    </div>
                    <div>
                        <p class="view-items-link-browse"><?php echo link_to_items_in_collection($text = 'View the items in this collection'); ?></p>
	                </div>
                </div>
            </div>
        </div><?php // end class="collection". ?>
    <?php endforeach; ?>
    </div>
    <div class="row">
        <?php fire_plugin_hook('public_collections_browse', array('collections' => $collections, 'view' => $this)); ?>
    </div>
</div><?php // end primary. ?>
<?php echo foot();
