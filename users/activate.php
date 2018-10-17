<?php
$pageTitle = __('User Activation');
echo head(array(
    'title' => $pageTitle,
    'bodyclass' => 'activation',
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
            <p><?php echo html_escape(__('Hello %s. Your username is %s.', $user->name , $user->username)); ?></p>
            <form method="post" accept-charset="utf-8" class="form-horizontal">
                <div class="form-group">
                    <?php echo $this->formLabel('new_password1', __('Create a Password'), array('class' => 'required')); ?>
                    <div class="col-sm-10">
                        <?php echo $this->formPassword('new_password1', null, array('class' => 'text-input form-control')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <?php echo $this->formLabel('new_password2', __('Re-type the Password'), array('class' => 'required')); ?>
                    <div class="col-sm-10">
                        <?php echo $this->formPassword('new_password2', null, array('class' => 'text-input form-control')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="submit" class="submit" value="<?php echo __('Activate'); ?>" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php echo foot(array(), $footer);
