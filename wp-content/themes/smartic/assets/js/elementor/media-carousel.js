(function ($) {
    "use strict";
    $(window).on('elementor/frontend/init', () => {
        elementorFrontend.hooks.addAction('frontend/element_ready/smartic-media-carousel.default', ($scope) => {
            let $carousel = $('.smartic-carousel', $scope);
            if ($carousel.length > 0) {
                let data = $carousel.data('settings');

                $carousel.slick(
                    {
                        dots: data.navigation == 'both' || data.navigation == 'dots' ? true : false,
                        arrows: data.navigation == 'both' || data.navigation == 'arrows' ? true : false,
                        infinite: data.loop,
                        speed: 300,
                        slidesToShow: parseInt(data.items),
                        autoplay: data.autoplay,
                        autoplaySpeed: data.autoplaySpeed,
                        slidesToScroll: 1,
                        lazyLoad: 'ondemand',
                        rtl: data.rtl,
                        centerMode: data.centerMode ? data.centerMode : false,
                        centerPadding: data.centerPadding ? data.centerPadding : false,
                        responsive: [
                            {
                                breakpoint: 1025,
                                settings: {
                                    slidesToShow: parseInt(data.items_tablet),
                                }
                            },
                            {
                                breakpoint: 768,
                                settings: {
                                    slidesToShow: parseInt(data.items_mobile),
                                }
                            }
                        ]
                    }
                );

            }

            // $carousel.on('beforeChange afterChange load', function () {
            //     $('.slick-list .slick-active', $scope).removeClass('item-center');
            //     let $position = Math.floor($('.slick-list .slick-active', $scope).length / 2);
            //     $(".slick-active:eq(" + $position + ")", $scope).addClass('item-center');
            //
            // });

        });
    });

})(jQuery);
