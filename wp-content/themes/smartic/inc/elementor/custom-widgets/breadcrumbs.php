<?php
// Breadcrumb
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

add_action( 'elementor/element/breadcrumb/section_product_rating_style/before_section_end', function ($element, $args ) {

	$element->add_group_control(
		Group_Control_Typography::get_type(),
		[
			'name' => 'typography_link',
			'selector' => '{{WRAPPER}} a',
			'label' => esc_html__( 'Link', 'smartic' ),
		]
	);

	$element->add_control(
		'breadcrumb_last_icon',
		[
			'label' => esc_html__( 'Color Icon', 'smartic' ),
			'type' => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} i' => 'color: {{VALUE}};',
			],
		]
	);


}, 10, 2 );
