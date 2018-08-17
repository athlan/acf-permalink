<?php
/**
 * Tests case.
 *
 * @package WordPress_ACF_Permalinks
 */

namespace AcfPermalinks\Tests\Integration\MetaKeyPermalinkStructure;

use BaseTestCase;

/**
 * Class DefaultFormatter
 */
class DefaultFormatter extends BaseTestCase {

	/**
	 * Test case.
	 */
	function test_generates_permalink_with_default_single_value() {
		// given.
		$this->permalink_steps->given_permalink_structure( '/%field_some_text_field%/%postname%/' );
		$this->given_text_field( 'some_text_field' );
		$value = 'Some Value';

		$post_params     = array(
			'post_title' => 'Some page title',
			'meta_input' => array(
				'some_text_field' => $value,
			),
		);
		$created_post_id = $this->factory()->post->create( $post_params );

		// when & then.
		$this->permalink_asserter->has_permalink( $created_post_id, '/some-value/some-page-title/' );
	}

	/**
	 * Test case.
	 */
	function test_generates_permalink_with_multiple_values_using_default_separator() {
		// given.
		$this->permalink_steps->given_permalink_structure( '/%field_some_text_field%/%postname%/' );
		$this->given_text_field( 'some_text_field' );
		$value = array( 'Some first value', 'Some second value' );

		$post_params     = array(
			'post_title' => 'Some page title',
			'meta_input' => array(
				'some_text_field' => $value,
			),
		);
		$created_post_id = $this->factory()->post->create( $post_params );

		// when & then.
		$this->permalink_asserter->has_permalink( $created_post_id, '/some-first-value-some-second-value/some-page-title/' );
	}

	/**
	 * Define text field.
	 *
	 * @param string $name Field name.
	 */
	private function given_text_field( $name ) {
		$field_options = array();

		$this->acf_steps->given_acf_field( $name, 'text', $field_options );
	}
}
