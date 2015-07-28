<!DOCTYPE html>
<html class="<?php echo get_theme_option('Style Sheet'); ?>" lang="<?php echo get_html_lang(); ?>">
<head>
    <?php
        if(is_current_url('/')) { 
            echo '<link rel="stylesheet" type="text/css" href="themes/WearingGayHistoryTheme/css/mosaic-style.css" />';
        }
        ?>
    
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php if ($description = option('description')): ?>
    <meta name="description" content="<?php echo $description; ?>">
    <?php endif; ?>

    <?php
    if (isset($title)) {
        $titleParts[] = strip_formatting($title);
    }
    $titleParts[] = option('site_title');
    ?>
    <title><?php echo implode(' · ', $titleParts); ?></title>

    <?php echo auto_discovery_link_tags(); ?>

    <!-- Plugin Stuff -->
    <?php fire_plugin_hook('public_head', array('view' => $this)); ?>

    <!-- Stylesheets -->
    <?php if ($temp_banner = get_theme_option('temp banner text')) {
        queue_css_file('beta');
    } ?>
    <?php if (get_theme_option('Use Internal Bootstrap') == '1') {
        queue_css_file('bootstrap.min');
    }
    else {
        queue_css_url('//netdna.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css');
    }
    queue_css_file('style');
    echo head_css();
    ?>
    
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <!-- JavaScripts -->
    <?php queue_js_file(array('globals', 'vendor/jquery-accessibleMegaMenu')); ?>
    <?php echo head_js(); ?>
    <?php // see footer for bootstrap-related js...
    queue_js_file('globals');
    echo head_js(); ?>
</head>
<?php echo body_tag(array('id' => @$bodyid, 'class' => @$bodyclass)); ?>
    <?php include_once("analyticstracking.php") ?>
    <?php fire_plugin_hook('public_body', array('view' => $this)); ?>
    <?php if ($temp_banner) : ?>
   
    <?php endif; ?>
    <div>
        
    <div class="container" id="logo">
        <div class="row">
        <div class="col-md-12 col-sm-12" id="logoimg">
        <?php echo link_to_home_page(theme_logo()); ?>
        </div>
        </div>
    </div>
        <nav class="navbar" id="wrap">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>

            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse" id="bs-example-navbar-collapse-1">
                <?php $nav = public_nav_main(); echo $nav->setUlClass('nav navelement navbar-nav')?>
            
            <ul class="nav navbar-nav">
                <li><a href="https://twitter.com/WearingGayHist"  target="__blank"><i class="fa fa-lg fa-twitter"></i></a></li>
                <li><a href="https://www.facebook.com/Wearinggayhistory"  target="__blank"><i class="fa fa-lg fa-facebook"></i></a></li>
            </ul>
            
            </div>
            
            
        </nav>
        </div>
        <div class="container" id="wrapper">
        <div id="content">
