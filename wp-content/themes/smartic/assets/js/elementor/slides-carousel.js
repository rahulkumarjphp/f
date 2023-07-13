(function ($) {
    "use strict";
    $(window).on('elementor/frontend/init', () => {
        elementorFrontend.hooks.addAction('frontend/element_ready/smartic-slides-carousel.default', ($scope) => {
            let $carousel = $('.js-swiper-container', $scope);
            if ($carousel.length > 0) {
                let mySwiper = new Swiper($carousel.get(0), {
                    direction: 'vertical',
                    loop: false,
                    autoHeight: false,
                    spaceBetween: 0,
                    slidesPerView: 1,
                    effect: "slide",
                    initialSlide: 1,
                    mousewheel: true,
                    scrollbar: {
                        el: '.swiper-scrollbar',
                        draggable: true,
                        dragSize: 19
                    },
                });
            }
        });
    });
})(jQuery);
