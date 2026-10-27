<?php
/**
 * Section: photo gallery with a lightbox.
 *
 * @package DeeproseCarter
 */

$dc_images = (array) get_sub_field( 'images' );
if ( ! $dc_images ) {
	return;
}
?>
<section class="gallery-sec pad" id="gallery"><div class="wrap">
	<div class="head-row">
		<div><?php dc_eyebrow( get_sub_field( 'eyebrow' ) ); ?><h2><?php echo esc_html( get_sub_field( 'heading' ) ); ?></h2></div>
		<div class="head-side">
			<?php if ( get_sub_field( 'intro' ) ) : ?><p class="lede"><?php echo esc_html( get_sub_field( 'intro' ) ); ?></p><?php endif; ?>
			<?php dc_link( get_sub_field( 'link' ), 'link' ); ?>
		</div>
	</div>
	<div class="pgallery" data-lightbox>
		<?php foreach ( $dc_images as $dc_i => $dc_id ) : ?>
			<?php $dc_cap = wp_get_attachment_caption( $dc_id ); ?>
			<a class="pg-item pg-<?php echo (int) ( $dc_i % 6 ); ?>" href="<?php echo esc_url( wp_get_attachment_image_url( $dc_id, 'full' ) ); ?>" data-caption="<?php echo esc_attr( $dc_cap ); ?>">
				<?php echo dc_img( $dc_id, 'large', array( 'loading' => 'lazy' ) ); // phpcs:ignore ?>
				<?php if ( $dc_cap ) : ?><span class="pg-cap"><?php echo esc_html( $dc_cap ); ?></span><?php endif; ?>
			</a>
		<?php endforeach; ?>
	</div>
</div></section>
