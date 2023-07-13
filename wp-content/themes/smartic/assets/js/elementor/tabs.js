(function ($) {
    "use strict";
    $(window).on('elementor/frontend/init', () => {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/smartic-tabs.default', ( $scope ) => {
            $scope.addClass('elementor-widget-tabs');
            let $tabs = $scope.find('.elementor-tabs-wrapper');
            let $contents = $scope.find('.elementor-tabs-content-wrapper');

            // Active tab
            $contents.find('.elementor-active').show();

            $tabs.find('.elementor-tab-title').on('click', function () {
                $tabs.find('.elementor-tab-title').removeClass('elementor-active');
                $contents.find('.elementor-tab-content').removeClass('elementor-active').hide();
                $(this).addClass('elementor-active');
                let id = $(this).attr('aria-controls');
                $contents.find('#'+ id).addClass('elementor-active').show();
                let $slider = $contents.find('#'+ id + ' .swiper-container');
                if($slider.length) {
                    let swiperInstance = $slider.data( 'swiper' );
                    swiperInstance.update();
                }
            })

        } );
    });

})(jQuery);