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

    <!-- Plugin Stuff -->
    <?php //plugin_header(); ?>

    <!-- Stylesheets -->
    <?php
        queue_css_file(array('bootstrap','font-awesome','site'));
        echo head_css();
    ?>

    <!-- JavaScripts -->
    <?php 
        queue_js_file(array('bootstrap.min','site'),$dir='js');
        
        if (get_theme_option('Use Google Analytics') == 1): ?>
            <script type="text/javascript">
                var _gaq = _gaq || [];
                _gaq.push(['_setAccount', '<?php echo html_entity_decode(get_theme_option('Google Analytics Account')); ?>']);
                _gaq.push(['_trackPageview']);

                (function() {
                  var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                  ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
                })();

             </script>
            
    <?php endif;
        
        echo head_js(); 
    ?>
</head>

<?php echo body_tag(array('id' => @$bodyid, 'class' => @$bodyclass)); ?>
<?php fire_plugin_hook('public_body', array('view'=>$this)); ?>
<div id="wrap">
<div class="container">
    <div class="row">
        <div class="span12">
            <?php fire_plugin_hook('public_header'); ?>
        </div>
    </div>
    <div class="row">
    <div id="header">
        <div class="span8">
            <div id="site-title" class="page-header">
                <h1><?php echo link_to_home_page(theme_logo()); ?></h1>
            </div>
        </div>
        <div class="span4">
            <div id="search-container" class="pull-right" style="margin-top: 20px;"><?php echo search_form(array(true,'Search',array('class'=>'form-search pull-right'))); ?>
                <div class="pull-right">
                    <i class="icon-search"></i> <?php //echo link_to_advanced_search($text='Advanced Search Options',$props=array('class'=>'text-warning')); ?>
                </div>
            </div><!-- end search -->
        </div>
    </div><!-- end header -->
    <?php //echo custom_header_image(); ?>
    </div> 
    <div class="navbar">
        <div id="primary-nav" class="navbar-inner">
            
                <?php $nav = public_nav_main(); echo $nav->setUlClass('nav') ?>
            
        </div><!-- end primary-nav -->
    </div><!-- end navbar -->
</div>
        <div id="content" class="container">
                <?php fire_plugin_hook('public_content_top'); ?>