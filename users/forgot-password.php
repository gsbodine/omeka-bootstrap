<?php
$pageTitle = __('Forgot Password');
echo head(array('title' => $pageTitle, 'bodyclass' => 'login'), $header);
?>
<div class="row">
    <div class="span12">
        <h1><?php echo $pageTitle; ?></h1>
        <p id="login-links">
            <span id="backtologin"><?php echo link_to('users', 'login', __('<i class="icon-arrow-left"></i> Back to Log In'), array('class'=>'btn btn-warning btn-small')); ?></span>
        </p>
        
        <?php echo flash(); ?>

        <p><?php echo __('Enter your email address to retrieve your password.'); ?></p>
        <form method="post" accept-charset="utf-8">
            <div class="field">    
                <div class="inputs">
                    <?php echo $this->formText('email', @$_POST['email']); ?>
                </div>
            </div>

            <button type="submit" class="btn btn-primary"><?php echo __('Submit'); ?> <i class="icon-circle-arrow-right"></i></button>
        </form>
    </div>
</div>
<?php echo foot(array(), $footer); ?>
