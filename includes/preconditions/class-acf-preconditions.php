<?php
/**
 * Precoditions checker.
 *
 * @package WordPress_ACF_Permalinks
 */

namespace AcfPermalinks;

/**
 * Class Acf_Preconditions
 *
 * @package AcfPermalinks
 */
class Acf_Preconditions {

	/**
	 * Checks if ACF plugin is installed.
	 *
	 * @return array Check result.
	 */
	public static function check_acf_installed() {
		$result = class_exists( 'acf' );
		return Preconditions::build_check_result( $result );
	}
}
