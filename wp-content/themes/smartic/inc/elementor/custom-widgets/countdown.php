<?php
//			Countdown
use Elementor\Controls_Manager;

add_action( 'elementor/element/countdown/section_countdown/before_section_end', function ($element, $args ) {

	$element->add_control(
		'show_dot',
		[
			'label'     => esc_html__( 'Show Dots', 'smartic' ),
			'type'      => Controls_Manager::SWITCHER,
			'selectors' => [
				'{{WRAPPER}} .elementor-countdown-item:after' => 'content: "";',
			],
			'separator' => 'before'
		]
	);

},10,2);
