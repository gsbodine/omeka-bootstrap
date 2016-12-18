<?php
$title = __('Browse Exhibits');
echo head(array(
    'title' => $title,
    'bodyclass' => 'exhibits browse',
));
?>
<div id="primary">
    <div id="exhibits-title" class="row page-header">
        <div class="col-xs-12">
            <h1><span class="glyphicon glyphicon-eye-open"></span> <?php echo $title; ?> <?php echo __('(%s total)', $total_results); ?></h1>
        </div>
    </div>
<?php if (count($exhibits) > 0): ?>
<nav class="exhibits-nav navigation" id="secondary-nav">
    <?php echo nav(array(
            array(
                'label' => __('Browse All'),
                'uri' => url('exhibits'),
            ),
            array(
                'label' => __('Browse by Tag'),
                'uri' => url('exhibits/tags'),
            )
    ))->setUlClass('nav nav-pills'); ?>
</nav>

<?php if ($paginationLinks = pagination_links()): ?>
    <div id="pagination-top">
        <?php echo $paginationLinks; ?>
    </div>
<?php endif; ?>

<?php $exhibitCount = 0; ?>
<?php foreach (loop('exhibit') as $exhibit): ?>
    <?php $exhibitCount++; ?>
    <div class="row exhibit <?php echo $exhibitCount % 2 ? 'even' : 'odd'; ?>">
        <div class="col-sm-2">
            <div class="exhibit-img">
                <?php
                $exhibitImage = record_image($exhibit, 'square_thumbnail', array('class' => 'image img-responsive'));
                if ($exhibitImage):
                    echo exhibit_builder_link_to_exhibit($exhibit, $exhibitImage);
                else: ?>
                    <div class="image none"></div>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-sm-7">
            <div class="exhibit-title">
                <h3><?php echo link_to_exhibit(null, array('class' => 'permalink', 'snippet' => 250)); ?></h3>
            </div>
            <?php if ($exhibitDescription = metadata('exhibit', 'description', array('no_escape' => true, 'snippet' => 500))): ?>
            <div class="exhibit-description"><?php echo $exhibitDescription; ?></div>
            <?php endif; ?>
        </div>
        <div class="col-sm-3">
            <?php if ($exhibitTags = tag_string('exhibit', 'exhibits')): ?>
            <div class="browse-items-tags well well-sm">
                <p><span class="fa fa-tag"></span> <strong><?php echo __('Tags'); ?></strong></p>
                <p class="tags"><?php echo $exhibitTags; ?></p>
            </div>
            <?php endif; ?>
        </div>
    </div>
<?php endforeach; ?>

<?php if ($paginationLinks): ?>
    <div id="pagination-bottom">
        <?php echo $paginationLinks; ?>
    </div>
<?php endif; ?>

<?php else: ?>
<div class="row">
    <div class="col-xs-12">
        <p><?php echo __('There are no exhibits available yet.'); ?></p>
    </div>
</div>
<?php endif; ?>

</div>
<?php echo foot();
