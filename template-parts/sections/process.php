<?php
/**
 * Section: how we work.
 *
 * @package DeeproseCarter
 */

$dc_steps = get_sub_field( 'steps' );
?>
<section class="process navy on-navy pad" id="process"><div class="wrap">
	<div class="center">
		<?php dc_eyebrow( get_sub_field( 'eyebrow' ) ); ?>
		<h2><?php echo esc_html( get_sub_field( 'heading' ) ); ?></h2>
		<?php if ( get_sub_field( 'intro' ) ) : ?><p class="lede"><?php echo esc_html( get_sub_field( 'intro' ) ); ?></p><?php endif; ?>
	</div>
	<?php if ( $dc_steps ) : ?>
		<div class="steps" style="--cols:<?php echo (int) count( $dc_steps ); ?>">
			<?php foreach ( $dc_steps as $dc_n => $dc_step ) : ?>
				<div class="step"><b><?php echo esc_html( str_pad( (string) ( $dc_n + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></b><h3><?php echo esc_html( $dc_step['title'] ); ?></h3><p><?php echo esc_html( $dc_step['text'] ); ?></p></div>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>
	<?php if ( get_sub_field( 'button' ) ) : ?><div class="btnrow"><?php dc_link( get_sub_field( 'button' ), 'btn btn-ghost' ); ?></div><?php endif; ?>
</div></section>
