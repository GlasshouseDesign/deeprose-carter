<?php
/**
 * Section: call to action.
 *
 * @package DeeproseCarter
 */

$dc_button   = get_sub_field( 'button' );
$dc_phone    = dc_setting( 'phone' );
$dc_whatsapp = dc_setting( 'whatsapp' );
if ( empty( $dc_button['url'] ) ) {
	$dc_button = array( 'url' => dc_quote_mailto(), 'title' => __( 'Request a quote', 'deeprose-carter' ), 'target' => '' );
}
?>
<section class="cta-band navy on-navy pad" id="contact"><div class="wrap">
	<?php get_template_part( 'template-parts/roof' ); ?>
	<?php if ( get_sub_field( 'eyebrow' ) ) : ?><div class="eyebrow" style="justify-content:center"><?php echo esc_html( get_sub_field( 'eyebrow' ) ); ?></div><?php endif; ?>
	<h2><?php echo esc_html( get_sub_field( 'heading' ) ); ?></h2>
	<?php if ( get_sub_field( 'text' ) ) : ?><p class="lede"><?php echo esc_html( get_sub_field( 'text' ) ); ?></p><?php endif; ?>
	<div class="ctas">
		<?php dc_link( $dc_button, 'btn btn-light' ); ?>
		<?php if ( get_sub_field( 'show_phone' ) && $dc_phone ) : ?><a class="btn btn-ghost" href="<?php echo esc_attr( dc_tel( $dc_phone ) ); ?>"><?php echo esc_html( sprintf( /* translators: %s phone */ __( 'Call %s', 'deeprose-carter' ), $dc_phone ) ); ?></a><?php endif; ?>
		<?php if ( get_sub_field( 'show_whatsapp' ) && $dc_whatsapp ) : ?><a class="btn btn-ghost" href="<?php echo esc_url( 'https://wa.me/' . preg_replace( '/\D/', '', $dc_whatsapp ) ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'WhatsApp us', 'deeprose-carter' ); ?></a><?php endif; ?>
	</div>
</div></section>
