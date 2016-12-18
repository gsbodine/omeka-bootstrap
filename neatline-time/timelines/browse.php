<?php
/**
 * The public browse view for Timelines.
 */

$head = array('bodyclass' => 'timelines primary',
              'title' => html_escape(__('Browse Timelines')));
echo head($head);
?>

<div class="timelines">
    <h1><span class="glyphicon glyphicon-time"></span> <?php echo __('Browse Timelines'); ?></h1>
    <?php
    $linkToNav = get_option('neatline_time_link_to_nav');
    if ($linkToNav == 'browse' || $linkToNav == 'main'): ?>
    <nav class="items-nav navigation secondary-nav">
        <?php echo public_nav_items()->setUlClass('nav nav-pills'); ?>
    </nav>
    <?php endif; ?>
    <?php if ($total_results) : ?>
    <?php foreach (loop('Neatline_Time_Timelines') as $timeline): ?>
    <div class="timeline">
        <h2><?php echo link_to($timeline, 'show', $timeline->title); ?></h2>
        <?php echo snippet_by_word_count(metadata($timeline, 'description'), '10'); ?>
    </div>
    <?php endforeach; ?>
    <div class="pagination">
      <?php echo pagination_links(); ?>
    </div>
    <?php else: ?>
    <p><?php echo __('You have no timelines.'); ?></p>
    <?php endif; ?>
</div>
<?php echo foot();
