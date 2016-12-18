<?php
$pageTitle = __('Confirmation Error');
echo head(array(
    'bodyclass' => 'confirm',
    'title' => $pageTitle,
));
?>
<div id="primary">
    <div class="row page-header">
        <div class="col-xs-12">
            <h1><?php echo $pageTitle; ?></h1>
            <?php echo bootstrap_flash('info'); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <?php echo bootstrap_form($form, 'horizontal'); ?>
        </div>
    </div>
</div>
<?php echo foot();
