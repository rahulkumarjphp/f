<?php
//          Divider
use Elementor\Controls_Manager;

add_action( 'elementor/element/divider/section_divider_style/before_section_end', function ($element, $args ) {
	$element->add_control(
		'divider_border_radius',
		[
			'label' => esc_html__( 'Border Radius', 'smartic' ),
			'type' => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors' => [
				'{{WRAPPER}} .elementor-divider .elementor-divider-separator' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
	);
},10,2);
