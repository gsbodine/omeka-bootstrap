<?php
$pageTitle = __('Advanced Search');

if ($formActionUri):
    $formAttributes['action'] = $formActionUri;
else:
    $formAttributes['action'] = uri(array('controller' => 'items', 'action' => 'browse'));
endif;

$formAttributes['method'] = 'GET';

if (!$isPartial):
head(array(
    'title' => $pageTitle,
    'bodyclass' => 'advanced-search',
    'bodyid' => 'advanced-search-page',
));
?>
<div id="primary">
<?php
endif;
?>
    <div class="row page-header">
        <div class="col-xs-12">
            <h1><?php echo $pageTitle; ?></h1>
        </div>
    </div>
<div class="row">
    <form <?php echo _tag_attributes($formAttributes); ?>>
        <div class="col-xs-12">
            <div class="row">
                <div class="col-xs-12">
                    <hr />
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div id="search-keywords" class="field form-inline">
                        <?php echo label(array('for' => 'keyword-search', 'class' => 'label'), __('Search for Keywords:')); ?>
                        <div class="inputs">
                            <?php echo text(array(
                                'name' => 'search',
                                'size' => '85',
                                'id' => 'keyword-search',
                                'class' => 'textinput search-query col-sm-6',
                            ), @$_REQUEST['search']); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12"><hr /></div>
            </div>
            <div class="row">
                <div class="col-sm-9">
                    <div id="search-narrow-by-fields" class="field">
                        <div class="label label-default"><?php echo __('Narrow by Specific Fields'); ?></div>
                        <div class="inputs">
                        <?php
                        // If the form has been submitted, retain the number of search
                        // fields used and rebuild the form
                        if (!empty($_GET['advanced'])) {
                            $search = $_GET['advanced'];
                        } else {
                            $search = array(array('field' => '', 'type' => '', 'value' => ''));
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
                                echo select_element(
                                    array('name' => "advanced[$i][element_id]"),
                                    @$rows['element_id'],
                                    null,
                                    array('record_types' => array('Item', 'All'),
                                        'sort' => 'alphaBySet'));
                                echo select(
                                    array('name' => "advanced[$i][type]"),
                                    array('contains' => __('contains'),
                                        'does not contain' => __('does not contain'),
                                        'is exactly' => __('is exactly'),
                                        'is empty' => __('is empty'),
                                        'is not empty' => __('is not empty')),
                                    @$rows['type']
                                );
                                echo text(
                                    array('name' => "advanced[$i][terms]",
                                        'size' => 20),
                                    @$rows['terms']); ?>
                                <button type="button" class="remove_search btn btn-danger btn-sm" disabled="disabled" style="display: none;"><span class="glyphicon glyphicon-minus-sign icon-white"></span><?php echo __('Remove Field'); ?></button>
                            </div>
                        <?php endforeach; ?>
                        </div>
                        <button type="button" class="add_search btn btn-info btn-sm"><span class="glyphicon glyphicon-plus-sign icon-white"></span> <?php echo __('Add a Field'); ?></button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12"><hr /></div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="field">
                        <?php echo label(array('for' => 'collection-search', 'class' => 'label'), __('Search By Collection')); ?>
                        <div class="inputs"><?php
                            echo select_collection(array(
                                'name' => 'collection',
                                'id' => 'collection-search',
                                'class' => 'col-sm-6',
                            ), @$_REQUEST['collection']); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12"><hr /></div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="field">
                        <?php echo label(array('for' => 'item-type-search', 'class' => 'label'), __('Search By Item/Document Type')); ?>
                        <div class="inputs"><?php
                            echo select_item_type(array('name' => 'type', 'id' => 'item-type-search', 'class' => 'col-sm-3'),
                                @$_REQUEST['type']); ?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="field">
                        <label class="label label-default"><?php echo __('Search by Script Type'); ?></label>
                        <div class="inputs">
                            <?php echo select(array('name' => 'script-type', 'id' => 'script-type', 'class' => 'col-sm-3'),
                                array('1' => __('Primarily Handwritten'),
                                    '0' => __('Primarily Typewritten'),
                                ),
                                @$_REQUEST['script-type']); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12"><hr /></div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="field">
                        <?php echo label(array('for' => 'tag-search', 'class' => 'label'), __('Search By Tags')); ?>
                        <div class="inputs">
                            <?php
                            $tagList = tag_string(get_tags(), $link = false, $delimiter = ",");
                            $quotedTags = str_replace(",", "\",\"", $tagList);
                            echo text(array(
                                'name' => 'tags',
                                'size' => '40',
                                'id' => 'tag-search',
                                'class' => 'textinput typeahead col-sm-3',
                                'data-provide' => 'typeahead',
                                'data-source' => '["'.$quotedTags.'"]',
                                'data-items' => '12',
                                'data-minLength' => '2',
                            ),
                            @$_REQUEST['tags']); ?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div id="search-by-range" class="field">
                        <label for="range" class="label label-default"><?php echo __('Search by a range of ID#s (example: 1-4, 156, 79)'); ?></label>
                        <div class="inputs">
                        <?php echo text(
                                array(
                                    'name' => 'range',
                                    'size' => '40',
                                    'class' => 'textinput col-sm-3',
                                ),
                                @$_GET['range']); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12"><hr /></div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="field">
                        <?php echo label(array('for' => 'creator-search', 'class' => 'label'), __('Search for an Author')); ?>
                        <div class="inputs">
                            <?php
                            //$tagList = tag_string(get_tags(),$link=false,$delimiter=",");
                            //$quotedTags = str_replace(",", "\",\"", $tagList);
                            echo text(array(
                                'name' => 'creator-search',
                                'size' => '40',
                                'id' => 'creator-search',
                                'class' => 'textinput typeahead col-sm-3',
                                'data-provide' => 'typeahead',
                                //'data-source' => '["'.$quotedTags.'"]',
                                'data-items' => '12',
                                'data-minLength' => '2',
                            ),
                            @$_REQUEST['creator']); ?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div id="search-by-range" class="field">
                        <label for="recipient-search" class="label label-default"><?php echo __('Search for a Recipient'); ?></label>
                        <div class="inputs">
                        <?php echo text(
                            array(
                                'name' => 'recipient-search',
                                'id' => 'recipient-search',
                                'size' => '40',
                                'class' => 'textinput col-sm-3',
                            ),
                            @$_GET['recipient']); ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php if (is_admin_theme()): ?>
            <div class="row">
                <div class="col-xs-12"><hr /></div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <?php if (has_permission('Items', 'showNotPublic')): ?>
                    <div class="field">
                        <?php echo label(array('for' => 'public', 'class' => 'label'), __('Public/Non-Public')); ?>
                        <div class="inputs">
                            <?php echo select(array('name' => 'public', 'id' => 'public'),
                                array(
                                    '1' => __('Only Public Items'),
                                    '0' => __('Only Non-Public Items'),
                                ),
                                @$_REQUEST['public']); ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="col-sm-4">
                    <div class="field">
                        <?php echo label(array('for' => 'featured', 'class' => 'label'), __('Featured/Non-Featured')); ?>
                        <div class="inputs">
                            <?php echo select(array('name' => 'featured', 'id' => 'featured'),
                                array(
                                    '1' => __('Only Featured Items'),
                                    '0' => __('Only Non-Featured Items'),
                                ),
                                @$_REQUEST['featured']); ?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <?php if (is_admin_theme()): //(has_permission('Users', 'browse')): ?>
                    <div class="field">
                    <?php
                        echo label(array('for' => 'user-search', 'class' => 'label'), __('Search By User'));?>
                        <div class="inputs"><?php
                            echo select_user(array(
                                'name' => 'user',
                                'id' => 'user-search',
                            ),
                            @$_REQUEST['user']);?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-xs-12">
                    <?php is_admin_theme() ? fire_plugin_hook('admin_append_to_advanced_search') : fire_plugin_hook('public_append_to_advanced_search'); ?>
                </div>
            </div>
            <!-- <div class="col-xs-12"><hr /></div> -->
            <div class="row">
                <div class="col-xs-12">
                    <input class="submit btn btn-primary form-control" name="submit_search" id="submit_search_advanced" value="<?php echo __('Search'); ?>" type="submit">
                </div>
            </div>
        </div>
    </form>
</div><!-- close row -->
<?php echo js('search'); ?>
<script type="text/javascript">
    jQuery(document).ready(function () {
        Omeka.Search.activateSearchButtons();
    });
</script>
<?php if (!$isPartial): ?>
</div><?php // end primary ?>
<?php echo foot(); ?>
<?php endif;
