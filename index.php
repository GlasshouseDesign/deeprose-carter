<?php
/**
 * Blog listing and general archives.
 *
 * @package DeeproseCarter
 */

get_header();

$dc_title = __( 'News &amp; advice', 'deeprose-carter' );
$dc_intro = __( 'Project updates, building advice and what to expect when you build with us.', 'deeprose-carter' );
if ( is_home() && get_option( 'page_for_posts' ) ) {
	$dc_title = get_the_title( get_option( 'page_for_posts' ) );
} elseif ( is_archive() ) {
	$dc_title = get_the_archive_title();
	$dc_intro = get_the_archive_description();
} elseif ( is_search() ) {
	/* translators: %s: search term */
	$dc_title = sprintf( __( 'Search: %s', 'deeprose-carter' ), get_search_query() );
	$dc_intro = '';
}
?>
<section class="page-hero"><div class="wrap">
	<?php dc_eyebrow( __( 'Blog', 'deeprose-carter' ) ); ?>
	<h1><?php echo wp_kses_post( $dc_title ); ?></h1>
	<?php if ( $dc_intro ) : ?><p><?php echo wp_kses_post( wp_strip_all_tags( $dc_intro ) ); ?></p><?php endif; ?>
</div></section>

<section class="pad"><div class="wrap">
	<?php if ( have_posts() ) : ?>
		<div class="post-grid">
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/post-card' );
			endwhile;
			?>
		</div>
		<div class="pagination"><?php echo paginate_links( array( 'prev_text' => '&larr;', 'next_text' => '&rarr;' ) ); // phpcs:ignore ?></div>
	<?php else : ?>
		<div class="empty-state"><h2><?php esc_html_e( 'Nothing here yet', 'deeprose-carter' ); ?></h2><p class="lede"><?php esc_html_e( 'New articles will appear here soon.', 'deeprose-carter' ); ?></p></div>
	<?php endif; ?>
</div></section>
<?php
get_footer();
