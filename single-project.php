<?php
/**
 * Single project: framed photo with the title card, a short facts strip, the photos,
 * and more projects. Kept deliberately light: a summary, a few facts and the pictures.
 *
 * @package DeeproseCarter
 */

get_header();

while ( have_posts() ) :
	the_post();
	$dc_location = function_exists( 'get_field' ) ? get_field( 'location' ) : '';
	$dc_summary  = function_exists( 'get_field' ) ? get_field( 'summary' ) : '';
	$dc_rows     = function_exists( 'get_field' ) ? (array) get_field( 'gallery', false, false ) : array();
	$dc_gallery  = array_values( array_filter( array_map( fn( $r ) => is_array( $r ) ? (int) reset( $r ) : 0, $dc_rows ) ) );
	$dc_types    = get_the_terms( get_the_ID(), 'project_type' );
	$dc_services = dc_project_services( get_the_ID() );
	?>
	<div class="stage stage-page">
		<div class="film"><?php if ( has_post_thumbnail() ) : ?><?php the_post_thumbnail( 'full', array( 'fetchpriority' => 'high', 'sizes' => '100vw' ) ); ?><?php endif; ?></div>
		<nav class="crumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'deeprose-carter' ); ?>">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'deeprose-carter' ); ?></a>
			<span aria-hidden="true">/</span><a href="<?php echo esc_url( get_post_type_archive_link( 'project' ) ); ?>"><?php esc_html_e( 'Projects', 'deeprose-carter' ); ?></a>
			<span aria-hidden="true">/</span><span aria-current="page"><?php the_title(); ?></span>
		</nav>
		<div class="card">
			<?php dc_eyebrow( $dc_location ? $dc_location : __( 'Project', 'deeprose-carter' ) ); ?>
			<h1><?php the_title(); ?></h1>
			<?php if ( $dc_summary ) : ?><p><?php echo esc_html( $dc_summary ); ?></p><?php endif; ?>
			<div class="ctas">
				<a class="btn btn-light" href="<?php echo esc_url( dc_quote_mailto() ); ?>"><?php esc_html_e( 'Request a quote', 'deeprose-carter' ); ?></a>
				<?php if ( $dc_gallery ) : ?><a class="btn btn-ghost" href="#gallery"><?php esc_html_e( 'See the photos', 'deeprose-carter' ); ?></a><?php endif; ?>
			</div>
		</div>
	</div>

	<section class="project-facts"><div class="wrap">
		<dl class="pfacts">
			<?php if ( $dc_location ) : ?><div><dt><?php esc_html_e( 'Location', 'deeprose-carter' ); ?></dt><dd><?php echo esc_html( $dc_location ); ?></dd></div><?php endif; ?>
			<?php if ( $dc_types && ! is_wp_error( $dc_types ) ) : ?>
				<div><dt><?php esc_html_e( 'The work', 'deeprose-carter' ); ?></dt><dd><?php echo esc_html( implode( ', ', wp_list_pluck( $dc_types, 'name' ) ) ); ?></dd></div>
			<?php endif; ?>
			<?php if ( $dc_services ) : ?>
				<div><dt><?php esc_html_e( 'Related services', 'deeprose-carter' ); ?></dt><dd><?php echo implode( ', ', array_map( fn( $s ) => '<a href="' . esc_url( get_permalink( $s ) ) . '">' . esc_html( get_the_title( $s ) ) . '</a>', $dc_services ) ); // phpcs:ignore ?></dd></div>
			<?php endif; ?>
			<div><dt><?php esc_html_e( 'Managed by', 'deeprose-carter' ); ?></dt><dd><?php esc_html_e( 'Josh & Callum', 'deeprose-carter' ); ?></dd></div>
		</dl>
		<?php if ( trim( get_the_content() ) ) : ?><div class="prose project-text"><?php the_content(); ?></div><?php endif; ?>
	</div></section>

	<?php if ( $dc_gallery ) : ?>
		<section class="gallery-sec pad" id="gallery"><div class="wrap">
			<div class="head-row"><div><?php dc_eyebrow( __( 'The finished work', 'deeprose-carter' ) ); ?><h2><?php esc_html_e( 'Photos', 'deeprose-carter' ); ?></h2></div></div>
			<div class="pgallery" data-lightbox>
				<?php foreach ( $dc_gallery as $dc_i => $dc_id ) : ?>
					<?php $dc_cap = wp_get_attachment_caption( $dc_id ); ?>
					<a class="pg-item pg-<?php echo (int) ( $dc_i % 6 ); ?>" href="<?php echo esc_url( wp_get_attachment_image_url( $dc_id, 'full' ) ); ?>" data-caption="<?php echo esc_attr( $dc_cap ); ?>">
						<?php echo dc_img( $dc_id, 'large', array( 'loading' => 'lazy' ) ); // phpcs:ignore ?>
						<?php if ( $dc_cap ) : ?><span class="pg-cap"><?php echo esc_html( $dc_cap ); ?></span><?php endif; ?>
					</a>
				<?php endforeach; ?>
			</div>
		</div></section>
	<?php endif; ?>

	<?php
	$dc_more = get_posts( array( 'post_type' => 'project', 'numberposts' => 2, 'post__not_in' => array( get_the_ID() ) ) );
	if ( $dc_more ) :
		?>
		<section class="more-projects pad"><div class="wrap">
			<div class="head-row">
				<div><?php dc_eyebrow( __( 'Recent work', 'deeprose-carter' ) ); ?><h2><?php esc_html_e( 'More projects', 'deeprose-carter' ); ?></h2></div>
				<a class="link" href="<?php echo esc_url( get_post_type_archive_link( 'project' ) ); ?>"><?php esc_html_e( 'View all projects', 'deeprose-carter' ); ?></a>
			</div>
			<div class="more-grid">
				<?php foreach ( $dc_more as $dc_p ) : ?>
					<?php dc_project_card( $dc_p->ID, 'small' ); ?>
				<?php endforeach; ?>
			</div>
		</div></section>
	<?php endif; ?>

	<?php
	get_template_part( 'template-parts/cta-default' );
endwhile;

get_footer();
