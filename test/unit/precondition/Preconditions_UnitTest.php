<?php
/**
 * Tests case.
 *
 * @package WordPress_ACF_Permalinks
 */

namespace AcfPermalinks\Tests\Unit;

use AcfPermalinks\Preconditions;
use PHPUnit_Framework_TestCase;

/**
 * Class Multivalue_Formatter_Helper_UnitTest
 */
class Preconditions_UnitTest extends PHPUnit_Framework_TestCase {

	/**
	 * Passing check.
	 *
	 * @var callable
	 */
	private $check_failing;

	/**
	 * Failing check.
	 *
	 * @var callable
	 */
	private $check_passing;

	/**
	 * Setup.
	 */
	public function setUp() {
		$this->check_failing = function () {
			return Preconditions::build_check_result( false );
		};
		$this->check_passing = function () {
			return Preconditions::build_check_result( true );
		};
	}

	/**
	 * Test case.
	 */
	public function test_success_if_all_check_passes() {
		// given.
		$preconditions = new Preconditions();
		$preconditions->add_precondition( 'check1', $this->check_passing );
		$preconditions->add_precondition( 'check2', $this->check_passing );

		// when.
		$result = $preconditions->check();

		// then.
		$this->assertTrue( $result['result'] );
		$this->assertCount( 2, $result['checks'] );

		$this->assertArrayHasKey( 'check1', $result['checks'] );
		$this->assertArrayHasKey( 'check2', $result['checks'] );

		$this->assertTrue( $result['checks']['check1']['result'] );
		$this->assertTrue( $result['checks']['check2']['result'] );
	}

	/**
	 * Test case.
	 */
	public function test_fail_if_one_check_fail() {
		// given.
		$preconditions = new Preconditions();
		$preconditions->add_precondition( 'check1', $this->check_passing );
		$preconditions->add_precondition( 'check2', $this->check_failing );

		// when.
		$result = $preconditions->check();

		// then.
		$this->assertFalse( $result['result'] );
		$this->assertCount( 2, $result['checks'] );

		$this->assertArrayHasKey( 'check1', $result['checks'] );
		$this->assertArrayHasKey( 'check2', $result['checks'] );

		$this->assertTrue( $result['checks']['check1']['result'] );
		$this->assertFalse( $result['checks']['check2']['result'] );
	}

	/**
	 * Test case.
	 */
	public function test_fail_if_all_checks_fail() {
		// given.
		$preconditions = new Preconditions();
		$preconditions->add_precondition( 'check1', $this->check_failing );
		$preconditions->add_precondition( 'check2', $this->check_failing );

		// when.
		$result = $preconditions->check();

		// then.
		$this->assertFalse( $result['result'] );
		$this->assertCount( 2, $result['checks'] );

		$this->assertArrayHasKey( 'check1', $result['checks'] );
		$this->assertArrayHasKey( 'check2', $result['checks'] );

		$this->assertFalse( $result['checks']['check1']['result'] );
		$this->assertFalse( $result['checks']['check2']['result'] );
	}
}
