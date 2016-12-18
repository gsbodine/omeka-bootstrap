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

     <script type="text/javascript">
    jQuery(document).ready(function () {
        <?php if (get_theme_option('Use Advanced Search')): ?>
        Omeka.showAdvancedForm();
        <?php endif; ?>
        Omeka.dropDown();
    });
    </script>

    <?php
    // Omeka 2.4 and Bootstrap 3.3.7 use the same jQuery (1.12).
    $config = Zend_Registry::get('bootstrap')->getResource('Config');
    $useInternalAssets = isset($config->theme->useInternalAssets)
       ? (bool) $config->theme->useInternalAssets
       : false;
    if ($useInternalAssets) : ?>
    <script src="<?php echo src('vendor/jquery', 'javascripts', 'js'); ?>"></script>
    <?php else: ?>
    <script src="//code.jquery.com/jquery.js"></script>
    <?php endif; ?>
    <?php if (get_theme_option('Use Internal Bootstrap')) :?>
    <script src="<?php echo src('bootstrap.min', 'javascripts', 'js'); ?>"></script>
    <?php else: ?>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <?php endif; ?>

    <?php if (get_theme_option('Use Advanced Search')): ?>
    <script type="text/javascript">
    $(function () {
        $('#show-advanced').popover({
            placement: 'auto bottom',
            container: 'body',
            trigger: 'click',
            html : true,
            title: '',
            content: function() {
                return $("#advanced-form").html();
            }
        });

        $('#show-advanced').on('shown.bs.popover', function (e) {
            $('#advanced-form').html('');

            // The current values should be set manually for a complex reason.
            $('.popover-form input[name=query_type]').on('change', function () {
                var value = $(this).val();
                // Don't use prop() for compatibility.
                $(".popover-form input[name=query_type][value=" + value + "]").attr('checked', 'checked');
                $(".popover-form input[name=query_type]:not([value=" + value + "])").removeAttr('checked');
            });

            $('.popover-form input[name="record_types[]"]').on('change', function () {
                if ($(this).attr('checked')) {
                    $(this).removeAttr('checked');
                } else {
                    $(this).attr('checked', 'checked');
                }
            });
        });

        $('#show-advanced').on('hide.bs.popover', function (e) {
            var content = $(this).data('bs.popover').$tip.find('.popover-content');
            $('#advanced-form').html(content.html());
        });
    });
    </script>
    <?php endif; ?>
    <?php if(is_current_url('/')): ?>
    <?php if (get_theme_option('Display Grid Rotator')):
    echo js_tag('modernizr-custom');
    echo js_tag('jquery.gridrotator');
    ?>
     <script type="text/javascript">
               jQuery(document).ready(function() {
                    $( '#ri-grid' ).gridrotator( {
                    rows : 3,
                    preventClick : false,
                    columns : 8,
                    maxStep : 2,
                    interval : 2000,
                    w1024 : {
                        rows : 3,
                        columns : 6
                    },
                    w768 : {
                        rows : 3,
                        columns : 5
                    },
                    w480 : {
                        rows : 3,
                        columns : 4
                    },
                    w320 : {
                        rows : 3,
                        columns : 4
                    },
                    w240 : {
                        rows : 3,
                        columns : 3
                    },
                } );
            });
        </script>
    <?php endif; ?>
    <?php endif; ?>
    <?php if (get_theme_option('Use Google Analytics') && $googleAccount = get_theme_option('Google Analytics Account')): ?>
    <?php echo common('analyticstracking.php', array('account' => $googleAccount)); ?>
    <?php endif; ?>
</body>
</html>
