<?php
$user = current_user();
$pageTitle =  get_option('guest_user_dashboard_label');
echo head(array('title' => $pageTitle));
?>
<h1><i class="icon-dashboard"></i> <?php echo $pageTitle; ?></h1>
<hr />
<div id='primary'>
<?php echo flash(); ?>
    <div class="row">
        <div class="span4">
            <h2><?php echo $this->gravatar($user->email,array('imgSize' => 35)) . ' ' . $user->username ?></h2>
            <h3>Status: editor</h3>
            <p><a href="/community"><i class="icon-eye-open"></i> See what others have contributed and where <em>you</em> could help most.</a></p> 
            <p>If you you're not sure where to go from here, <a href="/participate">take a look at the <i class="icon-group"></i> Participate page</a>.</p>
        </div>
        <div class="span8">
            <?php foreach($widgets as $index=>$widget): ?>
            <div class='<?php if($index & 1): ?>guest-user-widget-odd <?php else:?>guest-user-widget-even<?php endif;?> span4'>
                <?php echo guest_user_widget($widget); ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php echo foot(); ?>
