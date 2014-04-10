<!DOCTYPE html>
<html class="<?php echo get_theme_option('Style Sheet'); ?>" lang="<?php echo get_html_lang(); ?>">
<head>
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
    <title><?php echo implode(' &middot; ', $titleParts); ?></title>

    <?php echo auto_discovery_link_tags(); ?>

    <!-- Plugin Stuff -->
    <?php fire_plugin_hook('public_head', array('view'=>$this)); ?>

    <!-- Stylesheets -->
    <?php if ($temp_banner = get_theme_option('temp banner text')) {
        queue_css_file('beta');
    } ?>
    <?php if (get_theme_option('Use Internal Bootstrap') == '1') {
        queue_css_file('bootstrap.min');
    }
    else {
        queue_css_url('//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css');
    }
    queue_css_file('style');
    echo head_css();
    ?>

    <!-- JavaScripts -->
    <?php // see footer for bootstrap-related js...
    queue_js_file('globals');
    echo head_js(); ?>
</head>
<?php echo body_tag(array('id' => @$bodyid, 'class' => @$bodyclass)); ?>
    <?php fire_plugin_hook('public_body', array('view'=>$this)); ?>
    <?php if ($temp_banner) : ?>
    <span id="corner-banner">
        <em><?php echo $temp_banner; ?></em>
    </span>
    <?php endif; ?>
    <div id="wrap" class="container">
        <header id="header" role="banner">
            <div id="site-title">
                <div class=""><?php echo link_to_home_page(theme_logo()); ?></div>
            </div>
            <div id="search-container pull-right">
                <?php echo search_form(array('show_advanced' => true, 'class' => 'form-inline pull-right', 'role' => 'form')); ?>
            </div>
            <?php fire_plugin_hook('public_header', array('view'=>$this)); ?>
        </header>

        <nav class="top navbar navbar-default" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle menu</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/"><?php echo get_theme_option('navbar_brand_text'); ?></a>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <?php $nav = public_nav_main(); echo $nav->setUlClass('nav navbar-nav navbar-right')?>
            </div>
        </nav>

        <div id="content" class="container">