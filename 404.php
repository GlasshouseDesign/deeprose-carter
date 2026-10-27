<?php
/**
 * Page not found.
 *
 * @package DeeproseCarter
 */

get_header();
?>
<section class="page-hero"><div class="wrap">
	<?php dc_eyebrow( __( 'Page not found', 'deeprose-carter' ) ); ?>
	<h1><?php esc_html_e( "We can't find that page", 'deeprose-carter' ); ?></h1>
	<p><?php esc_html_e( 'It may have moved. Try the homepage, or get in touch and we will help.', 'deeprose-carter' ); ?></p>
	<div class="ctas" style="margin-top:32px"><a class="btn btn-light" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Back to the homepage', 'deeprose-carter' ); ?></a></div>
</div></section>
<?php
get_footer();
