<?php
$title = metadata('exhibit', 'title');
echo head(array(
    'title' => $title,
    'bodyclass' => 'exhibits summary',
));
?>
<div class="primary">
    <div class="row page-header">
        <div class="col-xs-12">
            <h1><span class="glyphicon glyphicon-eye-open"></span> <?php echo $title; ?></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-9">
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

        <div class="col-sm-3">
            <?php
            $pageTree = exhibit_builder_page_tree();
            if ($pageTree):
            ?>
            <nav id="exhibit-pages">
                <h4><?php echo exhibit_builder_link_to_exhibit($exhibit); ?></h4>
                <?php echo $pageTree; ?>
            </nav>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php echo foot();
