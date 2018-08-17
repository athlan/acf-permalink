<?php
/**
 * Tests case.
 *
 * @package WordPress_ACF_Permalinks
 */

namespace AcfPermalinks\Tests\Unit;

use AcfPermalinks\Field_Permalink_Formatter_Context;
use AcfPermalinks\Formatter\Multivalue_Formatter_Helper;

use InvalidArgumentException;
use PHPUnit_Framework_TestCase;

/**
 * Class Multivalue_Formatter_Helper_UnitTest
 */
class Multivalue_Formatter_Helper_UnitTest extends PHPUnit_Framework_TestCase {

	/**
	 * Setup.
	 */
	public function setUp() {
		$this->value             = 'some-value-to-format';
		$this->permalink_options = array( 'option' => 'value' );
		$this->format_function   = array( $this, 'format_single_value' );
		$this->context           = new Field_Permalink_Formatter_Context();
	}

	/**
	 * Formats the value and remembers passed arguments.
	 *
	 * @param mixed                             $value Value to format.
	 * @param array                             $permalink_options Permalink options.
	 * @param Field_Permalink_Formatter_Context $context Context.
	 *
	 * @return mixed Formatted value.
	 */
	public function format_single_value( $value, array $permalink_options, Field_Permalink_Formatter_Context $context ) {
		$this->format_call = array(
			'value'             => $value,
			'permalink_options' => $permalink_options,
			'context'           => $context,
		);

		if (null === $value) {
			return null;
		}

		return 'Formatted ' . $value;
	}

	/**
	 * Test case.
	 */
	public function test_throws_exception_when_format_function_is_not_callable() {
		// given.
		$helper                       = new Multivalue_Formatter_Helper();
		$not_callable_format_function = 'this is not callable object';

		// when.
		$this->expectException( 'InvalidArgumentException' );
		$helper->format( $this->value, $this->permalink_options, $not_callable_format_function, $this->context );
	}

	/**
	 * Test case.
	 */
	public function test_formats_single_value() {
		// given.
		$helper = new Multivalue_Formatter_Helper();
		$value  = 'some value';

		// when.
		$formatted_value = $helper->format( $value, $this->permalink_options, $this->format_function, $this->context );

		// then.
		$this->assertEquals( $formatted_value, 'Formatted some value' );
		$this->assertThatFormatCallHasArguments( $value, $this->permalink_options, $this->context );
	}

	/**
	 * Test case.
	 */
	public function test_formats_multiple_values() {
		// given.
		$helper = new Multivalue_Formatter_Helper();
		$value  = serialize( array( 'some first value', 'some second value' ) );

		// when.
		$formatted_value = $helper->format( $value, $this->permalink_options, $this->format_function, $this->context );

		// then.
		$this->assertEquals( $formatted_value, 'Formatted some first value-Formatted some second value' );
	}

	/**
	 * Test case.
	 */
	public function test_formats_multiple_values_ignores_nulls() {
		// given.
		$helper = new Multivalue_Formatter_Helper();
		$value  = serialize( array( 'some first value', null, 'some third value' ) );

		// when.
		$formatted_value = $helper->format( $value, $this->permalink_options, $this->format_function, $this->context );

		// then.
		$this->assertEquals( $formatted_value, 'Formatted some first value-Formatted some third value' );
	}

	/**
	 * Test case.
	 */
	public function test_formats_multiple_values_using_custom_separator() {
		// given.
		$helper                         = new Multivalue_Formatter_Helper();
		$value                          = serialize( array( 'some first value', 'some second value' ) );
		$permalink_options              = $this->permalink_options;
		$permalink_options['separator'] = ' and ';

		// when.
		$formatted_value = $helper->format( $value, $permalink_options, $this->format_function, $this->context );

		// then.
		$this->assertEquals( $formatted_value, 'Formatted some first value and Formatted some second value' );
	}

	/**
	 * Assert.
	 *
	 * @param mixed                             $value Value to format.
	 * @param array                             $permalink_options Permalink options.
	 * @param Field_Permalink_Formatter_Context $context Context.
	 */
	private function assertThatFormatCallHasArguments( $value, $permalink_options, $context ) {
		$this->assertTrue( $this->format_call['value'] === $value );
		$this->assertTrue( $this->format_call['permalink_options'] == $permalink_options );
		$this->assertTrue( $this->format_call['context'] === $context );
	}

	/**
	 * Value to format.
	 *
	 * @var string
	 */
	private $value;

	/**
	 * Permalink options.
	 *
	 * @var array
	 */
	private $permalink_options;

	/**
	 * Format callable.
	 *
	 * @var callable
	 */
	private $format_function;

	/**
	 * Given context.
	 *
	 * @var Field_Permalink_Formatter_Context
	 */
	private $context;

	/**
	 * Call to format.
	 *
	 * @var array
	 */
	public $format_call;

}
