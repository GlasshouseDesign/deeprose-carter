<?php
/**
 * Section: page hero with a framed photo and overlapping card (used on service pages).
 *
 * @package DeeproseCarter
 */

$dc_heading = get_sub_field( 'heading' ) ? get_sub_field( 'heading' ) : get_the_title();
$dc_archive = get_post_type_archive_link( get_post_type() );
?>
<div class="stage stage-page">
	<div class="film"><?php echo dc_img( get_sub_field( 'image' ), 'full', array( 'fetchpriority' => 'high', 'sizes' => '100vw' ) ); // phpcs:ignore ?></div>
	<?php if ( get_sub_field( 'breadcrumb' ) ) : ?>
		<nav class="crumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'deeprose-carter' ); ?>">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'deeprose-carter' ); ?></a>
			<?php if ( $dc_archive && 'page' !== get_post_type() ) : ?><span aria-hidden="true">/</span><a href="<?php echo esc_url( $dc_archive ); ?>"><?php echo esc_html( get_post_type_object( get_post_type() )->labels->name ); ?></a><?php endif; ?>
			<span aria-hidden="true">/</span><span aria-current="page"><?php the_title(); ?></span>
		</nav>
	<?php endif; ?>
	<div class="card">
		<?php dc_eyebrow( get_sub_field( 'eyebrow' ) ); ?>
		<h1><?php echo esc_html( $dc_heading ); ?></h1>
		<?php if ( get_sub_field( 'text' ) ) : ?><p><?php echo esc_html( get_sub_field( 'text' ) ); ?></p><?php endif; ?>
		<div class="ctas"><?php dc_link( get_sub_field( 'button_primary' ), 'btn btn-light' ); ?><?php dc_link( get_sub_field( 'button_secondary' ), 'btn btn-ghost' ); ?></div>
	</div>
</div>
