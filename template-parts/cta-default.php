<?php
/**
 * Call to action used at the end of blog posts and archives.
 *
 * @package DeeproseCarter
 */

$dc_phone    = dc_setting( 'phone' );
$dc_whatsapp = dc_setting( 'whatsapp' );
?>
<section class="cta-band navy on-navy pad"><div class="wrap">
	<?php get_template_part( 'template-parts/roof' ); ?>
	<div class="eyebrow" style="justify-content:center"><?php esc_html_e( 'Get started', 'deeprose-carter' ); ?></div>
	<h2><?php esc_html_e( 'Ready to talk about your project?', 'deeprose-carter' ); ?></h2>
	<p class="lede"><?php esc_html_e( "Book a free, no-obligation site visit. We'll listen to your ideas and give you honest advice.", 'deeprose-carter' ); ?></p>
	<div class="ctas">
		<a class="btn btn-light" href="<?php echo esc_url( dc_quote_mailto() ); ?>"><?php esc_html_e( 'Request a quote', 'deeprose-carter' ); ?></a>
		<?php if ( $dc_phone ) : ?><a class="btn btn-ghost" href="<?php echo esc_attr( dc_tel( $dc_phone ) ); ?>"><?php echo esc_html( sprintf( /* translators: %s phone */ __( 'Call %s', 'deeprose-carter' ), $dc_phone ) ); ?></a><?php endif; ?>
		<?php if ( $dc_whatsapp ) : ?><a class="btn btn-ghost" href="<?php echo esc_url( 'https://wa.me/' . preg_replace( '/\D/', '', $dc_whatsapp ) ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'WhatsApp us', 'deeprose-carter' ); ?></a><?php endif; ?>
	</div>
</div></section>
