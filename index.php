<?php echo head(array('bodyid'=>'home')); ?>
<script type="text/javascript">jQuery(document).ready(function($) { $('#SiteDevModal').modal('show')});</script>
<div id="SiteDevModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h1 id="modalLabel"><i class="icon-time"></i> In Development</h1>
        </div>
        <div class="modal-body">
            <p>Please bear with us; the MBDA site is under <strong>active construction and development</strong> through April 2013.</p>
            <p>Feel free to have a look around, to use the site for research or teaching, and/or to contact us if you have any questions.</p>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Close</button>
        </div>
</div>
    <div id="primary">
    <div class="row">
        <div class="span4">
            <div style="text-align: center;">
                <a href="/items"><img class="img-rounded" title="Browse" src="<?php echo img('BrowseImage.jpg'); ?>" alt="Browse Items in the Archive" /></a>
                <h2>BROWSE</h2>
                <p class="lead">Browse the items in the archive</p>
            </div>
        </div>
        <div class="span4">
            <div style="text-align: center;">
                <a href="/exhibits"><img class="img-rounded" title="Learn" src="<?php echo img('MBRoanie.jpg'); ?>" alt="Learn" /></a>
                <h2>LEARN</h2>
                <p class="lead">Visit the MBDA educational exhibits</p>
            </div>
        </div>
        <div class="span4">
            <div style="text-align: center;">
                <a href="/participate"><img class="img-rounded" title="Participate" src="<?php echo img('1950GrandMarch.jpg'); ?>" alt="Participate in the archival process by editing, describing, or transcribing documents and objects for the MBDA" /></a>
                <h2>PARTICIPATE</h2>
                <p class="lead">Help us edit the documents in the collection</p>
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
        </div><!-- end secondary -->



<?php echo foot(); ?>