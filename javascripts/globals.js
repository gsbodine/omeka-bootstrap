if (!Omeka) {
    var Omeka = {};
}

(function ($) {
    Omeka.showAdvancedForm = function () {
        var advancedForm = $('#advanced-form');
        var searchTextbox = $('#search-form input[type=text]');
        var searchSubmit = $('#search-form input[type=submit]');
        if (advancedForm) {
            advancedForm.css("display", "none");
            searchSubmit.addClass("with-advanced").after('<a href="#" id="advanced-search" class="button">Advanced Search</a>');
            advancedForm.click(function (event) {
                event.stopPropagation();
            });
            $("#advanced-search").click(function (event) {
                event.preventDefault();
                event.stopPropagation();
                advancedForm.fadeToggle();
                $(document).click(function (event) {
                    if (event.target.id == 'query') {
                        return;
                    }
                    advancedForm.fadeOut();
                    $(this).unbind(event);
                });
            });
        } else {
            $('#search-form input[type=submit]').addClass("blue button");
        }
    };

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
})(jQuery);

/*
 * @copyright Garrick S. Bodine, 2012
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 */

jQuery(document).ready(function($){

    // for theming the form helper buttons with Bootstrap button defaults classes
    // for theming the search button with Bootstrap button defaults
    $("#submit_search").addClass("btn");

    // for adding the 'active' class, which is Bootstrap's equivalent of Omeka's
    // 'current' class for on-current-page links
    $(".current").addClass("active");

//    $('.carousel').carousel();

    // making tags look like labels and adding the icons
    $('a[rel="tag"]').addClass("label label-primary");
    $(".popular").addClass("btn btn-default");
    $('.v-popular,.vv-popular,.vvv-popular');
    $('.vvvv-popular,.vvvvv-popular,.vvvvvv-popular').addClass("btn btn-primary");
    $('.vvvvvvv-popular,.vvvvvvvv-popular').addClass("btn btn-large btn-success");

//    $('.dropdown-toggle').dropdown();

    // activating popovers on desired page boxen
//    $('.pop-box').popover();

    $(".tooltipper").tooltip();
});
