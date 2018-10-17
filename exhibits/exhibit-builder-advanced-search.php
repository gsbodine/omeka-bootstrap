<div class="field form-group">
    <?php echo $this->formLabel('exhibit', __('Search by Exhibit')); ?>
    <div class="col-sm-10">
    <div class="inputs input-group">
        <?php echo $this->formSelect('exhibit', @$_GET['exhibit'], array(), get_table_options('Exhibit')); ?>
    </div>
    </div>
</div>
