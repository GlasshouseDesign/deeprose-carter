<?php
/**
 * Site header.
 *
 * @package DeeproseCarter
 */

$dc_button = dc_setting( 'header_button' );
if ( empty( $dc_button['url'] ) ) {
	$dc_button = array( 'url' => dc_quote_mailto(), 'title' => __( 'Request a quote', 'deeprose-carter' ), 'target' => '' );
}
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width,initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> id="top">
<?php wp_body_open(); ?>
<a class="skip" href="#main"><?php esc_html_e( 'Skip to content', 'deeprose-carter' ); ?></a>

<header class="top">
	<nav class="nav" aria-label="<?php esc_attr_e( 'Main', 'deeprose-carter' ); ?>"><?php echo dc_menu_links( 'primary-left' ); // phpcs:ignore ?></nav>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo"><img src="<?php echo esc_url( DC_URI . '/assets/img/logo-navy.svg' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>, <?php esc_attr_e( 'home', 'deeprose-carter' ); ?>"></a>
	<nav class="nav r" aria-label="<?php esc_attr_e( 'Secondary', 'deeprose-carter' ); ?>">
		<?php echo dc_menu_links( 'primary-right' ); // phpcs:ignore ?>
		<?php dc_link( $dc_button, 'btn btn-navy' ); ?>
		<button class="menu-toggle" type="button" aria-expanded="false" aria-controls="mnav"><span class="bars" aria-hidden="true"><i></i><i></i><i></i></span><span class="sr"><?php esc_html_e( 'Menu', 'deeprose-carter' ); ?></span></button>
	</nav>
</header>

<main id="main">
