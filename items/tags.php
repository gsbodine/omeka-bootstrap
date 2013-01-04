<?php
$pageTitle = __('Browse Items');
echo head(array('title'=>$pageTitle,'bodyid'=>'items','bodyclass'=>'tags'));
?>

<div id="primary">

    <div class="page-title"><h1><i class="icon-tags"></i> <?php echo $pageTitle; ?> <small>By Current Tags </small></h1></div>
    <?php echo public_nav_items()->setUlClass('nav nav-pills'); ?>
    
    <?php 
        asort($tags);
        echo tag_cloud($tags,url('items/browse')); ?>

</div><!-- end primary -->

<?php echo foot(); ?>
