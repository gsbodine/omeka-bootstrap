<?php
$title = metadata('exhibit_page', 'title');
echo head(array(
    'title' => $title . ' &middot; ' . metadata('exhibit', 'title'),
    'bodyclass' => 'exhibits show',
));
?>
<div class="primary">
    <?php // Don't duplicate the main breadcrumb, but set it if needed.
    /* Not used, because there is the nav as main tree.
    if (!($breadcrumb = get_theme_option('Display Breadcrumb Trail'))):
        echo common('breadcrumb', array('title' => @$title, 'mode' => $breadcrumb));
    endif; ?>
    */
    ?>
<div class="row page-header">
    <div class="col-xs-12">
        <h1><span class="glyphicon glyphicon-eye-open"></span> <?php echo $title; ?></h1>
    </div>
</div>
<div class="row">
<div class="col-sm-9">
    <?php /*
    <nav id="exhibit-child-pages">
        <?php echo exhibit_builder_child_page_nav(); ?>
    </nav>
    */ ?>
    <div id="exhibit-blocks" role="main">
        <?php exhibit_builder_render_exhibit_page(); ?>
    </div>
<nav class="pager" id="exhibit-page-navigation">
    <?php if ($prevLink = exhibit_builder_link_to_previous_page()): ?>
    <div id="exhibit-nav-prev" class="previous">
    <?php echo $prevLink; ?>
    </div>
    <?php endif; ?>
    <?php if ($nextLink = exhibit_builder_link_to_next_page()): ?>
    <div id="exhibit-nav-next" class="next">
    <?php echo $nextLink; ?>
    </div>
    <?php endif; ?>
    <div id="exhibit-nav-up">
    <?php echo exhibit_builder_page_trail(); ?>
    </div>
</nav>
</div>
<div class="col-sm-3">
    <nav id="exhibit-pages">
        <h4><?php echo exhibit_builder_link_to_exhibit($exhibit); ?></h4>
        <?php echo exhibit_builder_page_tree($exhibit, $exhibit_page); ?>
    </nav>
</div>
</div>
</div>
<?php echo foot();
