<?php
if (!empty($formActionUri)):
    $formAttributes['action'] = $formActionUri;
else:
    $formAttributes['action'] = url(array('controller'=>'items',
                                          'action'=>'browse'));
endif;
$formAttributes['method'] = 'GET';
?>
<div class="row">
    <div class="span12">
        <div class="row">
            <div class="span8">
                <form <?php echo tag_attributes($formAttributes); ?>>
                    <fieldset>
                        <legend style="padding-top:0"><i class="icon-key"></i> Keyword Search</legend>
                        <div id="search-keywords" class="field">
                            <?php echo $this->formLabel('keyword-search', __('Search for Keywords')); ?>
                            <div class="inputs">
                            <?php
                                echo $this->formText(
                                    'search',
                                    @$_REQUEST['search'],
                                    array('id' => 'keyword-search', 'size' => '40')
                                );
                            ?>
                            </div>
                        </div>
                        <div id="search-narrow-by-fields" class="field">
                            <div class="label"><?php echo __('Narrow by Specific Fields'); ?></div>
                            <div class="inputs">
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
                                <div class="search-entry">
                                    <?php
                                    //The POST looks like =>
                                    // advanced[0] =>
                                    //[field] = 'description'
                                    //[type] = 'contains'
                                    //[terms] = 'foobar'
                                    //etc
                                    echo $this->formSelect(
                                        "advanced[$i][element_id]",
                                        @$rows['element_id'],
                                        array(),
                                        get_table_options('Element', null, array(
                                            'record_types' => array('Item', 'All'),
                                            'sort' => 'alphaBySet')
                                        )
                                    );
                                    echo $this->formSelect(
                                        "advanced[$i][type]",
                                        @$rows['type'],
                                        array(),
                                        label_table_options(array(
                                            'contains' => __('contains'),
                                            'does not contain' => __('does not contain'),
                                            'is exactly' => __('is exactly'),
                                            'is empty' => __('is empty'),
                                            'is not empty' => __('is not empty'))
                                        )
                                    );
                                    echo $this->formText(
                                        "advanced[$i][terms]",
                                        @$rows['terms'],
                                        array('size' => '20')
                                    );
                                    ?>
                                    <button type="button" class="remove_search" disabled="disabled" style="display: none;">-</button>
                                </div>
                            <?php endforeach; ?>
                            </div>
                            <button type="button" class="add_search btn btn-info"><i class="icon-plus-sign"></i> <?php echo __('Add a Field'); ?></button>
                        </div>
                    </fieldset>

                    <fieldset>
                        <legend><i class="icon-sitemap"></i> Collections Search</legend>
                        <div class="field">
                            <?php echo $this->formLabel('collection-search', __('Search By Collection')); ?>
                            <div class="inputs">
                            <?php
                                echo $this->formSelect(
                                    'collection',
                                    @$_REQUEST['collection'],
                                    array('id' => 'collection-search'),
                                    get_table_options('Collection')
                                );
                            ?>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <legend><i class="icon-question-sign"></i> Item Type Search</legend>
                        <div class="field">
                            <?php echo $this->formLabel('item-type-search', __('Search By Type')); ?>
                            <div class="inputs">
                            <?php
                                echo $this->formSelect(
                                    'type',
                                    @$_REQUEST['item-type-search'],
                                    array('id' => 'item-type-search'),
                                    get_table_options('ItemType')
                                );
                            ?>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <legend><i class="icon-tags"></i> Tags Search</legend>
                        <div class="field">
                            <?php echo $this->formLabel('tag-search', __('Search By Tags')); ?>
                            <div class="inputs">
                            <?php
                                echo $this->formText('tags', @$_REQUEST['tags'],
                                    array('size' => '40', 'id' => 'tag-search')
                                );
                            ?>
                            </div>
                        </div>
                    </fieldset>


                    <?php fire_plugin_hook('public_items_search', array('view' => $this)); ?>
                    <div>
                        <input type="submit" class="submit btn btn-primary" name="submit_search" id="submit_search_advanced" value="<?php echo __('Search'); ?>" />
                    </div>
                </form>
            </div>
            <div class="span4">
                
            </div>
        </div>
    </div>
</div>
<?php echo js_tag('items-search'); ?>
<script type="text/javascript">
    jQuery(document).ready(function () {
        Omeka.Search.activateSearchButtons();
    });
</script>
