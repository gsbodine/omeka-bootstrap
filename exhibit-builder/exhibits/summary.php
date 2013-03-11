<?php echo head(array('title' => metadata('exhibit', 'title'), 'bodyid'=>'exhibit', 'bodyclass'=>'summary')); ?>
<div class="row">
    <div class="span12">
        <h1><?php echo metadata('exhibit', 'title'); ?></h1>
        <?php echo exhibit_builder_page_nav(); ?>
        <div class="row">
            <?php if ($exhibitDescription = metadata('exhibit', 'description', array('no_escape' => true))): ?>
                <div class="exhibit-description span9">
                    <?php echo $exhibitDescription; ?>
                </div>
            <?php endif; ?>

            <?php if (($exhibitCredits = metadata('exhibit', 'credits'))): ?>
                <div class="exhibit-credits span3">
                    <h3><?php echo __('Credits'); ?></h3>
                    <p><?php echo $exhibitCredits; ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="span12">
    <nav id="exhibit-pages">
        <ul class="nav nav-pills">
            <?php set_exhibit_pages_for_loop_by_exhibit(); ?>
            <?php foreach (loop('exhibit_page') as $exhibitPage): ?>
            <?php echo exhibit_builder_page_summary($exhibitPage); ?>
            <?php endforeach; ?>
        </ul>
    </nav>
    </div>
</div>

<?php echo foot(); ?>
