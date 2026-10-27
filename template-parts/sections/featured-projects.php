<?php
/**
 * Section: featured projects.
 *
 * @package DeeproseCarter
 */

$dc_ids = get_sub_field( 'projects' );
if ( ! $dc_ids ) {
	$dc_ids = get_posts( array( 'post_type' => 'project', 'numberposts' => 3, 'fields' => 'ids' ) );
}
?>
<section class="projects navy on-navy pad" id="projects"><div class="wrap">
	<div class="head-row">
		<div><?php dc_eyebrow( get_sub_field( 'eyebrow' ) ); ?><h2><?php echo esc_html( get_sub_field( 'heading' ) ); ?></h2></div>
		<?php dc_link( get_sub_field( 'link' ), 'link' ); ?>
	</div>
	<div class="pgrid">
		<?php foreach ( array_values( (array) $dc_ids ) as $dc_i => $dc_id ) { dc_project_card( $dc_id, 0 === $dc_i ? 'big' : 'small' ); } ?>
	</div>
</div></section>
