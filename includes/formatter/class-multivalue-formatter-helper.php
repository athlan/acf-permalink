<?php
/**
 * Default ACF Permalink Formatter
 *
 * @package WordPress_ACF_Permalinks
 */

namespace AcfPermalinks\Formatter;

use AcfPermalinks\Field_Permalink_Formatter_Context;
use InvalidArgumentException;

/**
 * Multivalue_Formatter_Helper.
 */
class Multivalue_Formatter_Helper {

	/**
	 * Helps to dispatch potentially multi-value field to format.
	 *
	 * @param mixed                             $value Field values.
	 * @param array                             $permalink_options Permalink options.
	 * @param callable                          $format_function Format function reference.
	 * @param Field_Permalink_Formatter_Context $context Formatting context.
	 *
	 * @return string
	 * @throws InvalidArgumentException When $format_function is not callable.
	 */
	public static function format( $value, $permalink_options, $format_function, Field_Permalink_Formatter_Context $context ) {
		if ( ! is_callable( $format_function ) ) {
			throw new InvalidArgumentException( 'Format function is not callable.' );
		}

		// Support for multiple choices.
		$values = maybe_unserialize( $value );
		if ( ! is_array( $values ) ) {
			$values = array( $values );
		}

		$new_values = array();

		foreach ( $values as $value ) {
			$value = call_user_func_array( $format_function, array( $value, $permalink_options, $context ) );

			if ( null !== $value ) {
				$new_values[] = $value;
			}
		}

		if ( 0 === count( $new_values ) ) {
			return null;
		}

		if ( array_key_exists( 'separator', $permalink_options ) ) {
			$join_by = $permalink_options['separator'];
		} else {
			$join_by = '-';
		}

		return join( $join_by, $new_values );
	}
}
