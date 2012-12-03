        </div><!-- end content -->

        <div id="footer" class="container">
            <div class="row"><div class="span12"><hr /></div></div>
            <div id="footer-text" class="row">
                <div class="span12"> 
                    <?php echo html_entity_decode(get_theme_option('Footer Text')); ?>
                    
                    <?php if ((get_theme_option('Display Footer Copyright') == 1) && $copyright = option('copyright')): ?>
                        <div><small><?php echo html_entity_decode($copyright); ?></small></div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="span12">
                    <?php fire_plugin_hook('public_theme_footer'); ?>
                </div>
            </div>
            
        </div><!-- end footer -->
    </div><!-- end wrap -->
</body>
</html>
