<?php
/**
 * Default ACF Permalink Formatter
 *
 * @package WordPress_ACF_Permalinks
 */

namespace AcfPermalinks\Formatter;

use AcfPermalinks\FieldPermalinkFormatterContext;
use InvalidArgumentException;

/**
 * DatepickerFormatter.
 */
class MultivalueFormatterHelper {

	public static function format( $value, $permalink_options, $format_function, FieldPermalinkFormatterContext $context ) {
		if ( ! is_callable( $format_function ) ) {
			throw new InvalidArgumentException( "Format function is not callable." );
		}

		// Support for multiple choices.
		$values = maybe_unserialize( $value );
		if ( ! is_array( $values ) ) {
			$values = array( $values );
		}

		$new_values = array();

		foreach ( $values as $value ) {
			$value        = call_user_func_array( $format_function, array( $value, $permalink_options, $context ) );
			$new_values[] = $value;
		}

		if ( array_key_exists( 'separator', $permalink_options ) ) {
			$join_by = $permalink_options['separator'];
		} else {
			$join_by = '-';
		}

		return join( $join_by, $new_values );
	}
}
