<?php
/**
 * Projects listing (also used for project types).
 *
 * @package DeeproseCarter
 */

get_header();
$dc_types = get_terms( array( 'taxonomy' => 'project_type', 'hide_empty' => true ) );
?>
<section class="page-hero"><div class="wrap">
	<?php dc_eyebrow( __( 'Recent work', 'deeprose-carter' ) ); ?>
	<h1><?php echo is_tax() ? esc_html( single_term_title( '', false ) ) : esc_html__( 'Our projects', 'deeprose-carter' ); ?></h1>
	<p><?php esc_html_e( 'Extensions, renovations and new builds across Chippenham and North Wiltshire.', 'deeprose-carter' ); ?></p>
	<?php if ( $dc_types && ! is_wp_error( $dc_types ) ) : ?>
		<div class="chips" style="margin-top:32px">
			<a href="<?php echo esc_url( get_post_type_archive_link( 'project' ) ); ?>"><span><?php esc_html_e( 'All', 'deeprose-carter' ); ?></span></a>
			<?php foreach ( $dc_types as $dc_t ) : ?><a href="<?php echo esc_url( get_term_link( $dc_t ) ); ?>"><span><?php echo esc_html( $dc_t->name ); ?></span></a><?php endforeach; ?>
		</div>
	<?php endif; ?>
</div></section>
<section class="pad"><div class="wrap">
	<?php if ( have_posts() ) : ?>
		<div class="archive-grid">
			<?php
			while ( have_posts() ) :
				the_post();
				dc_project_card( get_the_ID(), 'small' );
			endwhile;
			?>
		</div>
		<div class="pagination"><?php echo paginate_links(); // phpcs:ignore ?></div>
	<?php else : ?>
		<div class="empty-state"><h2><?php esc_html_e( 'Projects coming soon', 'deeprose-carter' ); ?></h2></div>
	<?php endif; ?>
</div></section>
<?php
get_template_part( 'template-parts/cta-default' );
get_footer();
