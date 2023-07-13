(function ($) {
    "use strict";
    $(window).on('elementor/frontend/init', () => {
        elementorFrontend.hooks.addAction('frontend/element_ready/smartic-image-carousel.default', ($scope) => {
            let $carousel = $('.smartic-carousel', $scope);
            if ($carousel.length > 0) {
                let data = $carousel.data('settings');
                $carousel.slick(
                    {
                        dots: false,
                        arrows: false,
                        slidesToShow: parseInt(data.items),
                        slidesToScroll: 1,
                        infinite: true,
                        speed: 300,
                        autoplay: true,
                        autoplaySpeed: 2000,
                        rtl: data.rtl,
                        variableWidth: data.variableWidth,
                        centerMode: true,
                        responsive: [
                            {
                                breakpoint: 1024,
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
        });
    });

})(jQuery);
