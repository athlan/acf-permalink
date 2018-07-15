<?php
/**
 * Interface definition for formatters.
 *
 * @package WordPress_ACF_Permalinks
 */

namespace AcfPermalinks;

use AcfPermalinks\FieldPermalinkFormatterContext;
use WP_Post;

/**
 * FieldPermalinkFormatter.
 */
interface FieldPermalinkFormatter {

	/**
	 * @param FieldPermalinkFormatterContext $context
	 *
	 * @return boolean
	 */
	function supports( FieldPermalinkFormatterContext $context );

	/**
	 * @param FieldPermalinkFormatterContext $context
	 *
	 * @return mixed
	 */
	function format( FieldPermalinkFormatterContext $context );
}
