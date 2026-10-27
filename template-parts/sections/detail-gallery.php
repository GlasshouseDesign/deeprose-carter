<?php
/**
 * Section: detail gallery (four images, first and third tall).
 *
 * @package DeeproseCarter
 */

$dc_images = (array) get_sub_field( 'images' );
?>
<section class="details pad"><div class="wrap">
	<div class="head-row">
		<div><?php dc_eyebrow( get_sub_field( 'eyebrow' ) ); ?><h2><?php echo esc_html( get_sub_field( 'heading' ) ); ?></h2></div>
		<?php if ( get_sub_field( 'intro' ) ) : ?><p class="lede"><?php echo esc_html( get_sub_field( 'intro' ) ); ?></p><?php endif; ?>
	</div>
	<?php if ( $dc_images ) : ?>
		<div class="dgrid">
			<?php foreach ( array_values( $dc_images ) as $dc_i => $dc_g ) : ?>
				<figure<?php echo in_array( $dc_i, array( 0, 2 ), true ) ? ' class="tall"' : ''; ?>>
					<?php echo dc_img( $dc_g['image'], 'large', array( 'loading' => 'lazy' ) ); // phpcs:ignore ?>
					<?php if ( $dc_g['caption'] ) : ?><figcaption><?php echo esc_html( $dc_g['caption'] ); ?></figcaption><?php endif; ?>
				</figure>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>
</div></section>
