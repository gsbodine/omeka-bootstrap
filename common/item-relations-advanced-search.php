<?php
  $provideRelationComments = get_option('item_relations_provide_relation_comments');
?>
<div class="field form-group form-inline">
    <?php echo $this->formLabel('item_relations_property_id', __('Item Relations')); ?>
    <div class="col-sm-10">
    <div class="inputs input-group">
        <div class="radio">
            <label>
               <input type="radio" name="item_relations_clause_part" value="subject" checked="checked" /><?php echo __('Subject '); ?>
            </label>
        </div>
        <div class="radio">
            <label>
                <input type="radio" name="item_relations_clause_part" value="object" /><?php echo __('Object'); ?>
            </label>
        </div>
    </div>
    <span class="explanation help-block">
    <?php
        echo __('Filter this search for items being "Subject" or "Object".');
    ?>
    </span>
    <div class="inputs input-group">
        <?php echo $this->formSelect('item_relations_property_id', @$_GET['item_relations_property_id'], array('class' => 'inline'), $formSelectProperties); ?>
    </div>
    <span class="explanation help-block">
        <?php
        echo __('Filter this search for items with the selected '
            . 'relation. For example, when selecting "Subject" items with the '
            . '"hasPart" relation, the search will return all items that have '
            . 'parts. When selecting "Object" items with the same relation, the '
            . 'search will return all items that are parts of other items.');
        ?>
    </span>
    <?php if ($provideRelationComments) : ?>
    <div class="inputs input-group">
        <?php echo $this->formText('item_relations_comment', @$_GET['item_relations_comment'], array('size' => '40')); ?>
    </div>
    <span class="explanation help-block">
        <?php
            echo __('Filter this search for items in relations that contain a certain text portion in their comments.');
        ?>
    </span>
    <?php endif; ?>
    </div>
</div>
