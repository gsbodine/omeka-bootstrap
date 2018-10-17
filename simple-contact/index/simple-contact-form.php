<div id="simple-contact">
<?php echo $this->form('contact_form', $options['form_attributes']); ?>
    <div class="field form-group">
        <?php echo $this->formLabel('name', __('Your Name'), array('class' => 'sr-only')); ?>
        <div class="col-xs-12">
            <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                <?php echo $this->formText('name', $options['name'], array('placeholder' => __('Your Name'))); ?>
            </div>
        </div>
    </div>
    <div class="field form-group">
        <?php echo $this->formLabel('email', __('Your Email'), array('class' => 'sr-only')); ?>
        <div class="col-xs-12">
            <div class="input-group">
                <span class="input-group-addon">@</span>
                <?php echo $this->formText('email', $options['email'], array('placeholder' => __('Your Email'))); ?>
            </div>
        </div>
    </div>
    <div class="field form-group">
        <?php echo $this->formLabel('message', __('Your Message'), array('class' => 'sr-only')); ?>
        <div class="col-xs-12">
            <?php echo $this->formTextarea('message', $options['message'], array('rows' => '10', 'placeholder' => __('Your message'), 'class' => 'form-control')); ?>
        </div>
    </div>

    <?php if ($options['captcha']): ?>
    <div class="field form-group">
        <?php echo $options['captcha']; ?>
    </div>
    <?php endif; ?>
    <?php echo $this->formHidden('path', $options['path']); ?>
    <div class="form-group">
        <div class="col-xs-12">
            <?php echo $this->formSubmit('send', __('Send Message'), array('class' => 'btn btn-primary')); ?>
        </div>
    </div>
</form>
</div>
