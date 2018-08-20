<?php
/**
 * Default ACF Permalink Formatter
 *
 * @package WordPress_ACF_Permalinks
 */

namespace AcfPermalinks\Formatter;

use AcfPermalinks\Field_Permalink_Formatter;
use AcfPermalinks\Field_Permalink_Formatter_Context;
use WP_User;

/**
 * User_Formatter.
 */
class User_Formatter implements Field_Permalink_Formatter {

	/**
	 * Checks is formatter can support field.
	 *
	 * @param Field_Permalink_Formatter_Context $context Formatting context.
	 *
	 * @return boolean
	 */
	function supports( Field_Permalink_Formatter_Context $context ) {
		$acf_options = $context->acf_field_options();

		return 'user' == $acf_options['type'];
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
		$user = get_userdata( $value );

		if ( $user instanceof WP_User ) {
			if ( array_key_exists( 'format', $permalink_options ) ) {
				$format = $permalink_options['format'];
				$value  = $this->format_value_tokens( $user, $format );
			} else {
				$value = $user->user_login;
			}

			return $value;
		}

		return null;
	}

	/**
	 * Assemblies final string based on given format.
	 *
	 * @param WP_User $user User.
	 * @param string  $format Format.
	 *
	 * @return string The formatted string.
	 */
	private function format_value_tokens( WP_User $user, $format ) {
		$replacements = array(
			'login'       => $user->user_login,
			'nicename'    => $user->user_nicename,
			'firstname'   => $user->first_name,
			'lastname'    => $user->last_name,
			'displayname' => $user->display_name,
			'email'       => str_replace( '@', ' at ', $user->user_email ),
		);

		return str_replace( array_keys( $replacements ), array_values( $replacements ), $format );
	}
}
