<?php
use Elementor\Controls_Manager;
add_action( 'elementor/element/image/section_image/before_section_end', function ( $element, $args ) {

	$element->add_control(
		'style_theme',
		[
			'type' => \Elementor\Controls_Manager::SWITCHER,
			'label' => esc_html__( 'Style Theme', 'smartic' ),
			'prefix_class'	=> 'style-theme-'
		]
	);

}, 10, 2 );
