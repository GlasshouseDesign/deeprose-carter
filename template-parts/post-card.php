<?php
/**
 * Blog post card.
 *
 * @package DeeproseCarter
 */

$dc_cats = get_the_category();
?>
<a class="post-card" href="<?php the_permalink(); ?>">
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="ph"><?php the_post_thumbnail( 'dc-card', array( 'loading' => 'lazy' ) ); ?></div>
	<?php else : ?>
		<div class="ph empty"><img src="<?php echo esc_url( DC_URI . '/assets/img/mark-navy.svg' ); ?>" alt=""></div>
	<?php endif; ?>
	<span class="cat"><?php echo esc_html( $dc_cats ? $dc_cats[0]->name : '' ); ?><?php echo $dc_cats ? ' · ' : ''; ?><?php echo esc_html( get_the_date() ); ?></span>
	<h2><?php the_title(); ?></h2>
	<p><?php echo esc_html( get_the_excerpt() ); ?></p>
	<span class="link"><?php esc_html_e( 'Read more', 'deeprose-carter' ); ?></span>
</a>
