        </div><!-- end content -->

        <div id="footer" class="container">
            <footer>
            <div class="row"><div class="span12"><hr /></div></div>
           
            <div id="footer-text" class="row">
                <div class="span4 text-center"><a href="http://berry.edu/oakhill"><img src="<?php echo img('OakHill.jpg'); ?>" class="image-rounded" /></a></div>
                <div class="span4 text-center" style="text-align: center;"><a href="http://berry.edu"><img src="<?php echo img('BC.png'); ?>" class="image-rounded" /></a></div>
                <div class="span4 text-center"><a href="http://bloomu.edu"><img src="<?php echo img('BU.png'); ?>" class="image-rounded" /></a></div>
                
            </div>
            
             <div class="row">
                <div class="span12 text-center" style="background:#15397F;color:#fff;">
                    <div style="padding: 1em;">
                    <small>
                    <?php //echo html_entity_decode(get_theme_option('Footer Text')); ?>
                    
                    <?php if ($copyright = option('copyright')): ?>
                        This work is licensed under a <a style="color:#fff;" rel="license" href="http://creativecommons.org/licenses/by-nc-nd/3.0/">Creative Commons Attribution-NonCommercial-NoDerivs 3.0 Unported License</a>.<br />
                        <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/3.0/"><img alt="Creative Commons License" style="border-width:0" src="http://i.creativecommons.org/l/by-nc-nd/3.0/80x15.png" /></a><br />
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
