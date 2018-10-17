<div class="collection record">
    <?php
    $title = metadata($collection, 'display_title');
    $image = record_image($collection, 'square_thumbnail', array('class' => 'center-block img-responsive'));
    $description = metadata($collection, array('Dublin Core', 'Description'), array('no_escape' => true, 'snippet' => 150));
    ?>
    <h3 class="ellipsis"><?php echo link_to($this->collection, 'show', $title); ?></h3>
    <div class="image-featured">
    <?php if ($image): ?>
        <?php echo link_to($collection, 'show', $image, array('class' => 'image')); ?>
    <?php else: ?>
        <?php $noFile = '<img src="' . img('no-file.png') . '" class="center-block img-responsive" alt="' . __('No file') . '" />'; ?>
        <?php echo link_to($collection, 'show', $noFile, array('class' => 'image none')); ?>
    <?php endif; ?>
    </div>
    <div class="collection-description">
    <?php if ($description): ?>
        <div class="ellipsis"><?php echo $description; ?></div>
    <?php endif; ?>
    </div>
</div>
