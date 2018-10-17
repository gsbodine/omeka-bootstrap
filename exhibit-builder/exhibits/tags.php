<?php
$title = __('Browse Exhibits by Tag');
echo head(array(
    'title' => $title,
    'bodyclass' => 'exhibits tags',
));
?>
<div id="primary">
    <div id="exhibits-title" class="row page-header">
        <div class="col-xs-12">
            <h1><span class="glyphicon glyphicon-eye-open"></span> <?php echo $title; ?></h1>
        </div>
    </div>
</div>
<nav class="navigation exhibits-tags" id="secondary-nav">
    <?php echo nav(array(
            array(
                'label' => __('Browse All'),
                'uri' => url('exhibits/browse'),
            ),
            array(
                'label' => __('Browse by Tag'),
                'uri' => url('exhibits/tags'),
            )
    ))->setUlClass('nav nav-pills'); ?>
</nav>

<?php echo tag_cloud($tags, 'exhibits/browse'); ?>
<?php echo foot();
