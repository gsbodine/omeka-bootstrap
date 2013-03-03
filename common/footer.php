        </div><!-- end content -->

    <div  class="container">
        <div class="row">
            <div class="span12">
            <footer>
            <hr />
           
            <div id="footer-text" class="row">
                <div class="span6 muted">
                    <div class="row">
                        <div class="span2 text-center"><a href="http://bloomu.edu"><img src="<?php echo img('BU.png'); ?>" class="img muted" /></a></div>
                        <div class="span2 text-center"><a href="http://berry.edu/oakhill"><img src="<?php echo img('OakHill.png'); ?>" class="image-rounded" /></a></div>
                        <div class="span2 text-center" style="text-align: center;"><a href="http://berry.edu"><img src="<?php echo img('BC.png'); ?>" class="image-rounded" /></a></div>
                    </div>
                    <p style="margin-left: 1em;"><small>This project is a collaboration between faculty, staff, and students at Bloomsburg University and Berry College, initiated in support of teaching, research, and community engagement. </small></p>
                </div> 
                <div class="span3">
                    
                </div>
                <div class="span3" style="text-align:right;">
                    <ul class="nav nav-pills nav-stacked" style="padding-right:1em;">
                        <li><a href="/contact"><i class="icon-comment-alt"></i> Contact us</a></li>
                        <li><a href="https://twitter.com/BerryArchive"><i class="icon-twitter"></i> Follow us</a></li>
                    </ul>
                </div>
            </div>
            
             <div class="row">
                <div class="span12" style="background:#15397F;color:#fff;">
                    <div style="padding: 1em;" class="text-center">
                    <small>
                    <?php if ($copyright = option('copyright')): ?>
                        <p>This work is licensed under a <a style="color:#fff;" rel="license" href="http://creativecommons.org/licenses/by-nc-nd/3.0/">Creative Commons Attribution-NonCommercial-NoDerivs 3.0 Unported License</a>.</p>
                        <p><a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/3.0/"><img alt="Creative Commons License" style="border-width:0" src="http://i.creativecommons.org/l/by-nc-nd/3.0/80x15.png" /></a></p>
                    <?php endif; ?>
                    </small>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="span12">
                    <?php fire_plugin_hook('public_footer'); ?>
                </div>
            </div>
            </footer>    
        </div><!-- end footer -->
        </div>
    </div><!-- end wrap -->
</body>
</html>
