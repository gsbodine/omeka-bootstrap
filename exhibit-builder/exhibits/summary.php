<?php echo head(array(
    'title' => metadata('exhibit', 'title'),
    'bodyclass' => 'exhibits summary',
));
?>
<div class="primary">
<div class="row">
<div class="col-xs-12">
<h1><?php echo metadata('exhibit', 'title'); ?></h1>
</div>
</div>
<div class="row">
<div class="col-md-9">

<?php echo exhibit_builder_page_nav(); ?>

    <?php if ($exhibitDescription = metadata('exhibit', 'description', array('no_escape' => true))): ?>
    <div class="exhibit-description">
        <?php echo $exhibitDescription; ?>
    </div>
    <?php endif; ?>
    <?php if (($exhibitCredits = metadata('exhibit', 'credits'))): ?>
    <div class="exhibit-credits">
        <h3><?php echo __('Credits'); ?></h3>
        <p><?php echo $exhibitCredits; ?></p>
    </div>
    <?php endif; ?>
</div>

<div class="col-md-3">
<nav id="exhibit-pages">
<h4>Exhibit Pages:</h4>
    <ul>
        <?php set_exhibit_pages_for_loop_by_exhibit(); ?>
        <?php foreach (loop('exhibit_page') as $exhibitPage): ?>
        <?php echo exhibit_builder_page_summary($exhibitPage); ?>
        <?php endforeach; ?>
    </ul>
</nav>
</div>
</div>
</div>
<?php echo foot();
