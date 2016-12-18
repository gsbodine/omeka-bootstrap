<?php if (!$type): ?>
<p><?php echo __('You must choose a contribution type to continue.'); ?></p>
<?php else:
$isRequired = $type->isFileRequired();
$isAllowed = $type->isFileAllowed();
$allowMultipleFiles = $isAllowed && $type->multiple_files;
?>
<?php if (!isset($process) || $process == 'add'): ?>
<h2><?php echo __('Contribute a %s', $type->display_name); ?></h2>
<?php endif; ?>

<?php
// When a file is required, the upload element is displayed before other ones.
if ($isRequired): ?>
<div id="files-form" class="form-group drawer-contents">
    <?php echo $this->formLabel('file', __('Upload a file')); ?>
    <div id="files-metadata" class="col-sm-10">
        <div id="upload-files" class="files">
            <?php echo $this->formFile($allowMultipleFiles ? 'file[0]' : 'file', array('class' => 'fileinput button')); ?>
           <p class="help-block"><?php echo __('The maximum file size is %s.', max_file_size()); ?></p>
        </div>
    </div>
</div>
<?php endif; ?>

<?php
foreach ($type->getTypeElements() as $contributionTypeElement) {
    echo $this->elementForm($contributionTypeElement->Element, $item, array('contributionTypeElement'=>$contributionTypeElement));
}
?>

<?php if (!$isRequired && $isAllowed): ?>
<div id="files-form" class="form-group drawer-contents">
    <?php echo $this->formLabel('file', __('Upload a file (Optional)')); ?>
    <div id="files-metadata" class="col-sm-10">
        <div id="upload-files" class="files">
            <?php echo $this->formFile($allowMultipleFiles ? 'file[0]' : 'file', array('class' => 'fileinput button')); ?>
           <p class="help-block"><?php echo __('The maximum file size is %s.', max_file_size()); ?></p>
        </div>
    </div>
</div>
<?php endif; ?>

<?php if ($allowMultipleFiles): ?>
<script type="text/javascript" charset="utf-8">
    <?php if (!empty($preset)): ?>
jQuery(window).load(function () {
    Omeka.Items.enableAddFiles(<?php echo js_escape(__('Add Another File')); ?>);
});
    <?php else: ?>
Omeka.Items.enableAddFiles(<?php echo js_escape(__('Add Another File')); ?>);
    <?php endif; ?>
</script>
<?php endif; ?>

<?php if ($type->add_tags) : ?>
<div id="tag-form" class="form-group">
    <?php echo $this->formLabel('tags',__('Add Tags')); ?>
    <div class="col-sm-10">
        <?php echo $this->formText('tags', isset($tags) ? $tags : ''); ?>
        <p id="add-tags-explanation" class="help-block"><?php echo __('Separate tags with %s', option('tag_delimiter')); ?></p>
    </div>
</div>
<?php endif; ?>

<div class="row">
<?php
// Allow other plugins to append to the form (pass the type to allow decisions
// on a type-by-type basis).
fire_plugin_hook('contribution_type_form', array('type'=>$type, 'view'=>$this));
?>
</div>

<?php $user = current_user(); ?>
<?php if(( get_option('contribution_open') || get_option('contribution_strict_anonymous') ) && !$user) : ?>
<div class="form-group">
    <?php
        if (get_option('contribution_strict_anonymous')) {
            echo $this->formLabel('contribution_email', __('Email (Optional)'));
        } else {
            echo $this->formLabel('contribution_email', __('Email (Required)'));
        }
    ?>
    <div class="col-sm-10">
    <?php
        if(isset($_POST['contribution_email'])) {
            $email = $_POST['contribution_email'];
        } else {
            $email = '';
        }
        echo $this->formText('contribution_email', $email);
    ?>
    </div>
</div>

<?php else: ?>
<div class="bs-callout bs-callout-info">
    <p><?php echo __('You are logged in as: %s', '<strong>' . metadata($user, 'name') . '</strong>'); ?></p>
</div>
<?php endif; ?>

    <?php
    //pull in the user profile form if it is set
    if( isset($profileType) ): ?>

    <script type="text/javascript" charset="utf-8">
    //<![CDATA[
    jQuery(document).bind('omeka:elementformload', function (event) {
         Omeka.Elements.makeElementControls(event.target, <?php echo js_escape(url('user-profiles/profiles/element-form')); ?>,'UserProfilesProfile'<?php if ($id = metadata($profile, 'id')) echo ', '.$id; ?>);
         Omeka.Elements.enableWysiwyg(event.target);
    });
    //]]>
    </script>

        <h2 class='contribution-userprofile <?php echo $profile->exists() ? "exists" : ""  ?>'><?php echo  __('Your %s profile', $profileType->label); ?></h2>
        <p id='contribution-userprofile-visibility'>
        <?php if ($profile->exists()) :?>
            <span class='contribution-userprofile-visibility'><?php echo __('Show'); ?></span><span class='contribution-userprofile-visibility' style='display:none'><?php echo __('Hide'); ?></span>
            <?php else: ?>
            <span class='contribution-userprofile-visibility' style='display:none'><?php echo __('Show'); ?></span><span class='contribution-userprofile-visibility'><?php echo __('Hide'); ?></span>
        <?php endif; ?>
        </p>
        <div class='contribution-userprofile <?php echo $profile->exists() ? "exists" : ""  ?>'>
        <p class="user-profiles-profile-description"><?php echo $profileType->description; ?></p>
        <fieldset name="user-profiles">
        <?php
        foreach($profileType->Elements as $element) {
            echo $this->profileElementForm($element, $profile);
        }
        ?>
        </fieldset>
        </div>
        <?php endif; ?>
<?php endif;
