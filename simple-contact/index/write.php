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
    <?php echo $this->simpleContactForm(array('form_attributes' => array('class' => 'form-horizontal'))); ?>
</div>
<?php echo foot();
