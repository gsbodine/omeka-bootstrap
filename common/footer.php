        </div><!-- end content -->
        <footer>
            <div id="custom-footer-text">
                <?php if ( $footerText = get_theme_option('Footer Text') ): ?>
                <p><?php echo $footerText; ?></p>
                <?php endif; ?>
                <?php if ((get_theme_option('Display Footer Copyright') == 1) && $copyright = option('copyright')): ?>
                    <p><?php echo $copyright; ?></p>
                <?php endif; ?>
            </div>
            <div class="pull-right">
                <p><?php echo __('Proudly powered by <a href="http://omeka.org">Omeka</a>.'); ?></p>
            </div>
            <div>
                <?php fire_plugin_hook('public_footer'); ?>
            </div>
        </footer>
    </div><!--end wrap-->
    <script type="text/javascript">
    jQuery(document).ready(function () {
        Omeka.showAdvancedForm();
        Omeka.dropDown();
    });
    </script>
    <?php
    // Omeka 2 and Bootstrap 3.1.1 use the same jQuery (1.10).
    $config = Zend_Registry::get('bootstrap')->getResource('Config');
    $useInternalAssets = isset($config->theme->useInternalAssets)
       ? (bool) $config->theme->useInternalAssets
       : false;
    if ($useInternalAssets) : ?>
    <script src="<?php echo src('vendor/jquery', 'javascripts', 'js'); ?>"></script>
    <?php else: ?>
    <script src="//code.jquery.com/jquery.js"></script>
    <?php endif; ?>
    <?php if (get_theme_option('Use Internal Bootstrap') == '1') :?>
    <script src="<?php echo src('bootstrap.min', 'javascripts', 'js'); ?>"></script>
    <?php else: ?>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <?php endif; ?>
</body>
</html>
