<?php
/**
 * Section: long-form service description with an "included" list, facts and a contact card.
 *
 * @package DeeproseCarter
 */

$dc_list  = (array) get_sub_field( 'list' );
$dc_facts = (array) get_sub_field( 'facts' );
$dc_phone = dc_setting( 'phone' );
$dc_email = dc_setting( 'quote_email' );
?>
<section class="service-detail pad"><div class="wrap"><div class="sd-grid">
	<div class="sd-main">
		<?php dc_eyebrow( get_sub_field( 'eyebrow' ) ); ?>
		<?php if ( get_sub_field( 'heading' ) ) : ?><h2><?php echo esc_html( get_sub_field( 'heading' ) ); ?></h2><?php endif; ?>
		<div class="prose"><?php echo wp_kses_post( get_sub_field( 'body' ) ); ?></div>
	</div>
	<aside class="sd-aside">
		<?php if ( $dc_list ) : ?>
			<div class="sd-card">
				<h3><?php echo esc_html( get_sub_field( 'list_title' ) ); ?></h3>
				<ul class="ticks"><?php foreach ( $dc_list as $dc_i ) : ?><li><?php echo esc_html( $dc_i['item'] ); ?></li><?php endforeach; ?></ul>
			</div>
		<?php endif; ?>
		<?php if ( $dc_facts ) : ?>
			<div class="sd-card">
				<h3><?php esc_html_e( 'At a glance', 'deeprose-carter' ); ?></h3>
				<dl class="facts"><?php foreach ( $dc_facts as $dc_f ) : ?><div><dt><?php echo esc_html( $dc_f['label'] ); ?></dt><dd><?php echo esc_html( $dc_f['value'] ); ?></dd></div><?php endforeach; ?></dl>
			</div>
		<?php endif; ?>
		<?php if ( get_sub_field( 'show_contact' ) ) : ?>
			<div class="sd-card sd-contact">
				<h3><?php esc_html_e( 'Talk to Josh or Callum', 'deeprose-carter' ); ?></h3>
				<p><?php esc_html_e( 'Free, no-obligation site visits across Chippenham and North Wiltshire.', 'deeprose-carter' ); ?></p>
				<a class="btn btn-light" href="<?php echo esc_url( dc_quote_mailto() ); ?>"><?php esc_html_e( 'Request a quote', 'deeprose-carter' ); ?></a>
				<?php if ( $dc_phone ) : ?><a class="sd-line" href="<?php echo esc_attr( dc_tel( $dc_phone ) ); ?>"><?php echo esc_html( $dc_phone ); ?></a><?php endif; ?>
				<?php if ( $dc_email ) : ?><a class="sd-line" href="mailto:<?php echo esc_attr( antispambot( $dc_email ) ); ?>"><?php echo esc_html( antispambot( $dc_email ) ); ?></a><?php endif; ?>
			</div>
		<?php endif; ?>
	</aside>
</div></div></section>
