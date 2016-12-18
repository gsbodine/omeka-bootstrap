<?php
if (!empty($formActionUri)):
    $formAttributes['action'] = $formActionUri;
else:
    $formAttributes['action'] = url(array('controller'=>'items',
                                          'action'=>'browse'));
endif;
$formAttributes['method'] = 'GET';
$formAttributes['class'] = 'form-horizontal';
?>

<form <?php echo tag_attributes($formAttributes); ?>>
    <div id="search-keywords" class="field form-group">
        <?php echo $this->formLabel('keyword-search', __('Search for Keywords')); ?>
        <div class="col-sm-10">
        <div class="inputs input-group">
        <?php
            echo $this->formText(
                'search',
                @$_REQUEST['search'],
                array('id' => 'keyword-search', 'size' => '40')
            );
        ?>
        </div>
        </div>
    </div>
    <div id="search-narrow-by-fields" class="field form-group">
        <?php echo $this->formLabel('advanced', __('Narrow by Specific Fields')); ?>
        <div class="col-sm-10">

        <?php
        // If the form has been submitted, retain the number of search
        // fields used and rebuild the form
        if (!empty($_GET['advanced'])) {
            $search = $_GET['advanced'];
        } else {
            $search = array(array('field'=>'','type'=>'','value'=>''));
        }

        //Here is where we actually build the search form
        foreach ($search as $i => $rows): ?>
            <div class="search-entry input-group">
                <?php
                //The POST looks like =>
                // advanced[0] =>
                //[field] = 'description'
                //[type] = 'contains'
                //[terms] = 'foobar'
                //etc
                $newOmeka = version_compare(OMEKA_VERSION, '2.5', '>=');
                if ($newOmeka) {
                    echo $this->formSelect(
                        "advanced[$i][joiner]",
                        @$rows['joiner'],
                        array(
                            'title' => __("Search Joiner"),
                            'id' => null,
                            'class' => 'advanced-search-joiner inline'
                        ),
                        array(
                            'and' => __('AND'),
                            'or' => __('OR'),
                        )
                    );
                }
                echo $this->formSelect(
                    "advanced[$i][element_id]",
                    @$rows['element_id'],
                    array(
                        'title' => __("Search Field"),
                        'id' => null,
                        'class' => 'advanced-search-element inline',
                    ),
                    get_table_options('Element', null, array(
                        'record_types' => array('Item', 'All'),
                        'sort' => 'orderBySet')
                    )
                );
                // btn btn-default dropdown-toggle
                // <span class="caret"></span></button>

                $advancedOptions = array(
                    'contains' => __('contains'),
                    'does not contain' => __('does not contain'),
                    'is exactly' => __('is exactly'),
                    'is empty' => __('is empty'),
                    'is not empty' => __('is not empty'),
                );
                if ($newOmeka) {
                    $advancedOptions += array(
                        'starts with' => __('starts with'),
                        'ends with' => __('ends with'),
                    );
                }
                echo $this->formSelect(
                    "advanced[$i][type]",
                    @$rows['type'],
                    array(
                        'title' => __("Search Type"),
                        'id' => null,
                        'class' => 'advanced-search-type inline'
                    ),
                    label_table_options($advancedOptions)
                );
                echo $this->formText(
                    "advanced[$i][terms]",
                    @$rows['terms'],
                    array(
                        'size' => '20',
                        'title' => __("Search Terms"),
                        'id' => null,
                        'class' => 'advanced-search-terms inline',
                    )
                );
                ?>
                <button type="button" class="remove_search btn btn-danger" disabled="disabled" title="<?php echo __('Remove field'); ?>" style="display: none;"><span class="glyphicon glyphicon-minus"></span></button>
            </div>
        <?php endforeach; ?>
        </div>
        <button type="button" class="add_search btn btn-success pull-right" title="<?php echo __('Add a Field'); ?>"><span class="glyphicon glyphicon-plus"></span> <?php echo __('Add a Field'); ?></button>
    </div>

    <div id="search-by-range" class="field form-group">
        <?php echo $this->formLabel('range', __('Search by a range of ID#s (example: 1-4, 156, 79)')); ?>
        <div class="col-sm-10">
        <div class="inputs input-group">
        <?php
            echo $this->formText('range', @$_GET['range'], array('size' => '40'));
        ?>
        </div>
        </div>
    </div>

    <div class="field form-group">
        <?php echo $this->formLabel('collection-search', __('Search By Collection')); ?>
        <div class="col-sm-10">
        <div class="inputs input-group">
        <?php
            echo $this->formSelect(
                'collection',
                @$_REQUEST['collection'],
                array('id' => 'collection-search'),
                get_table_options('Collection', null, array('include_no_collection' => true))
            );
        ?>
        </div>
        </div>
    </div>

    <div class="field form-group">
        <?php echo $this->formLabel('item-type-search', __('Search By Type')); ?>
        <div class="col-sm-10">
        <div class="inputs input-group">
        <?php
            echo $this->formSelect(
                'type',
                @$_REQUEST['type'],
                array('id' => 'item-type-search'),
                get_table_options('ItemType')
            );
        ?>
        </div>
        </div>
    </div>

    <?php if(is_allowed('Users', 'browse')): ?>
    <div class="field form-group">
    <?php
        echo $this->formLabel('user-search', __('Search By User')); ?>
        <div class="col-sm-10">
        <div class="inputs input-group">
        <?php
            echo $this->formSelect(
                'user',
                @$_REQUEST['user'],
                array('id' => 'user-search'),
                get_table_options('User')
            );
        ?>
        </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="field form-group">
        <?php echo $this->formLabel('tag-search', __('Search By Tags')); ?>
        <div class="col-sm-10">
        <div class="inputs input-group">
        <?php
            echo $this->formText('tags', @$_REQUEST['tags'],
                array('size' => '40', 'id' => 'tag-search')
            );
        ?>
        </div>
        </div>
    </div>

    <?php if (is_allowed('Items','showNotPublic')): ?>
    <div class="field form-group">
        <?php echo $this->formLabel('public', __('Public/Non-Public')); ?>
        <div class="inputs input-group">
        <div class="col-sm-10">
        <?php
            echo $this->formSelect(
                'public',
                @$_REQUEST['public'],
                array(),
                label_table_options(array(
                    '1' => __('Only Public Items'),
                    '0' => __('Only Non-Public Items')
                ))
            );
        ?>
        </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="field form-group">
        <?php echo $this->formLabel('featured', __('Featured/Non-Featured')); ?>
        <div class="col-sm-10">
        <div class="inputs input-group">
        <?php
            echo $this->formSelect(
                'featured',
                @$_REQUEST['featured'],
                array(),
                label_table_options(array(
                    '1' => __('Only Featured Items'),
                    '0' => __('Only Non-Featured Items')
                ))
            );
        ?>
        </div>
        </div>
    </div>

    <?php fire_plugin_hook('public_items_search', array('view' => $this)); ?>
    <div class="col-sm-offset-2">
        <?php if (!isset($buttonText)) $buttonText = __('Search for items'); ?>
        <input type="submit" class="submit btn btn-primary" name="submit_search" id="submit_search_advanced" value="<?php echo $buttonText ?>">
    </div>
</form>

<?php echo js_tag('items-search'); ?>
<script type="text/javascript">
    jQuery(document).ready(function () {
        Omeka.Search.activateSearchButtons();
    });
</script>
