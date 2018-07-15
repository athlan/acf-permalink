<?php
/**
 * Default ACF Permalink Formatter
 *
 * @package WordPress_ACF_Permalinks
 */

namespace AcfPermalinks\Formatter;

use AcfPermalinks\FieldPermalinkFormatter;
use AcfPermalinks\FieldPermalinkFormatterContext;

/**
 * CheckboxFormatter.
 */
class CheckboxFormatter implements FieldPermalinkFormatter {

	/**
	 * @param FieldPermalinkFormatterContext $context
	 *
	 * @return boolean
	 */
	function supports( FieldPermalinkFormatterContext $context ) {
		$acf_options = $context->getAcfFieldOptions();

		return $acf_options['type'] == 'checkbox';
	}

	/**
	 * @param FieldPermalinkFormatterContext $context
	 *
	 * @return mixed
	 */
	function format( FieldPermalinkFormatterContext $context ) {
		$context->terminate();

		$value = $context->getValueOriginal();
		$value = maybe_unserialize($value);

		return $this->format_value($value, $context->getPermalinkOptions());
	}

	private function format_value( $value, $permalink_options ) {
		if ( is_array( $value ) ) {
			$value = join( '-', $value );
		}

		return $value;
	}
}
