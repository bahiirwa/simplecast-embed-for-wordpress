<?php
/**
 * Add Embed shortcode.
 * Adds backward compatibility in that.
 *
 * @package SimplecastEmbedForWordPress
 */

/**
 * Add shortcode callback.
 *
 * @param array $atts Attributes from the shortcode.
 *
 * @return string html for the shortcode.
 */
function simplecast_embed( $atts ) {

	if ( ! isset( $atts['src'] ) ) {
		return '[simplecast-embed error="src attribute needs to be set"]';
	}

	$mode = 'false';
	if ( 1 === $atts['mode'] || $atts['mode'] ) {
		$mode = 'true';
	}

	$url = 'https://api.simplecast.com/oembed?url=' . $atts['src'] . '?dark=' . $mode;

	$response = wp_remote_get( $url );

	if ( ! is_array( $response ) || isset( $response['errors'] ) || ! isset( $response['body'] ) ) {
		return '[simplecast-embed error="Could not find episode"]';
	}

	$json_data = json_decode( $response['body'], true );

	if ( ! $json_data || ! isset( $json_data['html'] ) || ! is_string( $json_data['html'] ) ) {
		return '[simplecast-embed error="Could not get iframe html"]';
	}

	$whitelist = array(
		'iframe' => array(
			'frameborder' => array(),
			'height'      => array(),
			'scrolling'   => array(),
			'src'         => array(),
			'title'       => array(),
			'width'       => array(),
		),
	);

	return wp_kses( $json_data['html'], $whitelist );
}

add_shortcode( 'simplecast-embed', 'simplecast_embed' );
