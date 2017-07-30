<?php
/**
 * @version $Id$
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @copyright Center for History and New Media, 2010
 * @package Contribution
 */

$contributionPath = get_option('contribution_page_path');
queue_css_file('form');

queue_js_file('contribution-public-form');
//load user profiles js and css if needed
if (get_option('contribution_user_profile_type') && plugin_is_active('UserProfiles')) {
    queue_js_file('admin-globals');
    queue_js_file('tiny_mce', 'javascripts/vendor/tiny_mce');
    queue_js_file('elements');
    queue_css_string("input.add-element {display: block}");
}

$itemTitle = strip_formatting(metadata($item, array('Dublin Core', 'Title')));
if ($itemTitle == '') {
    $itemTitle = __('[Untitled]');
} elseif ($itemTitle != __('[Untitled]')) {
    $itemTitle = '"' . $itemTitle . '"';
}
$title = __('Update Contribution %s', $itemTitle);
$bodyClass = 'contribution edit';

echo head(array(
    'title' => $title,
    'bodyclass' => $bodyClass,
)); ?>

<div id="primary">
    <div class="row page-header">
        <div class="col-xs-12">
            <h1><span class="glyphicon glyphicon-oil"></span> <?php echo $title; ?></h1>
            <?php echo bootstrap_flash('info'); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
    <form method="post" action="" enctype="multipart/form-data" class="form-horizontal">
        <fieldset id="contribution-item-metadata">
            <label for="contribution-type"><?php echo __('Item Type:'); ?></label>
            <span><?php echo $type->display_name; ?></span>
            <?php if (metadata($item, 'has files')): ?>
            <div id="file-list" class="form-group">
                <label class="control-label col-sm-2"><?php echo __('Files'); ?></label>
                <ul class="sortable" style="list-style-type: none;">
                <?php foreach ($item->Files as $key => $file): ?>
                    <li class="file" style="display: inline-block;">
                        <div class="sortable-item">
                            <?php echo link_to($file, 'show', file_image('thumbnail', array(), $file), array()); ?>
                        </div>
                    </li>
                <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>
            <div id="contribution-type-form">
                <?php if (isset($type)) {
                    $partialOptions = array();
                    $partialOptions['process'] = 'edit';
                    $partialOptions['type'] = $type;
                    $partialOptions['item'] = $item;
                    $partialOptions['tags'] = isset($_POST['tags']) ? $_POST['tags'] : tag_string($item, '');
                    if (isset($profileType)) {
                        $partialOptions['profileType'] = $profileType;
                    }
                    if (isset($profile)) {
                        $partialOptions['profile'] = $profile;
                    }
                    echo $this->partial('contribution/type-form.php', $partialOptions);
                }?>
            </div>
        </fieldset>

        <?php
        $submitOptions = array();
        $submitOptions['process'] = 'edit';
        $submitOptions['contribution_contributed_item'] = $contribution_contributed_item;
        $submitOptions['captchaScript'] = null;
        $submitOptions['type'] = isset($type) ? $type : null;
        $submitOptions['submitLabel'] = __('Update Contribution');
        echo $this->partial('contribution/contribution-submit-form.php', $submitOptions);
        echo $csrf; ?>
    </form>
    </div>
    </div>
</div>
<?php echo foot();
