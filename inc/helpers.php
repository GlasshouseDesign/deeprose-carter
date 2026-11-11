<?php
/**
 * Template helpers.
 *
 * @package DeeproseCarter
 */

defined( 'ABSPATH' ) || exit;

/**
 * Read a Site Settings value, with a fallback when ACF is missing or the field is empty.
 */
function dc_setting( $name, $fallback = '' ) {
	if ( ! function_exists( 'get_field' ) ) {
		return $fallback;
	}
	$value = get_field( $name, 'option' );
	return ( null === $value || '' === $value || false === $value ) ? $fallback : $value;
}

/**
 * Whether the current page is built from page sections.
 */
function dc_has_sections( $post_id = null ) {
	return function_exists( 'have_rows' ) && have_rows( 'page_sections', $post_id ? $post_id : get_the_ID() );
}

/**
 * The four-pane window from the logo, used as a bullet.
 */
function dc_win() {
	return '<span class="win" aria-hidden="true"><i></i><i></i><i></i><i></i></span>';
}

/**
 * Eyebrow label with the window bullet.
 */
function dc_eyebrow( $text, $extra_style = '' ) {
	if ( ! $text ) {
		return;
	}
	printf(
		'<div class="eyebrow"%s>%s%s</div>',
		$extra_style ? ' style="' . esc_attr( $extra_style ) . '"' : '',
		dc_win(), // phpcs:ignore WordPress.Security.EscapeOutput -- static markup.
		esc_html( $text )
	);
}

/**
 * Output an ACF link field as a styled anchor.
 *
 * @param array|null $link  ACF link array.
 * @param string     $class CSS classes.
 * @param string     $style Inline style.
 */
function dc_link( $link, $class = 'btn btn-navy', $style = '' ) {
	if ( empty( $link['url'] ) ) {
		return;
	}
	$target = ! empty( $link['target'] ) ? $link['target'] : '';
	printf(
		'<a class="%1$s" href="%2$s"%3$s%4$s>%5$s</a>',
		esc_attr( $class ),
		esc_url( $link['url'] ),
		$target ? ' target="' . esc_attr( $target ) . '" rel="noopener"' : '',
		$style ? ' style="' . esc_attr( $style ) . '"' : '',
		esc_html( $link['title'] ? $link['title'] : __( 'Find out more', 'deeprose-carter' ) )
	);
}

/**
 * Phone number in tel: format.
 */
function dc_tel( $phone ) {
	return 'tel:' . preg_replace( '/[^0-9+]/', '', (string) $phone );
}

/**
 * The quote email link, with a subject line.
 */
function dc_quote_mailto() {
	$contact = get_page_by_path( 'contact' );
	if ( $contact && 'publish' === $contact->post_status ) {
		return get_permalink( $contact ) . '#enquiry';
	}
	$email = dc_setting( 'quote_email' );
	if ( ! $email ) {
		return home_url( '/contact/' );
	}
	return 'mailto:' . antispambot( $email ) . '?subject=' . rawurlencode( __( 'Quote request from the website', 'deeprose-carter' ) );
}

/**
 * Plain anchor list for a menu location, so the header keeps its simple markup.
 *
 * @param string $location Menu location.
 * @param string $class    Class for each link.
 * @return string HTML.
 */
function dc_menu_links( $location, $class = '' ) {
	$locations = get_nav_menu_locations();
	if ( empty( $locations[ $location ] ) ) {
		return '';
	}
	$items = wp_get_nav_menu_items( $locations[ $location ] );
	if ( ! $items ) {
		return '';
	}
	_wp_menu_item_classes_by_context( $items );
	$out = '';
	foreach ( $items as $item ) {
		if ( (int) $item->menu_item_parent ) {
			continue;
		}
		$current = in_array( 'current-menu-item', (array) $item->classes, true );
		$out    .= sprintf(
			'<a href="%1$s"%2$s%3$s%4$s>%5$s</a>',
			esc_url( $item->url ),
			$class ? ' class="' . esc_attr( $class ) . '"' : '',
			$current ? ' aria-current="page"' : '',
			$item->target ? ' target="' . esc_attr( $item->target ) . '" rel="noopener"' : '',
			esc_html( $item->title )
		);
	}
	return $out;
}

/**
 * Menu as a simple list (footer columns).
 */
function dc_menu_list( $location ) {
	$links = dc_menu_links( $location );
	if ( ! $links ) {
		return;
	}
	echo '<ul><li>' . str_replace( '</a><a', '</a></li><li><a', $links ) . '</li></ul>'; // phpcs:ignore WordPress.Security.EscapeOutput -- built from escaped parts.
}

/**
 * Attachment image with sensible defaults.
 */
function dc_img( $id, $size = 'large', $attr = array() ) {
	if ( ! $id ) {
		return '';
	}
	return wp_get_attachment_image( $id, $size, false, $attr );
}

/**
 * Render the page sections for a post.
 */
function dc_render_sections( $post_id = null ) {
	if ( ! function_exists( 'have_rows' ) ) {
		return false;
	}
	$post_id = $post_id ? $post_id : get_the_ID();
	if ( ! have_rows( 'page_sections', $post_id ) ) {
		return false;
	}
	while ( have_rows( 'page_sections', $post_id ) ) {
		the_row();
		$layout = get_row_layout();
		$file   = DC_DIR . '/template-parts/sections/' . sanitize_file_name( str_replace( '_', '-', $layout ) ) . '.php';
		if ( file_exists( $file ) ) {
			include $file;
		}
	}
	return true;
}

/**
 * Service card used by the services grid and the services archive.
 */
function dc_service_card( $service_id ) {
	$summary = function_exists( 'get_field' ) ? get_field( 'summary', $service_id ) : '';
	$thumb   = get_post_thumbnail_id( $service_id );
	?>
	<a class="tile" href="<?php echo esc_url( get_permalink( $service_id ) ); ?>">
		<?php if ( $thumb ) : ?>
			<div class="ph"><?php echo dc_img( $thumb, 'dc-card', array( 'loading' => 'lazy' ) ); // phpcs:ignore ?></div>
		<?php else : ?>
			<div class="ph empty"><img src="<?php echo esc_url( DC_URI . '/assets/img/mark-navy.svg' ); ?>" alt=""><span><?php esc_html_e( 'Photo to come', 'deeprose-carter' ); ?></span></div>
		<?php endif; ?>
		<h3><?php echo esc_html( get_the_title( $service_id ) ); ?></h3>
		<?php if ( $summary ) : ?><p><?php echo esc_html( $summary ); ?></p><?php endif; ?>
		<span class="link"><?php esc_html_e( 'Learn more', 'deeprose-carter' ); ?></span>
	</a>
	<?php
}

/**
 * Project card.
 */
function dc_project_card( $project_id, $size = 'small' ) {
	$terms    = get_the_terms( $project_id, 'project_type' );
	$location = function_exists( 'get_field' ) ? get_field( 'location', $project_id ) : '';
	$title    = get_the_title( $project_id ) . ( $location ? ', ' . $location : '' );
	?>
	<a class="proj <?php echo esc_attr( $size ); ?>" href="<?php echo esc_url( get_permalink( $project_id ) ); ?>">
		<?php echo dc_img( get_post_thumbnail_id( $project_id ), 'big' === $size ? 'dc-wide' : 'dc-card', array( 'loading' => 'lazy' ) ); // phpcs:ignore ?>
		<div class="meta">
			<?php if ( $terms && ! is_wp_error( $terms ) ) : ?>
				<div class="tags"><?php foreach ( $terms as $t ) : ?><span><?php echo esc_html( $t->name ); ?></span><?php endforeach; ?></div>
			<?php endif; ?>
			<h3><?php echo esc_html( $title ); ?></h3>
		</div>
	</a>
	<?php
}

/**
 * Is this an area page (Builders in Corsham and so on) that should stay out of search engines?
 * Area pages are tagged with the _dc_area meta and hidden until Site Settings → Search says otherwise.
 *
 * @param int $post_id Post ID.
 */
function dc_area_hidden( $post_id ) {
	return get_post_meta( $post_id, '_dc_area', true ) && ! dc_setting( 'areas_live' );
}

/**
 * Keep hidden area pages out of search results.
 */
function dc_area_robots( $robots ) {
	if ( is_page() && dc_area_hidden( get_queried_object_id() ) ) {
		$robots['noindex']  = true;
		$robots['nofollow'] = true;
	}
	return $robots;
}
add_filter( 'wp_robots', 'dc_area_robots' );

/**
 * Keep hidden area pages out of the sitemap.
 */
function dc_area_sitemap( $args, $post_type ) {
	if ( 'page' === $post_type && ! dc_setting( 'areas_live' ) ) {
		$args['meta_query'] = array( array( 'key' => '_dc_area', 'compare' => 'NOT EXISTS' ) ); // phpcs:ignore WordPress.DB.SlowDBQuery
	}
	return $args;
}
add_filter( 'wp_sitemaps_posts_query_args', 'dc_area_sitemap', 10, 2 );

/**
 * Services linked to a project, matched from its project types.
 *
 * @param int $post_id Project ID.
 * @return WP_Post[]
 */
function dc_project_services( $post_id ) {
	$map   = array(
		'extension'   => 'extensions',
		'kitchen'     => 'kitchens',
		'conversion'  => 'conversions',
		'renovation'  => 'renovations',
		'structural'  => 'structural',
		'landscaping' => 'groundworks',
		'groundworks' => 'groundworks',
		'new-build'   => 'new-builds',
	);
	$slugs = array();
	foreach ( (array) get_the_terms( $post_id, 'project_type' ) as $term ) {
		if ( $term && isset( $map[ $term->slug ] ) ) {
			$slugs[] = $map[ $term->slug ];
		}
	}
	if ( ! $slugs ) {
		return array();
	}
	return get_posts( array( 'post_type' => 'service', 'post_name__in' => array_unique( $slugs ), 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 10 ) );
}
