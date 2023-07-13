<?php
use Elementor\Controls_Manager;
add_action( 'elementor/element/image-box/section_style_content/before_section_end', function ( $element, $args ) {
	/** @var \Elementor\Element_Base $element */
	// Remove Schema

	$element->add_responsive_control(
		'padding',
		[
			'label' => esc_html__( 'Padding', 'smartic' ),
			'type' => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors' => [
				'{{WRAPPER}} .elementor-image-box-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
			],
		]
	);

}, 10, 2 );
