<?php
/**
 * Section: hero film with the overlapping card.
 *
 * @package DeeproseCarter
 */

$dc_webm   = get_sub_field( 'video_webm' );
$dc_mp4    = get_sub_field( 'video_mp4' );
$dc_poster = get_sub_field( 'poster' );
$dc_brand  = get_sub_field( 'brand_film' );
$dc_poster_url = $dc_poster ? wp_get_attachment_image_url( $dc_poster, 'dc-wide' ) : '';
?>
<div class="stage">
	<div class="film">
		<?php if ( $dc_webm || $dc_mp4 ) : ?>
			<video <?php echo $dc_poster_url ? 'poster="' . esc_url( $dc_poster_url ) . '"' : ''; ?> autoplay muted loop playsinline>
				<?php if ( $dc_webm ) : ?><source src="<?php echo esc_url( wp_get_attachment_url( $dc_webm ) ); ?>" type="video/webm"><?php endif; ?>
				<?php if ( $dc_mp4 ) : ?><source src="<?php echo esc_url( wp_get_attachment_url( $dc_mp4 ) ); ?>" type="video/mp4"><?php endif; ?>
			</video>
		<?php elseif ( $dc_poster ) : ?>
			<?php echo dc_img( $dc_poster, 'dc-wide', array( 'style' => 'width:100%;height:100%;object-fit:cover' ) ); // phpcs:ignore ?>
		<?php endif; ?>
	</div>
	<?php if ( get_sub_field( 'film_label' ) ) : ?><span class="now"><?php echo esc_html( get_sub_field( 'film_label' ) ); ?></span><?php endif; ?>
	<?php if ( $dc_brand ) : ?>
		<button class="play" type="button" data-film="<?php echo esc_url( wp_get_attachment_url( $dc_brand ) ); ?>"><i aria-hidden="true">&#9654;</i><?php echo esc_html( get_sub_field( 'brand_film_label' ) ? get_sub_field( 'brand_film_label' ) : __( 'Watch our story', 'deeprose-carter' ) ); ?></button>
	<?php endif; ?>
	<div class="card">
		<?php dc_eyebrow( get_sub_field( 'eyebrow' ) ); ?>
		<h1><?php echo esc_html( get_sub_field( 'heading' ) ); ?></h1>
		<?php if ( get_sub_field( 'text' ) ) : ?><p><?php echo esc_html( get_sub_field( 'text' ) ); ?></p><?php endif; ?>
		<div class="ctas"><?php dc_link( get_sub_field( 'button_primary' ), 'btn btn-light' ); ?><?php dc_link( get_sub_field( 'button_secondary' ), 'btn btn-ghost' ); ?></div>
	</div>
	<?php if ( get_sub_field( 'rail_text' ) ) : ?><div class="rail"><?php echo esc_html( get_sub_field( 'rail_text' ) ); ?></div><?php endif; ?>
</div>
