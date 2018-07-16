<?php
/**
 * Default ACF Permalink Formatter
 *
 * @package WordPress_ACF_Permalinks
 */

namespace AcfPermalinks\Formatter;

use AcfPermalinks\FieldPermalinkFormatter;
use AcfPermalinks\FieldPermalinkFormatterContext;
use WP_Post;

/**
 * PostFormatter.
 */
class PostFormatter implements FieldPermalinkFormatter {

	/**
	 * @param FieldPermalinkFormatterContext $context
	 *
	 * @return boolean
	 */
	function supports( FieldPermalinkFormatterContext $context ) {
		$acf_options = $context->getAcfFieldOptions();

		return in_array( $acf_options['type'], array( 'post_object', 'page_link' ) );
	}

	/**
	 * @param FieldPermalinkFormatterContext $context
	 *
	 * @return mixed
	 */
	function format( FieldPermalinkFormatterContext $context ) {
		$context->terminate();

		$value = $context->getValueOriginal();

		// Support for multiple choices.
		$value = maybe_unserialize( $value );
		if ( ! is_array( $value ) ) {
			$value = array( $value );
		}

		return $this->format_value( $value, $context->getPermalinkOptions() );
	}

	private function format_value( array $values, $permalink_options ) {
		$new_values = array();

		foreach ( $values as $value ) {
			$value        = $this->format_value_single( $value, $permalink_options );
			$new_values[] = $value;
		}

		$value = join( '-', $new_values );

		return $value;
	}

	private function format_value_single( $value, $permalink_options ) {
		// TODO get post name or id

		$post = get_post( $value );

		if ( $post instanceof WP_Post ) {
			$value = $post->post_name;
		}

		return $value;
	}
}
