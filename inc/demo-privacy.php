<?php
/**
 * Privacy policy for the demo setup. Written for UK GDPR and the Data Protection Act 2018.
 * Points for the client to confirm are listed in HANDOVER.md.
 *
 * @package DeeproseCarter
 */

defined( 'ABSPATH' ) || exit;

/**
 * Create or update the privacy policy page and set it as the site's privacy page.
 *
 * @return int Page ID.
 */
function dc_demo_privacy_policy() {
	$email   = 'jo@jdeeprosedevelopments.co.uk';
	$mailto  = '<a href="mailto:' . esc_attr( $email ) . '">' . esc_html( $email ) . '</a>';
	$content = implode(
		"\n",
		array(
			'<p><em>Last updated: 8 November 2026</em></p>',
			'<p>This policy explains what personal information Deeprose and Carter Developments Ltd collects when you use this website or work with us, why we collect it, how long we keep it and the rights you have. We keep it as short and plain as we can.</p>',

			'<h2>Who we are</h2>',
			'<p>Deeprose and Carter Developments Ltd, trading as Deeprose &amp; Carter Developments, is the data controller for your personal information. We are a company registered in England and Wales, company number 12007910, with our registered office at The Old Post Office, 41-43 Market Place, Chippenham, Wiltshire, SN15 3HR.</p>',
			'<p>If you have any questions about this policy or your information, email us at ' . $mailto . ' or write to us at the address above.</p>',

			'<h2>The information we collect</h2>',
			'<h3>When you ask for a quote or get in touch</h3>',
			'<p>When you use the quote form, email us, call us or send a message, we collect the details you give us. This usually includes your name, email address, phone number, the address or postcode of the property, details of your project and any photos or drawings you send. Photos of your home may show your property and anything in them, so please only send what you are happy for us to see.</p>',
			'<h3>When we work for you</h3>',
			'<p>If you go ahead with a project, we also keep the information needed to carry out the work and run the business: your contact details and the property address, quotes, contracts and invoices, payment records, drawings, approvals and certificates, site photos, and our correspondence with you.</p>',
			'<h3>When you visit the website</h3>',
			'<p>Like most websites, our hosting provider\'s servers record basic technical information when pages are requested, such as your IP address, browser type and the pages visited. This is used to keep the website secure and working properly.</p>',

			'<h2>How we use your information</h2>',
			'<ul>',
			'<li>To reply to your enquiry, arrange a site visit and prepare a quote.</li>',
			'<li>To plan, carry out and manage your project, and keep you updated.</li>',
			'<li>To invoice you, take payment and keep our accounts.</li>',
			'<li>To deal with any questions, snagging or claims about our work after it is finished.</li>',
			'<li>To meet our legal obligations, for example tax, building regulations and health and safety.</li>',
			'<li>To keep our website and systems secure.</li>',
			'</ul>',
			'<p>We do not sell your information, and we do not send marketing emails or newsletters.</p>',

			'<h2>Our legal reasons for using it</h2>',
			'<p>Data protection law requires us to have a lawful basis for using your information. We rely on:</p>',
			'<ul>',
			'<li><strong>Contract:</strong> to take steps you ask for before entering a contract, such as a site visit and quote, and to carry out a contract with you.</li>',
			'<li><strong>Legal obligation:</strong> to keep financial records and meet other legal and regulatory duties.</li>',
			'<li><strong>Legitimate interests:</strong> to run and protect our business, reply to general enquiries, keep the website secure, and deal with any claims. We only rely on this where it does not override your rights.</li>',
			'<li><strong>Consent:</strong> to use photos of your home on our website or social media. We will always ask first and will not show your address, and you can withdraw your consent at any time.</li>',
			'</ul>',

			'<h2>Who we share it with</h2>',
			'<p>We only share your information where we need to, and we expect everyone we share it with to keep it secure. This may include:</p>',
			'<ul>',
			'<li>the trusted tradespeople and suppliers working on your project, who need your name, address and contact details to do their part;</li>',
			'<li>architects, structural engineers, surveyors, building control and the local planning authority, where your project needs them;</li>',
			'<li>our accountant, insurers and professional advisers;</li>',
			'<li>the companies that provide our website hosting, email and IT services;</li>',
			'<li>anyone we are required to share it with by law, such as HMRC.</li>',
			'</ul>',

			'<h2>Information sent outside the UK</h2>',
			'<p>Some of our service providers may store or process information outside the UK. Where they do, we make sure it is protected by safeguards approved under UK data protection law, such as an adequacy decision or the UK International Data Transfer Agreement.</p>',

			'<h2>How long we keep it</h2>',
			'<ul>',
			'<li><strong>Enquiries and quotes that do not go ahead:</strong> up to 2 years from our last contact, in case you come back to us.</li>',
			'<li><strong>Financial records:</strong> 6 years after the end of the financial year they relate to, as required by HMRC.</li>',
			'<li><strong>Records of completed work</strong>, such as contracts, drawings, certificates and site photos: up to 12 years after the work is finished, because questions about building work can come up long afterwards.</li>',
			'<li><strong>Website server logs:</strong> for a short period set by our hosting provider.</li>',
			'</ul>',
			'<p>After that, we delete the information or make sure it can no longer identify you.</p>',

			'<h2>Cookies</h2>',
			'<p>This website does not use analytics, advertising or tracking cookies. WordPress may set essential cookies if you log in to the website, which only applies to people who manage the site. Our fonts are provided by Adobe Fonts, which receives your IP address so the fonts can be delivered to your browser but does not set cookies. If we add analytics in future, we will update this policy and ask for your consent first.</p>',

			'<h2>Your rights</h2>',
			'<p>You have the right to:</p>',
			'<ul>',
			'<li>ask for a copy of the information we hold about you;</li>',
			'<li>ask us to correct information that is wrong or incomplete;</li>',
			'<li>ask us to delete your information, where we no longer have a reason to keep it;</li>',
			'<li>ask us to limit how we use it, or object to us using it on the basis of legitimate interests;</li>',
			'<li>ask for information you gave us to be passed to you or another organisation in a common format;</li>',
			'<li>withdraw your consent at any time, where we rely on it.</li>',
			'</ul>',
			'<p>To use any of these rights, email us at ' . $mailto . '. We will reply within one month. There is usually no charge.</p>',

			'<h2>Keeping your information safe</h2>',
			'<p>We use password-protected devices and accounts, secure hosting and encrypted connections to protect your information, and only people who need it for your project can access it.</p>',

			'<h2>Complaints</h2>',
			'<p>If you are unhappy with how we have used your information, please tell us first so we can put it right. You also have the right to complain to the Information Commissioner\'s Office (ICO), the UK\'s data protection regulator, at <a href="https://ico.org.uk/make-a-complaint/" target="_blank" rel="noopener">ico.org.uk</a> or on 0303 123 1113.</p>',

			'<h2>Changes to this policy</h2>',
			'<p>We may update this policy from time to time. The date at the top shows when it was last changed.</p>',
		)
	);

	$page = (int) get_option( 'wp_page_for_privacy_policy' );
	$args = array(
		'post_type'    => 'page',
		'post_title'   => 'Privacy policy',
		'post_name'    => 'privacy-policy',
		'post_status'  => 'publish',
		'post_content' => $content,
	);
	if ( $page && get_post( $page ) ) {
		$args['ID'] = $page;
		wp_update_post( $args );
	} else {
		$page = dc_demo_post( 'page-privacy', $args );
		update_option( 'wp_page_for_privacy_policy', $page );
	}
	return $page;
}
