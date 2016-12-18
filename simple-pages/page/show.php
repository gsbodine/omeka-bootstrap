<?php
$title = metadata('simple_pages_page', 'title');
$bodyclass = 'page simple-page';
if ($is_home_page):
    $bodyclass .= ' simple-page-home';
endif;

echo head(array(
    'title' => $title,
    'bodyclass' => $bodyclass,
    'bodyid' => metadata('simple_pages_page', 'slug')
));
?>
<div id="primary">
    <?php if (!$is_home_page): ?>
    <div class="row page-header">
        <div class="col-xs-12">
            <h1><?php echo $simple_pages_page->title; ?></h1>
        </div>
    </div>
    <?php endif;

    $text = metadata('simple_pages_page', 'text', array('no_escape' => true));
    echo $this->shortcodes($text);
    ?>
</div>
<?php echo foot();
