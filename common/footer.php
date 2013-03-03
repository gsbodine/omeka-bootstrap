        </div><!-- end content -->

        <div id="footer" class="container">
            <footer>
            <div class="row"><div class="span12"><hr /></div></div>
           
            <div id="footer-text" class="row">
                <div class="span2 text-center"><a href="http://berry.edu/oakhill"><img src="<?php echo img('OakHill.jpg'); ?>" class="image-rounded" /></a></div>
                <div class="span2 text-center" style="text-align: center;"><a href="http://berry.edu"><img src="<?php echo img('BC.png'); ?>" class="image-rounded" /></a></div>
                <div class="span2 text-center"><a href="http://bloomu.edu"><img src="<?php echo img('BU.png'); ?>" class="image-rounded" /></a></div>
                <div class="span6"><div class="muted">This project is a collaboration of a few people some institutions and particles, etc...</div></div>
            </div>
            
             <div class="row" style="background:#15397F;color:#fff;">
                <div class="span4">
                     <div style="padding: 1em;" class="pull-left">
                        <small>
                        <p><a href="/contact" style="color: #fff;"><i class="icon-comment-alt"></i> Contact the Project</a></p>
                        <p><a href="/" style="color: #fff;"><i class="icon-twitter"></i> Follow us!</a></p>
                        </small>
                     </div>
                </div>
                <div class="span8">
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
    </div><!-- end wrap -->
</body>
</html>
