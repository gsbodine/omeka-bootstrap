<?php
$title = __('Contribution Terms of Service');
$bodyClass = 'contribution';

echo head(array(
    'title' => $title,
    'bodyclass' => $bodyClass,
)); ?>
<div id="primary">
    <div class="row page-header">
        <div class="col-xs-12">
            <h1><span class="glyphicon glyphicon-subtitles"></span> <?php echo $title; ?></h1>
            <?php echo get_option('contribution_consent_text'); ?>
        </div>
    </div>
</div>
<?php echo foot();
