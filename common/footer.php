        </div><!-- end content -->
        <div class="row">
        <footer class="col-md-12">
            <div id="custom-footer-text">
                <?php if ( $footerText = get_theme_option('Footer Text') ): ?>
                <p><?php echo $footerText; ?></p>
                <?php endif; ?>
                <?php if ((get_theme_option('Display Footer Copyright') == 1) && $copyright = option('copyright')): ?>
                    <p><?php echo $copyright; ?></p>
                <?php endif; ?>
            </div>
            <div class="omeka-props-footer pull-right">
                <p><?php echo __('Proudly powered by <a href="https://omeka.org">Omeka</a>.'); ?></p>
            </div>
            <div>
                <?php fire_plugin_hook('public_footer'); ?>
            </div>
        </footer>
        </div>
</div><!--end wrap-->

    <?php
    // Omeka 2.4 and Bootstrap 3.3.7 use the same jQuery (1.12), so it is not
    // recalled.
    ?>
    <?php if (get_theme_option('Use Internal Bootstrap')) :?>
    <script src="<?php echo src('bootstrap.min', 'javascripts', 'js'); ?>"></script>
    <?php else: ?>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <?php endif; ?>

    <?php
    if (is_current_url('/')):
        $displayGridRotator = (boolean) get_theme_option('Display Grid Rotator');
        if ($displayGridRotator):
            echo js_tag('modernizr-custom');
            echo js_tag('jquery.gridrotator');
        endif;
    else:
        $displayGridRotator = false;
    endif;
    ?>

     <script type="text/javascript">
    jQuery(document).ready(function () {
        <?php if (get_theme_option('Use Advanced Search')): ?>
        Omeka.showAdvancedForm();
        <?php endif; ?>
        Omeka.dropDown();
        <?php if ($displayGridRotator): ?>
        Omeka.displayGridRotator();
        <?php endif; ?>
    });
    </script>

    <?php if (get_theme_option('Use Google Analytics') && $googleAccount = get_theme_option('Google Analytics Account')): ?>
    <?php echo common('analyticstracking.php', array('account' => $googleAccount)); ?>
    <?php endif; ?>
</body>
</html>
