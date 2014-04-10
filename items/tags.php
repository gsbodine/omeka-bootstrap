<?php
$pageTitle = __('Browse Items');
echo head(array(
    'title' => $pageTitle,
    'bodyid' => 'items',
    'bodyclass' => 'tags',
));
?>
<div id="primary">
    <div class="page-title">
        <h1><i class="icon-tags"></i> <?php echo $pageTitle; ?> <small><?php echo __('By Current Tags'); ?></small></h1>
    </div>
    <div class="col-sm-12 col-md-12">
        <?php echo public_nav_items()->setUlClass('nav nav-pills'); ?>
        <?php
            asort($tags);
            echo tag_cloud($tags, url('items/browse'));
        ?>
    </div>
</div><!-- end primary -->
<?php echo foot(); ?>
