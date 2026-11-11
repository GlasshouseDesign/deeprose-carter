<?php
/**
 * Area pages for the demo setup: Builders in Chippenham, Corsham and so on.
 *
 * They live under /areas/, are left out of the menus, and are kept out of search engines
 * and the sitemap until Site Settings → Search → "Area pages visible to search engines" is on.
 * Each page has its own local copy, so they are not near-duplicates of each other.
 *
 * @package DeeproseCarter
 */

defined( 'ABSPATH' ) || exit;

/**
 * Build the parent Areas page and one page per town.
 *
 * @param array $m        Demo media IDs keyed by file name.
 * @param array $shared   Shared links and rows: contact_url, testimonial row.
 * @param array $services Service post IDs keyed by slug.
 * @return int[] Area page IDs keyed by town slug.
 */
function dc_demo_areas( $m, $shared, $services ) {
	$project = fn( $slug ) => get_permalink( get_page_by_path( $slug, OBJECT, 'project' ) );

	$parent = dc_demo_post( 'page-areas', array( 'post_type' => 'page', 'post_title' => 'Areas we cover', 'post_name' => 'areas' ) );
	update_post_meta( $parent, '_dc_area', 1 );

	$towns = array(
		'chippenham' => array(
			'town'     => 'Chippenham',
			'image'    => 'kitchen-open-plan',
			'distance' => 'Our home town',
			'council'  => 'Wiltshire Council',
			'villages' => 'Sutton Benger, Biddestone, Kington St Michael, Hullavington, Christian Malford, Langley Burrell, Yatton Keynell and Lacock',
			'intro'    => 'Extensions, kitchens, renovations and new builds in Chippenham and the surrounding villages, from a local team run by its owners.',
			'heading'  => 'Your local builders in Chippenham',
			'body'     => array(
				'<p>Deeprose &amp; Carter Developments is based in Chippenham, and most of our work is within a few miles of the town. Josh and Callum know the area\'s houses well, from Victorian terraces and stone cottages near the town centre to the newer estates at Pewsham, Cepen Park and Hardenhuish, and the stone farmhouses in the villages around.</p>',
				'<p>Being local means we can get to you quickly for a site visit, keep a close eye on every stage of the build and be on hand if you need us after the work is finished. Every project is overseen by Josh or Callum from the first visit to the final handover.</p>',
				'<h2>Recent work near Chippenham</h2>',
				'<p>Our projects close to home include an <a href="' . esc_url( $project( 'sutton-benger' ) ) . '">open-plan kitchen in Sutton Benger</a>, where walls were opened up to create a bright kitchen and dining space, and a <a href="' . esc_url( $project( 'biddestone' ) ) . '">new stone home in Biddestone</a>, built from the groundworks up.</p>',
				'<h2>Planning in Chippenham</h2>',
				'<p>Planning applications and building control in Chippenham are handled by Wiltshire Council. The town centre and several villages, including Biddestone and Lacock, are conservation areas, and many older properties are listed. We will tell you at the site visit what approvals your project is likely to need.</p>',
			),
			'faqs'     => array(
				'Which villages around Chippenham do you cover?' => 'All of them. We regularly work in Sutton Benger, Biddestone, Kington St Michael, Hullavington, Christian Malford, Langley Burrell, Yatton Keynell and Lacock, as well as across the town itself.',
				'Who handles planning for Chippenham?'            => 'Wiltshire Council deals with planning applications and building control for Chippenham and the surrounding villages. We can help you understand what your project needs and work with your architect on the application.',
				'Do you work on newer homes as well as period properties?' => 'Yes. We build extensions and conversions on newer estates around Chippenham as often as we renovate older stone houses. Some newer homes have planning conditions that affect what can be built without permission, so we check those first.',
			),
		),
		'corsham' => array(
			'town'     => 'Corsham',
			'image'    => 'biddestone-house',
			'distance' => 'About 4 miles',
			'council'  => 'Wiltshire Council',
			'villages' => 'Box, Neston, Gastard, Pickwick, Rudloe, Biddestone and Lacock',
			'intro'    => 'Extensions, renovations and stonework in Corsham and the villages around it, from a builder based just up the road in Chippenham.',
			'heading'  => 'Builders in Corsham',
			'body'     => array(
				'<p>Corsham is a stone town in every sense. Bath stone has been quarried beneath it for centuries, and its high street and Pickwick are lined with Georgian and older stone buildings. Building here well means matching that stone, its coursing and its detailing, so a new extension or alteration looks as though it has always been there.</p>',
				'<p>We are based in Chippenham, about four miles away, and work across Corsham and its villages, including Box, Neston, Gastard and Rudloe. Josh or Callum oversees every project personally, with one point of contact from the first visit to the final handover.</p>',
				'<h2>Period and listed homes in Corsham</h2>',
				'<p>Much of central Corsham is a conservation area, and many properties are listed. Work to a listed building usually needs listed building consent as well as building regulations approval, and older stone walls need breathable materials such as lime mortar and lime plaster. We can work with your architect or heritage consultant and help you through the approvals.</p>',
				'<h2>Newer homes too</h2>',
				'<p>Corsham has also grown, with newer homes around the town. We build extensions, kitchens and garage conversions on these just as carefully, and check for any planning conditions that affect what can be built.</p>',
			),
			'faqs'     => array(
				'Can you match Bath stone on an extension in Corsham?' => 'Yes. We take care to match the stone, coursing and detailing of the original house, using reclaimed or new stone as appropriate, so an extension sits naturally alongside it.',
				'Is Corsham in a conservation area?'                   => 'The historic town centre is, and some surrounding villages are too. Conservation areas have extra planning controls, so we will advise on what your project needs at the site visit.',
				'Which villages near Corsham do you cover?'            => 'We cover Box, Neston, Gastard, Pickwick, Rudloe, Biddestone and Lacock, as well as Corsham itself.',
			),
		),
		'calne' => array(
			'town'     => 'Calne',
			'image'    => 'extension-arches',
			'distance' => 'About 6 miles',
			'council'  => 'Wiltshire Council',
			'villages' => 'Derry Hill, Studley, Cherhill, Compton Bassett, Heddington, Bremhill and Hilmarton',
			'intro'    => 'Full renovations, extensions and kitchens in Calne and the surrounding villages, managed from start to finish by the owners.',
			'heading'  => 'Builders in Calne',
			'body'     => array(
				'<p>Calne sits between Chippenham and the Marlborough Downs, with a historic stone town centre, plenty of period cottages and a good number of newer homes. We work across the town and its villages, from Derry Hill and Studley to Cherhill and Heddington.</p>',
				'<p>Our team is based in Chippenham, about six miles away, so we can visit quickly and keep a close eye on your build. Josh or Callum oversees every stage, supported by trusted tradespeople we work with regularly.</p>',
				'<h2>A complete renovation in Calne</h2>',
				'<p>One of our recent projects in Calne was a <a href="' . esc_url( $project( 'calne' ) ) . '">full renovation of a stone house</a>, from top to bottom, inside and out. The work included a single-storey stone extension with arched steel windows, a new kitchen and all the outside landscaped.</p>',
				'<h2>Planning in Calne</h2>',
				'<p>Planning and building control in Calne are handled by Wiltshire Council. The town centre is a conservation area, and some properties are listed, so we will tell you what approvals are likely to be needed and help with the paperwork.</p>',
			),
			'faqs'     => array(
				'Have you worked in Calne before?'        => 'Yes. Recent work includes a full renovation of a stone house in Calne, with a new stone extension, a new kitchen and landscaping.',
				'Which villages around Calne do you cover?' => 'We cover Derry Hill, Studley, Cherhill, Compton Bassett, Heddington, Bremhill and Hilmarton, as well as the town itself.',
				'Can you take on a whole house renovation?' => 'Yes. We manage complete renovations from structural work and new services through to kitchens, bathrooms, decoration and the outside, so you have one team responsible for the whole job.',
			),
		),
		'devizes' => array(
			'town'     => 'Devizes',
			'image'    => 'orangery-terrace',
			'distance' => 'About 11 miles',
			'council'  => 'Wiltshire Council',
			'villages' => 'Rowde, Bromham, Potterne, Urchfont, Bishops Cannings, Seend and Roundway',
			'intro'    => 'Extensions, renovations and structural work in Devizes and the surrounding villages, from an owner-managed team in North Wiltshire.',
			'heading'  => 'Builders in Devizes',
			'body'     => array(
				'<p>Devizes is one of Wiltshire\'s finest market towns, with a remarkable number of listed buildings around the Market Place and the streets leading off it, alongside Victorian terraces and newer homes on the edges of town. We work across Devizes and its villages, including Rowde, Bromham, Potterne and Urchfont.</p>',
				'<p>Every project is overseen by Josh or Callum, from the first site visit to the final handover. You have one point of contact throughout, and a team of trusted trades working to the same standard.</p>',
				'<h2>Listed buildings and conservation areas</h2>',
				'<p>With so many listed buildings and a large conservation area, projects in Devizes often need extra care and extra approvals. Work to a listed building usually needs listed building consent, and older properties need breathable materials such as lime. We are happy to work with your architect or heritage adviser and help you through the process.</p>',
				'<h2>Extensions and conversions</h2>',
				'<p>For newer homes, we build single storey, two storey and wrap-around extensions, kitchen extensions and garage conversions, and check any planning conditions before work begins.</p>',
			),
			'faqs'     => array(
				'Do you work in Devizes?'                         => 'Yes. Devizes is about eleven miles from our base in Chippenham, and we work across the town and its villages, including Rowde, Bromham, Potterne, Urchfont, Bishops Cannings, Seend and Roundway.',
				'Can you work on listed buildings in Devizes?'    => 'Yes. We have experience with period and listed homes and understand the need for careful repairs, lime and matching materials. Most work to a listed building needs listed building consent, and we can help with it.',
				'Who handles planning for Devizes?'               => 'Wiltshire Council handles planning and building control for Devizes and the surrounding villages.',
			),
		),
		'malmesbury' => array(
			'town'     => 'Malmesbury',
			'image'    => 'extension-bifold',
			'distance' => 'About 10 miles',
			'council'  => 'Wiltshire Council',
			'villages' => 'Sherston, Crudwell, Lea, Great Somerford, Little Somerford, Brinkworth and Charlton',
			'intro'    => 'Extensions, renovations and new builds in Malmesbury and the villages on the edge of the Cotswolds.',
			'heading'  => 'Builders in Malmesbury',
			'body'     => array(
				'<p>Malmesbury is a hilltop town built around its abbey, with streets of stone houses and cottages that give it real character. The villages around it, such as Sherston, Crudwell and the Somerfords, sit on the edge of the Cotswolds, where Cotswold stone and traditional detailing are the norm.</p>',
				'<p>We work across Malmesbury and its villages from our base in Chippenham, about ten miles away. Josh or Callum oversees every build personally, with one point of contact throughout.</p>',
				'<h2>Building in stone</h2>',
				'<p>Most new work around Malmesbury needs to sit comfortably alongside older stone buildings. We take care to match stone, roof tiles and detailing, whether you want an extension that looks original or a contemporary glazed design that complements the house.</p>',
				'<h2>Approvals</h2>',
				'<p>The historic centre of Malmesbury is a conservation area, many properties are listed, and some nearby villages fall within the Cotswolds National Landscape, where extra planning controls apply. We will tell you what approvals your project is likely to need.</p>',
			),
			'faqs'     => array(
				'Which villages near Malmesbury do you cover?' => 'We cover Sherston, Crudwell, Lea, Great Somerford, Little Somerford, Brinkworth and Charlton, as well as Malmesbury itself.',
				'Can you match Cotswold stone?'                 => 'Yes. We take care to match the stone, roof tiles and detailing of your home so new work sits naturally alongside it.',
				'Do I need planning permission in Malmesbury?'  => 'It depends on the project and where your home is. The town centre is a conservation area, and some nearby villages are in the Cotswolds National Landscape, both of which have extra controls. Wiltshire Council handles planning, and we will advise at the site visit.',
			),
		),
		'melksham' => array(
			'town'     => 'Melksham',
			'image'    => 'rendered-extension',
			'distance' => 'About 7 miles',
			'council'  => 'Wiltshire Council',
			'villages' => 'Bowerhill, Berryfield, Shaw, Whitley, Atworth, Semington and Seend',
			'intro'    => 'Extensions, kitchens, garage conversions and renovations in Melksham and the surrounding villages.',
			'heading'  => 'Builders in Melksham',
			'body'     => array(
				'<p>Melksham has a real mix of homes: stone houses and terraces near the town centre and along the river, and a large number of newer homes in areas such as Bowerhill and Berryfield. We work across the town and its villages, including Shaw, Whitley, Atworth, Semington and Seend.</p>',
				'<p>Our team is based in Chippenham, about seven miles away. Josh or Callum oversees every project from the first visit to the final handover, so you always know who is responsible for your build.</p>',
				'<h2>Extensions and conversions for newer homes</h2>',
				'<p>For many families in Melksham, the best way to gain space is a single storey rear extension, a kitchen extension or a garage conversion. Some newer estates have planning conditions that limit what can be built without permission, so we check those before you commit.</p>',
				'<h2>Older properties</h2>',
				'<p>For period homes, we renovate with care, using lime and matching stone where they are right for the building, and help with listed building consent where it is needed.</p>',
			),
			'faqs'     => array(
				'Can I convert my garage in Melksham without planning permission?' => 'Often, yes, but some newer estates have conditions that remove permitted development rights. Building regulations approval is almost always needed. We check both before work starts.',
				'Which areas around Melksham do you cover?'                     => 'We cover the whole town, including Bowerhill and Berryfield, and the villages of Shaw, Whitley, Atworth, Semington and Seend.',
				'Who handles planning for Melksham?'                            => 'Wiltshire Council handles planning and building control for Melksham and the surrounding villages.',
			),
		),
		'royal-wootton-bassett' => array(
			'town'     => 'Royal Wootton Bassett',
			'image'    => 'garden-terrace',
			'distance' => 'About 14 miles',
			'council'  => 'Wiltshire Council',
			'villages' => 'Lyneham, Brinkworth, Broad Town, Lydiard Millicent and Hook',
			'intro'    => 'Extensions, kitchens, conversions and landscaping in Royal Wootton Bassett and the surrounding villages.',
			'heading'  => 'Builders in Royal Wootton Bassett',
			'body'     => array(
				'<p>Royal Wootton Bassett has a historic high street of brick and stone buildings and a large number of newer homes around it. We work across the town and nearby villages, including Lyneham, Brinkworth, Broad Town and Lydiard Millicent.</p>',
				'<p>Every project is overseen by Josh or Callum, from the first site visit to the final handover, supported by a carefully selected team of trusted tradespeople.</p>',
				'<h2>More space without moving</h2>',
				'<p>Many of the homes we work on around Royal Wootton Bassett are family houses that need more room. A rear or wrap-around extension, a kitchen extension or a garage conversion can make a big difference, and we can finish the job with new patios, paths and landscaping.</p>',
				'<h2>Approvals</h2>',
				'<p>Although it is close to Swindon, Royal Wootton Bassett is in Wiltshire, so planning and building control are handled by Wiltshire Council. The high street is a conservation area, and some newer estates have planning conditions, so we check what your project needs first.</p>',
			),
			'faqs'     => array(
				'Do you cover Royal Wootton Bassett?'        => 'Yes. It is about fourteen miles from our base in Chippenham, and we work across the town and nearby villages including Lyneham, Brinkworth, Broad Town, Lydiard Millicent and Hook.',
				'Is Royal Wootton Bassett in Swindon or Wiltshire for planning?' => 'Wiltshire. Planning applications and building control are handled by Wiltshire Council, not Swindon Borough Council.',
				'Can you do the landscaping as well as the extension?' => 'Yes. We carry out groundworks and hard landscaping, so we can finish an extension with a new patio, paths and steps as part of the same project.',
			),
		),
		'bath' => array(
			'town'     => 'Bath',
			'image'    => 'kitchen-marble',
			'distance' => 'About 13 miles',
			'council'  => 'Bath & North East Somerset Council',
			'villages' => 'Batheaston, Bathford, Box, Colerne, Combe Down and Larkhall',
			'intro'    => 'Careful renovations, kitchens and extensions in Bath and the villages to the east of the city.',
			'heading'  => 'Builders in Bath',
			'body'     => array(
				'<p>Bath is a city like no other, built almost entirely in its own honey-coloured stone. We work in Bath and the villages to the east of the city, including Batheaston, Bathford and Colerne, from our base in Chippenham, about thirteen miles away.</p>',
				'<p>Josh or Callum oversees every project personally, with one point of contact throughout and a team of trusted trades who understand older buildings.</p>',
				'<h2>Working in a World Heritage city</h2>',
				'<p>The whole city of Bath is a UNESCO World Heritage Site, most of it is a conservation area, and a very large number of its buildings are listed. Work here usually needs careful planning, and often listed building consent, from Bath &amp; North East Somerset Council. We are used to working with architects and heritage consultants and to using lime, Bath stone and traditional detailing.</p>',
				'<h2>Kitchens, renovations and extensions</h2>',
				'<p>Much of our work in and around Bath is inside existing homes: new kitchens, opening up rooms, and full renovations that bring an older house up to date without losing its character. Where an extension is possible, we build it to sit sympathetically alongside the original.</p>',
			),
			'faqs'     => array(
				'Who handles planning in Bath?'               => 'Bath &amp; North East Somerset Council handles planning, listed building consent and building control for Bath. Villages to the east, such as Box and Colerne, are in Wiltshire, where Wiltshire Council handles them.',
				'Do you work on listed buildings in Bath?'    => 'Yes. We understand the need for careful repairs, breathable materials such as lime, and matching Bath stone, and we can work with your architect or heritage consultant through the consent process.',
				'Which parts of Bath do you cover?'           => 'We work across the city, particularly the eastern side, and in the villages of Batheaston, Bathford, Box, Colerne, Combe Down and Larkhall.',
			),
		),
	);

	$ids = array();
	foreach ( $towns as $slug => $c ) {
		$town = $c['town'];
		$id   = dc_demo_post(
			'page-area-' . $slug,
			array(
				'post_type'    => 'page',
				'post_title'   => 'Builders in ' . $town,
				'post_name'    => $slug,
				'post_parent'  => $parent,
				'post_excerpt' => 'Builders in ' . $town . ': extensions, kitchens, conversions, renovations and new builds, managed by the owners from start to finish.',
			)
		);
		update_post_meta( $id, '_dc_area', 1 );

		$sections = array(
			array(
				'acf_fc_layout'    => 'page_hero',
				'image'            => $m[ $c['image'] ],
				'eyebrow'          => $town . ' & surrounding villages',
				'heading'          => 'Builders in ' . $town,
				'text'             => $c['intro'],
				'button_primary'   => dc_demo_link( $shared['contact_url'], 'Request a quote' ),
				'button_secondary' => dc_demo_link( get_post_type_archive_link( 'project' ), 'View our projects' ),
				'breadcrumb'       => 1,
			),
			array(
				'acf_fc_layout' => 'service_detail',
				'eyebrow'       => 'Builders in ' . $town,
				'heading'       => $c['heading'],
				'body'          => implode( "\n", $c['body'] ),
				'list_title'    => 'What we do in ' . $town,
				'list'          => array_map( fn( $id ) => array( 'item' => get_the_title( $id ) ), array_values( $services ) ),
				'facts'         => array(
					array( 'label' => 'From Chippenham', 'value' => $c['distance'] ),
					array( 'label' => 'Planning', 'value' => $c['council'] ),
					array( 'label' => 'Managed by', 'value' => 'Josh or Callum' ),
					array( 'label' => 'Site visit', 'value' => 'Free, no obligation' ),
				),
				'show_contact'  => 1,
			),
			array(
				'acf_fc_layout' => 'services_grid',
				'eyebrow'       => 'What we do',
				'heading'       => 'Our services in ' . $town,
				'intro'         => 'We also work in ' . $c['villages'] . '.',
				'services'      => array_values( $services ),
				'cta_heading'   => 'Not sure what you need?',
				'cta_text'      => "Tell us about your project and we'll point you in the right direction.",
				'cta_button'    => dc_demo_link( $shared['contact_url'], 'Talk to us' ),
			),
			$shared['testimonial'],
			array(
				'acf_fc_layout' => 'faqs',
				'eyebrow'       => $town . ' FAQs',
				'heading'       => 'Building in ' . $town,
				'button'        => dc_demo_link( $shared['contact_url'], 'Contact us' ),
				'items'         => array_map(
					fn( $q, $a ) => array( 'question' => $q, 'answer' => '<p>' . $a . '</p>' ),
					array_keys( $c['faqs'] ),
					$c['faqs']
				),
			),
			array(
				'acf_fc_layout' => 'contact_panel',
				'eyebrow'       => 'Get in touch',
				'heading'       => 'Planning a project in ' . $town . '?',
				'text'          => 'Tell us about your home and what you would like to achieve. Josh or Callum will arrange a free site visit and give you honest advice, with no obligation.',
				'points'        => array_map( fn( $t ) => array( 'text' => $t ), array( 'Free site visit and itemised quote', 'Owner-managed from start to finish', 'Based in Chippenham, working across North Wiltshire', 'Trusted, tidy and reliable trades' ) ),
				'button'        => '',
				'image'         => $m['team-plans'],
			),
		);
		update_field( 'field_dc_sections', $sections, $id );
		$ids[ $slug ] = $id;
	}

	// The parent page lists the towns, so /areas/ is not empty.
	update_field(
		'field_dc_sections',
		array(
			array(
				'acf_fc_layout' => 'text_block',
				'eyebrow'       => 'Areas we cover',
				'heading'       => 'Builders across North Wiltshire',
				'body'          => '<p>We are based in Chippenham and work across North Wiltshire and into Bath. Choose your area to find out more.</p><ul>' . implode( '', array_map( fn( $id ) => '<li><a href="' . esc_url( get_permalink( $id ) ) . '">' . esc_html( get_the_title( $id ) ) . '</a></li>', $ids ) ) . '</ul>',
			),
		),
		$parent
	);

	return $ids;
}
