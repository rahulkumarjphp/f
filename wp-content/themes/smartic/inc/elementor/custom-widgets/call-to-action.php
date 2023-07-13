<?php
//			Call to action
add_action( 'elementor/element/call-to-action/button_style/before_section_end', function ( $element, $args ) {

	$element->add_control(
		'button_padding',
		[
			'type' => \Elementor\Controls_Manager::DIMENSIONS,
			'label' => esc_html__( 'Padding', 'smartic' ),
			'selectors' => [
				'{{WRAPPER}} .elementor-cta__button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
	);

	$element->add_control(
		'button_effect',
		[
			'type' => \Elementor\Controls_Manager::SWITCHER,
			'label' => esc_html__( 'Effect Hover', 'smartic' ),
			'description'	=> esc_html__('Applies when adding icons to buttons in field button text.
												Example : <span>Button text<i class="smartic-icon-arrow"></i> </span> ','smartic'),
			'prefix_class'	=> 'button-effect-'
		]
	);
},10,2);
