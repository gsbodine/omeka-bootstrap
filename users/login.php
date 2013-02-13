<?php
queue_js_file('login');
$pageTitle = __('Log In');
echo head(array('bodyclass' => 'login', 'title' => $pageTitle), $header);
?>

<div class="row">
    <fieldset>
        <div class="span12"><legend><h1><i class="icon-lock"></i> Log in to <?php echo get_option('site_title'); ?></h1></legend></div>
        <div class="span5">
            <p class="btn btn-info"><strong><i class="icon-cog"></i> Need to create an account?</strong></p>
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
                        <input type="submit" class="btn btn-primary" value="Log in" /> 
                    </div>
                    <div class="span5">
                        <?php echo link_to('participate', 'forgot-password', __('Forgot password?'),array('class'=>'text-warning')); ?>
                    </div>
                </div>
            </form>
        </div>
    </fieldset>
</div>

<?php echo foot(); ?>