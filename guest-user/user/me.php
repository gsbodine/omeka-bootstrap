<?php
$user = current_user();
$pageTitle =  get_option('guest_user_dashboard_label');
echo head(array(
    'bodyclass' => 'confirm',
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
        <?php foreach($widgets as $index => $widget): ?>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="guest-user-widget guest-user-widget-<?php echo $index & 1 ? 'odd' : 'even'; ?>">
                <?php echo GuestUserPlugin::guestUserWidget($widget); ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<?php echo foot();
