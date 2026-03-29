<?php
/**
 * Switch de profil visiteur – pixmatch
 * Gestion via session PHP (sans cache full-page)
 */

/* -------------------------------------------------
 * 1. Démarrage de la session
 * ------------------------------------------------- */

function pixmatch_maybe_start_session() {
	if ( is_admin() ) {
		return;
	}

	if ( session_status() === PHP_SESSION_NONE ) {
		session_start();
	}
}
add_action( 'init', 'pixmatch_maybe_start_session', 1 );

/* -------------------------------------------------
 * 2. Profils autorisés + getter
 * ------------------------------------------------- */

function pixmatch_allowed_profiles(): array {
	return [
		'visit' => 'Particulier',
		'pro'     => 'Créateur',
	];
}

function pixmatch_get_profile(): string {
	$allowed = pixmatch_allowed_profiles();
	$profile = $_SESSION['pixmatch_profile'] ?? 'default';

	if ( ! isset( $allowed[ $profile ] ) ) {
		$profile = 'visit';
	}

	return $profile;
}

/* -------------------------------------------------
 * 3. Gestion du switch via URL sécurisée
 * ------------------------------------------------- */

function pixmatch_handle_profile_switch() {
	if ( is_admin() ) {
		return;
	}

	if ( empty( $_GET['switch_profile'] ) ) {
		return;
	}

	$requested = sanitize_key( wp_unslash( $_GET['switch_profile'] ) );

	$nonce = $_GET['_wpnonce'] ?? '';
	if ( ! wp_verify_nonce( $nonce, 'pixmatch_switch_profile' ) ) {
		return;
	}

	$allowed = pixmatch_allowed_profiles();
	if ( ! isset( $allowed[ $requested ] ) ) {
		return;
	}

	$_SESSION['pixmatch_profile'] = $requested;

	$redirect = remove_query_arg( [ 'switch_profile', '_wpnonce' ] );
	wp_safe_redirect( $redirect );
	exit;
}
add_action( 'template_redirect', 'pixmatch_handle_profile_switch' );

/* -------------------------------------------------
 * 4. Shortcode pour thème FSE > [pixmatch_profile_switch]
 * ------------------------------------------------- */

function pixmatch_profile_switch_shortcode(): string {
	$allowed = pixmatch_allowed_profiles();
	$current = pixmatch_get_profile();
	$nonce   = wp_create_nonce( 'pixmatch_switch_profile' );

	$out = '<div class="pixmatch-profile-switch" style="display:flex; gap:8px; flex-wrap:wrap;"><span style="padding:10px;">Je suis </span>';

	foreach ( $allowed as $slug => $label ) {
		$url = add_query_arg(
			[
				'switch_profile' => $slug,
				'_wpnonce'       => $nonce,
			]
		);

		$is_current = ( $slug === $current );

		$style = $is_current
			? 'font-weight:700;'
			: 'font-weight:100;';

		$out .= sprintf(
			'<a href="%s" style="%s" aria-current="%s">%s</a>',
			esc_url( $url ),
			esc_attr( $style ),
			$is_current ? 'true' : 'false',
			esc_html( $label )
		);
	}

	$out .= '</div>';

	return $out;
}
add_shortcode( 'pixmatch_profile_switch', 'pixmatch_profile_switch_shortcode' );

/**
 * Shortcode conditionnel selon le profil visiteur
 *
 * Utilisation :
 * [pixmatch_if profile="pro"] ... [/pixmatch_if]
 */
function pixmatch_if_profile_shortcode( $atts, $content = null ) {
	$atts = shortcode_atts(
		[
			'profile' => 'visit',
		],
		$atts,
		'pixmatch_if'
	);

	if ( pixmatch_get_profile() !== $atts['profile'] ) {
		return '';
	}

	// Important : permettre les blocs à l’intérieur
	return do_shortcode( $content );
}
add_shortcode( 'pixmatch_if', 'pixmatch_if_profile_shortcode' );
