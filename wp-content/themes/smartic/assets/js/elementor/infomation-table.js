(function ($) {
    "use strict";
    $(window).on('elementor/frontend/init', () => {
        elementorFrontend.hooks.addAction('frontend/element_ready/smartic-infomation-table.default', ($scope) => {
            $('.scrollbar-external').scrollbar({
                "autoScrollSize": false,
                "scrolly": $('.external-scroll_y')
            });
        });
    });

})(jQuery);
