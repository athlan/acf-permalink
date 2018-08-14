<?php
/**
 * Base Tests case.
 *
 * @package WordPress_Custom_Fields_Permalink
 */

/**
 * Class BaseTestCase
 */
class BaseTestCase extends WP_UnitTestCase {

	/**
	 * The PermalinkSteps.
	 *
	 * @var PermalinkSteps
	 */
	protected $permalink_steps;

	/**
	 * The PermalinkAsserter.
	 *
	 * @var PermalinkAsserter
	 */
	protected $permalink_asserter;

	/**
	 * The AcfSteps.
	 *
	 * @var AcfSteps
	 */
	protected $acf_steps;

	/**
	 * Set up test.
	 */
	public function setUp() {
		parent::setUp();

		$this->permalink_steps    = new PermalinkSteps( $this );
		$this->permalink_asserter = new PermalinkAsserter( $this );
		$this->acf_steps          = new AcfSteps( $this );
	}
}
