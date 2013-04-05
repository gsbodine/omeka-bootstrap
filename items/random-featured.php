<?php if ($items): ?>
    <?php foreach ($items as $item): ?>
        <div class="random-document">
            <div class="row">
                <div class="span3"><h4 class="text-center">Featured Document</h4></div>
        <?php
        $title = metadata($item, array('Dublin Core', 'Title'));
        $description = metadata($item, array('Dublin Core', 'Description'), array('snippet' => 50));
        ?> <div class="span3 text-center">
                <div class="text-center">
                    <?php if (metadata($item, 'has thumbnail')) {
                        echo link_to_item(
                            item_image('fullsize', array('class'=>'img-polaroid span2','style'=>'margin-bottom:1em'), 0, $item), 
                            array(), 'show', $item
                        );
                    }
                    ?>
                </div>
        </div>
                <div class="span3 text-center">
                    <p><small><strong><?php echo link_to($item, 'show', strip_formatting($title)); ?></strong></small></p>
                </div>
        <?php if ($description) {
            //echo '<p class="item-description"><small>' . $description . '</small></p>';
        } ?>
            </div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p><?php echo __('There is no featured document at this time.'); ?></p>
<?php endif; ?>
