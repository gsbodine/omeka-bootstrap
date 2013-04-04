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
                    <p>Editor contributions are acknowledged in document citations and through MBDA&rsquo;s top and recent 
                        editor lists. Get started and get cited!</p>
                </div>
            </div>
            <div class="item">
                <img src="<?php echo img('Carousel/StudyEarly20thCentury/troose.jpg')?>" alt="" />
                <div class="carousel-caption">
                    <h4>Study the Early 20th Century</h4>
                    <p>Learn about key historical moments such as WWI and WWII, women&rsquo;s suffrage, educational reform, and 
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
            <h2><a href="/participate">PARTICIPATE <small>Help edit MBDA</small></a></h2>
        </div>
        <div id="searchBox" class="homeBox" onclick="location.href='/items/search'">
            <h2><a href="/items/search">SEARCH <small>By name, date, or place</small></a></h2>
        </div>
    </div>
    <div class="span12">
        <hr />
    </div>
</div>
<div class="row">
    <div class="span3">
        <div class="triBox">
            <?php echo random_featured_items(1); ?>
        </div>
    </div>
    <div class="span3">
        <div class="triBox text-center">
            <div class="random-document">
                <div class="row">
                    <div class="span3">
                        <h4 class="text-center">Tag of the Week</h4>
                        <div style="border: 1px solid #999; border-radius:15px" class="padded">
                            <span class="label label-inverse"><i class="icon-tag"></i> Cool Tag</span>
                        </div>
                    </div>  
                </div>
            </div>
            <div class="random-document">
                <h4 class="text-center">Video Tutorial Here</h4>
            </div>
        </div>
    </div>
    <div class="span3">
        <div class="tribox">
            <div class="random-document">
                <h4>MBDA Links</h4>
                <ul class="nav nav-stacked" style="border-left:1px solid #ccc;">
                    <li class="padded"><a href="">Link list item</a></li>
                    <li class="padded"><a href="">Link list item</a></li>
                    <li class="padded"><a href="">Link list item</a></li>
                    <li class="padded"><a href="">Link list item</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="span3">
        <div class="triBox text-center">
            <h4>Watch Our Progress</h4>
            <div class="crowd-box" style="background: url(<?php echo img('1950GrandMarch.jpg') ?>); border-radius: 25px">
                <br /><br /><br />
                <h4 class="padded" style="background: rgba(255,255,255,.75)">Did someone say CROWDSOURCING?</h4>
                 
                <br /><br /><br />
            </div>
            <?php echo $this->completionMeter($size='small'); ?>
        </div>
    </div>
</div>
<?php echo foot(); ?>