<?php
add_action( 'elementor/element/icon-box/section_style_icon/before_section_end', function ( $element, $args ) {
	/** @var \Elementor\Element_Base $element */
	// Remove Schema
	$element->update_control( 'primary_color', [
		'selectors' => [
			'{{WRAPPER}}.elementor-view-stacked .elementor-icon' => 'background-color: {{VALUE}};',
			'{{WRAPPER}}.elementor-view-framed .elementor-icon, {{WRAPPER}}.elementor-view-default .elementor-icon' => 'fill: {{VALUE}}; color: {{VALUE}}; border-color: {{VALUE}};',
			'{{WRAPPER}}.elementor-icon-box-animation-yes .elementor-icon:before' => 'border-color: {{VALUE}};',
			'{{WRAPPER}}.elementor-icon-box-animation-default-yes .elementor-icon-box-wrapper:hover .elementor-icon:before' => 'background-color: {{VALUE}};',

		],
	] );
	$element->update_control( 'secondary_color', [
		'selectors' => [
			'{{WRAPPER}}.elementor-view-framed .elementor-icon' => 'background-color: {{VALUE}};',
			'{{WRAPPER}}.elementor-view-stacked .elementor-icon' => 'fill: {{VALUE}}; color: {{VALUE}};',
			'{{WRAPPER}}.elementor-icon-box-animation-yes .elementor-icon-box-wrapper:hover .elementor-icon:before' => 'border-color: {{VALUE}};',
		],
	] );
	$element->add_control(
		'icon_animation',
		[
			'condition'  => ['view' => 'stacked'],
			'type' => \Elementor\Controls_Manager::SWITCHER,
			'label' => esc_html__( 'Icon Animation', 'smartic' ),
			'prefix_class' => 'elementor-icon-box-animation-',
		]
	);
	$element->add_control(
    		'icon_animation_framed',
    		[
    			'condition'  => ['view' => 'framed'],
    			'type' => \Elementor\Controls_Manager::SWITCHER,
    			'label' => esc_html__( 'Icon Animation', 'smartic' ),
    			'prefix_class' => 'elementor-icon-box-animation-framed-',
    		]
    	);
	$element->add_control(
		'icon_animation_default',
		[
			'condition'  => ['view' => 'default'],
			'type' => \Elementor\Controls_Manager::SWITCHER,
			'label' => esc_html__( 'Icon Animation', 'smartic' ),
			'prefix_class' => 'elementor-icon-box-animation-default-',
		]
	);
}, 10, 2 );
