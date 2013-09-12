<?php echo $this->form('search-form', $options['form_attributes']); ?>
<div class="col-lg-3">
    <?php echo $this->formText('query', $filters['query'], array('class'=>'form-control','placeholder'=>'Search...')); ?>
</div>    
    <?php 
   /* if ($options['show_advanced']) {
        echo __('Search using this query type:');
        echo $this->formRadio('query_type', $filters['query_type'], array('class'=>'radio-inline'), $query_types, "\n");
        if ($record_types) {
            echo __('Search only these record types:');
            foreach ($record_types as $key => $value) {
                echo $this->formCheckbox('record_types[]', $key, in_array($key, $filters['record_types']) ? array('checked' => true, 'id' => 'record_types-' . $key) : null);
                echo $value;
            }

        } elseif (is_admin_theme()) {
            echo "<a href=\"<?php echo url('settings/edit-search')\"";
            echo __('Go to search settings to select record types to use.');
        }
   
        echo "<div><?php echo link_to_item_search(__('Advanced Search (Items only)'))";
        
    }
    */
    echo $this->formSubmit(null, $options['submit_value'], array('class' => 'btn btn-default'));
?>