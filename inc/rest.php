<?php
/**
 * Admin-only REST routes, so the site can be managed through the API with an Application Password.
 *
 * GET  /wp-json/dc/v1/sections/<id>  Page sections of a page, service or project.
 * POST /wp-json/dc/v1/sections/<id>  Replace them: { "sections": [ ...rows... ] }.
 * GET  /wp-json/dc/v1/settings       Site Settings.
 * POST /wp-json/dc/v1/settings       Update some of them: { "phone": "...", ... }.
 * POST /wp-json/dc/v1/setup          Run the D&C setup (overwrites demo content).
 * GET  /wp-json/dc/v1/version        Theme version, to check a deployment.
 *
 * @package DeeproseCarter
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the routes.
 */
function dc_rest_routes() {
	$admin = fn() => current_user_can( 'manage_options' );

	register_rest_route(
		'dc/v1',
		'/sections/(?P<id>\d+)',
		array(
			array(
				'methods'             => 'GET',
				'permission_callback' => $admin,
				'callback'            => fn( $r ) => array( 'id' => (int) $r['id'], 'sections' => get_field( 'page_sections', (int) $r['id'], false ) ),
			),
			array(
				'methods'             => 'POST',
				'permission_callback' => $admin,
				'callback'            => function ( $r ) {
					$id = (int) $r['id'];
					if ( ! get_post( $id ) ) {
						return new WP_Error( 'dc_not_found', 'No post with that ID.', array( 'status' => 404 ) );
					}
					update_field( 'field_dc_sections', (array) $r->get_param( 'sections' ), $id );
					return array( 'id' => $id, 'sections' => get_field( 'page_sections', $id, false ) );
				},
			),
		)
	);

	register_rest_route(
		'dc/v1',
		'/settings',
		array(
			array(
				'methods'             => 'GET',
				'permission_callback' => $admin,
				'callback'            => fn() => get_fields( 'option' ),
			),
			array(
				'methods'             => 'POST',
				'permission_callback' => $admin,
				'callback'            => function ( $r ) {
					foreach ( (array) $r->get_json_params() as $name => $value ) {
						update_field( sanitize_key( $name ), $value, 'option' );
					}
					return get_fields( 'option' );
				},
			),
		)
	);

	register_rest_route(
		'dc/v1',
		'/setup',
		array(
			'methods'             => 'POST',
			'permission_callback' => $admin,
			'callback'            => fn() => array( 'log' => dc_demo_run() ),
		)
	);

	register_rest_route(
		'dc/v1',
		'/version',
		array(
			'methods'             => 'GET',
			'permission_callback' => $admin,
			'callback'            => fn() => array( 'version' => DC_VERSION, 'gravity_forms' => class_exists( 'GFAPI' ) ),
		)
	);
}
add_action( 'rest_api_init', 'dc_rest_routes' );
