<?php
/**
 * Section: client testimonial.
 *
 * @package DeeproseCarter
 */

?>
<section class="testimonial pad" id="reviews"><div class="wrap"><div class="grid">
	<div>
		<?php dc_eyebrow( get_sub_field( 'eyebrow' ) ); ?>
		<div class="stars" aria-label="<?php esc_attr_e( 'Five stars', 'deeprose-carter' ); ?>"><i></i><i></i><i></i><i></i><i></i></div>
		<p class="pull"><?php echo esc_html( get_sub_field( 'pull_quote' ) ); ?></p>
		<div class="who">
			<div><b><?php echo esc_html( get_sub_field( 'name' ) ); ?></b><span><?php echo esc_html( get_sub_field( 'project' ) ); ?></span></div>
			<?php dc_link( get_sub_field( 'link' ), 'link' ); ?>
		</div>
	</div>
	<div class="story"><?php echo wp_kses_post( get_sub_field( 'body' ) ); ?></div>
</div></div></section>
