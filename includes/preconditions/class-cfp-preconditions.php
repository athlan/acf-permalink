<?php
/**
 * Precoditions checker.
 *
 * @package WordPress_ACF_Permalinks
 */

namespace AcfPermalinks;

/**
 * Class Cfp_Preconditions
 *
 * @package AcfPermalinks
 */
class Cfp_Preconditions {

	/**
	 * Checks if Custom Fields Permalink 2 plugin is installed.
	 *
	 * @return array Check result.
	 */
	public static function check_cfp_installed() {
		$result = defined( 'WORDPRESS_CUSTOM_FIELDS_PERMALINK_PLUGIN_VERSION' );
		return Preconditions::build_check_result( $result );
	}

	/**
	 * Checks if Custom Fields Permalink 2 plugin is installed in expected version.
	 *
	 * @return array Check result.
	 */
	public static function check_cfp_min_version() {
		$version          = @constant( 'WORDPRESS_CUSTOM_FIELDS_PERMALINK_PLUGIN_VERSION' );
		$expected_version = '1.4.0';

		$result     = null !== $version && version_compare( $version, $expected_version ) >= 0;
		$extra_info = array(
			'current_version'  => $version,
			'expected_version' => $expected_version,
		);

		return Preconditions::build_check_result( $result, $extra_info );
	}
}
