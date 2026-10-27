<?php
/**
 * Service page content for the demo setup. One function per service.
 *
 * @package DeeproseCarter
 */

defined( 'ABSPATH' ) || exit;

/**
 * Give a demo image a caption (used by the photo gallery).
 */
function dc_demo_caption( $id, $caption ) {
	if ( $id ) {
		wp_update_post( array( 'ID' => $id, 'post_excerpt' => $caption ) );
	}
}

/**
 * Extensions.
 *
 * @param int   $post_id Service post ID.
 * @param array $m       Demo media IDs keyed by file name.
 * @param array $shared  Shared links and rows: contact_url, testimonial row.
 */
function dc_demo_service_extensions( $post_id, $m, $shared ) {
	$contact = $shared['contact_url'];

	dc_demo_caption( $m['extension-arches'], 'Stone extension, Mile Elm' );
	dc_demo_caption( $m['extension-glazed'], 'Glazed doors to the garden, Mile Elm' );
	dc_demo_caption( $m['extension-bifold'], 'Bifold doors and terrace' );
	dc_demo_caption( $m['kitchen-open-plan'], 'Open-plan kitchen, Sutton Benger' );
	dc_demo_caption( $m['kitchen-marble'], 'Kitchen-diner' );
	dc_demo_caption( $m['rendered-extension'], 'Rendered extension with stone quoins' );

	wp_update_post(
		array(
			'ID'           => $post_id,
			'post_excerpt' => 'Single storey, two storey and wrap-around house extensions in Chippenham, Corsham and North Wiltshire. Owner-managed builds, planning support and free site visits.',
		)
	);

	$sections = array(
		array(
			'acf_fc_layout'    => 'page_hero',
			'image'            => $m['extension-glazed'],
			'eyebrow'          => 'Extensions in Chippenham & North Wiltshire',
			'heading'          => 'House extensions',
			'text'             => 'Single storey, two storey and wrap-around extensions, designed around how you live and project-managed from start to finish by Josh and Callum.',
			'button_primary'   => dc_demo_link( $contact, 'Request a quote' ),
			'button_secondary' => dc_demo_link( '#gallery', 'See our extensions' ),
			'breadcrumb'       => 1,
		),
		array(
			'acf_fc_layout' => 'service_detail',
			'eyebrow'       => 'Extensions',
			'heading'       => 'More space, built properly',
			'body'          => implode(
				"\n",
				array(
					'<p>An extension is one of the best ways to add space and value to your home without the cost and upheaval of moving. Whether you want a bright kitchen-diner opening on to the garden, an extra bedroom, a home office or a larger family room, Deeprose &amp; Carter Developments design and build <strong>house extensions across Chippenham, Corsham, Calne, Malmesbury, Melksham</strong> and the surrounding North Wiltshire villages.</p>',
					'<p>Every extension is overseen by the owners, Josh and Callum, from the first site visit to the final handover. You have one point of contact throughout, supported by a carefully selected team of trusted trades working to the same high standard.</p>',
					'<h2>Planning, building regulations and design</h2>',
					'<p>We can build from your own architect\'s drawings or introduce you to designers we trust. Many single storey rear extensions can be built under <strong>permitted development</strong>, while larger, two storey and wrap-around designs usually need <strong>planning permission</strong>. We will tell you honestly what is likely to be needed for your home and help with the paperwork.</p>',
					'<p>Every extension needs <strong>building regulations approval</strong>. We arrange and manage building control inspections throughout the build, coordinate the structural engineer\'s calculations, and handle <strong>party wall</strong> arrangements with neighbours where they apply.</p>',
					'<h2>An extension that suits your home</h2>',
					'<p>Many homes in North Wiltshire are built in Bath stone, Cotswold stone or brick, and some are listed or sit in conservation areas. We take care to match the stone, coursing, roof tiles and detailing so a new extension sits naturally with the original house, whether you want a traditional finish or a contemporary glazed design with steel-framed doors.</p>',
					'<h3>Warm, efficient and built to last</h3>',
					'<p>We build to current building regulations for insulation and energy efficiency, with good-quality glazing, roof lights and underfloor heating options that keep a larger space comfortable all year round.</p>',
					'<h2>Living with the build</h2>',
					'<p>Every project starts with a free site visit and a clear, itemised quote with no hidden costs. Once work begins we keep disruption to a minimum, keep the site tidy and safe, and give you regular updates so you always know what is happening next. Most families stay at home throughout, and we plan the work around you.</p>',
				)
			),
			'list_title'    => 'What we can include',
			'list'          => array_map(
				fn( $t ) => array( 'item' => $t ),
				array(
					'Single storey rear extensions',
					'Two storey and side extensions',
					'Wrap-around extensions',
					'Kitchen extensions and kitchen-diners',
					'Glazed and orangery-style extensions',
					'Architect and structural engineer coordination',
					'Planning and building regulations support',
					'Party wall arrangements',
					'Groundworks, drainage and foundations',
					'Steelwork and structural openings',
					'Bifold, sliding and steel-framed doors',
					'Roof lights and lantern roofs',
					'Underfloor heating, electrics and plumbing',
					'Plastering, flooring and decoration',
					'Kitchen and utility fitting',
					'Patios and landscaping to finish',
				)
			),
			'facts'         => array(
				array( 'label' => 'Managed by', 'value' => 'Josh or Callum' ),
				array( 'label' => 'Site visit', 'value' => 'Free, no obligation' ),
				array( 'label' => 'Planning', 'value' => 'Advice included' ),
				array( 'label' => 'Building control', 'value' => 'Managed for you' ),
				array( 'label' => 'Areas', 'value' => 'Chippenham & North Wiltshire' ),
			),
			'show_contact'  => 1,
		),
		array(
			'acf_fc_layout' => 'options_grid',
			'eyebrow'       => 'Types of extension',
			'heading'       => 'Which extension is right for you?',
			'intro'         => 'The right design depends on your house, your plot and how you want to use the space. We will talk through the options at your site visit.',
			'items'         => array(
				array( 'image' => '', 'title' => 'Single storey rear', 'text' => 'The most popular way to create a larger kitchen, dining or family room, opening the back of the house to the garden with bifold, sliding or steel-framed doors.' ),
				array( 'image' => '', 'title' => 'Wrap-around', 'text' => 'Extends to the side and rear in an L shape, making the most of side returns and awkward plots to create one generous open-plan space.' ),
				array( 'image' => '', 'title' => 'Two storey', 'text' => 'Adds space upstairs and down in one build, often a larger kitchen below with an extra bedroom or en suite above. Usually needs planning permission.' ),
				array( 'image' => '', 'title' => 'Side extension', 'text' => 'Uses the space beside the house for a utility room, boot room, cloakroom, study or a wider hallway and kitchen.' ),
				array( 'image' => '', 'title' => 'Kitchen extension', 'text' => 'A new kitchen-diner built as part of the extension, with structural openings into the existing house and the kitchen fitted by our team.' ),
				array( 'image' => '', 'title' => 'Glazed and orangery-style', 'text' => 'Light-filled rooms with lantern roofs and large glazed openings, built and insulated to feel part of the house all year round.' ),
			),
		),
		array(
			'acf_fc_layout' => 'photo_gallery',
			'eyebrow'       => 'Recent work',
			'heading'       => 'Our extensions',
			'intro'         => 'A selection of extensions we have built across North Wiltshire. Click any photo to see it full size.',
			'images'        => array( $m['extension-arches'], $m['extension-bifold'], $m['kitchen-marble'], $m['extension-glazed'], $m['kitchen-open-plan'], $m['rendered-extension'] ),
			'link'          => dc_demo_link( get_post_type_archive_link( 'project' ), 'View all projects' ),
		),
		$shared['testimonial'],
		array(
			'acf_fc_layout' => 'process',
			'eyebrow'       => 'How it works',
			'heading'       => 'Your extension, step by step',
			'intro'         => 'One point of contact from the first visit to the final handover.',
			'steps'         => array(
				array( 'title' => 'Site visit', 'text' => 'We look at the house and garden, talk through your ideas and give honest advice on what is possible.' ),
				array( 'title' => 'Design and approvals', 'text' => 'We work with your architect and engineer, and help with planning and building regulations.' ),
				array( 'title' => 'Quote and programme', 'text' => 'An itemised quote and a realistic schedule, so you know the cost and timings before we start.' ),
				array( 'title' => 'The build', 'text' => 'Foundations to roof, then first fix, plastering and finishes, with Josh or Callum overseeing every stage.' ),
				array( 'title' => 'Handover', 'text' => 'Building control sign-off, a final walk-round together and a clean, tidy site.' ),
			),
			'button'        => dc_demo_link( $contact, 'Contact us' ),
		),
		array(
			'acf_fc_layout' => 'faqs',
			'eyebrow'       => 'Extension FAQs',
			'heading'       => 'Questions about extensions',
			'button'        => dc_demo_link( $contact, 'Contact us' ),
			'items'         => array(
				array( 'question' => 'Do I need planning permission for an extension?', 'answer' => '<p>Not always. Many single storey rear extensions can be built under permitted development rights, within limits on size and height. Two storey and wrap-around extensions, and homes that are listed or in a conservation area, usually need planning permission. We will advise on your home at the site visit.</p>' ),
				array( 'question' => 'How long does an extension take to build?', 'answer' => '<p>It depends on the size, the design and the finishes. We give you a realistic programme with your quote, before any work starts, and keep you updated throughout the build.</p>' ),
				array( 'question' => 'How much does an extension cost?', 'answer' => '<p>Costs depend on the size, specification and finishes, so we do not give guide prices without seeing your home. After a free site visit we provide a clear, itemised quote with no hidden costs.</p>' ),
				array( 'question' => 'Can we stay at home during the build?', 'answer' => '<p>Most families do. Much of the early work happens outside, and we plan the stage where we open up into the house carefully, keeping dust and disruption to a minimum and talking you through how to keep your home usable.</p>' ),
				array( 'question' => 'Do you work with architects?', 'answer' => '<p>Yes. We are happy to build from your architect\'s drawings, or we can introduce you to architects and structural engineers we work with regularly.</p>' ),
				array( 'question' => 'Will the extension match my house?', 'answer' => '<p>We take care to match stone, brick, roof tiles and detailing so the extension looks as though it has always been there. If you would prefer a contemporary contrast, we can build that too.</p>' ),
			),
		),
		array(
			'acf_fc_layout' => 'contact_panel',
			'eyebrow'       => 'Get in touch',
			'heading'       => 'Planning an extension?',
			'text'          => 'Tell us about your home and what you would like to achieve. Josh or Callum will arrange a free site visit and give you honest advice, with no obligation.',
			'points'        => array_map(
				fn( $t ) => array( 'text' => $t ),
				array( 'Free site visit and itemised quote', 'Owner-managed from start to finish', 'Planning and building regulations support', 'Trusted, tidy and reliable trades' )
			),
			'button'        => '',
			'image'         => $m['team-plans'],
		),
	);
	update_field( 'field_dc_sections', $sections, $post_id );
}
