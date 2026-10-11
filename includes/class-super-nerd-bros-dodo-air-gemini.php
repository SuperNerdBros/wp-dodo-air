<?php
/**
 * Gemini access for Dodo Air: the one credential resolver plus the one outgoing call.
 *
 * The API key is read SERVER-SIDE through the WordPress core Connectors API (the `google`
 * connector). Core exposes no public function that returns a key's value, so the resolver
 * follows the same precedence as core's _wp_connectors_get_api_key_source(): environment
 * variable, then PHP constant, then the database option. Every name comes from the
 * connector's own `authentication` definition; nothing is hard-coded here.
 *
 * The key travels in the `x-goog-api-key` header, never in the URL, and is never echoed,
 * logged or returned from a REST route.
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

class Super_Nerd_Bros_Dodo_Air_Gemini {

	const CONNECTOR_ID = 'google';
	const MODEL        = 'gemini-1.5-flash';

	/** Gemini calls one user may make per window. */
	const MAX_CALLS_PER_WINDOW = 10;
	const WINDOW_SECONDS       = HOUR_IN_SECONDS;

	/**
	 * The credential for the Google connector, or '' when it is unregistered or unset.
	 */
	public static function get_key(): string {
		$is_available = function_exists( 'wp_get_connector' ) && function_exists( 'wp_is_connector_registered' );
		if ( ! $is_available || ! wp_is_connector_registered( self::CONNECTOR_ID ) ) {
			return '';
		}

		$connector = wp_get_connector( self::CONNECTOR_ID );
		$auth      = is_array( $connector ) ? ( $connector['authentication'] ?? array() ) : array();

		$from_env = self::from_env( (string) ( $auth['env_var_name'] ?? '' ) );
		if ( '' !== $from_env ) {
			return $from_env;
		}

		$from_constant = self::from_constant( (string) ( $auth['constant_name'] ?? '' ) );
		if ( '' !== $from_constant ) {
			return $from_constant;
		}

		return self::from_option( (string) ( $auth['setting_name'] ?? '' ) );
	}

	/**
	 * Counts one Gemini call against a user's hourly allowance.
	 *
	 * @return true|WP_Error WP_Error with status 429 once the allowance is spent.
	 */
	public static function consume_allowance( int $user_id ) {
		$key   = 'dodo_air_ai_rate_' . $user_id;
		$now   = time();
		$state = get_transient( $key );

		$is_window_open = is_array( $state ) && isset( $state['count'], $state['reset'] ) && $state['reset'] > $now;
		if ( ! $is_window_open ) {
			$state = array(
				'count' => 0,
				'reset' => $now + self::WINDOW_SECONDS,
			);
		}

		if ( $state['count'] >= self::MAX_CALLS_PER_WINDOW ) {
			return new WP_Error(
				'rate_limited',
				'Review limit reached. Please try again later.',
				array( 'status' => 429, 'retry_after' => $state['reset'] - $now )
			);
		}

		$state['count']++;
		set_transient( $key, $state, max( 1, $state['reset'] - $now ) );

		return true;
	}

	/**
	 * Sends one prompt to Gemini and returns the first text part.
	 *
	 * @return string|WP_Error
	 */
	public static function generate_text( string $prompt ) {
		$api_key = self::get_key();
		if ( '' === $api_key ) {
			return new WP_Error( 'no_api_key', 'The Google Gemini key is not configured. Add it in Settings > Connectors.', array( 'status' => 500 ) );
		}

		$url  = 'https://generativelanguage.googleapis.com/v1beta/models/' . self::MODEL . ':generateContent';
		$body = array(
			'contents' => array(
				array(
					'parts' => array(
						array( 'text' => $prompt ),
					),
				),
			),
		);

		$response = wp_remote_post( $url, array(
			'headers' => array(
				'Content-Type'   => 'application/json',
				'x-goog-api-key' => $api_key,
			),
			'body'    => wp_json_encode( $body ),
			'timeout' => 15,
		) );

		if ( is_wp_error( $response ) ) {
			return new WP_Error( 'ai_error', 'Failed to connect to AI service.', array( 'status' => 500 ) );
		}

		$data = json_decode( wp_remote_retrieve_body( $response ), true );
		if ( isset( $data['candidates'][0]['content']['parts'][0]['text'] ) ) {
			return trim( (string) $data['candidates'][0]['content']['parts'][0]['text'] );
		}

		return new WP_Error( 'ai_failed', 'AI did not return a valid response.', array( 'status' => 500 ) );
	}

	private static function from_env( string $env_var_name ): string {
		return '' === $env_var_name ? '' : self::as_string( getenv( $env_var_name ) );
	}

	private static function from_constant( string $constant_name ): string {
		$is_defined = '' !== $constant_name && defined( $constant_name );
		return $is_defined ? self::as_string( constant( $constant_name ) ) : '';
	}

	private static function from_option( string $setting_name ): string {
		return '' === $setting_name ? '' : self::as_string( get_option( $setting_name, '' ) );
	}

	private static function as_string( $value ): string {
		return is_scalar( $value ) ? trim( (string) $value ) : '';
	}
}
