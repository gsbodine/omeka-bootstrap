<fieldset id="contribution-confirm-submit" <?php if (empty($type)) { echo 'style="display: none;"'; }?>>
    <?php if (!empty($captchaScript)): ?>
        <div id="captcha" class="inputs"><?php echo $captchaScript; ?></div>
    <?php endif; ?>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <div class="checkbox">
                <label id="remember-label" for="remember">
                    <input name="remember" value="0" type="hidden">
                    <input id="remember" class="checkbox" name="remember" value="1" type="checkbox">
                    Remember Me?
                </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <div class="checkbox">
                <?php $public = isset($_POST['contribution-public']) ? $_POST['contribution-public'] : ($process == 'add' ? 0 : $contribution_contributed_item->public); ?>
                <label id="contribution-public-label" for="contribution-public">
                    <?php echo $this->formCheckbox('contribution-public', $public, array('class' => 'checkbox'), array('1', '0')); ?>
                    <?php echo __('Publish my contribution on the web.'); ?>
                </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <div class="checkbox">
                <?php $anonymous = isset($_POST['contribution-anonymous']) ? $_POST['contribution-anonymous'] : ($process == 'add' ? 0 : $contribution_contributed_item->anonymous); ?>
                <label id="contribution-anonymous-label" for="contribution-anonymous">
                    <?php echo $this->formCheckbox('contribution-anonymous', $anonymous, array('class' => 'checkbox'), array('1', '0')); ?>
                    <?php echo __('Keep identity private.'); ?>
                </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <div class="checkbox">
                <?php $agree = isset( $_POST['terms-agree']) ? $_POST['terms-agree'] : ($process == 'add' ? 0 : 1); ?>
                <label id="terms-agree-label" for="terms-agree">
                    <?php echo $this->formCheckbox('terms-agree', $anonymous, array('class' => 'checkbox'), array('1', '0')); ?>
                    <?php echo __('I agree to the Terms and Conditions.'); ?>
                </label>
                <p class="help-block"><?php echo __("In order to contribute, you must read and agree to the %s",  "<a href='" . contribution_contribute_url('terms') . "' target='_blank'>" . __('Terms and Conditions') . ".</a>"); ?></p>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <?php echo $this->formSubmit('form-submit', __('Contribute'), array('class' => 'btn btn-default')); ?>
        </div>
    </div>

</fieldset>


