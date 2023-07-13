(function ($) {
    "use strict";

    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/smartic-image-comparison.default', function ($scope) {
            let OpalCompElem = $scope.find(".smartic-images-compare-container"),
                OpalCompSettings = OpalCompElem.data("settings");

            OpalCompElem.imagesLoaded().done(function () {
                OpalCompElem.twentytwenty({
                    orientation: OpalCompSettings["orientation"],
                    default_offset_pct: OpalCompSettings["visibleRatio"],
                    switch_before_label: OpalCompSettings["switchBefore"],
                    before_label: OpalCompSettings["beforeLabel"],
                    switch_after_label: OpalCompSettings["switchAfter"],
                    after_label: OpalCompSettings["afterLabel"],
                    move_slider_on_hover: OpalCompSettings["mouseMove"],
                    click_to_move: OpalCompSettings["clickMove"],
                    show_drag: OpalCompSettings["showDrag"],
                    show_sep: OpalCompSettings["showSep"],
                    no_overlay: OpalCompSettings["overlay"],
                    horbeforePos: OpalCompSettings["beforePos"],
                    horafterPos: OpalCompSettings["afterPos"],
                    verbeforePos: OpalCompSettings["verbeforePos"],
                    verafterPos: OpalCompSettings["verafterPos"]
                });
            });
        });
    });

})(jQuery);
