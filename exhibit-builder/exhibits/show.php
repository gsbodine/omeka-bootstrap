<?php
echo head(array(
    'title' => metadata('exhibit_page', 'title') . ' &middot; ' . metadata('exhibit', 'title'),
    'bodyid' => 'exhibit',
    'bodyclass' => 'show'));
?>
<div class="row">
    <h1 class="text-center clearfix"><span class="exhibit-page"><?php echo metadata('exhibit_page', 'title'); ?></h1>
    <hr />
</div>
<div class="row">
    <div class="span9">
        <nav id="exhibit-child-pages">
            <?php echo exhibit_builder_child_page_nav(); ?>
        </nav>
        
        <?php 
            exhibit_builder_render_exhibit_page(); 
        ?>
        
        <div id="exhibit-page-navigation">
            <?php if ($prevLink = exhibit_builder_link_to_previous_page()): ?>
            <div id="exhibit-nav-prev">
            <?php echo $prevLink; ?>
            </div>
            <?php endif; ?>
            <?php if ($nextLink = exhibit_builder_link_to_next_page()): ?>
            <div id="exhibit-nav-next">
            <?php echo $nextLink; ?>
            </div>
            <?php endif; ?>
            <div id="exhibit-nav-up">
            <?php // echo exhibit_builder_page_trail(); ?>
            </div>
        </div>
    </div>
    <div class="span3">
        <nav id="exhibit-pages">
            <?php echo exhibit_builder_page_nav(); ?>
        </nav>
    </div>
</div>


<?php echo foot(); ?>
