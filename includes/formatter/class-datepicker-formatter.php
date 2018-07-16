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

		$date_value = date_create( $context->getValueOriginal() );

		return $this->format_value( $date_value, $context->getPermalinkOptions() );
	}

	private function format_value( \DateTime $value, $permalink_options ) {
		// TODO et format
		$format = "Y-m-d";

		return $value->format($format);
	}
}
