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
<div class="row">
    <div class="span7">
    <div id="homeCarousel" class="carousel slide">
        <ol class="carousel-indicators">
            <li data-target="#homeCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#homeCarousel" data-slide-to="1"></li>
            <li data-target="#homeCarousel" data-slide-to="2"></li>
            <li data-target="#homeCarousel" data-slide-to="3"></li>
            <li data-target="#homeCarousel" data-slide-to="4"></li>
        </ol>
        <!-- Carousel items -->
        <div class="carousel-inner">
            <div class="active item">
                <img src="<?php echo img('Carousel/RealMB/MBPlowsField.jpg'); ?>" alt="" />
                <div class="carousel-caption">
                    <h4>Discover the Real Martha Berry</h4>
                    <p>Much is known about the Berry Schools, but Martha Berry the woman remains 
                        a mystery. Who was she? Are the rumors about her love life true? Was she a feminist? What is the true 
                        story? Participate and discover for yourself the real Martha Berry. </p>
                </div>
            </div>
            <div class="item">
                <img src="<?php echo img('Carousel/TeachLearn/farmerettes.jpg') ?>" alt="" />
                <div class="carousel-caption">
                    <h4>Share Your Expertise</h4>
                    <p>Many visitors know as much or more about MBDA documents as we do, and we need your 
                        help! Every document you describe improves the collection&rsquo;s searchability and helps users learn more.</p>
                </div>
            </div>
            <div class="item">
                <img src="<?php echo img('Carousel/GetRecognized/band-1917.png'); ?>" alt="" />
                <div class="carousel-caption">
                    <h4>Get Recognized</h4>
                    <p>Editor contributions are acknowledged in document citations and through MBDA’s top and recent 
                        editor lists. Get started and get cited!</p>
                </div>
            </div>
            <div class="item">
                <img src="<?php echo img('Carousel/StudyEarly20thCentury/troose.jpg')?>" alt="" />
                <div class="carousel-caption">
                    <h4>Study the Early 20th Century</h4>
                    <p>Learn about key historical moments such as WWI and WWII, women’s suffrage, educational reform, and 
                        presidential elections. Mine the collection to study politics, diet, travel, medicine, advertising, language, 
                        business, education, and more...</p>
                </div>
            </div>
            <div class="item">
                <img src="<?php echo img('Carousel/UnearthStories/GirlsInField.jpg')?>" alt="" />  
                <div class="carousel-caption">                  
                    <h4>Unearth Stories</h4>
                    <p>Revive previously lost voices from the early twentieth century. Many letters are personal, exposing authors&rsquo; 
                        intimate stories of family, love, triumph, and sorrow. Dig into the collection and uncover a new story.</p>
                </div>
            </div>
            <div class="item">
                <img src="<?php echo img('Carousel/ShareExpertise/WWI.jpg') ?>" alt="" />
                 <div class="carousel-caption">
                    <h4>Find Family History</h4>
                    <p>Did you know that the collection contains correspondence with over 200 individuals and organizations? 
                        Discover links to Georgia as well as to locations across the US. You may just find a piece of your 
                        family history here!</p>
                </div>
            </div>
            <div class="item">
                <img src="<?php echo img('Carousel/TeachLearn/ClaraFordStudent.jpg')?>" alt="" />
                <div class="carousel-caption">
                    <h4>Teach and Learn</h4>
                    <p>Coming Soon: Lesson plans and activities to enhance social studies and language arts 
                        curricula, as well as university English and History courses.</p>
                </div>
            </div>
        </div>
        <!-- Carousel nav -->
        <a class="carousel-control left" href="#homeCarousel" data-slide="prev">&lsaquo;</a>
        <a class="carousel-control right" href="#homeCarousel" data-slide="next">&rsaquo;</a>
    </div>
    </div>
    <div class="span5">
        <div id="browseBox" class="homeBox" onclick="location.href='/items/browse'">
            <h2><a href="/items/browse">BROWSE <small>Browse the collection</small></a></h2>
        </div>
        <div id="learnBox" class="homeBox" onclick="location.href='/exhibits'">
            <h2><a href="/exhibits">LEARN <small>Explore educational resources</small></a></h2>
        </div>
        <div id="participateBox" class="homeBox" onclick="location.href='/participate'">
            <h2><a href="/participate">PARTICIPATE <small>Help improve MBDA</small></a></h2>
        </div>
        <div id="searchBox" class="homeBox" onclick="location.href='/items/search'">
            <h2><a href="/items/search">SEARCH <small>By name, date, or place</small></a></h2>
        </div>
    </div>
</div>

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