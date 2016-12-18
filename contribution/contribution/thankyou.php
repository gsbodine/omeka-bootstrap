<?php
$title = __('Contribute');
$bodyClass = 'contribution';

echo head(array(
    'title' => $title,
    'bodyclass' => $bodyClass,
)); ?>
<div id="primary">
    <div class="row page-header">
        <div class="col-xs-12">
            <h1><span class="glyphicon glyphicon-thumbs-up"></span> <?php echo __("Thank you for contributing!"); ?></h1>
            <p><?php echo __("Your contribution will show up in the archive once an administrator approves it. Meanwhile, feel free to %s or %s." , contribution_link_to_contribute(__('make another contribution')), "<a href='" . url('items/browse') . "'>" . __('browse the archive') . "</a>"); ?>
            </p>
            <?php if(get_option('contribution_open') && !current_user()): ?>
            <p><?php echo __("If you would like to interact with the site further, you can use an account that is ready for you. Visit %s, and request a new password for the email you used.", "<a href='" . url('users/forgot-password') . "'>" . __('this page') . "</a>"); ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php echo foot();
