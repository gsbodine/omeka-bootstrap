<?php echo $this->form('search-form', $options['form_attributes']); ?>
    <div class="input-group">
        <?php echo $this->formText('query', $filters['query'], array(
            'title' => __('Search'),
            'class' => 'search-query',
            'placeholder' => __('Search'),
        )); ?>
        <span class="input-group-btn">
    <?php if ($options['show_advanced']): ?>
            <a href="#" id="show-advanced" class="show-advanced btn btn-default" role="button" tabindex="0">
                <span class="glyphicon glyphicon-plus"></span>
            </a>
    <?php endif; ?>
            <?php echo $this->formButton('submit_search', $options['submit_value'], array(
                'type' => 'submit',
                'class' => 'btn btn-default',
                'content' => '<span class="glyphicon glyphicon-search"></span>',
                'escape' => false,
            )); ?>
        </span>
    </div>
    <?php if ($options['show_advanced']): ?>
    <div id="advanced-form">
    <div class="popover-form">
        <fieldset id="query-types">
            <legend><?php echo __('Search using this query type:'); ?></legend>
            <?php echo $this->formRadio('query_type', $filters['query_type'], array(
                'form' => 'search-form',
            ), $query_types); ?>
        </fieldset>
        <?php if ($record_types): ?>
            <?php if (count($record_types) > 1): ?>
        <fieldset id="record-types">
            <legend><?php echo __('Search only these record types:'); ?></legend>
            <?php foreach ($record_types as $key => $value): ?>
            <?php echo $this->formCheckbox('record_types[]', $key, array(
                'checked' => in_array($key, $filters['record_types']),
                'id' => 'record_types-' . $key,
                'form' => 'search-form',
            )); ?> <?php echo $this->formLabel('record_types-' . $key, $value); ?><br />
            <?php endforeach; ?>
        </fieldset>
            <?php else: ?>
                <?php echo $this->formHidden('record_types[]', reset($filters['record_types'])); ?>
            <?php endif; ?>
        <?php elseif (is_admin_theme()): ?>
            <p><a href="<?php echo url('settings/edit-search'); ?>"><?php echo __('Go to search settings to select record types to use.'); ?></a></p>
        <?php endif; ?>
        <p><?php echo link_to_item_search(__('Advanced Search (Items only)')); ?></p>
    </div>
    </div>
    <?php else: ?>
        <?php echo $this->formHidden('query_type', $filters['query_type']); ?>
        <?php foreach ($filters['record_types'] as $type): ?>
        <?php echo $this->formHidden("record_types[{$type}]", $type); ?>
        <?php endforeach; ?>
    <?php endif; ?>
</form>
