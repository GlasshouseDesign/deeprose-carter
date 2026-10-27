<?php
/**
 * Section: scrolling services banner.
 *
 * @package DeeproseCarter
 */

$dc_items = array_filter( wp_list_pluck( (array) get_sub_field( 'items' ), 'text' ) );
if ( ! $dc_items ) {
	return;
}
$dc_run = '';
foreach ( $dc_items as $dc_i ) {
	$dc_run .= '<span>' . esc_html( $dc_i ) . '</span>' . dc_win();
}
?>
<div class="ticker" role="marquee" aria-label="<?php echo esc_attr( __( 'Our services:', 'deeprose-carter' ) . ' ' . implode( ', ', $dc_items ) ); ?>">
	<div class="ticker-track" aria-hidden="true"><?php echo $dc_run . $dc_run; // phpcs:ignore ?></div>
</div>
