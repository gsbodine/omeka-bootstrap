<!DOCTYPE html>
<html class="<?php echo get_theme_option('Style Sheet'); ?>" lang="<?php echo get_html_lang(); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php if ($description = option('description')): ?>
    <meta name="description" content="<?php echo $description; ?>">
    <?php endif; ?>
    <?php /* <link rel="shortcut icon" href="<?php echo src('favicon.ico'); ?>" type="image/x-icon" /> */ ?>
    <?php /* <link rel="apple-touch-icon" href="<?php echo src('images/favicon.svg'); ?>" /> */ ?>
    <?php
    echo auto_discovery_link_tags();

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
    <?php
    if (get_theme_option('Use Internal Bootstrap')) {
        queue_css_file('bootstrap.min');
        queue_css_file('font-awesome.min');
    } else {
        queue_css_url('//netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');
        queue_css_url('//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    }
    queue_css_url('//fonts.googleapis.com/css?family=Lato:300,400,700|Didact+Gothic');
    queue_css_file('style');
    $displayBanner = get_theme_option('Display Corner Banner');
    if ($displayBanner) {
        queue_css_file('corner-banner');
    }
    if (get_theme_option('Display Grid Rotator') && is_current_url('/')) {
        queue_css_file('mosaic-style');
    }
    echo head_css();
    ?>

    <!-- JavaScripts -->
    <?php queue_js_file(array('globals', 'vendor/jquery-accessibleMegaMenu')); ?>
    <?php echo head_js(); ?>
    <?php // see footer for bootstrap-related js...
    queue_js_file('globals');
    echo head_js(); ?>
</head>
<?php echo body_tag(array('id' => @$bodyid, 'class' => @$bodyclass)); ?>
    <?php fire_plugin_hook('public_body', array('view' => $this)); ?>
    <?php if ($displayBanner): ?>
    <span id="corner-banner">
        <em><?php echo $displayBanner; ?></em>
    </span>
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
                <?php
                $twitter = get_theme_option('Link Twitter');
                $facebook = get_theme_option('Link Facebook');
                if ($twitter || $facebook): ?>
                <ul class="nav navbar-nav">
                    <?php if ($twitter): ?>
                    <li><a href="<?php echo $twitter; ?>" target="__blank"><i class="fa fa-lg fa-twitter"></i></a></li>
                    <?php endif; ?>
                    <?php if ($facebook): ?>
                    <li><a href="<?php echo $facebook; ?>" target="__blank"><i class="fa fa-lg fa-facebook"></i></a></li>
                    <?php endif; ?>
                </ul>
                <?php endif; ?>
            </div>
         </div>
    </nav>
    <div class="container" id="wrapper">
        <div id="content">
