<?php
/**
 * Single project.
 *
 * @package DeeproseCarter
 */

get_header();

while ( have_posts() ) :
	the_post();
	$dc_location = function_exists( 'get_field' ) ? get_field( 'location' ) : '';
	$dc_summary  = function_exists( 'get_field' ) ? get_field( 'summary' ) : '';
	$dc_gallery  = function_exists( 'get_field' ) ? get_field( 'gallery' ) : array();
	$dc_types    = get_the_terms( get_the_ID(), 'project_type' );
	?>
	<section class="page-hero"><div class="wrap">
		<?php dc_eyebrow( $dc_location ? $dc_location : __( 'Project', 'deeprose-carter' ) ); ?>
		<h1><?php the_title(); ?></h1>
		<?php if ( $dc_summary ) : ?><p><?php echo esc_html( $dc_summary ); ?></p><?php endif; ?>
		<?php if ( $dc_types && ! is_wp_error( $dc_types ) ) : ?><div class="tags" style="margin-top:26px"><?php foreach ( $dc_types as $dc_t ) : ?><span><?php echo esc_html( $dc_t->name ); ?></span><?php endforeach; ?></div><?php endif; ?>
	</div></section>
	<?php if ( has_post_thumbnail() ) : ?><div class="article-hero-img"><?php the_post_thumbnail( 'dc-wide' ); ?></div><?php endif; ?>
	<section class="pad"><div class="wrap">
		<div class="prose"><?php the_content(); ?></div>
		<?php if ( $dc_gallery ) : ?>
			<div class="archive-grid" style="margin-top:64px">
				<?php foreach ( $dc_gallery as $dc_g ) : ?><figure style="margin:0"><?php echo dc_img( $dc_g['image'], 'dc-card', array( 'loading' => 'lazy', 'style' => 'width:100%;height:100%;object-fit:cover' ) ); // phpcs:ignore ?></figure><?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div></section>
	<?php
	get_template_part( 'template-parts/cta-default' );
endwhile;

get_footer();
