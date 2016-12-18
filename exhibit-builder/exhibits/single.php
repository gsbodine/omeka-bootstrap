<div class="exhibit record">
    <h3 class="ellipsis"><?php echo exhibit_builder_link_to_exhibit($exhibit); ?></h3>
    <div class="exhibitimg">
    <?php if ($exhibitImage = record_image($exhibit, 'square_thumbnail', array('class' => 'img-responsive'))): ?>
        <?php echo exhibit_builder_link_to_exhibit($exhibit, $exhibitImage, array('class' => 'image')); ?>
    <?php endif; ?>
    </div>
    <div class="exhibitdescrp">
    <p class="ellipsis"><?php echo snippet_by_word_count(metadata($exhibit, 'description', array('no_escape' => true))); ?></p>
    </div>
</div>
