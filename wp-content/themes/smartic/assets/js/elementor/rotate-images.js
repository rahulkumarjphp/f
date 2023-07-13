(function ($) {
    "use strict";
    $(window).on('elementor/frontend/init', () => {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/smartic-rotate-image.default', ( $scope ) => {
            // Code Here

        } );
    });
})(jQuery);