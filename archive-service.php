<?php
/**
 * Services listing.
 *
 * @package DeeproseCarter
 */

get_header();
?>
<section class="page-hero"><div class="wrap">
	<?php dc_eyebrow( __( 'What we do', 'deeprose-carter' ) ); ?>
	<h1><?php esc_html_e( 'Our services', 'deeprose-carter' ); ?></h1>
	<p><?php esc_html_e( 'Every project is managed by Josh or Callum, with a trusted team of specialist trades for each stage.', 'deeprose-carter' ); ?></p>
</div></section>
<section class="services pad"><div class="wrap">
	<div class="sgrid">
		<?php
		while ( have_posts() ) :
			the_post();
			dc_service_card( get_the_ID() );
		endwhile;
		?>
	</div>
</div></section>
<?php
get_template_part( 'template-parts/cta-default' );
get_footer();
