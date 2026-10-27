<?php
/**
 * Section: areas we cover.
 *
 * @package DeeproseCarter
 */

$dc_towns = array_filter( array_map( 'trim', explode( "\n", (string) get_sub_field( 'towns' ) ) ) );
?>
<section class="areas pad"><div class="wrap"><div class="grid">
	<div>
		<?php dc_eyebrow( get_sub_field( 'eyebrow' ) ); ?>
		<h2><?php echo esc_html( get_sub_field( 'heading' ) ); ?></h2>
		<?php if ( get_sub_field( 'intro' ) ) : ?><p class="lede" style="margin-top:18px"><?php echo esc_html( get_sub_field( 'intro' ) ); ?></p><?php endif; ?>
	</div>
	<div class="chips"><?php foreach ( $dc_towns as $dc_t ) : ?><span><?php echo esc_html( $dc_t ); ?></span><?php endforeach; ?></div>
</div></div></section>
