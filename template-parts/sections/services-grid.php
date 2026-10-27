<?php
/**
 * Section: services grid.
 *
 * @package DeeproseCarter
 */

$dc_ids = get_sub_field( 'services' );
if ( ! $dc_ids ) {
	$dc_ids = get_posts( array( 'post_type' => 'service', 'numberposts' => 7, 'orderby' => array( 'menu_order' => 'ASC', 'title' => 'ASC' ), 'fields' => 'ids' ) );
}
?>
<section class="services pad" id="services"><div class="wrap">
	<div class="head-row">
		<div><?php dc_eyebrow( get_sub_field( 'eyebrow' ) ); ?><h2><?php echo esc_html( get_sub_field( 'heading' ) ); ?></h2></div>
		<?php if ( get_sub_field( 'intro' ) ) : ?><p class="lede"><?php echo esc_html( get_sub_field( 'intro' ) ); ?></p><?php endif; ?>
	</div>
	<div class="sgrid">
		<?php foreach ( (array) $dc_ids as $dc_id ) { dc_service_card( $dc_id ); } ?>
		<?php if ( get_sub_field( 'cta_heading' ) ) : ?>
			<div class="tile cta">
				<div><h3><?php echo esc_html( get_sub_field( 'cta_heading' ) ); ?></h3><?php if ( get_sub_field( 'cta_text' ) ) : ?><p style="margin-top:14px"><?php echo esc_html( get_sub_field( 'cta_text' ) ); ?></p><?php endif; ?></div>
				<?php dc_link( get_sub_field( 'cta_button' ), 'btn btn-light', 'align-self:flex-start' ); ?>
			</div>
		<?php endif; ?>
	</div>
</div></section>
