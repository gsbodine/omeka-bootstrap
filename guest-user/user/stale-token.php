<?php
$pageTitle = __('Stale Token');
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
        <div class="col-xs-12">
            <p><?php echo __("Your temporary access to the site has expired. Please check your email for the link to follow to confirm your registration."); ?></p>
            <p><?php echo __("You have been logged out, but can continue browsing the site."); ?></p>
        </div>
    </div>
</div><?php // end primary ?>
<?php echo foot();
