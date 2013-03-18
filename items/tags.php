<?php
$pageTitle = __('Browse Items');
echo head(array('title'=>$pageTitle,'bodyid'=>'items','bodyclass'=>'tags'));
?>

<div id="primary">

    <div class="page-title"><h1><i class="icon-tags"></i> <?php echo $pageTitle; ?> <small>By Current Tags </small></h1></div>
    <?php echo public_nav_items()->setUlClass('nav nav-pills'); ?>
    <div class="row">
        <div class="span12">
            <a href="/items/search#searchByTag" class="btn btn-warning" style="margin:2em"><i class="icon-search"></i> Search Tags by Name</a>
        </div>
    </div>
    <?php    
        asort($tags);
        echo tag_cloud($tags,url('items/browse')); ?>

</div><!-- end primary -->

<?php echo foot(); ?>
