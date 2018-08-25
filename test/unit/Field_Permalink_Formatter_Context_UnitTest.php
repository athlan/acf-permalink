<?php
/**
 * Tests case.
 *
 * @package WordPress_ACF_Permalinks
 */

namespace AcfPermalinks\Tests\Unit;

use AcfPermalinks\Field_Permalink_Formatter_Context;

use PHPUnit_Framework_TestCase;
use WP_Post;

/**
 * Class Field_Permalink_Formatter_Context_UnitTest
 */
class Field_Permalink_Formatter_Context_UnitTest extends PHPUnit_Framework_TestCase {

	/**
	 * Test case.
	 */
	public function test_initializes_context_properly() {
		// given.
		$context = new Field_Permalink_Formatter_Context();

		// when.
		$context->initialize($this->field_name, $this->field_value, $this->field_original_value,
			$this->permalink_options, $this->acf_field_options, $this->wp_post);

		// then.
		$this->assertEquals( $this->field_name, $context->field_name());
		$this->assertEquals( $this->field_value, $context->value());
		$this->assertEquals( $this->field_original_value, $context->value_original());
		$this->assertEquals( $this->permalink_options, $context->permalink_options());
		$this->assertEquals( $this->acf_field_options, $context->acf_field_options());
		$this->assertEquals( $this->wp_post, $context->post());
	}

	/**
	 * Test case.
	 */
	public function test_is_not_terminated_after_initialization() {
		// given.
		$context = new Field_Permalink_Formatter_Context();

		// when.
		$context->initialize($this->field_name, $this->field_value, $this->field_original_value,
			$this->permalink_options, $this->acf_field_options, $this->wp_post);

		// then.
		$this->assertFalse( $context->is_terminated());
	}

	/**
	 * Test case.
	 */
	public function test_is_terminated_after_termination() {
		// given.
		$context = new Field_Permalink_Formatter_Context();

		// when.
		$context->initialize($this->field_name, $this->field_value, $this->field_original_value,
			$this->permalink_options, $this->acf_field_options, $this->wp_post);

		$context->terminate();

		// then.
		$this->assertTrue( $context->is_terminated());
	}

	/**
	 * Test case.
	 */
	public function test_is_not_terminated_after_termination_and_second_initialization() {
		// given.
		$context = new Field_Permalink_Formatter_Context();

		// when.
		$context->initialize($this->field_name, $this->field_value, $this->field_original_value,
			$this->permalink_options, $this->acf_field_options, $this->wp_post);

		$context->terminate();

		$context->initialize($this->field_name, $this->field_value, $this->field_original_value,
			$this->permalink_options, $this->acf_field_options, $this->wp_post);

		// then.
		$this->assertFalse( $context->is_terminated());
	}

	/**
	 * Field name.
	 *
	 * @var string
	 */
	private $field_name = 'field_name';

	/**
	 * Field value.
	 *
	 * @var array
	 */
	private $field_value = array('some_value');

	/**
	 * Field original value.
	 *
	 * @var array
	 */
	private $field_original_value = array('some_original_value');

	/**
	 * Permalink options.
	 *
	 * @var array
	 */
	private $permalink_options = array('some_permalink_options');

	/**
	 * ACF field options.
	 *
	 * @var array
	 */
	private $acf_field_options = array('some_acf_field_options');

	/**
	 * Test post.
	 *
	 * @var WP_Post
	 */
	private $wp_post = null;
}
