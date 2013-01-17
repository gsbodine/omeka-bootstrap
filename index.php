<?php echo head(array('bodyid'=>'home')); ?>
    <div id="primary">
    <div class="row">
        <div class="span4">
            <div style="text-align: center;"><a href="/items"><img class="img-rounded pop-box" title="&lt;h4&gt;Browse&lt;/h4&gt;" src="<?php echo img('BrowseImage.jpg'); ?>" alt="Browse Items in the Archive" data-content="&lt;p class=&quot;lead&quot;&gt;Browse Items in the Archive&lt;/p&gt;" data-html="true" data-trigger="hover" data-placement="top" /></a>
                <h2>BROWSE</h2>
            </div>
        </div>
        <div class="span4">
            <div style="text-align: center;"><a href="/items/advanced-search"><img class="img-rounded pop-box" title="&lt;h4&gt;Search&lt;/h4&gt;" src="<?php echo img('MBRoanie.jpg'); ?>" alt="Search for an item in the Archive" data-content="&lt;p class=&quot;lead&quot;&gt;Search for an Item in the Archive&lt;/p&gt;" data-trigger="hover" data-html="true" data-placement="top" /></a>
                <h2>SEARCH</h2>
            </div>
        </div>
        <div class="span4">
            <div style="text-align: center;"><a href="/participate"><img class="img-rounded pop-box" title="&lt;h4&gt;Participate&lt;/h4&gt;" src="<?php echo img('1950GrandMarch.jpg'); ?>" alt="Participate in the archival process by editing, describing, or transcribing documents and objects for the MBDA" data-content="&lt;p class=&quot;lead&quot;&gt;Help Us Edit the Archive&lt;/p&gt;" data-html="true" data-trigger="hover" data-placement="top" /></a>
                <h2>PARTICIPATE</h2>
            </div>
        </div>
    </div>
    </div><!-- end primary -->

    <div id="secondary">
        <div id="recent-items">
        <?php
        $homepageRecentItems = (int)option('Homepage Recent Items');
        if ($homepageRecentItems > 0) { set_loop_records('items',recent_items($homepageRecentItems)); }
        if (has_loop_records('item')):
        ?>
        <div class="row">
            <div class="span12"><hr /></div>   
        </div>
            
        <div class="row">
            <div class="span12">
                <h2><?php echo __('Recently Added Items'); ?></h2>
            </div>
        </div>   
        <div class="row-fluid">
            <ul class="thumbnails">
            <?php while (loop_items()): ?>
                <li class="span4">
                    <div class="thumbnail" style="padding-left:1em;padding-right:1em;text-align:center;">
                        <h3><?php echo link_to_item(); ?></h3>
                        <?php if(item_has_thumbnail()): ?>
                            <div class="item-img">
                                <?php echo link_to_item(item_thumbnail($props=array('class'=>'img-rounded','style'=>'margin:1em'))); ?>
                            </div>
                        <?php endif; ?>
                        <?php if($desc = item('Dublin Core', 'Description', array('snippet'=>150))): ?>
                                <p style="text-align: left"><?php echo $desc; ?><?php echo link_to_item('see more',(array('class'=>'show'))) ?></p>
                        <?php endif; ?>
                    </div>
                </li>
            <?php endwhile; ?>
            </ul>
        </div><!-- end row -->
        <?php endif; ?>
        </div>
        </div>

    </div><!-- end secondary -->
</div>

<?php echo foot(); ?>