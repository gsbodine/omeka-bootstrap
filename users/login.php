<?php
queue_js_file('login');
$pageTitle = __('Log In');
echo head(array(
    'bodyclass' => 'login',
    'title' => $pageTitle,
), $header);
?>
<div id="primary">
    <div class="row page-header">
        <div class="col-xs-12">
            <h1><span class="glyphicon glyphicon-user"></span> <?php echo $pageTitle; ?></h1>
            <p id="login-links">
                <span id="backtosite"><?php echo link_to_home_page(__('Go to Home Page')); ?></span>  |  <span id="forgotpassword"><?php echo link_to('users', 'forgot-password', __('Lost your password?')); ?></span>
            </p>
            <?php echo bootstrap_flash('danger'); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <?php echo bootstrap_form($form->setAction($this->url('users/login')), 'horizontal'); ?>
        </div>
    </div>
</div><?php // end primary ?>
<?php echo foot(array(), $footer);
