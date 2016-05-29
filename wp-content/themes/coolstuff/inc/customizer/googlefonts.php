<?php 

function coolstuff_google_fonts_customizer( $wp_customize ){

	$wp_customize -> add_section( 'typography_options', array(
		'title' => esc_html__( 'Typography Options', 'coolstuff' ),
		'description' => esc_html__('Modify Fonts', 'coolstuff' ),
		'priority' => 6
	));
}
add_action( 'customize_register', 'coolstuff_google_fonts_customizer' );