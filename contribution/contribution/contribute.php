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
if(get_option('contribution_user_profile_type') && plugin_is_active('UserProfiles') ) {
    queue_js_file('admin-globals');
    queue_js_file('tiny_mce', 'javascripts/vendor/tiny_mce');
    queue_js_file('elements');
    queue_css_string("input.add-element {display: block}");
}

$title = __('Contribute');
$bodyClass = 'contribution add';

echo head(array(
    'title' => $title,
    'bodyclass' => $bodyClass,
)); ?>
<script type="text/javascript">
// <![CDATA[
enableContributionAjaxForm(<?php echo js_escape(url($contributionPath . '/type-form')); ?>);
// ]]>
</script>

<div id="primary">
    <div class="row page-header">
        <div class="col-xs-12">
            <h1><span class="glyphicon glyphicon-oil"></span> <?php echo $title; ?></h1>
            <?php echo bootstrap_flash('info'); ?>
        </div>
    </div>

    <?php if(! ($user = current_user() )
              && !(get_option('contribution_open') )
            ):
    ?>
        <?php $session = new Zend_Session_Namespace;
              $session->redirect = absolute_url();
        ?>
    <div class="row">
        <div class="col-xs-12">
        <p>
        <?php echo __('You must %screate an account%s or %slog in%s before contributing.', '<a href="' . url('guest-user/user/register') .'">', '</a>', '<a href="' . url('guest-user/user/login') . '">', '</a>'); ?>
        <?php echo __('You can still leave your identity to site visitors anonymous.'); ?>
        </p>
        </div>
    </div>
    <?php else: ?>
    <div class="row">
        <div class="col-xs-12">
        <form method="post" action="" enctype="multipart/form-data" class="form-horizontal">
            <fieldset id="contribution-item-metadata">
                <div class="inputs form-group">
                    <label class="control-label col-sm-2" for="contribution-type"><?php echo __("What type of item do you want to contribute?"); ?></label>
                    <div class="col-sm-10">
                        <?php $options = get_table_options('ContributionType' ); ?>
                        <?php $typeId = isset($type) ? $type->id : '' ; ?>
                        <?php echo $this->formSelect( 'contribution_type', $typeId,
                                array('multiple' => false, 'id' => 'contribution-type') , $options); ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="submit" name="submit-type" id="submit-type" class="btn btn-default" value="Select" />
                    </div>
                </div>
                <div id="contribution-type-form">
                    <?php if (isset($type)) {
                        $partialOptions = array();
                        $partialOptions['preset'] = true;
                        $partialOptions['process'] = 'add';
                        $partialOptions['type'] = $type;
                        $partialOptions['item'] = $item;
                        $partialOptions['tags'] = isset($_POST['tags']) ? $_POST['tags'] : null;
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
            $submitOptions['process'] = 'add';
            $submitOptions['captchaScript'] = isset($captchaScript) ? $captchaScript : null;
            $submitOptions['type'] = isset($type) ? $type : null;
            $submitOptions['submitLabel'] = __('Contribute');
            echo $this->partial('contribution/contribution-submit-form.php', $submitOptions);
            echo $csrf; ?>
        </form>
        </div>
    </div>
    <?php endif; ?>
</div>
<?php echo foot();
