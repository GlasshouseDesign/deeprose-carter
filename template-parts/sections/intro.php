<?php
/**
 * Section: intro and key figures.
 *
 * @package DeeproseCarter
 */

$dc_stats = get_sub_field( 'stats' );
?>
<section class="intro pad"><div class="wrap">
	<div class="grid">
		<div><?php dc_eyebrow( get_sub_field( 'eyebrow' ) ); ?><h2><?php echo esc_html( get_sub_field( 'heading' ) ); ?></h2></div>
		<div>
			<?php if ( get_sub_field( 'text' ) ) : ?><p class="lede"><?php echo esc_html( get_sub_field( 'text' ) ); ?></p><?php endif; ?>
			<?php if ( get_sub_field( 'strong_text' ) ) : ?><p class="lede strong"><?php echo esc_html( get_sub_field( 'strong_text' ) ); ?></p><?php endif; ?>
			<?php dc_link( get_sub_field( 'link' ), 'link' ); ?>
		</div>
	</div>
	<?php if ( $dc_stats ) : ?>
		<div class="stats">
			<?php foreach ( $dc_stats as $dc_s ) : ?>
				<?php $dc_num = is_numeric( $dc_s['value'] ) ? ' data-count="' . esc_attr( $dc_s['value'] ) . '"' : ''; ?>
				<div><b<?php echo $dc_num; // phpcs:ignore ?>><?php echo esc_html( $dc_s['value'] ); ?></b><span><?php echo esc_html( $dc_s['label'] ); ?></span></div>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>
</div></section>
