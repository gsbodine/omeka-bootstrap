<?php
queue_js_file('login');
$pageTitle = __('Log In');
echo head(array('bodyclass' => 'login', 'title' => $pageTitle), $header);
?>

<div class="row">
    <fieldset>
        <div class="span12"><legend><h1 class="text-center"><i class="icon-lock"></i> Log in to <?php echo get_option('site_title'); ?></h1></legend></div>
        <div class="span5">
            <p class="text-center"><a class="btn btn-success" href="/user/register"><strong><i class="icon-cog"></i> Need to create an account?</strong></a></p>
        </div>
        <div class="span7">
            <?php echo flash(); ?>
            <form action="/users/login" id="crowded-login-form" method="post" accept-charset="utf-8">
                <div class="field">
                <label for="username"><i class="icon-user"></i> Username</label>
                <div class="inputs">
                    <input type="text" name="username" id="username" class="span3" />
                </div>
                </div>

                <div class="field">
                <label for="password"><i class="icon-key"></i> Password</label>
                <div class="inputs">
                    <input type="password" name="password" id="password" class="span3" />
                </div>
                </div>
                <div class="row">
                    <div class="span2">
                        <button type="submit" class="btn btn-primary"><i class="icon-signin"></i> <?php echo __('Log In') ?></button> 
                    </div>
                    <div class="span5">
                        <?php echo link_to('users', 'forgot-password', __('<i class="icon-question-sign"></i> Forgot password?'),array('class'=>'text-warning')); ?>
                    </div>
                </div>
            </form>
        </div>
    </fieldset>
</div>

<?php echo foot(); ?>