<div class="exhibit record">
    <?php
    $image = record_image($exhibit, 'square_thumbnail', array('class' => 'center-block img-responsive'));
    $description = snippet_by_word_count(metadata($exhibit, 'description', array('no_escape' => true, 'snippet' => 150)));
    ?>
    <h3><?php echo exhibit_builder_link_to_exhibit($exhibit); ?></h3>
    <div class="image-featured">
    <?php if ($image): ?>
        <?php echo exhibit_builder_link_to_exhibit($exhibit, $image, array('class' => 'image')); ?>
    <?php else: ?>
        <?php $noFile = '<img src="' . img('no-file.png') . '" class="center-block img-responsive" alt="' . __('No file') . '" />'; ?>
        <?php echo link_to($exhibit, 'show', $noFile, array('class' => 'image none')); ?>
    <?php endif; ?>
    </div>
    <div class="exhibit-description">
        <?php if ($description): ?>
        <div class="ellipsis"><?php echo $description; ?></div>
        <?php endif; ?>
    </div>
</div>
