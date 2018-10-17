<?php
$carousel = get_theme_option('display_homepage_carousel');
if ($carousel) {
    queue_css_file(array(
        'vendor/owl-carousel/owl.carousel',
        'vendor/owl-carousel/owl.transitions',
        'owl.theme',
    ));
    queue_js_file('vendor/owl-carousel/owl.carousel.min');

    // Prepare the carousel with a dir inside images/carousel.
    $imagesDir = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'carousel' . DIRECTORY_SEPARATOR;
    $images = is_dir($imagesDir) ? glob($imagesDir . '*.{png,jpg,gif}', GLOB_BRACE) : array();
    $images = array_map('basename', $images);
    if (empty($images)) {
        $carousel = false;
    }
}

echo head(array(
    'bodyid' => 'home',
));
?>
<?php if ($carousel): ?>
<div id="owl-carousel" class="owl-carousel">
    <?php foreach ($images as $image): ?>
    <div>
       <img src="<?php echo src($image, 'images/carousel'); ?>" class="img-responsive" alt="slide">
    </div>
    <?php endforeach; ?>
</div>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $("#owl-carousel").owlCarousel( {
            items: <?php echo count($images); ?>,
            singleItem: true,
            autoPlay: true,
            slideSpeed: 400,
            paginationSpeed: 1000,
            stopOnHover: false,
            transitionStyle: "fade"
        });
    });
</script>
<?php endif; ?>

<?php
if (get_theme_option('Display Grid Rotator')):
    $items = get_random_featured_items('100', true);
    displayGridRotator($items);
endif;
?>

<?php $homepageText = get_theme_option('Homepage Text'); ?>
<?php if ($homepageText): ?>
<div class="row home-features home-text" id="home-tagline"> <?php // start tagline ?>
    <div class="col-xs-12 col-sm-10">
        <?php /* <h1 id="tagline"><?php echo option('site_title'); ?></h1> */ ?>
        <?php echo $homepageText; ?>
    </div>
</div>
<?php endif; ?>

<div class="row home-features"> <?php // start about & tag cloud ?>
    <div class="col-sm-4 home-stories"> <?php // about ?>
        <?php if (get_theme_option('Display Featured Exhibit')
            && plugin_is_active('ExhibitBuilder')
            && function_exists('exhibit_builder_display_random_featured_exhibit')): ?>
        <?php // Featured Exhibit. It uses the partial exhibits/single.php. ?>
            <?php echo exhibit_builder_display_random_featured_exhibit(); ?>
        <?php endif; ?>
    </div><?php // end about ?>

    <div class="col-sm-4 home-themes"><?php // tag cloud ?>
        <?php if (get_theme_option('Display Homepage Tags')): ?>
        <h2 id="tagcloud"><?php echo __('Themes'); ?></h2>
        <?php echo tag_cloud(get_recent_tags(15), '/items/browse', 9); ?>
        <a style="margin-left:10px;" href="<?php echo url('items/tags'); ?>" class="btn btn-default"><?php echo __('View More'); ?></a>
        <?php endif; ?>
    </div>
    <div class="col-sm-4 home-map">
    <?php if (get_theme_option('Display Homepage Map') && plugin_is_active('Geolocation')): ?>
        <h2><?php echo __('Map'); ?></h2>
        <a href="<?php echo url('geolocation/map/browse'); ?>"> <?php echo __('Display Geolocation Map.'); ?></a>
    <?php endif; ?>
    </div>
</div>

<div class="row home-features">
    <div class="col-sm-4 home-items">
        <?php if (get_theme_option('Display Featured Item')): ?>
        <div id="featured-item">
            <h2><?php echo __('Featured Item'); ?></h2>
            <?php echo random_featured_items(1); ?>
        </div>
        <?php endif; ?>
    </div>
    <div class="col-sm-4 home-collection">
    <?php if (get_theme_option('Display Featured Collection')): ?>
        <div id="featured-collection">
            <h2><?php echo __('Featured Collection'); ?></h2>
            <?php echo random_featured_collection(); ?>
        </div>
    <?php endif; ?>
    </div>
    <div class="col-sm-4 home-recents">
    <?php
        $recentItems = (integer) get_theme_option('Homepage Recent Items');
        if ($recentItems): ?>
        <div id="recent-items">
            <h2><?php echo __('Recently Added Items'); ?></h2>
            <?php echo recent_items($recentItems); ?>
            <p class="view-items-link"><a href="<?php echo html_escape(url('items')); ?>"><?php echo __('View All Items'); ?></a></p>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php fire_plugin_hook('public_home', array('view' => $this)); ?>

<?php echo foot();
