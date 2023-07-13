(function ($) {
    "use strict";
    $(window).on('elementor/frontend/init', () => {
        elementorFrontend.hooks.addAction('frontend/element_ready/smartic-testimonials.default', ($scope) => {
            let $carousel = $('.smartic-carousel', $scope);
            let $currentItem = $('.current-item', $scope);
            if ($carousel.length > 0) {
                let data = $carousel.data('settings');

                $carousel.on('init reInit afterChange', function (event, slick, currentSlide, nextSlide) {
                    var i = (currentSlide ? currentSlide : 0) + 1;
                    $currentItem.text(i + '/' + slick.slideCount);
                });
                if ($('.style9',$scope).length) {
                    let $nav = $('.testimonial-image-style', $scope);
                    $carousel.slick({
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrows: false,
                        fade: true,
                        asNavFor: $nav
                    });
                    $nav.slick({
                        slidesToShow: parseInt(data.items),
                        slidesToScroll: 1,
                        asNavFor: $carousel,
                        adaptiveHeight: false,
                        dots: false,
                        centerMode: true,
                        focusOnSelect: true,
                        arrows: false,
                        centerPadding: '0px'
                    });
                } else {
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
                    ).on('setPosition', function (event, slick) {
                        slick.$slides.css('height', slick.$slideTrack.height() + 'px');
                    });
                }
            }
        });
    });

})(jQuery);

