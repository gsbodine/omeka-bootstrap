<?php
$pageTitle = __('Browse Items');
echo head(array('title'=>$pageTitle,'bodyid'=>'items','bodyclass'=>'tags'));
?>

<div id="primary">

    <div class="page-title"><h1><?php echo $pageTitle; ?> <small>By Current Tags</small></h1></div>

    <ul class="navigation item-tags nav nav-tabs" id="secondary-nav">
        <?php echo public_nav_items(); ?>
    </ul>
    
    <?php 
        asort($tags);
        echo tag_cloud($tags,uri('items/browse')); ?>

</div><!-- end primary -->

<?php echo foot(); ?>
