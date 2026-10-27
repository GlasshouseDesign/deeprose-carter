<?php
/**
 * Homepage: built from page sections.
 *
 * @package DeeproseCarter
 */

get_header();

while ( have_posts() ) {
	the_post();
	if ( ! dc_render_sections() ) {
		get_template_part( 'template-parts/page-simple' );
	}
}

get_footer();
