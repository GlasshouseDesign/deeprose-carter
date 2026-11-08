<?php
/**
 * Gravity Forms quote form. The D&C setup builds it when Gravity Forms is active,
 * with the same fields as the built-in form, and puts its shortcode on the Contact page.
 *
 * @package DeeproseCarter
 */

defined( 'ABSPATH' ) || exit;

/**
 * Create or update the quote form.
 *
 * @param string $to Fallback address for the notification (Site Settings → Quote email is used when set).
 * @return int Form ID, or 0 if Gravity Forms is not active or the form could not be saved.
 */
function dc_gf_quote_form( $to ) {
	if ( ! class_exists( 'GFAPI' ) ) {
		return 0;
	}

	$choices = fn( $list ) => array_map( fn( $t ) => array( 'text' => $t, 'value' => $t ), $list );
	$privacy = get_privacy_policy_url();
	$half    = 6;

	$fields = array(
		array( 'id' => 1, 'type' => 'text', 'label' => 'Your name', 'isRequired' => true, 'layoutGridColumnSpan' => $half, 'enableAutocomplete' => true, 'autocompleteAttribute' => 'name' ),
		array( 'id' => 2, 'type' => 'email', 'label' => 'Email', 'isRequired' => true, 'layoutGridColumnSpan' => $half, 'enableAutocomplete' => true, 'autocompleteAttribute' => 'email' ),
		array( 'id' => 3, 'type' => 'phone', 'label' => 'Phone', 'isRequired' => true, 'phoneFormat' => 'international', 'layoutGridColumnSpan' => $half, 'enableAutocomplete' => true, 'autocompleteAttribute' => 'tel' ),
		array( 'id' => 4, 'type' => 'text', 'label' => 'Postcode of the property', 'layoutGridColumnSpan' => $half, 'enableAutocomplete' => true, 'autocompleteAttribute' => 'postal-code' ),
		array( 'id' => 5, 'type' => 'select', 'label' => 'Type of project', 'choices' => $choices( dc_cf_project_types() ), 'placeholder' => 'Choose one', 'layoutGridColumnSpan' => $half ),
		array( 'id' => 6, 'type' => 'select', 'label' => 'When would you like to start?', 'choices' => $choices( dc_cf_timings() ), 'placeholder' => 'Choose one', 'layoutGridColumnSpan' => $half ),
		array( 'id' => 7, 'type' => 'textarea', 'label' => 'Tell us about your project', 'isRequired' => true, 'placeholder' => 'What you would like to do, the size of the space and whether you have plans or planning permission yet.' ),
		array(
			'id'                => 8,
			'type'              => 'fileupload',
			'label'             => 'Photos or plans (optional)',
			'description'       => 'Up to ' . DC_CF_MAX_PHOTOS . ' files: JPG, PNG, HEIC, WebP or PDF, 8MB each.',
			'multipleFiles'     => true,
			'maxFiles'          => DC_CF_MAX_PHOTOS,
			'maxFileSize'       => 8,
			'allowedExtensions' => 'jpg,jpeg,png,heic,webp,pdf',
		),
		array(
			'id'            => 9,
			'type'          => 'consent',
			'label'         => 'Consent',
			'isRequired'    => true,
			'checkboxLabel' => 'I am happy for Deeprose & Carter to contact me about my enquiry.',
			'description'   => $privacy ? 'See our <a href="' . esc_url( $privacy ) . '">privacy policy</a>.' : '',
			'inputs'        => array(
				array( 'id' => '9.1', 'label' => 'Consent' ),
				array( 'id' => '9.2', 'label' => 'Text', 'isHidden' => true ),
				array( 'id' => '9.3', 'label' => 'Description', 'isHidden' => true ),
			),
		),
	);

	$form = array(
		'title'          => 'Request a quote',
		'description'    => '',
		'labelPlacement' => 'top_label',
		'markupVersion'  => 2,
		'enableHoneypot' => true,
		'button'         => array( 'type' => 'text', 'text' => 'Send my enquiry' ),
		'fields'         => $fields,
		'notifications'  => array(
			'dc-quote' => array(
				'id'                => 'dc-quote',
				'name'              => 'Quote request',
				'isActive'          => true,
				'event'             => 'form_submission',
				'toType'            => 'email',
				'to'                => $to,
				'from'              => '{admin_email}',
				'fromName'          => 'Deeprose & Carter website',
				'replyTo'           => '{Email:2}',
				'subject'           => 'Quote request from {Your name:1}',
				'message'           => '{all_fields}',
				'enableAttachments' => true,
			),
		),
		'confirmations'  => array(
			'dc-thanks' => array(
				'id'        => 'dc-thanks',
				'name'      => 'Thank you',
				'isDefault' => true,
				'type'      => 'message',
				'message'   => '<h3>Thank you, your enquiry is on its way</h3><p>Josh or Callum will be in touch shortly to talk through your project and arrange a site visit.</p>',
			),
		),
		// Matches the privacy policy: no IP addresses, entries deleted after 2 years.
		'personalData'   => array(
			'preventIP' => true,
			'retention' => array( 'policy' => 'delete', 'retain_entries_days' => 730 ),
		),
	);

	$id = (int) get_option( 'dc_gf_quote_form' );
	if ( $id && GFAPI::form_id_exists( $id ) ) {
		$form['id'] = $id;
		$result     = GFAPI::update_form( $form, $id );
	} else {
		$result = GFAPI::add_form( $form );
		$id     = is_wp_error( $result ) ? 0 : (int) $result;
		update_option( 'dc_gf_quote_form', $id );
	}
	return is_wp_error( $result ) ? 0 : $id;
}

/**
 * Always send quote requests to the quote email in Site Settings, so changing it there is enough.
 */
function dc_gf_quote_to( $notification, $form ) {
	if ( 'dc-quote' === ( $notification['id'] ?? '' ) && (int) $form['id'] === (int) get_option( 'dc_gf_quote_form' ) ) {
		$notification['to'] = dc_setting( 'quote_email', $notification['to'] );
	}
	return $notification;
}
add_filter( 'gform_notification', 'dc_gf_quote_to', 10, 2 );
