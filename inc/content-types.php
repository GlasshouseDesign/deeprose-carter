<?php
/**
 * Services and Projects.
 *
 * @package DeeproseCarter
 */

defined( 'ABSPATH' ) || exit;

function dc_register_content_types() {
	register_post_type(
		'service',
		array(
			'labels'        => array(
				'name'          => __( 'Services', 'deeprose-carter' ),
				'singular_name' => __( 'Service', 'deeprose-carter' ),
				'add_new_item'  => __( 'Add new service', 'deeprose-carter' ),
				'edit_item'     => __( 'Edit service', 'deeprose-carter' ),
				'all_items'     => __( 'All services', 'deeprose-carter' ),
			),
			'public'        => true,
			'has_archive'   => 'services',
			'rewrite'       => array( 'slug' => 'services', 'with_front' => false ),
			'menu_icon'     => 'dashicons-hammer',
			'menu_position' => 21,
			'supports'      => array( 'title', 'editor', 'thumbnail', 'page-attributes', 'revisions' ),
			'show_in_rest'  => true,
		)
	);

	register_post_type(
		'project',
		array(
			'labels'        => array(
				'name'          => __( 'Projects', 'deeprose-carter' ),
				'singular_name' => __( 'Project', 'deeprose-carter' ),
				'add_new_item'  => __( 'Add new project', 'deeprose-carter' ),
				'edit_item'     => __( 'Edit project', 'deeprose-carter' ),
				'all_items'     => __( 'All projects', 'deeprose-carter' ),
			),
			'public'        => true,
			'has_archive'   => 'projects',
			'rewrite'       => array( 'slug' => 'projects', 'with_front' => false ),
			'menu_icon'     => 'dashicons-building',
			'menu_position' => 22,
			'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions' ),
			'show_in_rest'  => true,
		)
	);

	register_taxonomy(
		'project_type',
		'project',
		array(
			'labels'            => array(
				'name'          => __( 'Project types', 'deeprose-carter' ),
				'singular_name' => __( 'Project type', 'deeprose-carter' ),
			),
			'hierarchical'      => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'rewrite'           => array( 'slug' => 'project-type' ),
		)
	);
}
add_action( 'init', 'dc_register_content_types' );

/**
 * Services and projects keep the order set in the admin.
 */
function dc_archive_order( $query ) {
	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}
	if ( $query->is_post_type_archive( 'service' ) ) {
		$query->set( 'orderby', array( 'menu_order' => 'ASC', 'title' => 'ASC' ) );
		$query->set( 'posts_per_page', -1 );
	}
	if ( $query->is_post_type_archive( 'project' ) || $query->is_tax( 'project_type' ) ) {
		$query->set( 'posts_per_page', 12 );
	}
}
add_action( 'pre_get_posts', 'dc_archive_order' );
