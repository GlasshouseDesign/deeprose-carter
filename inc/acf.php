<?php
/**
 * ACF Pro: field groups saved in the theme, Site Settings page, and a notice if ACF is missing.
 *
 * @package DeeproseCarter
 */

defined( 'ABSPATH' ) || exit;

/**
 * Field groups are stored as JSON in /acf-json so they travel with the theme.
 */
add_filter( 'acf/settings/save_json', fn() => DC_DIR . '/acf-json' );
add_filter(
	'acf/settings/load_json',
	function ( $paths ) {
		$paths[] = DC_DIR . '/acf-json';
		return $paths;
	}
);

/**
 * Site Settings page.
 */
function dc_options_page() {
	if ( function_exists( 'acf_add_options_page' ) ) {
		acf_add_options_page(
			array(
				'page_title' => __( 'Site Settings', 'deeprose-carter' ),
				'menu_title' => __( 'Site Settings', 'deeprose-carter' ),
				'menu_slug'  => 'dc-site-settings',
				'capability' => 'edit_theme_options',
				'icon_url'   => 'dashicons-admin-settings',
				'position'   => 59,
				'redirect'   => false,
			)
		);
	}
}
add_action( 'acf/init', 'dc_options_page' );

/**
 * Collapse flexible content rows by default and label them with their heading.
 */
add_filter(
	'acf/fields/flexible_content/layout_title/name=page_sections',
	function ( $title, $field, $layout, $i ) {
		$heading = get_sub_field( 'heading' );
		if ( ! $heading ) {
			$heading = get_sub_field( 'pull_quote' );
		}
		return $heading ? esc_html( $title ) . ' <span style="opacity:.6;font-weight:400">· ' . esc_html( wp_trim_words( $heading, 8 ) ) . '</span>' : $title;
	},
	10,
	4
);

/**
 * Admin notice when ACF Pro is not active.
 */
function dc_acf_notice() {
	if ( function_exists( 'acf_add_options_page' ) || ! current_user_can( 'activate_plugins' ) ) {
		return;
	}
	echo '<div class="notice notice-error"><p><strong>Deeprose &amp; Carter theme:</strong> please install and activate <strong>Advanced Custom Fields PRO</strong>. The page sections, Site Settings and project details depend on it.</p></div>';
}
add_action( 'admin_notices', 'dc_acf_notice' );

/**
 * Pages and services are built from sections, so they use the classic edit screen
 * with the sections directly under the title. Blog posts keep the block editor.
 */
function dc_use_block_editor( $use, $post ) {
	if ( in_array( get_post_type( $post ), array( 'page', 'service' ), true ) ) {
		return false;
	}
	return $use;
}
add_filter( 'use_block_editor_for_post', 'dc_use_block_editor', 10, 2 );

/**
 * Tidy the classic editor for sectioned pages: shrink the content box until it is needed.
 */
function dc_admin_styles() {
	$screen = get_current_screen();
	if ( ! $screen || ! in_array( $screen->post_type, array( 'page', 'service' ), true ) ) {
		return;
	}
	echo '<style>#acf-group_dc_page_sections .acf-flexible-content .layout{margin-bottom:12px}#acf-group_dc_page_sections .acf-fc-layout-handle{font-size:14px}#postdivrich #content{min-height:120px}</style>';
}
add_action( 'admin_head', 'dc_admin_styles' );
