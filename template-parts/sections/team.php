<?php
/**
 * Section: team.
 *
 * @package DeeproseCarter
 */

?>
<section class="team pad" id="about"><div class="wrap"><div class="grid">
	<?php if ( get_sub_field( 'image' ) ) : ?><div class="photo"><?php echo dc_img( get_sub_field( 'image' ), 'dc-wide', array( 'loading' => 'lazy' ) ); // phpcs:ignore ?></div><?php endif; ?>
	<div>
		<?php dc_eyebrow( get_sub_field( 'eyebrow' ) ); ?>
		<h2><?php echo esc_html( get_sub_field( 'heading' ) ); ?></h2>
		<div class="team-text"><?php echo wp_kses_post( get_sub_field( 'text' ) ); ?></div>
		<?php dc_link( get_sub_field( 'button' ), 'btn btn-navy' ); ?>
	</div>
</div></div></section>
