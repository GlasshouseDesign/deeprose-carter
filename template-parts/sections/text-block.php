<?php
/**
 * Section: text block.
 *
 * @package DeeproseCarter
 */

?>
<section class="text-block pad"><div class="wrap">
	<?php dc_eyebrow( get_sub_field( 'eyebrow' ) ); ?>
	<?php if ( get_sub_field( 'heading' ) ) : ?><h2 style="margin-bottom:28px"><?php echo esc_html( get_sub_field( 'heading' ) ); ?></h2><?php endif; ?>
	<div class="prose"><?php echo wp_kses_post( get_sub_field( 'body' ) ); ?></div>
</div></section>
