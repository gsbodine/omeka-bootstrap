<?php
$pageTitle = __('Browse Items');
echo head(array(
    'title' => $pageTitle,
    'bodyid' => 'items',
    'bodyclass' => 'tags',
));
?>
<div id="primary">
    <div class="row page-header">
        <div class="col-xs-12">
            <h1><span class="glyphicon glyphicon-list"></span> <?php echo $pageTitle; ?> <small><span class="glyphicon glyphicon-tags"></span> <?php echo __('By Current Tags'); ?></small></h1>
        </div>
    </div>
    <nav class="items-nav navigation secondary-nav">
        <?php echo public_nav_items()->setUlClass('nav nav-pills'); ?>
    </nav>
    <?php
        asort($tags);
        echo tag_cloud($tags, url('items/browse'));
    ?>
</div><?php // end primary. ?>
<?php echo foot();
