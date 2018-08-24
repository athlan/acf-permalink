<?php
/**
 * Precoditions checker.
 *
 * @package WordPress_ACF_Permalinks
 */

namespace AcfPermalinks;

/**
 * Class Preconditions
 *
 * @package AcfPermalinks
 */
class Preconditions {

	/**
	 * Preconditions.
	 *
	 * @var array
	 */
	private $preconditions = array();

	/**
	 * Adds precondition to check.
	 *
	 * @param string   $name The precondition name.
	 * @param callable $check_callback The precondition callback.
	 */
	public function add_precondition( $name, $check_callback ) {
		$this->preconditions[] = array(
			'name'           => $name,
			'check_callback' => $check_callback,
		);
	}

	/**
	 * Builds precondition checker result.
	 *
	 * @param boolean $result Result.
	 * @param array   $extra_info An extra info.
	 *
	 * @return array
	 */
	public static function build_check_result( $result, array $extra_info = array() ) {
		return array(
			'result'     => $result,
			'extra_info' => $extra_info,
		);
	}

	/**
	 * Performs checks.
	 *
	 * @return array The result.
	 */
	public function check() {
		$result_general = true;
		$results        = array();

		foreach ( $this->preconditions as $precondition ) {
			$check_result = call_user_func( $precondition['check_callback'] );
			$result       = $check_result['result'];
			$extra_info   = $check_result['extra_info'];

			if ( false === $result ) {
				$result_general = false;
			}
			$results[ $precondition['name'] ] = array(
				'result'     => $result,
				'extra_info' => $extra_info,
			);
		}

		return array(
			'result' => $result_general,
			'checks' => $results,
		);
	}
}
