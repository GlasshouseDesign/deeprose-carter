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

	dc_demo_caption( $m['extension-arches'], 'Stone extension, Calne' );
	dc_demo_caption( $m['extension-glazed'], 'Glazed doors to the garden, Calne' );
	dc_demo_caption( $m['orangery-dusk'], 'Orangery-style extension and stone terrace' );
	dc_demo_caption( $m['orangery-terrace'], 'Orangery-style extension on a stone cottage' );
	dc_demo_caption( $m['orangery-front-door'], 'New entrance with stone surround' );
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
			'images'        => array( $m['extension-arches'], $m['orangery-dusk'], $m['extension-bifold'], $m['kitchen-marble'], $m['orangery-front-door'], $m['extension-glazed'], $m['kitchen-open-plan'], $m['orangery-terrace'], $m['rendered-extension'] ),
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

/**
 * Build a service page from a content array, in the same section order as Extensions.
 *
 * Keys: excerpt, hero, detail, options, gallery (optional), testimonial (optional, replaces the shared review), process, faqs, contact.
 *
 * @param int   $post_id Service post ID.
 * @param array $m       Demo media IDs keyed by file name.
 * @param array $shared  Shared links and rows: contact_url, testimonial row.
 * @param array $c       Page content.
 */
function dc_demo_service_page( $post_id, $m, $shared, $c ) {
	$contact = $shared['contact_url'];

	wp_update_post( array( 'ID' => $post_id, 'post_excerpt' => $c['excerpt'] ) );

	$sections = array(
		array(
			'acf_fc_layout'    => 'page_hero',
			'image'            => $m[ $c['hero']['image'] ],
			'eyebrow'          => $c['hero']['eyebrow'],
			'heading'          => $c['hero']['heading'],
			'text'             => $c['hero']['text'],
			'button_primary'   => dc_demo_link( $contact, 'Request a quote' ),
			'button_secondary' => empty( $c['gallery'] )
				? dc_demo_link( get_post_type_archive_link( 'project' ), 'View our projects' )
				: dc_demo_link( '#gallery', $c['hero']['gallery_link'] ),
			'breadcrumb'       => 1,
		),
		array(
			'acf_fc_layout' => 'service_detail',
			'eyebrow'       => $c['detail']['eyebrow'],
			'heading'       => $c['detail']['heading'],
			'body'          => implode( "\n", $c['detail']['body'] ),
			'list_title'    => 'What we can include',
			'list'          => array_map( fn( $t ) => array( 'item' => $t ), $c['detail']['list'] ),
			'facts'         => array_map(
				fn( $label, $value ) => array( 'label' => $label, 'value' => $value ),
				array_keys( $c['detail']['facts'] ),
				$c['detail']['facts']
			),
			'show_contact'  => 1,
		),
		array(
			'acf_fc_layout' => 'options_grid',
			'eyebrow'       => $c['options']['eyebrow'],
			'heading'       => $c['options']['heading'],
			'intro'         => $c['options']['intro'],
			'items'         => array_map(
				fn( $title, $text ) => array( 'image' => '', 'title' => $title, 'text' => $text ),
				array_keys( $c['options']['items'] ),
				$c['options']['items']
			),
		),
	);

	if ( ! empty( $c['gallery'] ) ) {
		foreach ( $c['gallery']['captions'] as $file => $caption ) {
			dc_demo_caption( $m[ $file ], $caption );
		}
		$sections[] = array(
			'acf_fc_layout' => 'photo_gallery',
			'eyebrow'       => 'Recent work',
			'heading'       => $c['gallery']['heading'],
			'intro'         => $c['gallery']['intro'],
			'images'        => array_map( fn( $f ) => $m[ $f ], array_keys( $c['gallery']['captions'] ) ),
			'link'          => dc_demo_link( get_post_type_archive_link( 'project' ), 'View all projects' ),
		);
	}

	$sections[] = $c['testimonial'] ?? $shared['testimonial'];
	$sections[] = array(
		'acf_fc_layout' => 'process',
		'eyebrow'       => 'How it works',
		'heading'       => $c['process']['heading'],
		'intro'         => 'One point of contact from the first visit to the final handover.',
		'steps'         => array_map(
			fn( $title, $text ) => array( 'title' => $title, 'text' => $text ),
			array_keys( $c['process']['steps'] ),
			$c['process']['steps']
		),
		'button'        => dc_demo_link( $contact, 'Contact us' ),
	);
	$sections[] = array(
		'acf_fc_layout' => 'faqs',
		'eyebrow'       => $c['faqs']['eyebrow'],
		'heading'       => $c['faqs']['heading'],
		'button'        => dc_demo_link( $contact, 'Contact us' ),
		'items'         => array_map(
			fn( $q, $a ) => array( 'question' => $q, 'answer' => '<p>' . $a . '</p>' ),
			array_keys( $c['faqs']['items'] ),
			$c['faqs']['items']
		),
	);
	$sections[] = array(
		'acf_fc_layout' => 'contact_panel',
		'eyebrow'       => 'Get in touch',
		'heading'       => $c['contact']['heading'],
		'text'          => $c['contact']['text'],
		'points'        => array_map( fn( $t ) => array( 'text' => $t ), $c['contact']['points'] ),
		'button'        => '',
		'image'         => $m[ $c['contact']['image'] ],
	);

	update_field( 'field_dc_sections', $sections, $post_id );
}

/**
 * Kitchens.
 *
 * @param int   $post_id Service post ID.
 * @param array $m       Demo media IDs keyed by file name.
 * @param array $shared  Shared links and rows.
 */
function dc_demo_service_kitchens( $post_id, $m, $shared ) {
	dc_demo_service_page(
		$post_id,
		$m,
		$shared,
		array(
			'excerpt' => 'Kitchen refurbishments, kitchen extensions and open-plan knock-throughs in Chippenham, Corsham and North Wiltshire. Owner-managed from start to finish.',
			'hero'    => array(
				'image'        => 'kitchen-marble',
				'eyebrow'      => 'Kitchens in Chippenham & North Wiltshire',
				'heading'      => 'Kitchens',
				'text'         => 'Kitchen refurbishments, kitchen extensions and open-plan kitchen-diners, built around how your family lives and managed from start to finish by Josh and Callum.',
				'gallery_link' => 'See our kitchens',
			),
			'detail'  => array(
				'eyebrow' => 'Kitchens',
				'heading' => 'The heart of the home, done properly',
				'body'    => array(
					'<p>The kitchen is where most families spend their time, and getting it right makes a difference every day. Deeprose &amp; Carter Developments plan and build <strong>kitchens in Chippenham, Corsham, Calne, Malmesbury, Melksham</strong> and the villages of North Wiltshire, from a straightforward refurbishment to a new kitchen-diner as part of an extension.</p>',
					'<p>Because we are builders as well as fitters, we can take on the work that usually holds a kitchen project back: taking out walls, moving doors and windows, levelling floors and rerouting services. Josh or Callum oversees every job, so you have one point of contact and one team responsible for the whole result.</p>',
					'<h2>Kitchen refurbishments</h2>',
					'<p>If the layout works but the room is tired, a refurbishment can transform it. We strip out the old kitchen, update the electrics and plumbing, make good the walls and ceilings, lay new flooring and fit your new units, worktops and appliances, then finish with tiling and decoration.</p>',
					'<h2>Open-plan kitchen-diners</h2>',
					'<p>Joining a kitchen to the dining or living room is one of the most popular changes we make. Removing a <strong>load-bearing wall</strong> needs a structural engineer\'s calculations, a steel beam and <strong>building regulations approval</strong>, and we arrange all of it. The result is a bright, sociable space with room for an island, a family table and doors on to the garden.</p>',
					'<h2>Kitchen extensions</h2>',
					'<p>Where there simply is not enough room, a kitchen extension adds the space you need. We build the extension and fit the kitchen as one project, so the structure, services and finishes are planned together from the start.</p>',
					'<h3>Your kitchen, your choice</h3>',
					'<p>We are happy to fit a kitchen from your chosen supplier or designer, from bespoke painted cabinetry to a high-quality supplier range, and we can coordinate measuring and delivery with them so everything arrives when the room is ready.</p>',
				),
				'list'    => array(
					'Kitchen design coordination with your supplier',
					'Strip-out and disposal of the old kitchen',
					'Wall removals and steel beams',
					'Structural engineer and building control',
					'Moving doors, windows and openings',
					'Electrics, lighting and extra sockets',
					'Plumbing and appliance connections',
					'Underfloor heating',
					'Plastering and making good',
					'Floor levelling and new flooring',
					'Unit, worktop and appliance fitting',
					'Islands, larders and utility rooms',
					'Tiling and splashbacks',
					'Decoration and final finishing',
				),
				'facts'   => array(
					'Managed by'   => 'Josh or Callum',
					'Site visit'   => 'Free, no obligation',
					'Structural work' => 'Engineer and building control arranged',
					'Kitchen supply' => 'Your choice of supplier',
					'Areas'        => 'Chippenham & North Wiltshire',
				),
			),
			'options' => array(
				'eyebrow' => 'Kitchen projects',
				'heading' => 'What kind of kitchen project?',
				'intro'   => 'Every kitchen starts with how you want to use the room. We will look at the options with you at the site visit.',
				'items'   => array(
					'Kitchen refurbishment'    => 'A new kitchen in the existing room, with updated electrics, plumbing, flooring and finishes.',
					'Open-plan kitchen-diner'  => 'Walls taken out to join the kitchen, dining and living space into one bright room.',
					'Kitchen extension'        => 'More floor space for a larger kitchen, an island and a family table, often with doors to the garden.',
					'Utility and boot rooms'   => 'Laundry, storage and a place for muddy boots and dogs, keeping the main kitchen clear.',
					'Period and stone homes'   => 'Kitchens in older and listed houses, working with uneven walls, beams, flagstones and original features.',
					'Layout changes'           => 'Moving the kitchen to a different room, or reworking doors and windows to make the space work harder.',
				),
			),
			'gallery' => array(
				'heading'  => 'Our kitchens',
				'intro'    => 'A selection of kitchens we have built and fitted across North Wiltshire. Click any photo to see it full size.',
				'captions' => array(
					'kitchen-marble'    => 'Kitchen-diner',
					'kitchen-open-plan' => 'Open-plan kitchen, Sutton Benger',
					'kitchen-island'    => 'Painted kitchen island',
				),
			),
			'process' => array(
				'heading' => 'Your kitchen, step by step',
				'steps'   => array(
					'Site visit'          => 'We look at the room, talk through how you use it and give honest advice on layout and structural options.',
					'Design and supplier' => 'We work with your kitchen designer or supplier and arrange any engineer\'s calculations and approvals.',
					'Quote and programme' => 'An itemised quote and a realistic schedule, so you know the cost and timings before we start.',
					'The build'           => 'Strip-out, structural work, services and plastering, then floors, units, worktops and appliances.',
					'Handover'            => 'Tiling, decoration and a final walk-round together, with building control sign-off where needed.',
				),
			),
			'faqs'    => array(
				'eyebrow' => 'Kitchen FAQs',
				'heading' => 'Questions about kitchens',
				'items'   => array(
					'Do you supply the kitchen or just fit it?'      => 'We fit kitchens from your chosen supplier or designer and handle all the building work around them. If you have not chosen a kitchen yet, we are happy to recommend suppliers we know and trust.',
					'Can you knock through to make an open-plan kitchen?' => 'Yes. If the wall is load-bearing, we arrange a structural engineer to design the steel beam and supports, and manage the building regulations approval and inspections for you.',
					'How much does a new kitchen cost?'              => 'It depends on the size of the room, the building work involved and the kitchen you choose, so we do not give guide prices without seeing your home. After a free site visit we provide a clear, itemised quote.',
					'How long will we be without a kitchen?'         => 'It depends on the scope of the work. We give you a realistic programme with your quote, plan the work to keep the time without a kitchen as short as we can, and can help you set up a temporary kitchen elsewhere in the house.',
					'Do I need building regulations approval for a new kitchen?' => 'Replacing a kitchen like for like does not usually need approval, but removing a load-bearing wall, adding new drainage or extending does. Electrical work must also meet the regulations. We will tell you what applies and arrange it.',
					'Can you fit a kitchen in a listed or period home?' => 'Yes. We regularly work in older stone houses and take care with original features such as beams, flagstones and fireplaces. Listed buildings may need listed building consent, and we can help with that.',
				),
			),
			'contact' => array(
				'heading' => 'Planning a new kitchen?',
				'text'    => 'Tell us about your kitchen and how you would like it to work. Josh or Callum will arrange a free site visit and give you honest advice, with no obligation.',
				'points'  => array( 'Free site visit and itemised quote', 'Owner-managed from start to finish', 'Structural work and fitting by one team', 'Trusted, tidy and reliable trades' ),
				'image'   => 'kitchen-open-plan',
			),
		)
	);
}

/**
 * Loft and garage conversions.
 *
 * @param int   $post_id Service post ID.
 * @param array $m       Demo media IDs keyed by file name.
 * @param array $shared  Shared links and rows.
 */
function dc_demo_service_conversions( $post_id, $m, $shared ) {
	dc_demo_service_page(
		$post_id,
		$m,
		$shared,
		array(
			'excerpt' => 'Loft and garage conversions in Chippenham, Corsham and North Wiltshire. Extra bedrooms, offices and living space, with planning and approvals handled.',
			'hero'    => array(
				'image'        => 'team-plans',
				'eyebrow'      => 'Conversions in Chippenham & North Wiltshire',
				'heading'      => 'Loft & garage conversions',
				'text'         => 'Turn an unused loft or garage into a bedroom, home office or living space, with the structure, approvals and finish managed from start to finish by Josh and Callum.',
			),
			'testimonial' => array(
				'acf_fc_layout' => 'testimonial',
				'eyebrow'       => 'Client story',
				'pull_quote'    => 'Super tidy and lovely to have around the house.',
				'body'          => '<p>We recently had our garage converted by Josh and Calum and I was super impressed by their work. They were super tidy and lovely to have around the house. The team kept us well informed and I would recommend them to anyone. Thank you all!</p>',
				'name'          => 'Jon & Amy Ladd',
				'project'       => 'Garage conversion',
				'link'          => $shared['testimonial']['link'] ?? '',
			),
			'detail'  => array(
				'eyebrow' => 'Conversions',
				'heading' => 'Make more of the space you have',
				'body'    => array(
					'<p>If you need more room but do not want to move or give up the garden, a conversion is often the answer. Deeprose &amp; Carter Developments carry out <strong>loft conversions and garage conversions in Chippenham, Corsham, Calne, Malmesbury, Melksham</strong> and across North Wiltshire, creating extra bedrooms, en suites, home offices, playrooms and annexes.</p>',
					'<p>Josh or Callum oversees every conversion, so you have one point of contact from the first visit to the final sign-off, and a team of trusted trades working to the same standard.</p>',
					'<h2>Loft conversions</h2>',
					'<p>A loft conversion adds a new room, or a whole new floor, without using any of your garden. The right type depends on the shape of your roof, the head height available and the space you want, from a simple <strong>roof light conversion</strong> to a <strong>dormer</strong> or <strong>hip-to-gable</strong> conversion that adds full-height space.</p>',
					'<p>Many loft conversions can be built under <strong>permitted development</strong>, within limits on volume and design, while others need <strong>planning permission</strong>, particularly in conservation areas or on listed buildings. Every loft conversion needs <strong>building regulations approval</strong>, covering the structure, a safe staircase, fire protection and escape, insulation and ventilation. If you share a wall with a neighbour, the <strong>Party Wall Act</strong> may apply too. We guide you through all of it.</p>',
					'<h2>Garage conversions</h2>',
					'<p>An integral or attached garage is often used for little more than storage. Converting it creates a practical ground-floor room such as a home office, playroom, utility room, gym or bedroom with an en suite.</p>',
					'<p>We fill in the garage door opening with walls and windows to match the house, insulate the floor, walls and ceiling, and add heating, lighting and power so it feels part of the home. Most garage conversions need building regulations approval, and some homes, particularly on newer estates, have conditions that mean planning permission is needed too. We will check before you commit.</p>',
				),
				'list'    => array(
					'Roof light, dormer and hip-to-gable lofts',
					'Integral and attached garage conversions',
					'Bedrooms, en suites and shower rooms',
					'Home offices, playrooms and gyms',
					'Planning and permitted development advice',
					'Building regulations and building control',
					'Structural engineer coordination',
					'Party wall arrangements',
					'New staircases and fire protection',
					'Steelwork and floor strengthening',
					'Insulation and ventilation',
					'Roof lights, dormers and windows',
					'Electrics, heating and plumbing',
					'Plastering, joinery and decoration',
				),
				'facts'   => array(
					'Managed by'       => 'Josh or Callum',
					'Site visit'       => 'Free, no obligation',
					'Planning'         => 'Advice included',
					'Building control' => 'Managed for you',
					'Areas'            => 'Chippenham & North Wiltshire',
				),
			),
			'options' => array(
				'eyebrow' => 'Types of conversion',
				'heading' => 'Which conversion suits your home?',
				'intro'   => 'The best option depends on your roof, your garage and how you want to use the space. We will talk it through at your site visit.',
				'items'   => array(
					'Roof light loft'        => 'Uses the existing roof shape with roof lights added, often the simplest loft conversion where there is enough head height.',
					'Dormer loft'            => 'A box or pitched dormer extends the roof to add full-height floor space and room for a bathroom.',
					'Hip-to-gable loft'      => 'Builds up a sloping side of the roof into a vertical gable, opening up more usable space in many semi-detached and detached homes.',
					'Integral garage'        => 'A garage within the footprint of the house, converted into a warm, well-lit room with a window in place of the door.',
					'Attached garage'        => 'A garage beside the house, converted on its own or combined with an extension for a larger space.',
					'Annexe'                 => 'A detached garage or outbuilding turned into self-contained space for family, guests or working from home. Usually needs planning permission.',
				),
			),
			'process' => array(
				'heading' => 'Your conversion, step by step',
				'steps'   => array(
					'Site visit'           => 'We look at the loft or garage, check the head height and structure, and talk through what is possible.',
					'Design and approvals' => 'We work with your designer and engineer and help with planning, building regulations and party wall notices.',
					'Quote and programme'  => 'An itemised quote and a realistic schedule, so you know the cost and timings before we start.',
					'The build'            => 'Structure, staircase, windows and insulation, then services, plastering and finishes, with Josh or Callum overseeing every stage.',
					'Handover'             => 'Building control sign-off, a final walk-round together and a clean, tidy home.',
				),
			),
			'faqs'    => array(
				'eyebrow' => 'Conversion FAQs',
				'heading' => 'Questions about conversions',
				'items'   => array(
					'Is my loft suitable for a conversion?'           => 'It depends mainly on the head height, the roof structure and where a new staircase can go. We check all three at a free site visit and give you an honest view of what is possible.',
					'Do I need planning permission for a loft conversion?' => 'Not always. Many loft conversions fall under permitted development, within limits on volume and design. Front dormers, larger roof changes and homes in conservation areas or listed buildings usually need planning permission. We will advise on your home.',
					'Do I need planning permission to convert my garage?' => 'Many garage conversions do not, but some homes, especially on newer estates, have planning conditions that remove permitted development rights. Building regulations approval is almost always needed. We will check before any work starts.',
					'Can we stay at home during a loft conversion?'   => 'Usually, yes. Much of the work is carried out from the outside and within the loft itself, and we plan the stage where we open up the new staircase carefully to keep disruption to a minimum.',
					'How much does a conversion cost?'                => 'It depends on the type of conversion, the structure and the finishes, so we do not give guide prices without seeing your home. After a free site visit we provide a clear, itemised quote with no hidden costs.',
					'Will a conversion add value to my home?'         => 'A well-built extra bedroom or living space generally makes a home more appealing and more valuable, as long as it is properly approved and finished. We make sure you have the building control completion certificate for when you come to sell.',
				),
			),
			'contact' => array(
				'heading' => 'Thinking about a conversion?',
				'text'    => 'Tell us about your loft or garage and what you would like to use it for. Josh or Callum will arrange a free site visit and give you honest advice, with no obligation.',
				'points'  => array( 'Free site visit and itemised quote', 'Owner-managed from start to finish', 'Planning and building regulations support', 'Trusted, tidy and reliable trades' ),
				'image'   => 'hallway-stairs',
			),
		)
	);
}

/**
 * Renovations.
 *
 * @param int   $post_id Service post ID.
 * @param array $m       Demo media IDs keyed by file name.
 * @param array $shared  Shared links and rows.
 */
function dc_demo_service_renovations( $post_id, $m, $shared ) {
	dc_demo_service_page(
		$post_id,
		$m,
		$shared,
		array(
			'excerpt' => 'Full house, period and listed property renovations in Chippenham, Corsham and North Wiltshire. Owner-managed, with care for stone, lime and original features.',
			'hero'    => array(
				'image'        => 'stone-house',
				'eyebrow'      => 'Renovations in Chippenham & North Wiltshire',
				'heading'      => 'House renovations',
				'text'         => 'Full house, period and listed property renovations, from stripping back to the final coat of paint, managed from start to finish by Josh and Callum.',
				'gallery_link' => 'See our renovations',
			),
			'detail'  => array(
				'eyebrow' => 'Renovations',
				'heading' => 'Bringing homes back to their best',
				'body'    => array(
					'<p>Whether you have bought a house that needs everything doing or want to bring a much-loved home up to date, a renovation is a chance to get it exactly right. Deeprose &amp; Carter Developments carry out <strong>house renovations in Chippenham, Corsham, Calne, Malmesbury, Melksham</strong> and the villages of North Wiltshire, from single rooms to complete homes, inside and out.</p>',
					'<p>A renovation brings together more trades than almost any other project, and the order they work in matters. Josh or Callum project-manages every renovation personally, so you have one point of contact and a carefully planned programme, rather than a string of separate contractors to coordinate yourself.</p>',
					'<h2>Full house renovations</h2>',
					'<p>For a complete renovation we work from the structure outwards: any structural repairs and layout changes first, then rewiring, replumbing and heating, followed by plastering, joinery, kitchens and bathrooms, flooring and decoration. Where it is needed, we also take on the outside, from repointing and drainage to driveways, patios and landscaping, so the whole property is finished to the same standard.</p>',
					'<h2>Period and listed properties</h2>',
					'<p>Much of North Wiltshire is built in Bath and Cotswold stone, and older homes need a different approach to modern ones. We use breathable materials such as <strong>lime mortar and lime plaster</strong> where they are right for the building, repair rather than replace original features where we can, and take care to match stone and detailing.</p>',
					'<p>Work to a <strong>listed building</strong>, inside or out, usually needs <strong>listed building consent</strong> as well as building regulations approval, and homes in <strong>conservation areas</strong> have extra planning controls. We can work with your architect or heritage consultant and help you through the process.</p>',
					'<h2>Fire, flood and insurance work</h2>',
					'<p>After fire or water damage, we can strip out, dry, repair and rebuild the affected rooms, working alongside your insurer or loss adjuster to get your home back to how it was, or better.</p>',
				),
				'list'    => array(
					'Full house renovations, inside and out',
					'Period and listed property renovations',
					'Structural repairs and alterations',
					'Layout changes and open-plan living',
					'Rewiring and new electrics',
					'Replumbing and new heating systems',
					'Lime plastering and lime pointing',
					'Stonework repairs and repointing',
					'Kitchens and bathrooms',
					'Joinery, doors and staircases',
					'Flooring and decoration',
					'Fire and flood damage repairs',
					'Insurance reinstatement work',
					'Driveways, patios and landscaping',
				),
				'facts'   => array(
					'Managed by'    => 'Josh or Callum',
					'Site visit'    => 'Free, no obligation',
					'Period homes'  => 'Lime and stone specialists',
					'Approvals'     => 'Listed building and building control support',
					'Areas'         => 'Chippenham & North Wiltshire',
				),
			),
			'options' => array(
				'eyebrow' => 'Types of renovation',
				'heading' => 'What kind of renovation?',
				'intro'   => 'Every renovation is different. We will look at the whole property with you and help you decide what to tackle, and in what order.',
				'items'   => array(
					'Full house renovation'    => 'A complete renovation from top to bottom, often with layout changes, new services and the outside finished too.',
					'Period properties'        => 'Sensitive renovation of older homes, using lime, stone and traditional details where they are right for the building.',
					'Listed buildings'         => 'Careful work to listed homes, with support through listed building consent and approvals.',
					'Open-plan living'         => 'Walls taken out and rooms rearranged to suit the way you live now.',
					'Fire and flood damage'    => 'Strip-out, drying, repairs and rebuilding, working alongside your insurer or loss adjuster.',
					'Room-by-room updates'     => 'Kitchens, bathrooms and living spaces renovated in stages, planned so each stage fits with the next.',
				),
			),
			'gallery' => array(
				'heading'  => 'Our renovations',
				'intro'    => 'A selection of renovations we have completed across North Wiltshire. Click any photo to see it full size.',
				'captions' => array(
					'extension-arches' => 'Stone extension, Calne',
					'hallway-stairs'   => 'Hallway and oak staircase, Calne',
					'utility-room'     => 'Utility room, Calne',
					'kitchen-marble'   => 'Kitchen-diner',
					'arched-shower'    => 'Arched opening and plasterwork, Calne',
					'stone-house'      => 'Period stone house',
				),
			),
			'process' => array(
				'heading' => 'Your renovation, step by step',
				'steps'   => array(
					'Site visit'           => 'We look around the whole property, talk through your plans and give honest advice on priorities.',
					'Survey and approvals' => 'We work with your architect, engineer or heritage adviser and help with building regulations and listed building consent.',
					'Quote and programme'  => 'An itemised quote and a clear programme showing the order of work, so you know what to expect.',
					'The build'            => 'Structure first, then services, plastering and finishes, with Josh or Callum overseeing every trade.',
					'Handover'             => 'Building control sign-off, a final walk-round together and a clean, tidy home.',
				),
			),
			'faqs'    => array(
				'eyebrow' => 'Renovation FAQs',
				'heading' => 'Questions about renovations',
				'items'   => array(
					'Do you renovate listed buildings?'               => 'Yes. We work on period and listed homes and understand the need for breathable materials such as lime, careful repairs and matching stone. Most work to a listed building needs listed building consent, and we can help you with it.',
					'Can we live in the house during a renovation?'   => 'It depends on how much of the house is being renovated. Many clients stay at home while we work in stages; for a full renovation with rewiring and replumbing, moving out for part of the work can be quicker and easier. We will talk it through honestly at the start.',
					'How much does a house renovation cost?'          => 'Every property is different, so we do not give guide prices without seeing it. After a free site visit we provide a clear, itemised quote, so you can see where the money goes and decide on priorities.',
					'Where should a renovation start?'                => 'With anything structural, damp or roof-related, then the services hidden in the walls and floors, and the finishes last. We plan the order of work so nothing has to be undone later.',
					'Do you work on insurance claims?'                => 'Yes. After fire or water damage we can work alongside your insurer or loss adjuster, providing quotes and carrying out the strip-out, repairs and reinstatement.',
					'Can you finish the outside as well?'             => 'Yes. We can take on repointing, stonework, drainage, driveways, patios and landscaping, so the outside of the property is finished to the same standard as the inside.',
				),
			),
			'contact' => array(
				'heading' => 'Planning a renovation?',
				'text'    => 'Tell us about the property and what you would like to achieve. Josh or Callum will arrange a free site visit and give you honest advice, with no obligation.',
				'points'  => array( 'Free site visit and itemised quote', 'Owner-managed from start to finish', 'Experience with period and listed homes', 'Trusted, tidy and reliable trades' ),
				'image'   => 'team-plans',
			),
		)
	);
}

/**
 * Structural alterations.
 *
 * @param int   $post_id Service post ID.
 * @param array $m       Demo media IDs keyed by file name.
 * @param array $shared  Shared links and rows.
 */
function dc_demo_service_structural( $post_id, $m, $shared ) {
	dc_demo_service_page(
		$post_id,
		$m,
		$shared,
		array(
			'excerpt' => 'Load-bearing wall removal, steel beams, new openings and layout changes in Chippenham, Corsham and North Wiltshire. Engineer and building control arranged.',
			'hero'    => array(
				'image'        => 'kitchen-open-plan',
				'eyebrow'      => 'Structural work in Chippenham & North Wiltshire',
				'heading'      => 'Structural alterations',
				'text'         => 'Wall removals, steel beams, new openings and complete layout changes, carried out safely and signed off properly, with Josh or Callum overseeing every stage.',
				'gallery_link' => 'See our work',
			),
			'detail'  => array(
				'eyebrow' => 'Structural alterations',
				'heading' => 'Change the layout, safely',
				'body'    => array(
					'<p>Sometimes the best way to improve a home is to change how the rooms fit together. Deeprose &amp; Carter Developments carry out <strong>structural alterations in Chippenham, Corsham, Calne, Malmesbury, Melksham</strong> and across North Wiltshire, from taking out a single wall to reworking the whole ground floor.</p>',
					'<p>Structural work has to be done in the right order, with the right supports, and signed off properly. Josh or Callum oversees every job personally, and we coordinate the engineer, building control and every trade involved, so you deal with one team.</p>',
					'<h2>Load-bearing wall removal</h2>',
					'<p>Removing a <strong>load-bearing wall</strong> is the most common structural change we make, usually to create an open-plan kitchen, dining and living space. A <strong>structural engineer</strong> designs the steel beam and supports, we give <strong>building control</strong> notice before starting, and the work is inspected as it goes. We prop the structure safely while the wall comes out, install the steel on padstones, and make good so the beam disappears into the finished ceiling.</p>',
					'<h2>New openings and layout changes</h2>',
					'<p>We form new door and window openings, widen existing ones for bifold or steel-framed doors, remove chimney breasts, move staircases and rearrange rooms. In older stone homes we take particular care with walls that may be thick, rubble-filled or built with lime, and with the lintels and supports above them.</p>',
					'<h2>Party walls and approvals</h2>',
					'<p>Work that affects a wall shared with a neighbour, such as removing a chimney breast or inserting a beam into a party wall, may come under the <strong>Party Wall Act</strong>. We will tell you when notices are needed and work with your surveyor. Every structural alteration needs <strong>building regulations approval</strong>, and we make sure you receive the completion certificate at the end.</p>',
					'<h3>Insurance and repair work</h3>',
					'<p>We also carry out structural repairs, including work following subsidence, fire or water damage, alongside your insurer or loss adjuster.</p>',
				),
				'list'    => array(
					'Load-bearing wall removal',
					'Steel beams, padstones and columns',
					'Structural engineer coordination',
					'Building regulations and building control',
					'Party wall arrangements',
					'Temporary propping and support',
					'New door and window openings',
					'Widened openings for bifold doors',
					'Chimney breast removal',
					'Staircase moves and alterations',
					'Open-plan layout changes',
					'Structural repairs and insurance work',
					'Making good, plastering and decoration',
				),
				'facts'   => array(
					'Managed by'       => 'Josh or Callum',
					'Site visit'       => 'Free, no obligation',
					'Engineer'         => 'Arranged for you',
					'Building control' => 'Managed for you',
					'Areas'            => 'Chippenham & North Wiltshire',
				),
			),
			'options' => array(
				'eyebrow' => 'Structural work',
				'heading' => 'What do you need to change?',
				'intro'   => 'Most structural work starts with a simple question: what would make the house work better? We will look at the options with you at the site visit.',
				'items'   => array(
					'Open-plan living'     => 'Walls between the kitchen, dining and living rooms taken out to create one connected space.',
					'New openings'         => 'New doors and windows, or wider openings for bifold, sliding and steel-framed doors.',
					'Chimney breasts'      => 'Chimney breasts removed to free up floor space, with the remaining stack properly supported.',
					'Staircases'           => 'Staircases moved, turned or replaced to open up a hallway or make room for a new layout.',
					'Whole-floor layouts'  => 'A complete rethink of the ground floor, with rooms rearranged to suit how you live.',
					'Structural repairs'   => 'Repairs to walls, lintels and floors, including insurance work after subsidence, fire or water damage.',
				),
			),
			'gallery' => array(
				'heading'  => 'Our structural work',
				'intro'    => 'Walls opened up and layouts changed across North Wiltshire. Click any photo to see it full size.',
				'captions' => array(
					'team-plans'     => 'Josh and Callum on site',
					'kitchen-marble' => 'Kitchen-diner',
					'kitchen-island' => 'Painted kitchen island',
				),
			),
			'process' => array(
				'heading' => 'Your alterations, step by step',
				'steps'   => array(
					'Site visit'           => 'We look at the walls and structure involved and talk through what you want the space to do.',
					'Engineer and approvals' => 'A structural engineer designs the beams and supports, and we give building control notice.',
					'Quote and programme'  => 'An itemised quote and a realistic schedule, so you know the cost and timings before we start.',
					'The work'             => 'Propping, removal, steelwork and inspections, then making good, with Josh or Callum overseeing every stage.',
					'Handover'             => 'Building control sign-off, a completion certificate and a clean, tidy home.',
				),
			),
			'faqs'    => array(
				'eyebrow' => 'Structural FAQs',
				'heading' => 'Questions about structural work',
				'items'   => array(
					'How do I know if a wall is load-bearing?'            => 'It is not always obvious, especially in older houses. We look at the direction of the joists, what sits above the wall and how the house was built, and a structural engineer confirms it before any work is planned.',
					'Do I need building regulations approval to remove a wall?' => 'Yes, if the wall is load-bearing or the work affects the structure, fire safety or escape routes. We arrange the engineer\'s calculations, give building control notice and make sure you receive a completion certificate.',
					'Do I need a party wall agreement?'                   => 'If the work affects a wall shared with a neighbour, such as inserting a beam into it or removing a chimney breast, the Party Wall Act may apply and notices must be served. We will tell you when it applies.',
					'How much does it cost to remove a load-bearing wall?' => 'It depends on the length of the opening, what the wall is supporting and the finish you want, so we do not give guide prices without seeing it. After a free site visit we provide a clear, itemised quote.',
					'Is it messy?'                                        => 'Removing a wall does create dust, so we seal off the work area, protect floors and furniture, and clean up as we go. We will talk you through how to keep the rest of the house usable.',
					'Can you remove walls in an old stone house?'        => 'Yes. Older stone walls are often thick and built with lime, so they need a careful approach and the right supports. We have plenty of experience with period homes across North Wiltshire.',
				),
			),
			'contact' => array(
				'heading' => 'Planning structural changes?',
				'text'    => 'Tell us about your home and what you would like to change. Josh or Callum will arrange a free site visit and give you honest advice, with no obligation.',
				'points'  => array( 'Free site visit and itemised quote', 'Owner-managed from start to finish', 'Engineer and building control arranged', 'Trusted, tidy and reliable trades' ),
				'image'   => 'hallway-stairs',
			),
		)
	);
}

/**
 * Groundworks and landscaping.
 *
 * @param int   $post_id Service post ID.
 * @param array $m       Demo media IDs keyed by file name.
 * @param array $shared  Shared links and rows.
 */
function dc_demo_service_groundworks( $post_id, $m, $shared ) {
	dc_demo_service_page(
		$post_id,
		$m,
		$shared,
		array(
			'excerpt' => 'Groundworks and landscaping in Chippenham, Corsham and North Wiltshire: foundations, drainage, retaining walls, driveways, patios and paths.',
			'hero'    => array(
				'image'        => 'garden-terrace',
				'eyebrow'      => 'Groundworks in Chippenham & North Wiltshire',
				'heading'      => 'Groundworks & landscaping',
				'text'         => 'Site clearance, foundations, drainage, retaining walls, driveways, patios and paths, built on solid ground and finished to last.',
				'gallery_link' => 'See our landscaping',
			),
			'detail'  => array(
				'eyebrow' => 'Groundworks & landscaping',
				'heading' => 'Good work starts below ground',
				'body'    => array(
					'<p>The work you cannot see decides how well everything above it performs. Deeprose &amp; Carter Developments carry out <strong>groundworks and hard landscaping in Chippenham, Corsham, Calne, Malmesbury, Melksham</strong> and across North Wiltshire, both as part of our own extensions and new builds and as standalone projects.</p>',
					'<p>Josh or Callum oversees every job, from the first dig to the final sweep, so the levels, drainage and finishes are planned together and done properly.</p>',
					'<h2>Groundworks</h2>',
					'<p>We clear and excavate sites, dig and pour <strong>foundations</strong> for extensions, conversions and new builds, and lay <strong>drainage</strong>, from new connections and soakaways to surface water and land drainage that keeps gardens and buildings dry. Foundations and drainage for building work are inspected by building control, and we arrange those inspections as part of the job.</p>',
					'<h2>Driveways, patios and paths</h2>',
					'<p>A well-laid <strong>driveway or patio</strong> starts with a properly prepared, compacted sub-base and the right falls for water to run away. We lay natural stone, sandstone and porcelain paving, block paving and gravel. Most new or replacement front driveways need to use <strong>permeable surfacing</strong>, or drain to a lawn or border, to avoid needing planning permission, and we will recommend the right option for your home.</p>',
					'<h2>Retaining walls, steps and garden structures</h2>',
					'<p>Sloping gardens are common across North Wiltshire. We build <strong>retaining walls</strong> in stone, block and render, steps and terraces that make a garden easier to use, and features such as raised beds, walling and pergolas, matching the stone and style of the house.</p>',
				),
				'list'    => array(
					'Site clearance and excavation',
					'Foundations for extensions and new builds',
					'Drainage, soakaways and connections',
					'Land and surface water drainage',
					'Retaining walls and terracing',
					'Driveways and parking areas',
					'Permeable paving and gravel',
					'Patios in natural stone and porcelain',
					'Paths and garden steps',
					'Stone walling and repairs',
					'Raised beds and planters',
					'Pergolas and garden structures',
					'Turfing and finishing',
				),
				'facts'   => array(
					'Managed by'  => 'Josh or Callum',
					'Site visit'  => 'Free, no obligation',
					'Drainage'    => 'Designed for your site',
					'Driveways'   => 'Permeable options advised',
					'Areas'       => 'Chippenham & North Wiltshire',
				),
			),
			'options' => array(
				'eyebrow' => 'Groundworks & landscaping',
				'heading' => 'What do you need?',
				'intro'   => 'From the foundations of a new build to a new patio, every job starts with the ground. We will look at your site with you at the visit.',
				'items'   => array(
					'Foundations'          => 'Excavation and foundations for extensions, conversions, garden rooms and new builds.',
					'Drainage'             => 'New drainage, soakaways and land drainage to deal with surface water and wet ground.',
					'Driveways'            => 'New and replacement driveways in block paving, stone, resin-bound or gravel, laid on a solid base.',
					'Patios and terraces'  => 'Natural stone, sandstone and porcelain patios with the right falls, edging and pointing.',
					'Retaining walls'      => 'Walls and terracing that turn a sloping garden into level, usable space.',
					'Paths and steps'      => 'Garden paths, steps and edging that link the house, patio and garden together.',
				),
			),
			'gallery' => array(
				'heading'  => 'Our landscaping',
				'intro'    => 'A selection of groundworks and landscaping we have completed across North Wiltshire. Click any photo to see it full size.',
				'captions' => array(
					'garden-steps'     => 'Garden steps and rendered retaining walls',
					'garden-terrace'   => 'Stone terrace and oak pergola',
					'orangery-dusk'    => 'Orangery-style extension and stone terrace',
					'extension-bifold' => 'Bifold doors and terrace',
					'extension-glazed' => 'Glazed doors to the garden, Calne',
					'orangery-terrace' => 'Orangery-style extension on a stone cottage',
				),
			),
			'process' => array(
				'heading' => 'Your project, step by step',
				'steps'   => array(
					'Site visit'          => 'We look at the levels, ground conditions and drainage, and talk through what you would like.',
					'Design and approvals' => 'We plan levels, falls and drainage, and advise on materials and any approvals needed.',
					'Quote and programme' => 'An itemised quote and a realistic schedule, so you know the cost and timings before we start.',
					'The work'            => 'Excavation, sub-base, drainage and walls, then paving and finishes, with Josh or Callum overseeing every stage.',
					'Handover'            => 'A final walk-round together and a clean, tidy site.',
				),
			),
			'faqs'    => array(
				'eyebrow' => 'Groundworks FAQs',
				'heading' => 'Questions about groundworks',
				'items'   => array(
					'Do I need planning permission for a new driveway?'  => 'Usually not, as long as a new or replacement front driveway uses a permeable surface, or drains water to a lawn or border, rather than on to the road. Other rules apply to dropped kerbs and listed buildings. We will advise on your home.',
					'What is the best patio material?'                  => 'It depends on the style of your home and how you use the garden. Natural stone suits period homes, sandstone and porcelain are hard-wearing and easy to keep clean, and we can show you examples at the site visit.',
					'Can you sort out a waterlogged garden?'            => 'Often, yes. We look at why water is collecting and can install land drains, soakaways or surface water drainage to deal with it, as well as adjusting levels.',
					'Do you only do groundworks as part of a build?'    => 'No. We carry out groundworks for our own extensions and new builds, and also take on standalone driveways, patios, drainage and landscaping projects.',
					'How much does a patio or driveway cost?'           => 'It depends on the area, the ground conditions, the drainage and the materials you choose, so we do not give guide prices without seeing the site. After a free site visit we provide a clear, itemised quote.',
					'Can you build a retaining wall on a sloping garden?' => 'Yes. We build retaining walls in stone, block and render, and for taller walls we work with a structural engineer to make sure the design is right for the ground and the load.',
				),
			),
			'contact' => array(
				'heading' => 'Planning groundworks or landscaping?',
				'text'    => 'Tell us about your site or garden and what you would like to achieve. Josh or Callum will arrange a free site visit and give you honest advice, with no obligation.',
				'points'  => array( 'Free site visit and itemised quote', 'Owner-managed from start to finish', 'Drainage and levels done properly', 'Trusted, tidy and reliable trades' ),
				'image'   => 'garden-steps',
			),
		)
	);
}

/**
 * New builds.
 *
 * @param int   $post_id Service post ID.
 * @param array $m       Demo media IDs keyed by file name.
 * @param array $shared  Shared links and rows.
 */
function dc_demo_service_new_builds( $post_id, $m, $shared ) {
	dc_demo_service_page(
		$post_id,
		$m,
		$shared,
		array(
			'excerpt' => 'New build homes in Chippenham, Corsham and North Wiltshire, from groundworks to handover. Individual homes, replacement dwellings and annexes.',
			'hero'    => array(
				'image'        => 'biddestone-house',
				'eyebrow'      => 'New builds in Chippenham & North Wiltshire',
				'heading'      => 'New builds',
				'text'         => 'New homes built from the ground up, from foundations and drainage to the final finishes, project-managed from start to finish by Josh and Callum.',
			),
			'detail'  => array(
				'eyebrow' => 'New builds',
				'heading' => 'A new home, built to last',
				'body'    => array(
					'<p>Building a new home is one of the biggest projects you will ever take on, and the builder you choose makes all the difference. Deeprose &amp; Carter Developments build <strong>new homes in Chippenham, Corsham, Calne, Malmesbury, Melksham</strong> and the villages of North Wiltshire, from individual houses and replacement dwellings to annexes, as well as commercial new builds.</p>',
					'<p>Josh or Callum project-manages every new build personally, from the first dig to the day you get the keys. You have one point of contact throughout, a clear programme, and a carefully selected team of trusted trades working to the same high standard.</p>',
					'<h2>From planning to handover</h2>',
					'<p>We can build from your architect\'s approved drawings or introduce you to architects and engineers we work with regularly. Before work starts we review the drawings, the <strong>planning conditions</strong> and the <strong>building regulations</strong> approval with you, so there are no surprises once the build is under way.</p>',
					'<p>We carry out the groundworks, foundations and drainage ourselves, then build the structure, roof and envelope before first fix, plastering, second fix and finishes. Building control inspects the work at each key stage, and we make sure you receive the completion certificate at the end.</p>',
					'<h2>Built for North Wiltshire</h2>',
					'<p>Many new homes in the area are built in natural or reconstituted stone to suit local planning policy and the character of the village. We take care with stonework, roofing and detailing so a new house looks as though it belongs, while meeting current standards for insulation, airtightness and energy efficiency.</p>',
					'<h3>Warranties and mortgages</h3>',
					'<p>Mortgage lenders usually require a new home to have a <strong>structural warranty</strong> or a professional consultant\'s certificate. We will talk through the options with you early on and work with your chosen provider and their inspections.</p>',
				),
				'list'    => array(
					'Individual new homes',
					'Replacement dwellings',
					'Annexes and garden buildings',
					'Commercial new builds',
					'Architect and engineer coordination',
					'Planning conditions and building regulations',
					'Site clearance, groundworks and drainage',
					'Foundations and services',
					'Stonework, blockwork and timber frame',
					'Roofing and windows',
					'Electrics, plumbing and heating',
					'Plastering, joinery and decoration',
					'Kitchens and bathrooms',
					'Driveways and landscaping',
				),
				'facts'   => array(
					'Managed by'       => 'Josh or Callum',
					'Site visit'       => 'Free, no obligation',
					'Groundworks'      => 'Carried out in-house',
					'Building control' => 'Managed for you',
					'Areas'            => 'Chippenham & North Wiltshire',
				),
			),
			'options' => array(
				'eyebrow' => 'New build projects',
				'heading' => 'What are you building?',
				'intro'   => 'Every new build is different. We will look at your plot, drawings and plans with you and give honest advice before you commit.',
				'items'   => array(
					'Individual homes'      => 'A new house on your own plot, built to your architect\'s design and finished to your specification.',
					'Replacement dwellings' => 'An existing house taken down and replaced with a new home designed for how you live now.',
					'Annexes'               => 'Self-contained accommodation for family or guests, built in the grounds of an existing home.',
					'Garden buildings'      => 'Garden rooms, studios and home offices built properly, with foundations, insulation and services.',
					'Small developments'    => 'A small number of homes on one site, built and managed as a single project.',
					'Commercial buildings'  => 'New commercial buildings, from groundworks to handover.',
				),
			),
			'process' => array(
				'heading' => 'Your new build, step by step',
				'steps'   => array(
					'Site visit'           => 'We look at the plot and the drawings with you and give honest advice on the build.',
					'Approvals and planning' => 'We review planning conditions, building regulations and warranty requirements, and work with your designers.',
					'Quote and programme'  => 'An itemised quote and a clear programme, so you know the cost and timings before we start.',
					'The build'            => 'Groundworks to roof, then services and finishes, with Josh or Callum overseeing every stage.',
					'Handover'             => 'Building control completion, warranty sign-off and a final walk-round of your new home.',
				),
			),
			'faqs'    => array(
				'eyebrow' => 'New build FAQs',
				'heading' => 'Questions about new builds',
				'items'   => array(
					'Can you build from my architect\'s drawings?'  => 'Yes. We are happy to build from your architect\'s approved drawings, or we can introduce you to architects and structural engineers we work with regularly.',
					'Do you help with planning permission?'        => 'Planning applications are usually prepared by your architect or planning consultant, but we can review the drawings for buildability and cost, and help you deal with planning conditions before and during the build.',
					'Will my new home have a warranty?'            => 'Most mortgage lenders require a new home to have a structural warranty or a professional consultant\'s certificate. We will talk through the options early on and work with your chosen provider.',
					'How much does it cost to build a new house?'  => 'It depends on the size, design, plot and specification, so we do not give guide prices without seeing the drawings and the site. We provide a clear, itemised quote so you can see where the money goes.',
					'How long does a new build take?'              => 'It depends on the size and design of the house and the time of year. We give you a realistic programme with your quote, before any work starts, and keep you updated throughout.',
					'Do you build in stone?'                       => 'Yes. Many of our projects are in natural or reconstituted stone to suit local planning policy and the character of North Wiltshire villages.',
				),
			),
			'contact' => array(
				'heading' => 'Planning a new build?',
				'text'    => 'Tell us about your plot and your plans. Josh or Callum will arrange a free site visit and give you honest advice, with no obligation.',
				'points'  => array( 'Free site visit and itemised quote', 'Owner-managed from start to finish', 'Groundworks to handover by one team', 'Trusted, tidy and reliable trades' ),
				'image'   => 'team-plans',
			),
		)
	);
}
