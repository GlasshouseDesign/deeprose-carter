<?php
/**
 * Simple page: navy title band and the editor content.
 *
 * @package DeeproseCarter
 */

?>
<section class="page-hero"><div class="wrap">
	<h1><?php the_title(); ?></h1>
	<?php if ( has_excerpt() ) : ?><p><?php echo esc_html( get_the_excerpt() ); ?></p><?php endif; ?>
</div></section>
<?php if ( has_post_thumbnail() ) : ?>
	<div class="article-hero-img"><?php the_post_thumbnail( 'dc-wide' ); ?></div>
<?php endif; ?>
<section class="pad"><div class="wrap"><div class="prose"><?php the_content(); ?></div></div></section>
