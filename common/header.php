<!DOCTYPE html>
<html class="<?php echo get_theme_option('Style Sheet'); ?>" lang="<?php echo get_html_lang(); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php if ($description = option('description')): ?>
    <meta name="description" content="<?php echo $description; ?>">
    <?php endif; ?>
    <?php /* <link rel="shortcut icon" href="<?php echo img('favicon.ico'); ?>" type="image/x-icon" /> */ ?>
    <?php /* <link rel="apple-touch-icon" href="<?php echo img('favicon.svg'); ?>" type="image/svg+xml" /> */ ?>
    <?php
    if (isset($title)) {
        $titleParts[] = strip_formatting($title);
    }
    $titleParts[] = option('site_title');
    ?>
    <title><?php echo implode(' &middot; ', $titleParts); ?></title>

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
    queue_css_file('style');
    $displayCornerBanner = get_theme_option('Display Corner Banner');
    if ($displayCornerBanner) {
        queue_css_file('corner-banner');
    }
    if (get_theme_option('Display Grid Rotator') && is_current_url('/')):
        queue_css_file('grid-rotator-style');
    ?>
        <noscript>
        <link rel="stylesheet" type="text/css" href="<?php echo css_src('grid-rotator-fallback'); ?>" />
        </noscript>
        <!--[if lt IE 9]>
        <link rel="stylesheet" type="text/css" href="<?php echo css_src('grid-rotator-fallback'); ?>" />
        <![endif]-->
    <?php
    endif;

    echo head_css();
    ?>

    <!-- JavaScripts -->
    <?php If (get_theme_option('Use Accessible Mega Menu')):
        queue_js_file(array('globals', 'vendor/jquery-accessibleMegaMenu'));
    endif; ?>
    <?php // see footer for bootstrap-related js...
    echo head_js(); ?>
</head>
<?php echo body_tag(array('id' => @$bodyid, 'class' => @$bodyclass)); ?>
    <!-- <a href="#content" id="skipnav"><?php echo __('Skip to main content'); ?></a> -->
    <?php fire_plugin_hook('public_body', array('view' => $this)); ?>
    <?php if ($displayCornerBanner): ?>
    <span id="corner-banner">
        <em><?php echo $displayCornerBanner; ?></em>
    </span>
    <?php endif; ?>
    <header id="header" role="banner" class="container">
        <div class="row">
            <div id="site-title" class="col-sm-6">
                <div class="logoimg">
                    <h1><?php echo link_to_home_page(str_replace('>', ' class="img-responsive">', theme_logo())); ?></h1>
                </div>
            </div>
            <div id="search-container" class="col-sm-6" role="search">
                <?php echo search_form(array(
                    'show_advanced' => get_theme_option('Use Advanced Search'),
                    'submit_value' => __('Search'),
                    'form_attributes' => array('class' => 'form-search navbar-form navbar-right', 'role' => 'form'))); ?>
            </div>
        </div>
        <?php fire_plugin_hook('public_header', array('view' => $this)); ?>
    </header>
    <?php // Eventually remove the container to set the menu through screen. ?>
    <div class="container">
    <nav id="nav-wrap" class="navbar navbar-default">
        <div class="container-fluid">
            <?php // Brand and toggle get grouped for better mobile display ?>
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only"><?php echo __('Toggle navigation'); ?></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <?php if ($navbarBrandText = get_theme_option('Navbar Brand Text')): ?>
                <a class="navbar-brand" href="#"><?php echo $navbarBrandText; ?></a>
                <?php endif; ?>
            </div>
            <div class="navbar-collapse collapse" id="navbar">
                <?php $nav = bootstrap_nav(public_nav_main(), array(
                    'ulClass' => 'navigation nav navbar-nav navbar-left',
                    'addExternalLinks' => false,
                ));
                echo $nav;

                // Set a second part of the navbar.
                $twitter = get_theme_option('Link Twitter');
                $facebook = get_theme_option('Link Facebook');
                if ($twitter || $facebook): ?>
                <ul class="nav navbar-nav navbar-right">
                    <?php if ($twitter): ?>
                    <li><a href="<?php echo $twitter; ?>" target="__blank" class="navbar-link"><span class="fa fa-lg fa-twitter"></span></a></li>
                    <?php endif; ?>
                    <?php if ($facebook): ?>
                    <li><a href="<?php echo $facebook; ?>" target="__blank" class="navbar-link"><span class="fa fa-lg fa-facebook"></span></a></li>
                    <?php endif; ?>
                </ul>
                <?php endif; ?>
                <?php if (plugin_is_active('LocaleSwitcher')): ?>
                <?php echo $this->localeSwitcher(); ?>
                <?php endif; ?>
            </div>
         </div>
    </nav>
    <?php if ($breadcrumb = get_theme_option('Display Breadcrumb Trail')):
        echo common('breadcrumb', array('title' => @$title, 'mode' => $breadcrumb));
    endif; ?>
    </div>
    <div class="container" id="wrapper">
        <div id="content">
