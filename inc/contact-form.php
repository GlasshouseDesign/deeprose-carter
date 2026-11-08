<?php
/**
 * Built-in quote form. Used by the contact form section until a Gravity Forms
 * (or WPForms) shortcode is added, so the Contact page works from day one.
 *
 * Enquiries are emailed to the quote address in Site Settings, with any photos
 * attached. Nothing is stored in the database.
 *
 * @package DeeproseCarter
 */

defined( 'ABSPATH' ) || exit;

const DC_CF_ACTION     = 'dc_quote';
const DC_CF_MAX_PHOTOS = 5;
const DC_CF_MAX_BYTES  = 8 * MB_IN_BYTES;

/**
 * Project types for the dropdown: the published services, plus a catch-all.
 */
function dc_cf_project_types() {
	$types = get_posts( array( 'post_type' => 'service', 'numberposts' => 20, 'orderby' => 'menu_order', 'order' => 'ASC', 'fields' => 'ids' ) );
	$types = array_map( 'get_the_title', $types );
	$types[] = __( 'Something else', 'deeprose-carter' );
	return $types;
}

/**
 * Start date choices.
 */
function dc_cf_timings() {
	return array(
		__( 'As soon as possible', 'deeprose-carter' ),
		__( 'Within 3 months', 'deeprose-carter' ),
		__( 'In 3 to 6 months', 'deeprose-carter' ),
		__( 'In 6 months or more', 'deeprose-carter' ),
		__( 'Just exploring for now', 'deeprose-carter' ),
	);
}

/**
 * Form state passed back after a failed submission: errors and the values entered.
 */
function dc_cf_state() {
	static $state = null;
	if ( null !== $state ) {
		return $state;
	}
	$state = array( 'errors' => array(), 'values' => array() );
	$token = isset( $_GET['enquiry'] ) ? sanitize_key( wp_unslash( $_GET['enquiry'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification
	if ( $token && 'sent' !== $token ) {
		$saved = get_transient( 'dc_cf_' . $token );
		if ( is_array( $saved ) ) {
			$state = $saved;
		}
	}
	return $state;
}

/**
 * Render the built-in form.
 */
function dc_cf_render() {
	// phpcs:ignore WordPress.Security.NonceVerification
	if ( isset( $_GET['enquiry'] ) && 'sent' === $_GET['enquiry'] ) {
		?>
		<div class="cf-done" role="status" tabindex="-1" id="enquiry-sent">
			<?php echo dc_win(); // phpcs:ignore ?>
			<h3><?php esc_html_e( 'Thank you, your enquiry is on its way', 'deeprose-carter' ); ?></h3>
			<p><?php esc_html_e( 'Josh or Callum will be in touch shortly to talk through your project and arrange a site visit.', 'deeprose-carter' ); ?></p>
		</div>
		<?php
		return;
	}

	$state  = dc_cf_state();
	$errors = $state['errors'];
	$v      = $state['values'];
	$val    = fn( $k ) => isset( $v[ $k ] ) ? $v[ $k ] : '';
	$err    = function ( $k ) use ( $errors ) {
		if ( ! empty( $errors[ $k ] ) ) {
			printf( '<span class="cf-error" id="%1$s-error">%2$s</span>', esc_attr( 'cf-' . $k ), esc_html( $errors[ $k ] ) );
		}
	};
	$aria   = fn( $k ) => ! empty( $errors[ $k ] ) ? ' aria-invalid="true" aria-describedby="cf-' . esc_attr( $k ) . '-error"' : '';
	?>
	<form class="cf" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" enctype="multipart/form-data">
		<?php if ( $errors ) : ?>
			<div class="cf-alert" role="alert"><?php echo esc_html( ! empty( $errors['form'] ) ? $errors['form'] : __( 'Please check the highlighted fields and try again.', 'deeprose-carter' ) ); ?></div>
		<?php endif; ?>
		<input type="hidden" name="action" value="<?php echo esc_attr( DC_CF_ACTION ); ?>">
		<input type="hidden" name="dc_page" value="<?php echo esc_attr( get_the_ID() ); ?>">
		<input type="hidden" name="dc_t" value="<?php echo esc_attr( time() ); ?>">
		<?php wp_nonce_field( DC_CF_ACTION, 'dc_nonce' ); ?>
		<div class="cf-hp" aria-hidden="true"><label>Leave this empty <input type="text" name="dc_website" tabindex="-1" autocomplete="off"></label></div>

		<div class="cf-row">
			<div class="cf-field">
				<label for="cf-name"><?php esc_html_e( 'Your name', 'deeprose-carter' ); ?> <abbr title="required">*</abbr></label>
				<input id="cf-name" name="name" type="text" autocomplete="name" required value="<?php echo esc_attr( $val( 'name' ) ); ?>"<?php echo $aria( 'name' ); // phpcs:ignore ?>>
				<?php $err( 'name' ); ?>
			</div>
			<div class="cf-field">
				<label for="cf-email"><?php esc_html_e( 'Email', 'deeprose-carter' ); ?> <abbr title="required">*</abbr></label>
				<input id="cf-email" name="email" type="email" autocomplete="email" required value="<?php echo esc_attr( $val( 'email' ) ); ?>"<?php echo $aria( 'email' ); // phpcs:ignore ?>>
				<?php $err( 'email' ); ?>
			</div>
		</div>
		<div class="cf-row">
			<div class="cf-field">
				<label for="cf-phone"><?php esc_html_e( 'Phone', 'deeprose-carter' ); ?> <abbr title="required">*</abbr></label>
				<input id="cf-phone" name="phone" type="tel" autocomplete="tel" required value="<?php echo esc_attr( $val( 'phone' ) ); ?>"<?php echo $aria( 'phone' ); // phpcs:ignore ?>>
				<?php $err( 'phone' ); ?>
			</div>
			<div class="cf-field">
				<label for="cf-postcode"><?php esc_html_e( 'Postcode of the property', 'deeprose-carter' ); ?></label>
				<input id="cf-postcode" name="postcode" type="text" autocomplete="postal-code" value="<?php echo esc_attr( $val( 'postcode' ) ); ?>">
			</div>
		</div>
		<div class="cf-row">
			<div class="cf-field">
				<label for="cf-type"><?php esc_html_e( 'Type of project', 'deeprose-carter' ); ?></label>
				<select id="cf-type" name="project_type">
					<option value=""><?php esc_html_e( 'Please choose', 'deeprose-carter' ); ?></option>
					<?php foreach ( dc_cf_project_types() as $dc_o ) : ?><option<?php selected( $val( 'project_type' ), $dc_o ); ?>><?php echo esc_html( $dc_o ); ?></option><?php endforeach; ?>
				</select>
			</div>
			<div class="cf-field">
				<label for="cf-timing"><?php esc_html_e( 'When would you like to start?', 'deeprose-carter' ); ?></label>
				<select id="cf-timing" name="timing">
					<option value=""><?php esc_html_e( 'Please choose', 'deeprose-carter' ); ?></option>
					<?php foreach ( dc_cf_timings() as $dc_o ) : ?><option<?php selected( $val( 'timing' ), $dc_o ); ?>><?php echo esc_html( $dc_o ); ?></option><?php endforeach; ?>
				</select>
			</div>
		</div>
		<div class="cf-field">
			<label for="cf-message"><?php esc_html_e( 'Tell us about your project', 'deeprose-carter' ); ?> <abbr title="required">*</abbr></label>
			<textarea id="cf-message" name="message" rows="6" required placeholder="<?php esc_attr_e( 'What you would like to do, the size of the space and whether you have plans or planning permission yet.', 'deeprose-carter' ); ?>"<?php echo $aria( 'message' ); // phpcs:ignore ?>><?php echo esc_textarea( $val( 'message' ) ); ?></textarea>
			<?php $err( 'message' ); ?>
		</div>
		<div class="cf-field">
			<span class="cf-label" id="cf-photos-label"><?php esc_html_e( 'Photos or plans (optional)', 'deeprose-carter' ); ?></span>
			<label class="cf-drop" for="cf-photos">
				<input id="cf-photos" name="photos[]" type="file" multiple accept="image/jpeg,image/png,image/heic,image/webp,application/pdf" aria-labelledby="cf-photos-label" aria-describedby="cf-photos-hint<?php echo ! empty( $errors['photos'] ) ? ' cf-photos-error' : ''; ?>">
				<span class="cf-drop-text"><?php esc_html_e( 'Choose files', 'deeprose-carter' ); ?></span>
				<span class="cf-drop-files" aria-live="polite"></span>
			</label>
			<span class="cf-hint" id="cf-photos-hint"><?php printf( esc_html__( 'Up to %1$d files, JPG, PNG, HEIC or PDF, %2$dMB in total.', 'deeprose-carter' ), (int) DC_CF_MAX_PHOTOS, (int) ( DC_CF_MAX_BYTES / MB_IN_BYTES ) ); ?></span>
			<?php $err( 'photos' ); ?>
		</div>
		<div class="cf-field">
			<label class="cf-check">
				<input type="checkbox" name="consent" value="1" required<?php checked( $val( 'consent' ), '1' ); ?><?php echo $aria( 'consent' ); // phpcs:ignore ?>>
				<span>
					<?php
					$dc_privacy = get_privacy_policy_url();
					if ( $dc_privacy ) {
						/* translators: %s: privacy policy link. */
						printf( esc_html__( 'I am happy for Deeprose & Carter to contact me about my enquiry. See our %s.', 'deeprose-carter' ), '<a href="' . esc_url( $dc_privacy ) . '">' . esc_html__( 'privacy policy', 'deeprose-carter' ) . '</a>' );
					} else {
						esc_html_e( 'I am happy for Deeprose & Carter to contact me about my enquiry.', 'deeprose-carter' );
					}
					?>
				</span>
			</label>
			<?php $err( 'consent' ); ?>
		</div>
		<button class="btn btn-navy cf-submit" type="submit"><?php esc_html_e( 'Send my enquiry', 'deeprose-carter' ); ?></button>
	</form>
	<?php
}

/**
 * Handle a submission, then redirect back to the page.
 */
function dc_cf_handle() {
	$page   = isset( $_POST['dc_page'] ) ? absint( $_POST['dc_page'] ) : 0; // phpcs:ignore WordPress.Security.NonceVerification
	$back   = $page ? get_permalink( $page ) : home_url( '/contact/' );
	$fields = array( 'name', 'email', 'phone', 'postcode', 'project_type', 'timing', 'message', 'consent' );
	$values = array();
	foreach ( $fields as $f ) {
		$raw          = isset( $_POST[ $f ] ) ? wp_unslash( $_POST[ $f ] ) : ''; // phpcs:ignore WordPress.Security.NonceVerification, WordPress.Security.ValidatedSanitizedInput
		$values[ $f ] = 'message' === $f ? sanitize_textarea_field( $raw ) : sanitize_text_field( $raw );
	}
	$errors = array();

	// Spam checks: valid nonce, empty honeypot, and not submitted within three seconds of loading.
	$started = isset( $_POST['dc_t'] ) ? absint( $_POST['dc_t'] ) : 0; // phpcs:ignore WordPress.Security.NonceVerification
	$is_bot  = ! empty( $_POST['dc_website'] ) || ( time() - $started ) < 3; // phpcs:ignore WordPress.Security.NonceVerification
	if ( ! isset( $_POST['dc_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['dc_nonce'] ), DC_CF_ACTION ) ) {
		$errors['form'] = __( 'Sorry, the form timed out. Please send it again.', 'deeprose-carter' );
	}
	if ( $is_bot ) {
		// Pretend it worked, so bots learn nothing.
		wp_safe_redirect( add_query_arg( 'enquiry', 'sent', $back ) . '#enquiry' );
		exit;
	}

	if ( '' === $values['name'] ) {
		$errors['name'] = __( 'Please enter your name.', 'deeprose-carter' );
	}
	if ( ! is_email( $values['email'] ) ) {
		$errors['email'] = __( 'Please enter a valid email address.', 'deeprose-carter' );
	}
	if ( strlen( preg_replace( '/\D/', '', $values['phone'] ) ) < 10 ) {
		$errors['phone'] = __( 'Please enter a phone number we can call you on.', 'deeprose-carter' );
	}
	if ( '' === $values['message'] ) {
		$errors['message'] = __( 'Please tell us a little about your project.', 'deeprose-carter' );
	}
	if ( '1' !== $values['consent'] ) {
		$errors['consent'] = __( 'Please tick to let us contact you.', 'deeprose-carter' );
	}

	$files = $errors ? array() : dc_cf_files( $errors );

	if ( $errors ) {
		$token = strtolower( wp_generate_password( 12, false ) );
		set_transient( 'dc_cf_' . $token, array( 'errors' => $errors, 'values' => $values ), 15 * MINUTE_IN_SECONDS );
		wp_safe_redirect( add_query_arg( 'enquiry', $token, $back ) . '#enquiry' );
		exit;
	}

	$to      = dc_setting( 'quote_email', get_option( 'admin_email' ) );
	$subject = sprintf( /* translators: %s: name. */ __( 'Quote request from %s', 'deeprose-carter' ), $values['name'] );
	$rows    = array(
		__( 'Name', 'deeprose-carter' )     => $values['name'],
		__( 'Email', 'deeprose-carter' )    => $values['email'],
		__( 'Phone', 'deeprose-carter' )    => $values['phone'],
		__( 'Postcode', 'deeprose-carter' ) => $values['postcode'],
		__( 'Project', 'deeprose-carter' )  => $values['project_type'],
		__( 'Start', 'deeprose-carter' )    => $values['timing'],
	);
	$body = '';
	foreach ( $rows as $label => $value ) {
		$body .= $label . ': ' . ( '' === $value ? '-' : $value ) . "\n";
	}
	$body .= "\n" . $values['message'] . "\n\n";
	$body .= $files ? sprintf( /* translators: %d: number. */ _n( '%d file attached.', '%d files attached.', count( $files ), 'deeprose-carter' ), count( $files ) ) . "\n" : '';
	$body .= __( 'Sent from the contact form on', 'deeprose-carter' ) . ' ' . $back . "\n";

	$headers = array( 'Reply-To: ' . $values['name'] . ' <' . $values['email'] . '>' );
	$sent    = wp_mail( $to, $subject, $body, $headers, $files );

	foreach ( $files as $file ) {
		wp_delete_file( $file );
	}
	if ( $files ) {
		rmdir( dirname( $files[0] ) ); // phpcs:ignore WordPress.WP.AlternativeFunctions
	}

	if ( ! $sent ) {
		$token = strtolower( wp_generate_password( 12, false ) );
		set_transient(
			'dc_cf_' . $token,
			array(
				'errors' => array( 'form' => sprintf( /* translators: %s: email. */ __( 'Sorry, your enquiry could not be sent. Please try again, or email us at %s.', 'deeprose-carter' ), $to ) ),
				'values' => $values,
			),
			15 * MINUTE_IN_SECONDS
		);
		wp_safe_redirect( add_query_arg( 'enquiry', $token, $back ) . '#enquiry' );
		exit;
	}

	wp_safe_redirect( add_query_arg( 'enquiry', 'sent', $back ) . '#enquiry' );
	exit;
}
add_action( 'admin_post_' . DC_CF_ACTION, 'dc_cf_handle' );
add_action( 'admin_post_nopriv_' . DC_CF_ACTION, 'dc_cf_handle' );

/**
 * Check uploaded files and copy them to temporary files with their real names,
 * so they arrive in the email with the right name and extension.
 *
 * @param array $errors Errors, passed by reference.
 * @return string[] Paths to attach.
 */
function dc_cf_files( &$errors ) {
	// phpcs:disable WordPress.Security.NonceVerification, WordPress.Security.ValidatedSanitizedInput
	if ( empty( $_FILES['photos']['name'] ) || ! is_array( $_FILES['photos']['name'] ) ) {
		return array();
	}
	$f       = $_FILES['photos'];
	// phpcs:enable
	$allowed = array( 'jpg', 'jpeg', 'png', 'heic', 'webp', 'pdf' );
	$paths   = array();
	$total   = 0;
	$count   = 0;
	$dir     = trailingslashit( get_temp_dir() ) . 'dc-quote-' . wp_generate_password( 8, false );

	foreach ( $f['name'] as $i => $name ) {
		if ( UPLOAD_ERR_NO_FILE === $f['error'][ $i ] ) {
			continue;
		}
		++$count;
		$ext = strtolower( pathinfo( $name, PATHINFO_EXTENSION ) );
		if ( UPLOAD_ERR_OK !== $f['error'][ $i ] || ! is_uploaded_file( $f['tmp_name'][ $i ] ) ) {
			$errors['photos'] = __( 'One of your files did not upload. Please try a smaller file.', 'deeprose-carter' );
		} elseif ( ! in_array( $ext, $allowed, true ) ) {
			$errors['photos'] = __( 'Please send photos as JPG, PNG or HEIC, and plans as PDF.', 'deeprose-carter' );
		}
		$total += (int) $f['size'][ $i ];
	}
	if ( $count > DC_CF_MAX_PHOTOS ) {
		$errors['photos'] = sprintf( /* translators: %d: number. */ __( 'Please send no more than %d files.', 'deeprose-carter' ), DC_CF_MAX_PHOTOS );
	}
	if ( $total > DC_CF_MAX_BYTES ) {
		$errors['photos'] = sprintf( /* translators: %d: megabytes. */ __( 'Your files come to more than %dMB. Please send fewer or smaller files.', 'deeprose-carter' ), DC_CF_MAX_BYTES / MB_IN_BYTES );
	}
	if ( ! empty( $errors['photos'] ) || ! $count || ! wp_mkdir_p( $dir ) ) {
		return array();
	}

	foreach ( $f['name'] as $i => $name ) {
		if ( UPLOAD_ERR_OK !== $f['error'][ $i ] ) {
			continue;
		}
		$dest = $dir . '/' . sanitize_file_name( $name );
		if ( move_uploaded_file( $f['tmp_name'][ $i ], $dest ) ) {
			$paths[] = $dest;
		}
	}
	return $paths;
}
