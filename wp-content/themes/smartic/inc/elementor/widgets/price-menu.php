<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor price menu widget.
 *
 * Elementor widget that displays price menu.
 *
 * @since 1.0.0
 */
class OSF_Widget_Price_Menu extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve price menu widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'smartic-price-menu';
    }

    public function get_title() {
        return esc_html__( 'Smartic Price Menu', 'smartic' );
    }

    public function get_categories() {
        return array('smartic-addons');
    }

    public function get_icon() {
        return 'eicon-nav-menu';
    }

    /**
     * Get widget keywords.
     *
     * Retrieve the list of keywords the widget belongs to.
     *
     * @since 2.1.0
     * @access public
     *
     * @return array Widget keywords.
     */
    public function get_keywords() {
        return [ 'price menu', 'price', 'menu' ];
    }

    /**
     * Register price menu widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls() {
        $this->start_controls_section(
            'section_price_menu',
            [
                'label' => esc_html__( 'Price Menu', 'smartic' ),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'menu',
            [
                'label' => esc_html__( 'Menu', 'smartic' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => esc_html__( 'Sunday', 'smartic' ),
                'default' => esc_html__( 'Sunday', 'smartic' ),
            ]
        );

        $repeater->add_control(
            'info',
            [
                'label' => esc_html__( 'Info', 'smartic' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => esc_html__( '10.00 to 21.00', 'smartic' ),
                'default' => esc_html__( '10.00 to 21.00', 'smartic' ),
            ]
        );


        $this->add_control(
            'menu_list',
            [
                'label' => '',
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'menu' => esc_html__( 'Monday - Friday', 'smartic' ),
                        'info' => esc_html__( '8.00 to 18.00', 'smartic' ),
                    ],
                    [
                        'menu' => esc_html__( 'Saturday', 'smartic' ),
                        'info' => esc_html__( '9.00 to 21.00', 'smartic' ),
                    ],
                    [
                        'menu' => esc_html__( 'Sunday', 'smartic' ),
                        'info' => esc_html__( '10.00 to 21.00', 'smartic' ),
                    ],
                ],
                'title_field' => '{{{ menu }}}',
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_style_wrapper',
            [
                'label' => esc_html__( 'Wrapper', 'smartic' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'wrapper_spacing',
            [
                'label' => esc_html__( 'Spacing', 'smartic' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-menu-list-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_menu',
            [
                'label' => esc_html__( 'Menu', 'smartic' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'width_menu',
            [
                'label' => esc_html__( 'Width', 'smartic' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-menu-list' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'menu_color',
            [
                'label'     => esc_html__('Text Color', 'smartic'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} span.elementor-price-menu-list' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'menu_typography',
                'selector' => '{{WRAPPER}} .elementor-price-menu-list',
            ]
        );

        $this->add_responsive_control(
            'menu_margin',
            [
                'label' => esc_html__( 'Margin', 'smartic' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-menu-list' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'menu_padding',
            [
                'label' => esc_html__( 'Padding', 'smartic' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-menu-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_info',
            [
                'label' => esc_html__( 'Info', 'smartic' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'info_color',
            [
                'label'     => esc_html__('Text Color', 'smartic'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .info' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'info_typography',
                'selector' => '{{WRAPPER}} .info',
            ]
        );

        $this->add_responsive_control(
            'info_margin',
            [
                'label' => esc_html__( 'Margin', 'smartic' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .info' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'info_padding',
            [
                'label' => esc_html__( 'Padding', 'smartic' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render price menu widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $this->add_render_attribute( 'price_menu', 'class', 'elementor-price-menu' );
        ?>

        <ul <?php $this->print_render_attribute_string( 'price_menu' ); ?>>
            <?php
            foreach ( $settings['menu_list'] as $index => $item ) :
                $repeater_setting_key = $this->get_repeater_setting_key( 'menu', 'menu_list', $index );

                $this->add_render_attribute( $repeater_setting_key, 'class', 'elementor-price-menu-list' );

                $this->add_inline_editing_attributes( $repeater_setting_key );
                ?>
                <li class="elementor-price-menu-list-item" >
                    <span <?php $this->print_render_attribute_string( $repeater_setting_key ); ?>><?php echo esc_html($item['menu']); ?></span>
                    <span class="info"><?php echo esc_html($item['info']); ?></span>
                </li>
            <?php
            endforeach;
            ?>
        </ul>

        <?php
    }
}
$widgets_manager->register(new OSF_Widget_Price_Menu());
