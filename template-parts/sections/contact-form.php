<?php
/**
 * Section: quote form, with contact details and what happens next.
 * Uses the form shortcode if one is set (Gravity Forms or WPForms), otherwise the built-in form.
 *
 * @package DeeproseCarter
 */

$dc_shortcode = trim( (string) get_sub_field( 'form_shortcode' ) );
$dc_steps     = (array) get_sub_field( 'steps' );
$dc_points    = (array) get_sub_field( 'points' );
$dc_phone     = dc_setting( 'phone' );
$dc_email     = dc_setting( 'quote_email' );
$dc_whatsapp  = dc_setting( 'whatsapp' );
$dc_address   = dc_setting( 'address' );
?>
<section class="contact-form pad" id="enquiry"><div class="wrap"><div class="cf-grid">
	<div class="cf-main">
		<?php dc_eyebrow( get_sub_field( 'eyebrow' ) ); ?>
		<?php if ( get_sub_field( 'heading' ) ) : ?><h2><?php echo esc_html( get_sub_field( 'heading' ) ); ?></h2><?php endif; ?>
		<?php if ( get_sub_field( 'intro' ) ) : ?><p class="lede"><?php echo esc_html( get_sub_field( 'intro' ) ); ?></p><?php endif; ?>
		<div class="cf-box">
			<?php
			if ( $dc_shortcode ) {
				echo do_shortcode( $dc_shortcode ); // phpcs:ignore WordPress.Security.EscapeOutput -- form plugin output.
			} else {
				dc_cf_render();
			}
			?>
		</div>
	</div>
	<aside class="cf-aside">
		<div class="sd-card sd-contact">
			<h3><?php esc_html_e( 'Prefer to talk?', 'deeprose-carter' ); ?></h3>
			<?php if ( $dc_phone ) : ?><a class="sd-line cf-phone" href="<?php echo esc_attr( dc_tel( $dc_phone ) ); ?>"><?php echo esc_html( $dc_phone ); ?></a><?php endif; ?>
			<?php if ( $dc_email ) : ?><a class="sd-line" href="mailto:<?php echo esc_attr( antispambot( $dc_email ) ); ?>"><?php echo esc_html( antispambot( $dc_email ) ); ?></a><?php endif; ?>
			<?php if ( $dc_whatsapp ) : ?><a class="sd-line" href="<?php echo esc_url( 'https://wa.me/' . preg_replace( '/\D/', '', $dc_whatsapp ) ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'Message us on WhatsApp', 'deeprose-carter' ); ?></a><?php endif; ?>
			<?php if ( $dc_address ) : ?><p class="cf-address"><?php echo esc_html( $dc_address ); ?></p><?php endif; ?>
		</div>
		<?php if ( $dc_steps ) : ?>
			<div class="sd-card">
				<h3><?php echo esc_html( get_sub_field( 'steps_title' ) ? get_sub_field( 'steps_title' ) : __( 'What happens next', 'deeprose-carter' ) ); ?></h3>
				<ol class="cf-steps">
					<?php foreach ( $dc_steps as $dc_s ) : ?>
						<li><b><?php echo esc_html( $dc_s['title'] ); ?></b><?php if ( $dc_s['text'] ) : ?><span><?php echo esc_html( $dc_s['text'] ); ?></span><?php endif; ?></li>
					<?php endforeach; ?>
				</ol>
			</div>
		<?php endif; ?>
		<?php if ( $dc_points ) : ?>
			<ul class="ticks cf-points"><?php foreach ( $dc_points as $dc_p ) : ?><li><?php echo esc_html( $dc_p['text'] ); ?></li><?php endforeach; ?></ul>
		<?php endif; ?>
	</aside>
</div></div></section>
