<?php
queue_js_file('guest-user-password');
$pageTitle = get_option('guest_user_register_text') ?: __('Register');
echo head(array(
    'bodyclass' => 'register',
    'title' => $pageTitle,
));
?>
<div id="primary">
    <div class="row page-header">
        <div class="col-xs-12">
            <h1><span class="glyphicon glyphicon-user"></span> <?php echo $pageTitle; ?></h1>
            <?php echo bootstrap_flash('info'); ?>
        </div>
    </div>
    <div class="row">
        <div id='capabilities' class="col-xs-12">
            <p><?php echo get_option('guest_user_capabilities'); ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <?php echo bootstrap_form($form, 'horizontal'); ?>
            <p id='confirm'></p>
        </div>
    </div>
</div>
<?php echo foot();
