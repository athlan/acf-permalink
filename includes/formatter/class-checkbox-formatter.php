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

		$value             = $context->getValueOriginal();
		$permalink_options = $context->getPermalinkOptions();
		$format_function   = array( $this, "format_value_single" );

		return MultivalueFormatterHelper::format( $value, $permalink_options, $format_function, $context );
	}

	public function format_value_single( $value, $permalink_options, FieldPermalinkFormatterContext $context ) {
		// TODO get values or labels
		return $value;
	}
}
