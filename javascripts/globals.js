if (!Omeka) {
    var Omeka = {};
}

(function($) {
    // Skip to content
    Omeka.skipNav = function() {
        $("#skipnav").click(function() {
            $("#content").focus()
        });
    };

    // Show advanced options for site-wide search.
    Omeka.showAdvancedForm = function () {
        var advanced_form = $('#advanced-form');
        var search_submit = $('#search-form button');

        // Set up classes and DOM elements jQuery will use.
        if (advanced_form.length > 0) {
            $('#search-container').addClass('with-advanced');
        }

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
    };

    Omeka.megaMenu = function (menuSelector, customMenuOptions) {
        if (typeof menuSelector === 'undefined') {
            menuSelector = '#primary-nav';
        }

        var menuOptions = {
            /* prefix for generated unique id attributes, which are required
             to indicate aria-owns, aria-controls and aria-labelledby */
            uuidPrefix: "accessible-megamenu",

            /* css class used to define the megamenu styling */
            menuClass: "nav-menu",

            /* css class for a top-level navigation item in the megamenu */
            topNavItemClass: "nav-item",

            /* css class for a megamenu panel */
            panelClass: "sub-nav",

            /* css class for a group of items within a megamenu panel */
            panelGroupClass: "sub-nav-group",

            /* css class for the hover state */
            hoverClass: "hover",

            /* css class for the focus state */
            focusClass: "focus",

            /* css class for the open state */
            openClass: "open"
        };

        $.extend(menuOptions, customMenuOptions);

        $(menuSelector).accessibleMegaMenu(menuOptions);
    };

    // TODO Check to use megamenu or dropdown.
    Omeka.dropDown = function(){
        var dropdownMenu = $('#mobile-nav');
        dropdownMenu.prepend('<a class="menu">Menu</a>');
        //Hide the rest of the menu
        $('#mobile-nav .navigation').hide();

        //function the will toggle the menu
        $('.menu').click(function() {
            var x = $(this).attr('id');

            if (x==1) {
                $("#mobile-nav .navigation").slideUp();
                $(this).attr('id', '0');
            } else {
                $("#mobile-nav .navigation").slideDown();
                $(this).attr('id', '1');
            }
        });
    };

    Omeka.displayGridRotator = function() {
        $( '#ri-grid' ).gridrotator( {
            preventClick : false,
            rows: 3,
            columns: 8,
            maxStep: 2,
            interval: 2000,
            w1024: {
                rows: 3,
                columns: 6
            },
            w768: {
                rows: 3,
                columns: 5
            },
            w480: {
                rows: 3,
                columns: 4
            },
            w320: {
                rows: 3,
                columns : 4
            },
            w240: {
                rows: 3,
                columns: 3
            },
        });
    };

    $(document).ready(function () {
        $('.omeka-media').on('error', function () {
            if (this.networkState === HTMLMediaElement.NETWORK_NO_SOURCE ||
                this.networkState === HTMLMediaElement.NETWORK_EMPTY
            ) {
                $(this).replaceWith(this.innerHTML);
            }
        });

        /**
         * @copyright Garrick S. Bodine, 2012
         * @license http://www.gnu.org/licenses/gpl-3.0.txt
         */
        // for adding the 'active' class, which is Bootstrap's equivalent of Omeka's
        // 'current' class for on-current-page links
        $(".current").addClass("active");

        // Making tags look like labels and adding the icons for items/browse or items/show.
        $('a[rel="tag"]').addClass("label label-primary").prepend('<span class="glyphicon glyphicon-tag icon-white"></span> ');
        // For the full tag cloud in items/tags
        $('.hTagcloud .popularity li').prepend('<span class="glyphicon glyphicon-tag"></span> ');
        $(".popular").addClass("btn btn-default");
        $('.v-popular,.vv-popular,.vvv-popular').addClass("btn btn-small btn-info");
        $('.vvvv-popular,.vvvvv-popular,.vvvvvv-popular').addClass("btn btn-primary");
        $('.vvvvvvv-popular,.vvvvvvvv-popular').addClass("btn btn-large btn-success");

        // $('.dropdown-toggle').dropdown();

        // activating popovers on desired page boxen
        // $('.pop-box').popover();
    });

    // Adapted from the plugin Taxonomy (taxonomy.js).
    $(document).bind("omeka:elementformload", function() {
        $("select.taxonomy-open").each(function() {
            $(this).change(function() {
                var val = $(this).val();
                if (val == 'insert_new_term') {
                    $(this).next('input.taxonomy-open').show();
                    $(this).parent().find('button.taxonomy-open').show();
                    $(this).parent().find('p.taxonomy-open').show();

                } else {
                    $(this).next('input.taxonomy-open').hide();
                    $(this).parent().find('button.taxonomy-open').hide();
                    $(this).parent().find('p.taxonomy-open').hide();
                }
            }).change();

            $("button.taxonomy-open").click(function(){
                var field = $(this).parent().find('input.taxonomy-open');
                var val = field.val().trim();
                if (val.length == 0) {
                    return;
                }
                var select = $(this).parent().find('select.taxonomy-open');
                var exists = false;
                select.find('option').each(function(){
                    if (this.value == val) {
                        exists = true;
                        return false;
                    }
                });
                if (!exists) {
                    var insertNewTerm = select.children("option[value='insert_new_term']")[0].outerHTML;
                    select.children("option[value='insert_new_term']").remove();
                    select.append('<option value="' + val + '">' + val + '</option>');
                    select.append(insertNewTerm);
                }
                select.val(val);
                field.val('').hide();
                $(this).hide();
                $(this).parent().find('p.taxonomy-open').hide();
            });
        });
    });

})(jQuery);
