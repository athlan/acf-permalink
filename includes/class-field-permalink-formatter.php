<?php
/**
 * Interface definition for formatters.
 *
 * @package WordPress_ACF_Permalinks
 */

namespace AcfPermalinks;

use AcfPermalinks\Field_Permalink_Formatter_Context;
use WP_Post;

/**
 * Field_Permalink_Formatter.
 */
interface Field_Permalink_Formatter {

	/**
	 * Checks is formatter can support field.
	 *
	 * @param Field_Permalink_Formatter_Context $context Formatting context.
	 *
	 * @return boolean
	 */
	function supports( Field_Permalink_Formatter_Context $context );

	/**
	 * Performs field value formatting.
	 *
	 * @param Field_Permalink_Formatter_Context $context Formatting context.
	 *
	 * @return mixed
	 */
	function format( Field_Permalink_Formatter_Context $context );
}
