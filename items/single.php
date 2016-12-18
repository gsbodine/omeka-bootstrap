<div class="item record">
    <?php
    $title = metadata($item, 'display_title');
    $description = metadata($item, array('Dublin Core', 'Description'), array('snippet' => 150));
    ?>
    <h3 class="ellipsis"><?php echo link_to($item, 'show', $title); ?></h3>
    <?php if (metadata($item, 'has files')):
        echo link_to_item(
            item_image('square_thumbnail', array('class' => 'img-responsive'), 0, $item),
            array('class' => 'image'), 'show', $item
        );
    else:
        $noFile = '<img src="' . img('no-file.png') . '" class="img-rounded img-responsive img-polaroid" alt="' . __('No file') . '" />';
        echo link_to_item($noFile, array('class' => 'image none'), 'show', $item);
    endif; ?>
    <?php if ($description): ?>
        <p class="item-description caption ellipsis"><?php echo $description; ?></p>
    <?php endif; ?>
</div>
