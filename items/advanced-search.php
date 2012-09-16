<?php
$pageTitle = __('Advanced Search');
if (!$isPartial):
    head(array('title' => $pageTitle,
               'bodyclass' => 'advanced-search',
               'bodyid' => 'advanced-search-page'));
?>
    <?php if(!is_admin_theme()): ?>
        <div id="primary">
    <?php endif; ?>

    <h1><?php echo $pageTitle; ?></h1>

    <?php if(is_admin_theme()): ?>
        <div id="primary">
    <?php endif; ?>

<?php endif; ?>

<?php
if ($formActionUri):
    $formAttributes['action'] = $formActionUri;
else:
    $formAttributes['action'] = uri(array('controller'=>'items','action'=>'browse'));
endif;

$formAttributes['method'] = 'GET';
?>
<div class="row">
    
    <form <?php echo _tag_attributes($formAttributes); ?>>
    <div class="span12">
        <div id="search-keywords" class="field form-inline">
            <?php echo label(array('for'=>'keyword-search','class'=>'label'), __('Search for Keywords:')); ?>
            <div class="inputs">
            <?php echo text(array(
                    'name' => 'search',
                    'size' => '85',
                    'id' => 'keyword-search',
                    'class' => 'textinput search-query'), @$_REQUEST['search']); ?>
            </div>
        </div>
    </div>
    <div class="span12"><hr /></div>
    <div class="span12">
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
                    <button type="button" class="remove_search btn btn-small" disabled="disabled" style="display: none;"><i class="icon-minus-sign"></i> Remove Field</button>
                </div>
            <?php endforeach; ?>
            </div>
            <button type="button" class="add_search btn btn-small btn-info"><i class="icon-plus-sign icon-white"></i> <?php echo __('Add a Field'); ?></button>
        </div>
    </div><!-- end span12 -->
    <div class="span12"><hr /></div>
    <div class="span4">
        <div class="field">
            <?php echo label(array('for'=>'collection-search','class'=>'label'), __('Search By Collection')); ?>
            <div class="inputs"><?php
                echo select_collection(array(
                    'name' => 'collection',
                    'id' => 'collection-search'
                ), @$_REQUEST['collection']); ?>
            </div>
        </div>
    </div>
    <div class="span4">
        <div class="field">
            <?php echo label(array('for'=>'item-type-search','class'=>'label'), __('Search By Type')); ?>
            <div class="inputs"><?php
                echo select_item_type(array('name'=>'type', 'id'=>'item-type-search'),
                    @$_REQUEST['type']); ?>
            </div>
        </div>
    </div>
    <div class="span4">
        <?php if(has_permission('Users', 'browse')): ?>
        <div class="field">
        <?php
            echo label(array('for'=>'user-search','class'=>'label'), __('Search By User'));?>
            <div class="inputs"><?php
                echo select_user(array(
                        'name' => 'user',
                        'id' => 'user-search'),
                    @$_REQUEST['user']);?>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <div class="span12"><hr /></div>
    <div class="span6">
        <div class="field">
            <?php echo label(array('for'=>'tag-search','class'=>'label'), __('Search By Tags')); ?>
            <div class="inputs">
                <?php 
                $tagList = tag_string(get_tags(),$link=false,$delimiter=",");
                $quotedTags = str_replace(",", "\",\"", $tagList);
                echo text(array(
                    'name' => 'tags',
                    'size' => '40',
                    'id' => 'tag-search',
                    'class'=>'textinput typeahead',
                    'data-provide'=>'typeahead',
                    'data-source'=>'["'.$quotedTags.'"]',
                    'data-items'=>'12',
                    'data-minLength' => '2',
                    ),

                @$_REQUEST['tags']); ?>
            </div>
        </div>
    </div>
    <div class="span6">
        <div id="search-by-range" class="field">
            <label for="range" class="label"><?php echo __('Search by a range of ID#s (example: 1-4, 156, 79)'); ?></label>
            <div class="inputs">
            <?php echo text(
                    array('name' => 'range',
                          'size' => '40',
                          'class' => 'textinput'),
                    @$_GET['range']); ?>
            </div>
        </div>
    </div>
    <div class="span12"><hr /></div>
    <div class="span6">
        <?php if (has_permission('Items','showNotPublic')): ?>
        <div class="field">
            <?php echo label(array('for'=>'public','class'=>'label'), __('Public/Non-Public')); ?>
            <div class="inputs">
                <?php echo select(array('name' => 'public', 'id' => 'public'),
                    array('1' => __('Only Public Items'),
                          '0' => __('Only Non-Public Items')),
                    @$_REQUEST['public']); ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <div class="span6">
        <div class="field">
            <?php echo label(array('for'=>'featured','class'=>'label'), __('Featured/Non-Featured')); ?>
            <div class="inputs">
                <?php echo select(array('name' => 'featured', 'id' => 'featured'),
                    array('1' => __('Only Featured Items'),
                          '0' => __('Only Non-Featured Items')),
                    @$_REQUEST['featured']); ?>
            </div>
        </div>
    </div>
    <?php is_admin_theme() ? fire_plugin_hook('admin_append_to_advanced_search') : fire_plugin_hook('public_append_to_advanced_search'); ?>
    <div class="span12"><hr /></div>
    <div class="span12" style="text-align:center;">
        <input type="submit" class="submit btn btn-inverse" name="submit_search" id="submit_search_advanced" value="<?php echo __('Search'); ?>" />
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
</div> <!-- Close 'primary' div. -->
<?php foot(); ?>
<?php endif; ?>
