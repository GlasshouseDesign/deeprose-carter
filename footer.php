<?php
/**
 * Site footer, mobile menu and film pop-up.
 *
 * @package DeeproseCarter
 */

$dc_phone   = dc_setting( 'phone' );
$dc_email   = dc_setting( 'email' );
$dc_address = dc_setting( 'address' );
$dc_social  = dc_setting( 'social', array() );
$dc_mobile  = dc_menu_links( 'mobile' );
if ( ! $dc_mobile ) {
	$dc_mobile = dc_menu_links( 'primary-left' ) . dc_menu_links( 'primary-right' );
}
$dc_button = dc_setting( 'header_button' );
if ( empty( $dc_button['url'] ) ) {
	$dc_button = array( 'url' => dc_quote_mailto(), 'title' => __( 'Request a quote', 'deeprose-carter' ), 'target' => '' );
}
?>
</main>

<footer><div class="wrap">
	<div class="fgrid">
		<div>
			<img src="<?php echo esc_url( DC_URI . '/assets/img/logo-white.svg' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
			<div class="strap"><?php echo esc_html( dc_setting( 'strapline', 'Built around you' ) ); ?></div>
			<?php if ( dc_setting( 'footer_text' ) ) : ?><p class="small"><?php echo esc_html( dc_setting( 'footer_text' ) ); ?></p><?php endif; ?>
			<?php if ( $dc_social ) : ?>
				<div class="social">
					<?php foreach ( $dc_social as $dc_s ) : ?>
						<?php if ( ! empty( $dc_s['url'] ) ) : ?><a href="<?php echo esc_url( $dc_s['url'] ); ?>" target="_blank" rel="noopener"><span><?php echo esc_html( $dc_s['label'] ); ?></span></a><?php endif; ?>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
		<div><h4><?php esc_html_e( 'Services', 'deeprose-carter' ); ?></h4><?php dc_menu_list( 'footer-services' ); ?></div>
		<div><h4><?php esc_html_e( 'Company', 'deeprose-carter' ); ?></h4><?php dc_menu_list( 'footer-company' ); ?></div>
		<div>
			<h4><?php esc_html_e( 'Contact', 'deeprose-carter' ); ?></h4>
			<ul>
				<?php if ( $dc_phone ) : ?><li><a href="<?php echo esc_attr( dc_tel( $dc_phone ) ); ?>"><?php echo esc_html( $dc_phone ); ?></a></li><?php endif; ?>
				<?php if ( $dc_email ) : ?><li><a href="mailto:<?php echo esc_attr( antispambot( $dc_email ) ); ?>"><?php echo esc_html( antispambot( $dc_email ) ); ?></a></li><?php endif; ?>
				<?php if ( $dc_address ) : ?><li><?php echo nl2br( esc_html( $dc_address ) ); ?></li><?php endif; ?>
				<li><a href="<?php echo esc_url( $dc_button['url'] ); ?>"><?php echo esc_html( $dc_button['title'] ); ?></a></li>
			</ul>
		</div>
	</div>
	<div class="fbase">
		<span>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php echo esc_html( get_bloginfo( 'name' ) ); ?><?php echo dc_setting( 'company_details' ) ? ' · ' . esc_html( dc_setting( 'company_details' ) ) : ''; ?></span>
		<span class="legal"><?php echo str_replace( '</a><a', '</a> · <a', dc_menu_links( 'footer-legal' ) ); // phpcs:ignore ?></span>
	</div>
</div></footer>

<div class="mnav" id="mnav" hidden>
	<div class="mnav-in">
		<nav aria-label="<?php esc_attr_e( 'Mobile', 'deeprose-carter' ); ?>"><?php echo $dc_mobile; // phpcs:ignore ?></nav>
		<div class="mnav-foot">
			<?php dc_link( $dc_button, 'btn btn-light' ); ?>
			<?php if ( $dc_phone ) : ?><a class="mphone" href="<?php echo esc_attr( dc_tel( $dc_phone ) ); ?>"><?php echo esc_html( $dc_phone ); ?></a><?php endif; ?>
			<span><?php echo esc_html( dc_setting( 'strapline', 'Built around you' ) ); ?></span>
		</div>
	</div>
</div>

<dialog class="filmbox" id="filmbox" aria-label="<?php esc_attr_e( 'Brand film', 'deeprose-carter' ); ?>">
	<button class="filmclose" type="button" aria-label="<?php esc_attr_e( 'Close film', 'deeprose-carter' ); ?>">&times;</button>
	<video controls playsinline preload="none"></video>
</dialog>

<?php wp_footer(); ?>
</body>
</html>
