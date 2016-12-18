<div class="collection record">
    <?php
    $title = metadata($collection, 'display_title');
    $description = metadata($collection, array('Dublin Core', 'Description'), array('snippet' => 150));
    ?>
    <h3 class="ellipsis"><?php echo link_to($this->collection, 'show', $title); ?></h3>
    <?php if ($collectionImage = record_image($collection, 'square_thumbnail', array('class' => 'img-responsive'))): ?>
        <?php echo link_to($this->collection, 'show', $collectionImage, array('class' => 'image')); ?>
    <?php else: ?>
        <?php $noFile = '<img src="' . img('no-file.png') . '" class="img-responsive" alt="' . __('No file') . '" />'; ?>
        <?php echo link_to($this->collection, 'show', $noFile, array('class' => 'image none')); ?>
    <?php endif; ?>
    <?php if ($description): ?>
        <p class="collection-description ellipsis"><?php echo $description; ?></p>
    <?php endif; ?>
</div>