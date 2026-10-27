<?php
/**
 * Single service: page sections if set, otherwise a simple layout.
 *
 * @package DeeproseCarter
 */

get_header();

while ( have_posts() ) {
	the_post();
	if ( ! dc_render_sections() ) {
		get_template_part( 'template-parts/page-simple' );
		get_template_part( 'template-parts/cta-default' );
	}
}

get_footer();
