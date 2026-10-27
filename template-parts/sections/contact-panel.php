<?php
/**
 * Section: contact panel with contact details from Site Settings.
 *
 * @package DeeproseCarter
 */

$dc_button   = get_sub_field( 'button' );
$dc_points   = (array) get_sub_field( 'points' );
$dc_phone    = dc_setting( 'phone' );
$dc_email    = dc_setting( 'quote_email' );
$dc_whatsapp = dc_setting( 'whatsapp' );
$dc_address  = dc_setting( 'address' );
if ( empty( $dc_button['url'] ) ) {
	$dc_button = array( 'url' => dc_quote_mailto(), 'title' => __( 'Request a quote', 'deeprose-carter' ), 'target' => '' );
}
?>
<section class="contact-panel navy on-navy pad" id="contact"><div class="wrap"><div class="cp-grid<?php echo get_sub_field( 'image' ) ? ' has-img' : ''; ?>">
	<div class="cp-main">
		<?php dc_eyebrow( get_sub_field( 'eyebrow' ) ); ?>
		<h2><?php echo esc_html( get_sub_field( 'heading' ) ); ?></h2>
		<?php if ( get_sub_field( 'text' ) ) : ?><p class="lede"><?php echo esc_html( get_sub_field( 'text' ) ); ?></p><?php endif; ?>
		<?php if ( $dc_points ) : ?><ul class="ticks on-dark"><?php foreach ( $dc_points as $dc_p ) : ?><li><?php echo esc_html( $dc_p['text'] ); ?></li><?php endforeach; ?></ul><?php endif; ?>
		<div class="ctas"><?php dc_link( $dc_button, 'btn btn-light' ); ?></div>
	</div>
	<div class="cp-details">
		<?php if ( get_sub_field( 'image' ) ) : ?><div class="cp-img"><?php echo dc_img( get_sub_field( 'image' ), 'dc-card', array( 'loading' => 'lazy' ) ); // phpcs:ignore ?></div><?php endif; ?>
		<dl>
			<?php if ( $dc_phone ) : ?><div><dt><?php esc_html_e( 'Call', 'deeprose-carter' ); ?></dt><dd><a href="<?php echo esc_attr( dc_tel( $dc_phone ) ); ?>"><?php echo esc_html( $dc_phone ); ?></a></dd></div><?php endif; ?>
			<?php if ( $dc_email ) : ?><div><dt><?php esc_html_e( 'Email', 'deeprose-carter' ); ?></dt><dd><a href="mailto:<?php echo esc_attr( antispambot( $dc_email ) ); ?>"><?php echo esc_html( antispambot( $dc_email ) ); ?></a></dd></div><?php endif; ?>
			<?php if ( $dc_whatsapp ) : ?><div><dt><?php esc_html_e( 'WhatsApp', 'deeprose-carter' ); ?></dt><dd><a href="<?php echo esc_url( 'https://wa.me/' . preg_replace( '/\D/', '', $dc_whatsapp ) ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'Send us a message', 'deeprose-carter' ); ?></a></dd></div><?php endif; ?>
			<?php if ( $dc_address ) : ?><div><dt><?php esc_html_e( 'Based in', 'deeprose-carter' ); ?></dt><dd><?php echo esc_html( $dc_address ); ?></dd></div><?php endif; ?>
		</dl>
	</div>
</div></div></section>
