<?php
/**
 * Deeprose & Carter theme setup.
 *
 * @package DeeproseCarter
 */

defined( 'ABSPATH' ) || exit;

define( 'DC_VERSION', '1.0.0' );
define( 'DC_DIR', get_template_directory() );
define( 'DC_URI', get_template_directory_uri() );

require DC_DIR . '/inc/helpers.php';
require DC_DIR . '/inc/content-types.php';
require DC_DIR . '/inc/acf.php';
require DC_DIR . '/inc/demo-setup.php';
require DC_DIR . '/inc/demo-services.php';

/**
 * Theme supports, menus and image sizes.
 */
function dc_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'responsive-embeds' );

	register_nav_menus(
		array(
			'primary-left'    => __( 'Header: left of logo', 'deeprose-carter' ),
			'primary-right'   => __( 'Header: right of logo', 'deeprose-carter' ),
			'mobile'          => __( 'Mobile menu', 'deeprose-carter' ),
			'footer-services' => __( 'Footer: services', 'deeprose-carter' ),
			'footer-company'  => __( 'Footer: company', 'deeprose-carter' ),
			'footer-legal'    => __( 'Footer: legal links', 'deeprose-carter' ),
		)
	);

	add_image_size( 'dc-card', 900, 675, true );
	add_image_size( 'dc-wide', 1600, 1000, true );
}
add_action( 'after_setup_theme', 'dc_setup' );

/**
 * Styles and scripts.
 */
function dc_assets() {
	$kit = dc_setting( 'fonts_kit', 'jtl2yxi' );
	if ( $kit ) {
		wp_enqueue_style( 'dc-fonts', 'https://use.typekit.net/' . rawurlencode( $kit ) . '.css', array(), null );
	}
	wp_enqueue_style( 'dc-main', DC_URI . '/assets/css/main.css', array(), DC_VERSION );
	wp_enqueue_script( 'dc-site', DC_URI . '/assets/js/site.js', array(), DC_VERSION, array( 'strategy' => 'defer', 'in_footer' => true ) );
}
add_action( 'wp_enqueue_scripts', 'dc_assets' );

/**
 * Preconnect to Adobe Fonts.
 */
function dc_resource_hints( $urls, $relation ) {
	if ( 'preconnect' === $relation ) {
		$urls[] = array( 'href' => 'https://use.typekit.net', 'crossorigin' );
		$urls[] = array( 'href' => 'https://p.typekit.net', 'crossorigin' );
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'dc_resource_hints', 10, 2 );

/**
 * Body classes.
 */
function dc_body_class( $classes ) {
	if ( is_singular() && ! dc_has_sections() ) {
		$classes[] = 'no-sections';
	}
	return $classes;
}
add_filter( 'body_class', 'dc_body_class' );

/**
 * Shorter excerpts for cards.
 */
add_filter( 'excerpt_length', fn() => 26 );
add_filter( 'excerpt_more', fn() => '…' );
