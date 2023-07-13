<?php

use Elementor\Plugin;

if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('Smartic_Elementor')) :

    /**
     * The Smartic Elementor Integration class
     */
    class Smartic_Elementor {
        private $suffix = '';

        public function __construct() {
            $this->suffix = (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) ? '' : '.min';

            add_action('wp', [$this, 'register_auto_scripts_frontend']);
            add_action('elementor/init', array($this, 'add_category'));
            add_action('wp_enqueue_scripts', [$this, 'add_scripts'], 15);
            add_action('elementor/widgets/register', array($this, 'customs_widgets'));
            add_action('elementor/widgets/register', array($this, 'include_widgets'));
            add_action('elementor/frontend/after_enqueue_scripts', [$this, 'add_js']);

            // Custom Animation Scroll
            add_filter('elementor/controls/animations/additional_animations', [$this, 'add_animations_scroll']);

            // Elementor Fix Noitice WooCommerce
            add_action('elementor/editor/before_enqueue_scripts', array($this, 'woocommerce_fix_notice'));

            // Backend
            add_action('elementor/editor/after_enqueue_styles', [$this, 'add_style_editor'], 99);
//
//			// Add Icon Custom
            add_action('elementor/icons_manager/native', [$this, 'add_icons_native'], 20);
            add_action('elementor/controls/register', [$this, 'add_icons'], 20);

            add_filter('elementor/fonts/additional_fonts', [$this, 'additional_fonts']);
            add_action('wp_enqueue_scripts', [$this, 'elementor_kit']);

            add_filter('elementor/shapes/additional_shapes', [$this, 'custom_shapes']);
        }

        public function custom_shapes($additional_shapes) {
            $additional_shapes['opalshape'] = [
                'title'    => _x('Opal Shape', 'Shapes', 'smartic'),
                'has_flip' => true,
                'path'     => get_template_directory() . '/assets/images/shapes/opalshape.svg',
                'url'      => get_template_directory_uri() . '/assets/images/shapes/opalshape.svg',
            ];
            return $additional_shapes;
        }

        public function elementor_kit() {
            $active_kit_id = Elementor\Plugin::$instance->kits_manager->get_active_id();
            Elementor\Plugin::$instance->kits_manager->frontend_before_enqueue_styles();
            $myvals = get_post_meta($active_kit_id, '_elementor_page_settings', true);
            if (!empty($myvals)) {
                $css = '';
                $css .= $myvals['system_colors'][0]['color'] !== '' ? '--primary:' . $myvals['system_colors'][0]['color'] . ';' : '';
                $css .= $myvals['system_colors'][0]['color'] !== '' ? '--primary_hover:' . darken_color($myvals['system_colors'][0]['color'], 1.1) . ';' : '';
                $css .= $myvals['system_colors'][1]['color'] !== '' ? '--secondary:' . $myvals['system_colors'][1]['color'] . ';' : '';
                $css .= $myvals['system_colors'][2]['color'] !== '' ? '--text:' . $myvals['system_colors'][2]['color'] . ';' : '';
                $css .= $myvals['system_colors'][3]['color'] !== '' ? '--accent:' . $myvals['system_colors'][3]['color'] . ';' : '';

                $custom_color = $myvals['custom_colors'];

                foreach ($custom_color as $color) {
                    $title = $color["title"];
                    switch ($title) {
                        case "Light":
                            $css .= '--light:' . $color['color'] . ';';
                            break;
                        case "Dark":
                            $css .= '--dark:' . $color['color'] . ';';
                            break;
                        case "Border":
                            $css .= '--border:' . $color['color'] . ';';
                            break;
                    }
                }

                $var = "body{{$css}}";
                wp_add_inline_style('smartic-style', $var);
            }
        }

        public function additional_fonts($fonts) {
            $fonts["BROmny"] = 'system';
            $fonts["Inter Tight"] = 'googlefonts';

            return $fonts;
        }

        public function add_js() {
            global $smartic_version;
            wp_enqueue_script('smartic-elementor-frontend', get_theme_file_uri('/assets/js/elementor-frontend.js'), [], $smartic_version);
        }

        public function add_style_editor() {
            global $smartic_version;
            wp_enqueue_style('smartic-elementor-editor-icon', get_theme_file_uri('/assets/css/admin/elementor/icons.css'), [], $smartic_version);
        }

        public function add_scripts() {
            global $smartic_version;
            $suffix = (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) ? '' : '.min';
            wp_enqueue_style('smartic-elementor', get_template_directory_uri() . '/assets/css/base/elementor.css', '', $smartic_version);
            wp_style_add_data('smartic-elementor', 'rtl', 'replace');

            // Add Scripts
            wp_register_script('tweenmax', get_theme_file_uri('/assets/js/vendor/TweenMax.min.js'), array('jquery'), '1.11.1');
            wp_register_script('parallaxmouse', get_theme_file_uri('/assets/js/vendor/jquery-parallax.js'), array('jquery'), $smartic_version);

            if (smartic_elementor_check_type('animated-bg-parallax')) {
                wp_enqueue_script('tweenmax');
                wp_enqueue_script('jquery-panr', get_theme_file_uri('/assets/js/vendor/jquery-panr' . $suffix . '.js'), array('jquery'), '0.0.1');
            }

            $e_swiper_latest     = Plugin::$instance->experiments->is_feature_active('e_swiper_latest');
            $e_swiper_asset_path = $e_swiper_latest ? 'assets/lib/swiper/v8/' : 'assets/lib/swiper/';
            $e_swiper_version    = $e_swiper_latest ? '8.4.5' : '5.3.6';
            wp_register_script(
                'swiper',
                plugins_url('elementor/' . $e_swiper_asset_path . 'swiper.js', 'elementor'),
                [],
                $e_swiper_version,
                true
            );
        }


        public function register_auto_scripts_frontend() {
            global $smartic_version;
            wp_register_script('smartic-elementor-brand', get_theme_file_uri('/assets/js/elementor/brand.js'), array('jquery','elementor-frontend'), $smartic_version, true);
            wp_register_script('smartic-elementor-countdown', get_theme_file_uri('/assets/js/elementor/countdown.js'), array('jquery','elementor-frontend'), $smartic_version, true);
            wp_register_script('smartic-elementor-header-group', get_theme_file_uri('/assets/js/elementor/header-group.js'), array('jquery','elementor-frontend'), $smartic_version, true);
            wp_register_script('smartic-elementor-image-carousel', get_theme_file_uri('/assets/js/elementor/image-carousel.js'), array('jquery','elementor-frontend'), $smartic_version, true);
            wp_register_script('smartic-elementor-image-comparison', get_theme_file_uri('/assets/js/elementor/image-comparison.js'), array('jquery','elementor-frontend'), $smartic_version, true);
            wp_register_script('smartic-elementor-image-hotspots', get_theme_file_uri('/assets/js/elementor/image-hotspots.js'), array('jquery','elementor-frontend'), $smartic_version, true);
            wp_register_script('smartic-elementor-infomation-table', get_theme_file_uri('/assets/js/elementor/infomation-table.js'), array('jquery','elementor-frontend'), $smartic_version, true);
            wp_register_script('smartic-elementor-language-switcher', get_theme_file_uri('/assets/js/elementor/language-switcher.js'), array('jquery','elementor-frontend'), $smartic_version, true);
            wp_register_script('smartic-elementor-link-showcase', get_theme_file_uri('/assets/js/elementor/link-showcase.js'), array('jquery','elementor-frontend'), $smartic_version, true);
            wp_register_script('smartic-elementor-media-carousel', get_theme_file_uri('/assets/js/elementor/media-carousel.js'), array('jquery','elementor-frontend'), $smartic_version, true);
            wp_register_script('smartic-elementor-posts-grid', get_theme_file_uri('/assets/js/elementor/posts-grid.js'), array('jquery','elementor-frontend'), $smartic_version, true);
            wp_register_script('smartic-elementor-product-currency', get_theme_file_uri('/assets/js/elementor/product-currency.js'), array('jquery','elementor-frontend'), $smartic_version, true);
            wp_register_script('smartic-elementor-product-tab', get_theme_file_uri('/assets/js/elementor/product-tab.js'), array('jquery','elementor-frontend'), $smartic_version, true);
            wp_register_script('smartic-elementor-products', get_theme_file_uri('/assets/js/elementor/products.js'), array('jquery','elementor-frontend'), $smartic_version, true);
            wp_register_script('smartic-elementor-rotate-images', get_theme_file_uri('/assets/js/elementor/rotate-images.js'), array('jquery','elementor-frontend'), $smartic_version, true);
            wp_register_script('smartic-elementor-slides-carousel', get_theme_file_uri('/assets/js/elementor/slides-carousel.js'), array('jquery','elementor-frontend'), $smartic_version, true);
            wp_register_script('smartic-elementor-tabs', get_theme_file_uri('/assets/js/elementor/tabs.js'), array('jquery','elementor-frontend'), $smartic_version, true);
            wp_register_script('smartic-elementor-testimonial', get_theme_file_uri('/assets/js/elementor/testimonial.js'), array('jquery','elementor-frontend'), $smartic_version, true);
            wp_register_script('smartic-elementor-video', get_theme_file_uri('/assets/js/elementor/video.js'), array('jquery','elementor-frontend'), $smartic_version, true);
           
        }

        public function add_category() {
            Elementor\Plugin::instance()->elements_manager->add_category(
                'smartic-addons',
                array(
                    'title' => esc_html__('Smartic Addons', 'smartic'),
                    'icon'  => 'fa fa-plug',
                ),
                1);
        }

        public function add_animations_scroll($animations) {
            $animations['Smartic Animation'] = [
                'opal-move-up'    => 'Move Up',
                'opal-move-down'  => 'Move Down',
                'opal-move-left'  => 'Move Left',
                'opal-move-right' => 'Move Right',
                'opal-flip'       => 'Flip',
                'opal-helix'      => 'Helix',
                'opal-scale-up'   => 'Scale',
                'opal-am-popup'   => 'Popup',
            ];

            return $animations;
        }

        public function customs_widgets() {
            $files = glob(get_theme_file_path('/inc/elementor/custom-widgets/*.php'));
            foreach ($files as $file) {
                if (file_exists($file)) {
                    require_once $file;
                }
            }
        }

        /**
         * @param $widgets_manager Elementor\Widgets_Manager
         */
        public function include_widgets($widgets_manager) {
            $files = glob(get_theme_file_path('/inc/elementor/widgets/*.php'));
            foreach ($files as $file) {
                $file = get_theme_file_path('inc/elementor/widgets/' . basename($file));
                if (file_exists($file)) {
                    require_once $file;
                }
            }
        }

        public function woocommerce_fix_notice() {
            if (smartic_is_woocommerce_activated()) {
                remove_action('woocommerce_cart_is_empty', 'woocommerce_output_all_notices', 5);
                remove_action('woocommerce_shortcode_before_product_cat_loop', 'woocommerce_output_all_notices', 10);
                remove_action('woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10);
                remove_action('woocommerce_before_single_product', 'woocommerce_output_all_notices', 10);
                remove_action('woocommerce_before_cart', 'woocommerce_output_all_notices', 10);
                remove_action('woocommerce_before_checkout_form', 'woocommerce_output_all_notices', 10);
                remove_action('woocommerce_account_content', 'woocommerce_output_all_notices', 10);
                remove_action('woocommerce_before_customer_login_form', 'woocommerce_output_all_notices', 10);
            }
        }

        public function add_icons( $manager ) {
            $new_icons = json_decode( '{"smartic-icon-accurate-2":"accurate-2","smartic-icon-activity":"activity","smartic-icon-app-2":"app-2","smartic-icon-audio":"audio","smartic-icon-battery-2":"battery-2","smartic-icon-battery-3":"battery-3","smartic-icon-battery":"battery","smartic-icon-bedding":"bedding","smartic-icon-biodegradable":"biodegradable","smartic-icon-blade":"blade","smartic-icon-blades":"blades","smartic-icon-bluetooth-2":"bluetooth-2","smartic-icon-body":"body","smartic-icon-bow":"bow","smartic-icon-braking":"braking","smartic-icon-broken-link":"broken-link","smartic-icon-camera-2":"camera-2","smartic-icon-capacity-1":"capacity-1","smartic-icon-capacity":"capacity","smartic-icon-cardio":"cardio","smartic-icon-care":"care","smartic-icon-charge":"charge","smartic-icon-chip":"chip","smartic-icon-cookie":"cookie","smartic-icon-cruelty-free":"cruelty-free","smartic-icon-data":"data","smartic-icon-decay-tooth":"decay-tooth","smartic-icon-deck":"deck","smartic-icon-dental-care":"dental-care","smartic-icon-dental-floss":"dental-floss","smartic-icon-dental-floss1":"dental-floss1","smartic-icon-distortion":"distortion","smartic-icon-drone-1":"drone-1","smartic-icon-eco-friendly":"eco-friendly","smartic-icon-edge":"edge","smartic-icon-enjoy":"enjoy","smartic-icon-export":"export","smartic-icon-fast":"fast","smartic-icon-faster":"faster","smartic-icon-feedback":"feedback","smartic-icon-fields":"fields","smartic-icon-filter-1":"filter-1","smartic-icon-fixed":"fixed","smartic-icon-flexible":"flexible","smartic-icon-floss":"floss","smartic-icon-flower-1":"flower-1","smartic-icon-flying-skill":"flying-skill","smartic-icon-frame":"frame","smartic-icon-free-1":"free-1","smartic-icon-free-delivery-1":"free-delivery-1","smartic-icon-fresher-breath":"fresher-breath","smartic-icon-fried-chicken":"fried-chicken","smartic-icon-gallery":"gallery","smartic-icon-gift1":"gift1","smartic-icon-global":"global","smartic-icon-gluten":"gluten","smartic-icon-gmo":"gmo","smartic-icon-green-house-1":"green-house-1","smartic-icon-grinding":"grinding","smartic-icon-group":"group","smartic-icon-guarranted":"guarranted","smartic-icon-hamburger":"hamburger","smartic-icon-hand":"hand","smartic-icon-headphone-1":"headphone-1","smartic-icon-heart-rate":"heart-rate","smartic-icon-hot-1":"hot-1","smartic-icon-improve":"improve","smartic-icon-insert":"insert","smartic-icon-insomnia":"insomnia","smartic-icon-ion":"ion","smartic-icon-laurel-wreath":"laurel-wreath","smartic-icon-leaf":"leaf","smartic-icon-length1":"length1","smartic-icon-lens":"lens","smartic-icon-light":"light","smartic-icon-lighting":"lighting","smartic-icon-magnetic":"magnetic","smartic-icon-map":"map","smartic-icon-minus-solid":"minus-solid","smartic-icon-money-recive":"money-recive","smartic-icon-music-2":"music-2","smartic-icon-music":"music","smartic-icon-natural_1":"natural_1","smartic-icon-natural_2":"natural_2","smartic-icon-nature-1":"nature-1","smartic-icon-newspaper1":"newspaper1","smartic-icon-noise":"noise","smartic-icon-novelty-1":"novelty-1","smartic-icon-organic":"organic","smartic-icon-palm":"palm","smartic-icon-payload":"payload","smartic-icon-phone-4":"phone-4","smartic-icon-phone-5":"phone-5","smartic-icon-phone-6":"phone-6","smartic-icon-photo":"photo","smartic-icon-plant":"plant","smartic-icon-plastic":"plastic","smartic-icon-play-2":"play-2","smartic-icon-plus-1":"plus-1","smartic-icon-plus-solid":"plus-solid","smartic-icon-pose":"pose","smartic-icon-power-1":"power-1","smartic-icon-press":"press","smartic-icon-profit-1":"profit-1","smartic-icon-quality-2":"quality-2","smartic-icon-quiet":"quiet","smartic-icon-quote-3":"quote-3","smartic-icon-quote-4":"quote-4","smartic-icon-rabbit":"rabbit","smartic-icon-range":"range","smartic-icon-recharge-1":"recharge-1","smartic-icon-recharge":"recharge","smartic-icon-remider":"remider","smartic-icon-return-box-1":"return-box-1","smartic-icon-ride":"ride","smartic-icon-run":"run","smartic-icon-safe-2":"safe-2","smartic-icon-safe":"safe","smartic-icon-salads":"salads","smartic-icon-salt":"salt","smartic-icon-saver":"saver","smartic-icon-shipping-2":"shipping-2","smartic-icon-shoes":"shoes","smartic-icon-skin-cell-1":"skin-cell-1","smartic-icon-sleep-1":"sleep-1","smartic-icon-sleep":"sleep","smartic-icon-sleeping-1":"sleeping-1","smartic-icon-smartness":"smartness","smartic-icon-sos-2":"sos-2","smartic-icon-speed-2":"speed-2","smartic-icon-spices-1":"spices-1","smartic-icon-spices":"spices","smartic-icon-sustainable-1":"sustainable-1","smartic-icon-terrain":"terrain","smartic-icon-tooth":"tooth","smartic-icon-touch-2":"touch-2","smartic-icon-turbo":"turbo","smartic-icon-Union":"Union","smartic-icon-usb":"usb","smartic-icon-vegan":"vegan","smartic-icon-verify":"verify","smartic-icon-vibrating":"vibrating","smartic-icon-video-1":"video-1","smartic-icon-video-2":"video-2","smartic-icon-video-horizontal":"video-horizontal","smartic-icon-view":"view","smartic-icon-vitamins-3":"vitamins-3","smartic-icon-voice-2":"voice-2","smartic-icon-warranted":"warranted","smartic-icon-warranty-1":"warranty-1","smartic-icon-washing-hands-1":"washing-hands-1","smartic-icon-water-3":"water-3","smartic-icon-weight_2":"weight_2","smartic-icon-wifi-3":"wifi-3","smartic-icon-wisdom-tooth":"wisdom-tooth","smartic-icon-youtube-new":"youtube-new","smartic-icon-zip-1":"zip-1","smartic-icon-zip":"zip","smartic-icon-account":"account","smartic-icon-accurate":"accurate","smartic-icon-acivity":"acivity","smartic-icon-address":"address","smartic-icon-age":"age","smartic-icon-aids":"aids","smartic-icon-alarm":"alarm","smartic-icon-anti":"anti","smartic-icon-app":"app","smartic-icon-arrow-down":"arrow-down","smartic-icon-arrow-left":"arrow-left","smartic-icon-arrow-right":"arrow-right","smartic-icon-arrow-up":"arrow-up","smartic-icon-avoid":"avoid","smartic-icon-battery-4":"battery-4","smartic-icon-bluetooth-1":"bluetooth-1","smartic-icon-bmi":"bmi","smartic-icon-bodyfat":"bodyfat","smartic-icon-bone":"bone","smartic-icon-boot":"boot","smartic-icon-bottle":"bottle","smartic-icon-box-check":"box-check","smartic-icon-box":"box","smartic-icon-burn":"burn","smartic-icon-button":"button","smartic-icon-call":"call","smartic-icon-calorie":"calorie","smartic-icon-camera-1":"camera-1","smartic-icon-camera":"camera","smartic-icon-caret-vertiacl-menu":"caret-vertiacl-menu","smartic-icon-cart":"cart","smartic-icon-charger":"charger","smartic-icon-charging":"charging","smartic-icon-child":"child","smartic-icon-cleasing":"cleasing","smartic-icon-clock-time":"clock-time","smartic-icon-coffee":"coffee","smartic-icon-computer":"computer","smartic-icon-contact-2":"contact-2","smartic-icon-control":"control","smartic-icon-delivery-2":"delivery-2","smartic-icon-delivery-3":"delivery-3","smartic-icon-delivery":"delivery","smartic-icon-dental-care-1":"dental-care-1","smartic-icon-dental-checkup":"dental-checkup","smartic-icon-dental-protect":"dental-protect","smartic-icon-destination":"destination","smartic-icon-digested":"digested","smartic-icon-discount":"discount","smartic-icon-dispatch":"dispatch","smartic-icon-drone":"drone","smartic-icon-eco":"eco","smartic-icon-email":"email","smartic-icon-envelope-open-text":"envelope-open-text","smartic-icon-eyecare":"eyecare","smartic-icon-faceskin":"faceskin","smartic-icon-farmed":"farmed","smartic-icon-formula":"formula","smartic-icon-free":"free","smartic-icon-gaming":"gaming","smartic-icon-gem":"gem","smartic-icon-gps":"gps","smartic-icon-headphone":"headphone","smartic-icon-headphones-alt":"headphones-alt","smartic-icon-headset":"headset","smartic-icon-heart-2":"heart-2","smartic-icon-help":"help","smartic-icon-hydrating":"hydrating","smartic-icon-id-card":"id-card","smartic-icon-led":"led","smartic-icon-lightning":"lightning","smartic-icon-location":"location","smartic-icon-logo":"logo","smartic-icon-long-arrow-down":"long-arrow-down","smartic-icon-long-arrow-left":"long-arrow-left","smartic-icon-long-arrow-right":"long-arrow-right","smartic-icon-long-arrow-up":"long-arrow-up","smartic-icon-mail":"mail","smartic-icon-makeup":"makeup","smartic-icon-map-marker-alt":"map-marker-alt","smartic-icon-map-marker":"map-marker","smartic-icon-max-speed":"max-speed","smartic-icon-menu-header":"menu-header","smartic-icon-menu":"menu","smartic-icon-message":"message","smartic-icon-money":"money","smartic-icon-moneyback":"moneyback","smartic-icon-mountains":"mountains","smartic-icon-muscle":"muscle","smartic-icon-natural":"natural","smartic-icon-networking":"networking","smartic-icon-off":"off","smartic-icon-packed":"packed","smartic-icon-paper-plane":"paper-plane","smartic-icon-paw":"paw","smartic-icon-payment":"payment","smartic-icon-pencil-ruler":"pencil-ruler","smartic-icon-person":"person","smartic-icon-phone-1":"phone-1","smartic-icon-phone-2":"phone-2","smartic-icon-phone-3":"phone-3","smartic-icon-phone-volume":"phone-volume","smartic-icon-phone":"phone","smartic-icon-pickup":"pickup","smartic-icon-play_1":"play_1","smartic-icon-play-fill":"play-fill","smartic-icon-play":"play","smartic-icon-power":"power","smartic-icon-powerbank":"powerbank","smartic-icon-preserves":"preserves","smartic-icon-professionals-1":"professionals-1","smartic-icon-proffesionals":"proffesionals","smartic-icon-protect":"protect","smartic-icon-protected":"protected","smartic-icon-protein":"protein","smartic-icon-purification":"purification","smartic-icon-quality":"quality","smartic-icon-quote-1":"quote-1","smartic-icon-quote-2":"quote-2","smartic-icon-quote-5":"quote-5","smartic-icon-recipes":"recipes","smartic-icon-reliable":"reliable","smartic-icon-returns":"returns","smartic-icon-roasted":"roasted","smartic-icon-rocket":"rocket","smartic-icon-search-header":"search-header","smartic-icon-search":"search","smartic-icon-secure-2":"secure-2","smartic-icon-secure":"secure","smartic-icon-security":"security","smartic-icon-setup":"setup","smartic-icon-shield-alt":"shield-alt","smartic-icon-shipping":"shipping","smartic-icon-shoe-prints":"shoe-prints","smartic-icon-skin-2":"skin-2","smartic-icon-skin":"skin","smartic-icon-smartphone":"smartphone","smartic-icon-sos":"sos","smartic-icon-sound":"sound","smartic-icon-speaker":"speaker","smartic-icon-spray-can":"spray-can","smartic-icon-strenght":"strenght","smartic-icon-supplement":"supplement","smartic-icon-support-2":"support-2","smartic-icon-support":"support","smartic-icon-tag":"tag","smartic-icon-tags":"tags","smartic-icon-taste_2":"taste_2","smartic-icon-taste":"taste","smartic-icon-tea-cup":"tea-cup","smartic-icon-tea":"tea","smartic-icon-telephone":"telephone","smartic-icon-tennis-ball":"tennis-ball","smartic-icon-touch":"touch","smartic-icon-trusted":"trusted","smartic-icon-turnoff":"turnoff","smartic-icon-tv":"tv","smartic-icon-ultra":"ultra","smartic-icon-undo":"undo","smartic-icon-users":"users","smartic-icon-vitamins_3":"vitamins_3","smartic-icon-vitamins-2":"vitamins-2","smartic-icon-vitamins":"vitamins","smartic-icon-voice_2":"voice_2","smartic-icon-voice":"voice","smartic-icon-warranty":"warranty","smartic-icon-watch":"watch","smartic-icon-water_3":"water_3","smartic-icon-water-2":"water-2","smartic-icon-water":"water","smartic-icon-weight":"weight","smartic-icon-wifi":"wifi","smartic-icon-wishlist":"wishlist","smartic-icon-workout":"workout","smartic-icon-360":"360","smartic-icon-angle-down":"angle-down","smartic-icon-angle-left":"angle-left","smartic-icon-angle-right":"angle-right","smartic-icon-angle-up":"angle-up","smartic-icon-arrow-circle-down":"arrow-circle-down","smartic-icon-arrow-circle-left":"arrow-circle-left","smartic-icon-arrow-circle-right":"arrow-circle-right","smartic-icon-arrow-circle-up":"arrow-circle-up","smartic-icon-bars":"bars","smartic-icon-calendar":"calendar","smartic-icon-caret-down":"caret-down","smartic-icon-caret-left":"caret-left","smartic-icon-caret-right":"caret-right","smartic-icon-caret-up":"caret-up","smartic-icon-cart-empty":"cart-empty","smartic-icon-check-square":"check-square","smartic-icon-chevron-circle-left":"chevron-circle-left","smartic-icon-chevron-circle-right":"chevron-circle-right","smartic-icon-chevron-down":"chevron-down","smartic-icon-chevron-left":"chevron-left","smartic-icon-chevron-right":"chevron-right","smartic-icon-chevron-up":"chevron-up","smartic-icon-circle":"circle","smartic-icon-clock":"clock","smartic-icon-cloud-download-alt":"cloud-download-alt","smartic-icon-comment":"comment","smartic-icon-comments":"comments","smartic-icon-contact":"contact","smartic-icon-credit-card":"credit-card","smartic-icon-dot-circle":"dot-circle","smartic-icon-edit":"edit","smartic-icon-envelope":"envelope","smartic-icon-expand-alt":"expand-alt","smartic-icon-external-link-alt":"external-link-alt","smartic-icon-eye":"eye","smartic-icon-file-alt":"file-alt","smartic-icon-file-archive":"file-archive","smartic-icon-filter":"filter","smartic-icon-folder-open":"folder-open","smartic-icon-folder":"folder","smartic-icon-free_ship":"free_ship","smartic-icon-frown":"frown","smartic-icon-gift":"gift","smartic-icon-grid":"grid","smartic-icon-grip-horizontal":"grip-horizontal","smartic-icon-heart-fill":"heart-fill","smartic-icon-heart":"heart","smartic-icon-history":"history","smartic-icon-home":"home","smartic-icon-info-circle":"info-circle","smartic-icon-instagram":"instagram","smartic-icon-level-up-alt":"level-up-alt","smartic-icon-list":"list","smartic-icon-long-arrow-alt-down":"long-arrow-alt-down","smartic-icon-long-arrow-alt-left":"long-arrow-alt-left","smartic-icon-long-arrow-alt-right":"long-arrow-alt-right","smartic-icon-long-arrow-alt-up":"long-arrow-alt-up","smartic-icon-map-marker-check":"map-marker-check","smartic-icon-meh":"meh","smartic-icon-mesh":"mesh","smartic-icon-minus-circle":"minus-circle","smartic-icon-minus":"minus","smartic-icon-mobile-android-alt":"mobile-android-alt","smartic-icon-money-bill":"money-bill","smartic-icon-pencil-alt":"pencil-alt","smartic-icon-play-circle":"play-circle","smartic-icon-plus-circle":"plus-circle","smartic-icon-plus":"plus","smartic-icon-quote":"quote","smartic-icon-random":"random","smartic-icon-reply-all":"reply-all","smartic-icon-reply":"reply","smartic-icon-router":"router","smartic-icon-search-plus":"search-plus","smartic-icon-shield-check":"shield-check","smartic-icon-shopping-basket":"shopping-basket","smartic-icon-shopping-cart":"shopping-cart","smartic-icon-sign-out-alt":"sign-out-alt","smartic-icon-smile":"smile","smartic-icon-spinner":"spinner","smartic-icon-square":"square","smartic-icon-star":"star","smartic-icon-store":"store","smartic-icon-sync":"sync","smartic-icon-tachometer-alt":"tachometer-alt","smartic-icon-th-large":"th-large","smartic-icon-th-list":"th-list","smartic-icon-thumbtack":"thumbtack","smartic-icon-times-circle":"times-circle","smartic-icon-times":"times","smartic-icon-trophy-alt":"trophy-alt","smartic-icon-truck":"truck","smartic-icon-user-headset":"user-headset","smartic-icon-user-shield":"user-shield","smartic-icon-user":"user","smartic-icon-video":"video","smartic-icon-adobe":"adobe","smartic-icon-amazon":"amazon","smartic-icon-android":"android","smartic-icon-angular":"angular","smartic-icon-apper":"apper","smartic-icon-apple":"apple","smartic-icon-atlassian":"atlassian","smartic-icon-behance":"behance","smartic-icon-bitbucket":"bitbucket","smartic-icon-bitcoin":"bitcoin","smartic-icon-bity":"bity","smartic-icon-bluetooth":"bluetooth","smartic-icon-btc":"btc","smartic-icon-centos":"centos","smartic-icon-chrome":"chrome","smartic-icon-codepen":"codepen","smartic-icon-cpanel":"cpanel","smartic-icon-discord":"discord","smartic-icon-dochub":"dochub","smartic-icon-docker":"docker","smartic-icon-dribbble":"dribbble","smartic-icon-dropbox":"dropbox","smartic-icon-drupal":"drupal","smartic-icon-ebay":"ebay","smartic-icon-facebook":"facebook","smartic-icon-figma":"figma","smartic-icon-firefox":"firefox","smartic-icon-google-plus":"google-plus","smartic-icon-google":"google","smartic-icon-grunt":"grunt","smartic-icon-gulp":"gulp","smartic-icon-html5":"html5","smartic-icon-jenkins":"jenkins","smartic-icon-joomla":"joomla","smartic-icon-link-brand":"link-brand","smartic-icon-linkedin":"linkedin","smartic-icon-mailchimp":"mailchimp","smartic-icon-opencart":"opencart","smartic-icon-paypal":"paypal","smartic-icon-pinterest-p":"pinterest-p","smartic-icon-reddit":"reddit","smartic-icon-skype":"skype","smartic-icon-slack":"slack","smartic-icon-snapchat":"snapchat","smartic-icon-spotify":"spotify","smartic-icon-trello":"trello","smartic-icon-twitter":"twitter","smartic-icon-vimeo":"vimeo","smartic-icon-whatsapp":"whatsapp","smartic-icon-wordpress":"wordpress","smartic-icon-yoast":"yoast","smartic-icon-youtube":"youtube"}', true );
			$icons     = $manager->get_control( 'icon' )->get_settings( 'options' );
			$new_icons = array_merge(
				$new_icons,
				$icons
			);
			// Then we set a new list of icons as the options of the icon control
			$manager->get_control( 'icon' )->set_settings( 'options', $new_icons ); 
        }

        public function add_icons_native($tabs) {
            global $smartic_version;
            $tabs['opal-custom'] = [
                'name'          => 'smartic-icon',
                'label'         => esc_html__('Smartic Icon', 'smartic'),
                'prefix'        => 'smartic-icon-',
                'displayPrefix' => 'smartic-icon-',
                'labelIcon'     => 'fab fa-font-awesome-alt',
                'ver'           => $smartic_version,
                'fetchJson'     => get_theme_file_uri('/inc/elementor/icons.json'),
                'native'        => true,
            ];

            return $tabs;
        }
    }

endif;

return new Smartic_Elementor();
