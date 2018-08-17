<?php
/**
 * Default ACF Permalink Formatter
 *
 * @package WordPress_ACF_Permalinks
 */

namespace AcfPermalinks\Formatter;

use AcfPermalinks\Field_Permalink_Formatter;
use AcfPermalinks\Field_Permalink_Formatter_Context;

/**
 * Radio_Formatter.
 */
class Radio_Formatter implements Field_Permalink_Formatter {

	/**
	 * Checks is formatter can support field.
	 *
	 * @param Field_Permalink_Formatter_Context $context Formatting context.
	 *
	 * @return boolean
	 */
	function supports( Field_Permalink_Formatter_Context $context ) {
		$acf_options = $context->acf_field_options();

		return 'radio' == $acf_options['type'];
	}

	/**
	 * Performs field value formatting.
	 *
	 * @param Field_Permalink_Formatter_Context $context Formatting context.
	 *
	 * @return mixed
	 */
	function format( Field_Permalink_Formatter_Context $context ) {
		$context->terminate();

		$value             = $context->value_original();
		$permalink_options = $context->permalink_options();

		return $this->format_value_single( $value, $permalink_options, $context );
	}

	/**
	 * Format single value.
	 *
	 * @param string                            $value Field name.
	 * @param array                             $permalink_options Permalink options.
	 * @param Field_Permalink_Formatter_Context $context Formatting context.
	 *
	 * @return mixed
	 */
	public function format_value_single( $value, $permalink_options, Field_Permalink_Formatter_Context $context ) {
		if ( array_key_exists( 'label', $permalink_options ) ) {
			$acf_field_options = $context->acf_field_options();
			$choices           = $acf_field_options['choices'];

			if ( array_key_exists( $value, $choices ) ) {
				return $choices[ $value ];
			} else {
				return $value;
			}
		}

		return $value;
	}
}
