<?php
/**
 * Single blog post.
 *
 * @package DeeproseCarter
 */

get_header();

while ( have_posts() ) :
	the_post();
	$dc_cats = get_the_category();
	?>
	<article>
		<section class="page-hero"><div class="wrap">
			<?php dc_eyebrow( $dc_cats ? $dc_cats[0]->name : __( 'Blog', 'deeprose-carter' ) ); ?>
			<h1><?php the_title(); ?></h1>
			<div class="meta"><span><?php echo esc_html( get_the_date() ); ?></span><span><?php echo esc_html( sprintf( /* translators: %d: minutes */ __( '%d min read', 'deeprose-carter' ), max( 1, (int) round( str_word_count( wp_strip_all_tags( get_the_content() ) ) / 220 ) ) ) ); ?></span></div>
		</div></section>
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="article-hero-img"><?php the_post_thumbnail( 'dc-wide' ); ?></div>
		<?php endif; ?>
		<section class="pad"><div class="wrap">
			<div class="prose"><?php the_content(); ?></div>
			<nav class="post-nav" aria-label="<?php esc_attr_e( 'More articles', 'deeprose-carter' ); ?>">
				<div><?php $dc_prev = get_previous_post(); if ( $dc_prev ) : ?><span><?php esc_html_e( 'Previous', 'deeprose-carter' ); ?></span><a href="<?php echo esc_url( get_permalink( $dc_prev ) ); ?>"><?php echo esc_html( get_the_title( $dc_prev ) ); ?></a><?php endif; ?></div>
				<div style="text-align:right"><?php $dc_next = get_next_post(); if ( $dc_next ) : ?><span><?php esc_html_e( 'Next', 'deeprose-carter' ); ?></span><a href="<?php echo esc_url( get_permalink( $dc_next ) ); ?>"><?php echo esc_html( get_the_title( $dc_next ) ); ?></a><?php endif; ?></div>
			</nav>
		</div></section>
	</article>
	<?php
	get_template_part( 'template-parts/cta-default' );
endwhile;

get_footer();
