<?php
$js = '
var guestUserPasswordAgainText = ' . json_encode(__('Password again for match')) . ';
var guestUserPasswordsMatchText = ' . json_encode(__('Passwords match!')) . ';
var guestUserPasswordsNoMatchText = ' . json_encode(__("Passwords do not match!")) . ';';
queue_js_string($js);
queue_js_file('guest-user-password');

$pageTitle = __('Update Account');
echo head(array(
    'bodyclass' => 'update-account',
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
        <div class="col-xs-12">
            <?php echo bootstrap_form($form, 'horizontal'); ?>
        </div>
    </div>
</div>
<?php echo foot();
