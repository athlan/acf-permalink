<?php
/**
 * Default ACF Permalink Formatter
 *
 * @package WordPress_ACF_Permalinks
 */

namespace AcfPermalinks\Formatter;

use AcfPermalinks\Field_Permalink_Formatter;
use AcfPermalinks\Field_Permalink_Formatter_Context;
use WP_Post;

/**
 * Post_Formatter.
 */
class Post_Formatter implements Field_Permalink_Formatter {

	/**
	 * Checks is formatter can support field.
	 *
	 * @param Field_Permalink_Formatter_Context $context Formatting context.
	 *
	 * @return boolean
	 */
	function supports( Field_Permalink_Formatter_Context $context ) {
		$acf_options = $context->acf_field_options();

		return in_array( $acf_options['type'], array( 'post_object', 'page_link' ) );
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
		$format_function   = array( $this, 'format_value_single' );

		return Multivalue_Formatter_Helper::format( $value, $permalink_options, $format_function, $context );
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
		$post = get_post( $value );

		if ( $post instanceof WP_Post ) {
			$value = $post->post_name;

			return $value;
		}

		return null;
	}
}
