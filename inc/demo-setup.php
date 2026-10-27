<?php
/**
 * One-click setup: imports the approved homepage content, services, projects, pages, menus and settings.
 * Appearance → D&C setup. Safe to run more than once: it updates what it created before.
 *
 * @package DeeproseCarter
 */

defined( 'ABSPATH' ) || exit;

/**
 * Admin page.
 */
function dc_demo_menu() {
	add_theme_page( __( 'D&C setup', 'deeprose-carter' ), __( 'D&C setup', 'deeprose-carter' ), 'manage_options', 'dc-setup', 'dc_demo_page' );
}
add_action( 'admin_menu', 'dc_demo_menu' );

/**
 * Point people to the setup page after the theme is activated.
 */
function dc_demo_after_switch() {
	set_transient( 'dc_setup_notice', 1, DAY_IN_SECONDS );
}
add_action( 'after_switch_theme', 'dc_demo_after_switch' );

function dc_demo_notice() {
	if ( ! get_transient( 'dc_setup_notice' ) || get_option( 'dc_demo_done' ) || ! current_user_can( 'manage_options' ) ) {
		return;
	}
	printf(
		'<div class="notice notice-info"><p><strong>Deeprose &amp; Carter:</strong> %s <a href="%s">%s</a></p></div>',
		esc_html__( 'set up the homepage, services, projects and menus in one click.', 'deeprose-carter' ),
		esc_url( admin_url( 'themes.php?page=dc-setup' ) ),
		esc_html__( 'Go to D&C setup', 'deeprose-carter' )
	);
}
add_action( 'admin_notices', 'dc_demo_notice' );

function dc_demo_page() {
	$ran = false;
	$log = array();
	if ( isset( $_POST['dc_run_setup'] ) && check_admin_referer( 'dc_run_setup' ) ) {
		$log = dc_demo_run();
		$ran = true;
	}
	$acf = function_exists( 'acf_add_options_page' ) && function_exists( 'update_field' );
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Deeprose & Carter setup', 'deeprose-carter' ); ?></h1>
		<?php if ( ! $acf ) : ?>
			<div class="notice notice-error inline"><p><?php esc_html_e( 'Install and activate Advanced Custom Fields PRO first, then come back to this page.', 'deeprose-carter' ); ?></p></div>
		<?php else : ?>
			<p style="max-width:720px"><?php esc_html_e( 'This imports the photos and films into the Media Library, creates the Home, About, Contact and Blog pages, the seven services, three projects and a sample blog post, fills in Site Settings, sets up the menus and makes Home the front page.', 'deeprose-carter' ); ?></p>
			<p style="max-width:720px"><?php esc_html_e( 'It is safe to run again: it updates the items it created before rather than duplicating them. Anything you have edited in those items will be overwritten.', 'deeprose-carter' ); ?></p>
			<form method="post">
				<?php wp_nonce_field( 'dc_run_setup' ); ?>
				<p><button class="button button-primary button-hero" name="dc_run_setup" value="1"><?php echo get_option( 'dc_demo_done' ) ? esc_html__( 'Run setup again', 'deeprose-carter' ) : esc_html__( 'Set up demo content', 'deeprose-carter' ); ?></button></p>
			</form>
		<?php endif; ?>
		<?php if ( $ran ) : ?>
			<div class="notice notice-success inline"><p><strong><?php esc_html_e( 'Done.', 'deeprose-carter' ); ?></strong> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" target="_blank"><?php esc_html_e( 'View the site', 'deeprose-carter' ); ?></a></p></div>
			<ul style="list-style:disc;padding-left:20px"><?php foreach ( $log as $line ) : ?><li><?php echo esc_html( $line ); ?></li><?php endforeach; ?></ul>
		<?php endif; ?>
	</div>
	<?php
}

/**
 * Import one file from the theme's demo folder into the Media Library (once).
 */
function dc_demo_media( $rel, $alt = '' ) {
	$existing = get_posts( array( 'post_type' => 'attachment', 'post_status' => 'inherit', 'numberposts' => 1, 'meta_key' => '_dc_demo_file', 'meta_value' => $rel, 'fields' => 'ids' ) );
	if ( $existing ) {
		return (int) $existing[0];
	}
	$src = DC_DIR . '/demo/' . $rel;
	if ( ! file_exists( $src ) ) {
		return 0;
	}
	require_once ABSPATH . 'wp-admin/includes/file.php';
	require_once ABSPATH . 'wp-admin/includes/media.php';
	require_once ABSPATH . 'wp-admin/includes/image.php';
	$tmp = wp_tempnam( basename( $src ) );
	copy( $src, $tmp );
	$id = media_handle_sideload( array( 'name' => basename( $src ), 'tmp_name' => $tmp ), 0 );
	if ( is_wp_error( $id ) ) {
		@unlink( $tmp ); // phpcs:ignore
		return 0;
	}
	update_post_meta( $id, '_dc_demo_file', $rel );
	if ( $alt ) {
		update_post_meta( $id, '_wp_attachment_image_alt', $alt );
	}
	return (int) $id;
}

/**
 * Create or update a post identified by a demo key.
 */
function dc_demo_post( $key, $args ) {
	$found = get_posts( array( 'post_type' => $args['post_type'], 'post_status' => 'any', 'numberposts' => 1, 'meta_key' => '_dc_demo_key', 'meta_value' => $key, 'fields' => 'ids' ) );
	$args  = wp_parse_args( $args, array( 'post_status' => 'publish' ) );
	if ( $found ) {
		$args['ID'] = $found[0];
		$id         = wp_update_post( $args );
	} else {
		$id = wp_insert_post( $args );
		update_post_meta( $id, '_dc_demo_key', $key );
	}
	return (int) $id;
}

function dc_demo_link( $url, $title, $target = '' ) {
	return array( 'url' => $url, 'title' => $title, 'target' => $target );
}

/**
 * Build or rebuild a menu and assign it to a location.
 */
function dc_demo_menu_build( $name, $location, $items ) {
	$menu = wp_get_nav_menu_object( $name );
	$id   = $menu ? $menu->term_id : wp_create_nav_menu( $name );
	foreach ( (array) wp_get_nav_menu_items( $id ) as $old ) {
		wp_delete_post( $old->ID, true );
	}
	foreach ( $items as $pos => $item ) {
		$data = array( 'menu-item-title' => $item['title'], 'menu-item-status' => 'publish', 'menu-item-position' => $pos + 1 );
		if ( isset( $item['object_id'] ) ) {
			$data['menu-item-type']      = 'post_type';
			$data['menu-item-object']    = get_post_type( $item['object_id'] );
			$data['menu-item-object-id'] = $item['object_id'];
		} elseif ( isset( $item['archive'] ) ) {
			$data['menu-item-type']   = 'post_type_archive';
			$data['menu-item-object'] = $item['archive'];
		} else {
			$data['menu-item-type'] = 'custom';
			$data['menu-item-url']  = $item['url'];
		}
		wp_update_nav_menu_item( $id, 0, $data );
	}
	$locations              = get_theme_mod( 'nav_menu_locations', array() );
	$locations[ $location ] = $id;
	set_theme_mod( 'nav_menu_locations', $locations );
}

/**
 * Run the full setup.
 */
function dc_demo_run() {
	$log = array();
	if ( ! function_exists( 'update_field' ) ) {
		return array( 'ACF PRO is not active.' );
	}
	wp_raise_memory_limit( 'admin' );
	if ( function_exists( 'set_time_limit' ) ) {
		set_time_limit( 300 ); // phpcs:ignore
	}

	// Media.
	$m = array();
	$photos = array(
		'extension-arches'     => 'Stone extension with arched steel windows at Mile Elm',
		'extension-bifold'     => 'Stone extension with bifold doors',
		'extension-glazed'     => 'Stone extension with glazed doors at Mile Elm',
		'kitchen-marble'       => 'Kitchen with a marble-topped island',
		'kitchen-open-plan'    => 'Open-plan kitchen with a dark island',
		'kitchen-island'       => 'Painted kitchen island',
		'stone-house'          => 'Period stone house',
		'biddestone-house'     => 'New stone house in Biddestone',
		'garden-steps'         => 'Garden steps and rendered retaining walls',
		'garden-terrace'       => 'Garden terrace with oak pergola',
		'hallway-stairs'       => 'Hallway with oak staircase and stone floor',
		'utility-room'         => 'Utility room with arched steel door',
		'arched-shower'        => 'Arched tiled shower',
		'rendered-extension'   => 'Rendered extension with stone quoins',
		'stone-wall-extension' => 'Stone extension wall with roof lights',
		'team-plans'           => 'Josh and Callum reviewing plans on site',
		'hero-poster'          => 'Stone extension at Mile Elm',
		'brand-film-poster'    => 'Brand film',
	);
	foreach ( $photos as $file => $alt ) {
		$m[ $file ] = dc_demo_media( 'img/' . $file . '.jpg', $alt );
	}
	$m['loop-webm']  = dc_demo_media( 'video/dc-hero-loop.webm' );
	$m['loop-mp4']   = dc_demo_media( 'video/dc-hero-loop.mp4' );
	$m['brand-film'] = dc_demo_media( 'video/dc-brand-film.mp4' );
	$log[]           = sprintf( '%d media files in the Media Library.', count( array_filter( $m ) ) );

	// Services.
	$services_data = array(
		array( 'extensions', 'Extensions', 'Single storey, two storey and wrap-around extensions.', 'extension-bifold', 'Single storey, full height and wrap-around extensions, project-managed from start to finish.' ),
		array( 'kitchens', 'Kitchens', 'Refurbishments, kitchen extensions and open-plan knock-throughs.', 'kitchen-marble', 'Kitchen refurbishments, kitchen extensions and open-plan knock-throughs.' ),
		array( 'conversions', 'Loft & Garage Conversions', 'Turn unused space into bedrooms, offices and living space.', '', 'Garage and loft conversions that turn unused space into bedrooms, offices and living space.' ),
		array( 'renovations', 'Renovations', 'Full house, period and listed property renovations.', 'stone-house', 'Period properties, listed buildings, fire damage, open-plan living and full house renovations.' ),
		array( 'structural', 'Structural Alterations', 'Wall removals, new openings, layout changes and insurance work.', 'kitchen-open-plan', 'Wall openings, open-plan living, new openings, complete layout changes, structural alterations and insurance work.' ),
		array( 'groundworks', 'Groundworks & Landscaping', 'Site clearance, drainage, foundations, driveways and patios.', 'garden-steps', 'Site clearance and excavation, drainage, retaining walls, driveways, patios and paths, and foundations for extensions and conversions.' ),
		array( 'new-builds', 'New Builds', 'Residential new builds, from groundworks to handover.', 'biddestone-house', 'Commercial and residential new builds, from groundworks to handover.' ),
	);
	$services = array();
	foreach ( $services_data as $i => $s ) {
		$id = dc_demo_post( 'service-' . $s[0], array( 'post_type' => 'service', 'post_title' => $s[1], 'post_name' => $s[0], 'menu_order' => $i, 'post_content' => '<!-- wp:paragraph --><p>' . esc_html( $s[4] ) . '</p><!-- /wp:paragraph -->' ) );
		update_field( 'field_dc_srv_summary', $s[2], $id );
		if ( $s[3] && $m[ $s[3] ] ) {
			set_post_thumbnail( $id, $m[ $s[3] ] );
		} else {
			delete_post_thumbnail( $id );
		}
		$services[ $s[0] ] = $id;
	}
	$log[] = 'Seven services created.';

	// Projects.
	$projects_data = array(
		array( 'mile-elm', 'Stone extension & garden', 'Mile Elm', array( 'Extension', 'Kitchen', 'Landscaping' ), 'extension-arches', 'A single-storey stone extension with arched steel windows, a new kitchen and a landscaped garden.', array( 'extension-glazed', 'kitchen-marble', 'hallway-stairs', 'utility-room', 'arched-shower', 'garden-terrace' ) ),
		array( 'sutton-benger', 'Open-plan kitchen', 'Sutton Benger', array( 'Kitchen', 'Structural' ), 'kitchen-open-plan', 'Walls opened up to create a bright open-plan kitchen and dining space with bifold doors to the garden.', array() ),
		array( 'biddestone', 'New stone home', 'Biddestone', array( 'New build' ), 'biddestone-house', 'A new stone house built from the groundworks up.', array() ),
	);
	$projects = array();
	foreach ( $projects_data as $p ) {
		$id = dc_demo_post( 'project-' . $p[0], array( 'post_type' => 'project', 'post_title' => $p[1], 'post_name' => $p[0], 'post_content' => '<!-- wp:paragraph --><p>' . esc_html( $p[5] ) . ' Full project write-up to come.</p><!-- /wp:paragraph -->' ) );
		wp_set_object_terms( $id, $p[3], 'project_type' );
		set_post_thumbnail( $id, $m[ $p[4] ] );
		update_field( 'field_dc_prj_location', $p[2], $id );
		update_field( 'field_dc_prj_summary', $p[5], $id );
		update_field( 'field_dc_prj_gallery_note', array_map( fn( $k ) => array( 'image' => $m[ $k ] ), $p[6] ), $id );
		$projects[] = $id;
	}
	$log[] = 'Three projects created.';

	// Pages.
	$contact = dc_demo_post( 'page-contact', array( 'post_type' => 'page', 'post_title' => 'Contact', 'post_name' => 'contact' ) );
	$about   = dc_demo_post( 'page-about', array( 'post_type' => 'page', 'post_title' => 'About', 'post_name' => 'about' ) );
	$blog    = dc_demo_post( 'page-blog', array( 'post_type' => 'page', 'post_title' => 'News & advice', 'post_name' => 'blog' ) );
	$home    = dc_demo_post( 'page-home', array( 'post_type' => 'page', 'post_title' => 'Home', 'post_name' => 'home' ) );

	$contact_url = get_permalink( $contact );
	$quote_btn   = dc_demo_link( $contact_url, 'Request a quote' );
	$cta_row     = array(
		'acf_fc_layout' => 'cta',
		'eyebrow'       => 'Get started',
		'heading'       => 'Ready to talk about your project?',
		'text'          => "Book a free, no-obligation site visit. We'll listen to your ideas and give you honest advice.",
		'button'        => '',
		'show_phone'    => 1,
		'show_whatsapp' => 1,
	);
	$team_row = array(
		'acf_fc_layout' => 'team',
		'image'         => $m['team-plans'],
		'eyebrow'       => 'Meet the team',
		'heading'       => 'Josh & Callum run every build',
		'text'          => '<p>Deeprose &amp; Carter Developments is owned and run by Josh and Callum, who personally oversee and project-manage each build from start to finish.</p><p>They\'re supported by a carefully selected team of skilled, trusted tradespeople, chosen for the quality of their work, their reliability and the way they conduct themselves in your home.</p>',
		'button'        => dc_demo_link( get_permalink( $about ), 'About us' ),
	);

	$home_sections = array(
		array(
			'acf_fc_layout'    => 'hero_film',
			'video_webm'       => $m['loop-webm'],
			'video_mp4'        => $m['loop-mp4'],
			'poster'           => $m['hero-poster'],
			'film_label'       => 'Recent work · North Wiltshire',
			'eyebrow'          => 'Chippenham & North Wiltshire',
			'heading'          => 'Quality you can build on',
			'text'             => 'A well-run build makes all the difference. Every project is overseen by the owners, Josh and Callum, from first visit to final handover.',
			'button_primary'   => $quote_btn,
			'button_secondary' => dc_demo_link( get_post_type_archive_link( 'project' ), 'View our projects' ),
			'brand_film'       => $m['brand-film'],
			'brand_film_label' => 'Watch our story',
			'rail_text'        => 'Built around you',
		),
		array(
			'acf_fc_layout' => 'intro',
			'eyebrow'       => 'Built around you',
			'heading'       => 'A well-run build makes all the difference',
			'text'          => 'From extensions to full house renovations, we bring together skilled workmanship, careful coordination and practical thinking to keep your project moving smoothly.',
			'strong_text'   => "You bring us the idea. We'll take care of what it takes to make it happen.",
			'link'          => dc_demo_link( get_permalink( $about ), 'Our philosophy' ),
			'stats'         => array(
				array( 'value' => 'XX+', 'label' => "Years' combined experience" ),
				array( 'value' => 'XXX+', 'label' => 'Projects completed' ),
				array( 'value' => '£XM', 'label' => 'Public liability cover' ),
				array( 'value' => '2', 'label' => 'Owners on every build' ),
			),
		),
		array(
			'acf_fc_layout' => 'ticker',
			'items'         => array_map( fn( $t ) => array( 'text' => $t ), array( 'Extensions', 'Kitchens', 'Loft & garage conversions', 'Renovations', 'Structural work', 'Groundworks & landscaping', 'New builds' ) ),
		),
		array(
			'acf_fc_layout' => 'services_grid',
			'eyebrow'       => 'What we do',
			'heading'       => 'Our services',
			'intro'         => 'Every project is managed by Josh or Callum, with a trusted team of specialist trades for each stage.',
			'services'      => array_values( $services ),
			'cta_heading'   => 'Not sure what you need?',
			'cta_text'      => "Tell us about your project and we'll point you in the right direction.",
			'cta_button'    => dc_demo_link( $contact_url, 'Talk to us' ),
		),
		array(
			'acf_fc_layout' => 'featured_projects',
			'eyebrow'       => 'Recent work',
			'heading'       => 'Featured projects',
			'link'          => dc_demo_link( get_post_type_archive_link( 'project' ), 'View all projects' ),
			'projects'      => $projects,
		),
		array(
			'acf_fc_layout' => 'testimonial',
			'eyebrow'       => 'Client story',
			'pull_quote'    => 'Exceptional workmanship, thoughtful advice and a team that genuinely cares about getting things right.',
			'body'          => "<p>Josh, Calum and the team transformed four rooms in our very old house into one large kitchen-diner, dealing with different floor levels, structural challenges and the removal of a staircase along the way.</p>\n<p>They were knowledgeable, professional and incredibly thorough, taking the time to understand the existing building and even identifying an important change needed to the structural plans once the roof was exposed.</p>\n<p>The quality of the craftsmanship was outstanding, from rebuilding stone pillars and lime plastering to incorporating the original chimneys beautifully into the finished design.</p>\n<p>They were reliable, consultative and always willing to go the extra mile to keep the project on track. We couldn't be happier with the result and are already looking forward to working with them again. Highly recommended.</p>",
			'name'          => 'Joe Davies',
			'project'       => 'Kitchen-diner renovation',
			'link'          => dc_demo_link( 'https://www.facebook.com/JDeeprosedevelopmentsltd', 'Read more reviews', '_blank' ),
		),
		$team_row,
		array(
			'acf_fc_layout' => 'process',
			'eyebrow'       => 'How we work',
			'heading'       => 'A clear process from first visit to handover',
			'intro'         => 'No surprises and no jargon. One point of contact throughout.',
			'steps'         => array(
				array( 'title' => 'Initial chat', 'text' => 'Tell us about your project by phone, WhatsApp or our online form.' ),
				array( 'title' => 'Site visit', 'text' => 'We visit, listen to what you want and give honest advice.' ),
				array( 'title' => 'Detailed quote', 'text' => 'A clear, itemised quote with no hidden costs.' ),
				array( 'title' => 'The build', 'text' => 'Josh or Callum on site, with regular updates throughout.' ),
				array( 'title' => 'Handover', 'text' => 'A final walk-round together, and we stay in touch afterwards.' ),
			),
			'button'        => dc_demo_link( $contact_url, 'Contact us' ),
		),
		array(
			'acf_fc_layout' => 'detail_gallery',
			'eyebrow'       => 'Craftsmanship',
			'heading'       => "It's all in the detail",
			'intro'         => 'Arched openings, steel doors, reclaimed beams and hand-laid floors. The finishing touches that make a house feel finished.',
			'images'        => array(
				array( 'image' => $m['hallway-stairs'], 'caption' => 'Hallway & staircase' ),
				array( 'image' => $m['utility-room'], 'caption' => 'Utility room' ),
				array( 'image' => $m['arched-shower'], 'caption' => 'Arched shower' ),
				array( 'image' => $m['kitchen-island'], 'caption' => 'Kitchen island' ),
			),
		),
		array(
			'acf_fc_layout' => 'areas',
			'eyebrow'       => 'Areas we cover',
			'heading'       => 'Based in Chippenham, working across North Wiltshire',
			'intro'         => 'Not sure if we cover you? Give us a call.',
			'towns'         => implode( "\n", array( 'Chippenham', 'Corsham', 'Calne', 'Malmesbury', 'Melksham', 'Devizes', 'Royal Wootton Bassett', 'Lacock', 'Biddestone', 'Sutton Benger', 'Box', 'Bath', 'Surrounding villages' ) ),
		),
		array(
			'acf_fc_layout' => 'faqs',
			'eyebrow'       => 'FAQs',
			'heading'       => "Questions we're often asked",
			'button'        => dc_demo_link( $contact_url, 'Contact us' ),
			'items'         => array(
				array( 'question' => 'Do you handle planning permission and building regulations?', 'answer' => '<p>Yes. We work with your architect, or recommend one, and manage building control from start to finish. Answer to be confirmed by Josh and Callum.</p>' ),
				array( 'question' => 'How long does a typical extension take?', 'answer' => '<p>Answer to come from the client.</p>' ),
				array( 'question' => 'Are you fully insured?', 'answer' => '<p>Answer to come from the client.</p>' ),
				array( 'question' => 'Do you work on listed and period properties?', 'answer' => '<p>Answer to come from the client.</p>' ),
				array( 'question' => 'How do I get a quote, and is it free?', 'answer' => '<p>Answer to come from the client.</p>' ),
			),
		),
		$cta_row,
	);
	update_field( 'field_dc_sections', $home_sections, $home );

	update_field(
		'field_dc_sections',
		array(
			array(
				'acf_fc_layout' => 'text_block',
				'eyebrow'       => 'Our philosophy',
				'heading'       => 'A better way to build',
				'body'          => '<p>Founded in 2019 as J Deeprose Developments Ltd, the business was built around a simple idea: to offer homeowners a dependable building service with the same high standards, attention to detail and pride in workmanship that you would expect for yourself.</p><p>With a new name but the same core values, Deeprose &amp; Carter Developments continues with the same belief: that a successful project is about more than just the finished result.</p><p>Good communication, thoughtful planning, quality workmanship and having a team you can trust in your home are at the heart of every project we undertake. Those values continue to shape the way we work, from start to finish.</p>',
			),
			$team_row,
			$cta_row,
		),
		$about
	);
	update_field(
		'field_dc_sections',
		array(
			array(
				'acf_fc_layout' => 'text_block',
				'eyebrow'       => 'Contact',
				'heading'       => 'Tell us about your project',
				'body'          => '<p>Site visits and quotes are free and there is no obligation. Call us, email us or send a WhatsApp message and Josh or Callum will get back to you.</p><p>The full quote form will be added here.</p>',
			),
			$cta_row,
		),
		$contact
	);
	$log[] = 'Home, About, Contact and Blog pages created.';

	// Sample post.
	$cat = term_exists( 'Advice', 'category' );
	$cat = $cat ? (int) $cat['term_id'] : (int) wp_insert_term( 'Advice', 'category' )['term_id'];
	$post = dc_demo_post(
		'post-sample',
		array(
			'post_type'     => 'post',
			'post_title'    => 'Sample post: planning a house extension',
			'post_name'     => 'planning-a-house-extension',
			'post_excerpt'  => 'A placeholder article showing how blog posts look. Replace it with a real one.',
			'post_content'  => "<!-- wp:paragraph --><p>This is a sample post so you can see how articles look. Replace it with a real one, or delete it.</p><!-- /wp:paragraph --><!-- wp:heading --><h2 class=\"wp-block-heading\">Start with a clear brief</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Before any drawings, think about how you want to use the space, the budget, and when you would like the work done.</p><!-- /wp:paragraph --><!-- wp:quote --><blockquote class=\"wp-block-quote\"><!-- wp:paragraph --><p>A well-run build makes all the difference.</p><!-- /wp:paragraph --></blockquote><!-- /wp:quote -->",
			'post_category' => array( $cat ),
		)
	);
	set_post_thumbnail( $post, $m['extension-bifold'] );
	$log[] = 'Sample blog post created.';

	// Remove the WordPress starter content.
	foreach ( array( array( 'hello-world', 'post' ), array( 'sample-page', 'page' ) ) as $starter ) {
		$p = get_page_by_path( $starter[0], OBJECT, $starter[1] );
		if ( $p && ! get_post_meta( $p->ID, '_dc_demo_key', true ) ) {
			wp_delete_post( $p->ID, true );
		}
	}

	// Reading settings.
	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $home );
	update_option( 'page_for_posts', $blog );

	// Site Settings.
	$settings = array(
		'field_dc_set_phone'          => '01249 000 000',
		'field_dc_set_quote_email'    => 'jo@jdeeprosedevelopments.co.uk',
		'field_dc_set_email'          => 'jo@jdeeprosedevelopments.co.uk',
		'field_dc_set_whatsapp'       => '',
		'field_dc_set_address'        => 'Chippenham, Wiltshire',
		'field_dc_set_header_button'  => $quote_btn,
		'field_dc_set_strapline'      => 'Built around you',
		'field_dc_set_footer_text'    => 'Owner-managed builders based in Chippenham, working across North Wiltshire.',
		'field_dc_set_social'         => array( array( 'label' => 'Facebook', 'url' => 'https://www.facebook.com/JDeeprosedevelopmentsltd' ) ),
		'field_dc_set_company'        => 'Registered in England & Wales · Company no. XXXXXXXX',
		'field_dc_set_fonts_kit'      => 'jtl2yxi',
	);
	foreach ( $settings as $key => $value ) {
		update_field( $key, $value, 'option' );
	}
	$log[] = 'Site Settings filled in (phone number and company number are placeholders).';

	// Menus.
	$privacy = (int) get_option( 'wp_page_for_privacy_policy' );
	dc_demo_menu_build( 'Header left', 'primary-left', array(
		array( 'title' => 'Services', 'archive' => 'service' ),
		array( 'title' => 'Projects', 'archive' => 'project' ),
		array( 'title' => 'About', 'object_id' => $about ),
		array( 'title' => 'Blog', 'object_id' => $blog ),
	) );
	dc_demo_menu_build( 'Header right', 'primary-right', array(
		array( 'title' => 'Reviews', 'url' => home_url( '/#reviews' ) ),
	) );
	dc_demo_menu_build( 'Mobile', 'mobile', array(
		array( 'title' => 'Services', 'archive' => 'service' ),
		array( 'title' => 'Projects', 'archive' => 'project' ),
		array( 'title' => 'About', 'object_id' => $about ),
		array( 'title' => 'Reviews', 'url' => home_url( '/#reviews' ) ),
		array( 'title' => 'Blog', 'object_id' => $blog ),
		array( 'title' => 'Contact', 'object_id' => $contact ),
	) );
	dc_demo_menu_build( 'Footer services', 'footer-services', array_map( fn( $id ) => array( 'title' => get_the_title( $id ), 'object_id' => $id ), array_values( $services ) ) );
	dc_demo_menu_build( 'Footer company', 'footer-company', array(
		array( 'title' => 'About us', 'object_id' => $about ),
		array( 'title' => 'Projects', 'archive' => 'project' ),
		array( 'title' => 'Blog', 'object_id' => $blog ),
		array( 'title' => 'Reviews', 'url' => home_url( '/#reviews' ) ),
		array( 'title' => 'FAQs', 'url' => home_url( '/#faqs' ) ),
		array( 'title' => 'Contact', 'object_id' => $contact ),
	) );
	$legal = array();
	if ( $privacy && get_post( $privacy ) ) {
		wp_update_post( array( 'ID' => $privacy, 'post_status' => 'publish' ) );
		$legal[] = array( 'title' => 'Privacy', 'object_id' => $privacy );
	}
	dc_demo_menu_build( 'Footer legal', 'footer-legal', $legal );
	$log[] = 'Menus created and assigned.';

	flush_rewrite_rules();
	update_option( 'dc_demo_done', time() );
	return $log;
}
