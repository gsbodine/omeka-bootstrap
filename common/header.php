<!DOCTYPE html>
<html lang="<?php echo get_html_lang(); ?>">
<head>
    <meta charset="utf-8">
    <?php if ( $description = get_theme_option('description')): ?>
    <meta name="description" content="<?php echo $description; ?>" />
    <?php  endif; ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title><?php echo option('site_title'); echo isset($title) ? ' | ' . strip_formatting($title) : ''; ?></title>

    <?php echo auto_discovery_link_tags(); ?>

    <?php fire_plugin_hook('public_head',array('view'=>$this)); ?>

    
    <?php
        queue_css_file(array('bootstrap.min','bootstrap-responsive.min'));
        echo head_css();
    ?>
    <link rel="shortcut icon" href="<?php echo img('favicon.ico'); ?>" />
    <link href="//fonts.googleapis.com/css?family=Arvo:400,700|Oxygen:400,300" rel="stylesheet" type="text/css" />
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css" rel="stylesheet">
    
    <?php 
        queue_js_file(array('bootstrap.min','site'),$dir='js');
        echo head_js(); 
    ?>
</head>

<?php echo body_tag(array('id' => @$bodyid, 'class' => @$bodyclass)); ?>
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-39775971-1', 'berry.edu');
    ga('send', 'pageview');

</script>

<?php fire_plugin_hook('public_body', array('view'=>$this)); ?>
<div class="container">
    <header role="banner">
    <div class="row">
        <div class="span12">
            <div id="headerPluginHook">
                <?php fire_plugin_hook('public_header'); ?>
            </div>
        </div>
    </div>
    <div class="row">
    <div id="header">
        <div class="span8">
            <div id="site-title">
                <h1><?php echo link_to_home_page(theme_logo()); ?></h1>
            </div>
        </div>
        <div class="span4">
            <div id="search-container" class="pull-right">
                <div class="pull-right" style="padding-bottom: 5px;">
                    <?php echo link_to_item_search($text='<i class="icon-search" style="color: #fff;"></i> Advanced Search Options',$props=array('class'=>'label label-info')); ?>
                </div>
                <?php echo bootstrap_simple_search(); ?>
            </div>
        </div>
    </div>
    <?php //echo custom_header_image(); ?>
    </div> 
    </header>
    <div class="navbar">
        <div id="primary-nav" class="navbar-inner">
             <?php $nav = public_nav_main(); echo $nav->setUlClass('nav') ?>
        </div>
    </div>
</div>
<div id="content" class="container">
    <?php fire_plugin_hook('public_content_top', array('view'=>$this)); ?>