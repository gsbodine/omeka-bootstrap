<!DOCTYPE html>
<html lang="<?php echo get_html_lang(); ?>">
<head>
    <meta charset="utf-8">
    <?php if ( $description = settings('description')): ?>
    <meta name="description" content="<?php echo $description; ?>" />
    <?php endif; ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title><?php echo settings('site_title'); echo isset($title) ? ' | ' . strip_formatting($title) : ''; ?></title>

    <?php echo auto_discovery_link_tags(); ?>

    <!-- Plugin Stuff -->
    <?php fire_plugin_hook('public_theme_header'); ?>

    <!-- Stylesheets -->
    <?php
        queue_css(array('bootstrap','font-awesome','site'));
        display_css();
    ?>

    <!-- JavaScripts -->
    <?php 
        queue_js(array('bootstrap','site'),$dir='js');
        display_js(); 
    ?>
</head>

<?php echo body_tag(array('id' => @$bodyid, 'class' => @$bodyclass)); ?>
<?php plugin_body(); ?>
<div id="wrap">
<div class="container">
    <div class="row">
        <div class="span12">
            <?php plugin_page_header(); ?>
        </div>
    </div>
    <div class="row">
    <div id="header">
        <div class="span8">
            <div id="site-title" class="page-header">
                <h1><?php echo link_to_home_page(custom_display_logo()); ?></h1>
            </div>
        </div>
        <div class="span4">
            <div id="search-container" class="pull-right" style="margin-top: 20px;"><?php echo bootstrap_simple_search($buttonText='Search',$formProperties=array('class'=>'form-search pull-right')); ?>
                <div class="pull-right">
                    <i class="icon-search"></i> <?php echo link_to_advanced_search($text='Advanced Search Options',$props=array('class'=>'text-warning')); ?>
                </div>
            </div><!-- end search -->
        </div>
    </div><!-- end header -->
    <?php echo custom_header_image(); ?>
    </div> 
    <div class="navbar">
        <div id="primary-nav" class="navbar-inner">
            <ul class="nav">
            <?php echo custom_public_nav_header(); ?>
            </ul>
        </div><!-- end primary-nav -->
    </div><!-- end navbar -->
</div>
        <div id="content" class="container">
                <?php plugin_page_content(); ?>