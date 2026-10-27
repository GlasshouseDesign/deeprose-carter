<?php
/**
 * Section: grid of options (for example, types of extension).
 *
 * @package DeeproseCarter
 */

$dc_items = (array) get_sub_field( 'items' );
?>
<section class="options pad"><div class="wrap">
	<div class="head-row">
		<div><?php dc_eyebrow( get_sub_field( 'eyebrow' ) ); ?><h2><?php echo esc_html( get_sub_field( 'heading' ) ); ?></h2></div>
		<?php if ( get_sub_field( 'intro' ) ) : ?><p class="lede"><?php echo esc_html( get_sub_field( 'intro' ) ); ?></p><?php endif; ?>
	</div>
	<div class="ogrid">
		<?php foreach ( $dc_items as $dc_n => $dc_o ) : ?>
			<article class="option">
				<?php if ( ! empty( $dc_o['image'] ) ) : ?><div class="ph"><?php echo dc_img( $dc_o['image'], 'dc-card', array( 'loading' => 'lazy' ) ); // phpcs:ignore ?></div><?php endif; ?>
				<span class="num"><?php echo esc_html( str_pad( (string) ( $dc_n + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
				<h3><?php echo esc_html( $dc_o['title'] ); ?></h3>
				<p><?php echo esc_html( $dc_o['text'] ); ?></p>
			</article>
		<?php endforeach; ?>
	</div>
</div></section>
