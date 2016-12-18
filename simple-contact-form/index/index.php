<?php
$pageTitle = __('Contact Us');
echo head(array(
    'title' => $pageTitle,
    'bodyclass' => 'contact-us',
    'bodyid' => 'contact-us',
));
?>
<div id="primary">
    <div class="row">
        <div class="col-xs-12">
            <h1><span class="glyphicon glyphicon-pencil"></span> <?php echo html_escape(get_option('simple_contact_page_contact_title')); ?></h1>
            <?php echo bootstrap_flash('danger'); ?>
         </div>
    </div>
    <div id="form-instructions">
        <?php echo get_option('simple_contact_page_contact_text'); // HTML ?>
    </div>
<div id="simple-contact">
<?php
// Keep the form of the fork of Simple Contact.
$options = array(
    'form_attributes' => array('class' => 'form-horizontal'),
    'name' => $name,
    'email' => $email,
    'message' => $message,
    'captcha' => $captcha,
    'path' => 'contact',
);
echo $this->form('contact_form', $options['form_attributes']); ?>
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
                <?php echo $this->formText('email', $options['email'], array( 'placeholder' => __('Your Email'))); ?>
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
</div>
<?php echo foot();
