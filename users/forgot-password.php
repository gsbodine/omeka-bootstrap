<?php
$pageTitle = __('Forgot Password');
echo head(array(
    'title' => $pageTitle,
    'bodyclass' => 'login',
), $header);
?>
<div id="primary">
    <div class="row page-header">
        <div class="col-xs-12">
            <h1><span class="glyphicon glyphicon-user"></span> <?php echo $pageTitle; ?></h1>
            <p id="login-links">
                <span id="backtologin"><?php echo link_to('users', 'login', __('Back to Log In')); ?></span>
            </p>
            <?php echo bootstrap_flash('danger'); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <p class="clear"><?php echo __('Enter your email address to retrieve your password.'); ?></p>
            <form method="post" accept-charset="utf-8" class="form-horizontal">
                <div class="form-group">
                    <label for="email" class="control-label col-sm-2 required"><?php echo __('Email'); ?></label>
                    <div class="col-sm-10">
                        <?php echo $this->formText('email', @$_POST['email']); ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="submit" class="submit" value="<?php echo __('Submit'); ?>" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php echo foot(array(), $footer);
