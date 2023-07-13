<?php
//			Form
use Elementor\Controls_Manager;

add_action( 'elementor/element/form/section_field_style/before_section_end', function ($element, $args ) {
	$element->add_control(
		'field_border_color_focus',
		[
			'label' => esc_html__( 'Border Color Focus', 'smartic' ),
			'type' => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .elementor-field-group:not(.elementor-field-type-upload) .elementor-field:not(.elementor-select-wrapper):focus' => 'border-color: {{VALUE}};',
				'{{WRAPPER}} .elementor-field-group .elementor-select-wrapper select:focus' => 'border-color: {{VALUE}};',
			],
		]
	);

	$element->add_control(
		'field_text_padding',
		[
			'type' => \Elementor\Controls_Manager::DIMENSIONS,
			'label' => esc_html__( 'Padding', 'smartic' ),
			'selectors' => [
				'{{WRAPPER}} .elementor-field-group:not(.elementor-field-type-upload):not(.elementor-field-type-recaptcha_v3):not(.elementor-field-type-recaptcha) .elementor-field:not(.elementor-select-wrapper)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				'{{WRAPPER}} .elementor-field-group .elementor-select-wrapper select' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
	);

	$element->add_control(
		'field_text_margin',
		[
			'type' => \Elementor\Controls_Manager::DIMENSIONS,
			'label' => esc_html__( 'Margin', 'smartic' ),
			'selectors' => [
				'{{WRAPPER}} .elementor-field-group .elementor-field' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
	);

	$element->add_control(
		'textarea_heading',
		[
			'type' => \Elementor\Controls_Manager::HEADING,
			'label' => esc_html__( 'Textarea', 'smartic' ),
			'separator'	=> 'before'
		]
	);

	$element->add_control(
		'textarea_color',
		[
			'type' => \Elementor\Controls_Manager::COLOR,
			'label' => esc_html__( 'Color', 'smartic' ),
			'selectors' => [
				'{{WRAPPER}} textarea.elementor-field' => 'color: {{VALUE}} !important',
			],
		]
	);

	$element->add_control(
		'textarea_background',
		[
			'type' => \Elementor\Controls_Manager::COLOR,
			'label' => esc_html__( 'Background', 'smartic' ),
			'selectors' => [
				'{{WRAPPER}} textarea.elementor-field' => 'background: {{VALUE}} !important',
			],
		]
	);

	$element->add_control(
		'textarea_border_color',
		[
			'type' => \Elementor\Controls_Manager::COLOR,
			'label' => esc_html__( 'Border Color', 'smartic' ),
			'selectors' => [
				'{{WRAPPER}} textarea.elementor-field ' => 'border-color: {{VALUE}} !important',
			],
		]
	);

	$element->add_control(
		'textarea_border_color_active',
		[
			'type' => \Elementor\Controls_Manager::COLOR,
			'label' => esc_html__( 'Border Color Active', 'smartic' ),
			'selectors' => [
				'{{WRAPPER}} textarea.elementor-field:focus ' => 'border-color: {{VALUE}} !important',
			],
		]
	);

	$element->add_control(
		'textarea_border',
		[
			'label' => esc_html__( 'Border Width', 'smartic' ),
			'type' => \Elementor\Controls_Manager::SLIDER,
			'range' => [
				'px' => [
					'min' => 0,
					'max' => 20,
				],
			],
			'selectors' => [
				'{{WRAPPER}} textarea.elementor-field' => 'border-width: {{SIZE}}{{UNIT}} !important;',
			],
		]
	);

	$element->add_control(
		'textarea_padding',
		[
			'label' => esc_html__( 'Padding', 'smartic' ),
			'type' => \Elementor\Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em' ],
			'selectors' => [
				'{{WRAPPER}} .elementor-field-group-message textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
			],
		]
	);


},10,2);

add_action('elementor/element/form/section_steps_style/after_section_end', function($element, $args){
	$element->update_control(
		'button_background_color',
		[
			'global' => [
				'default'	=> ''
			]
		]
	);
}, 10, 2);

add_action( 'elementor/element/form/section_field_style/before_section_end', function ( $element, $args ) {
	$element->add_control(
		'fields_alignment',
		[
			'type' => \Elementor\Controls_Manager::CHOOSE,
			'label' => esc_html__( 'Alignment', 'smartic' ),
			'options'   => [
				'left'   => [
					'title' => esc_html__('Left', 'smartic'),
					'icon'  => 'fa fa-align-left',
				],
				'center' => [
					'title' => esc_html__('Center', 'smartic'),
					'icon'  => 'fa fa-align-center',
				],
				'right'  => [
					'title' => esc_html__('Right', 'smartic'),
					'icon'  => 'fa fa-align-right',
				],
			],
			'prefix_class'	=> 'fields-align-'
		]
	);
},10,2);
