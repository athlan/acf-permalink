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
 * DatepickerFormatter.
 */
class DatepickerFormatter implements FieldPermalinkFormatter {

	/**
	 * @param FieldPermalinkFormatterContext $context
	 *
	 * @return boolean
	 */
	function supports( FieldPermalinkFormatterContext $context ) {
		$acf_options = $context->getAcfFieldOptions();

		return $acf_options['type'] == 'date_picker';
	}

	/**
	 * @param FieldPermalinkFormatterContext $context
	 *
	 * @return mixed
	 */
	function format( FieldPermalinkFormatterContext $context ) {
		$context->terminate();

		$value = $context->getValueOriginal();
		return $this->format_value($value, $context->getPermalinkOptions());
	}

	private function format_value( $value, $permalink_options ) {
		return $value;
	}
}
