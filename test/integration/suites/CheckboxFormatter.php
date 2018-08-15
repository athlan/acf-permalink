<?php
/**
 * Tests case.
 *
 * @package WordPress_ACF_Permalinks
 */

namespace AcfPermalinks\Tests\Integration\MetaKeyPermalinkStructure;

use BaseTestCase;

/**
 * Class DatepickerFormatter
 */
class CheckboxFormatter extends BaseTestCase {

	/**
	 * Test case.
	 */
	function test_generates_permalink_with_single_value() {
		// given.
		$this->permalink_steps->given_permalink_structure( '/%field_some_checkbox_field%/%postname%/' );
		$this->given_checkbox_field( 'some_checkbox_field' );
		$selected_values = array( 'cat' );

		$post_params     = array(
			'post_title' => 'Some page title',
			'meta_input' => array(
				'some_checkbox_field' => $selected_values,
			),
		);
		$created_post_id = $this->factory()->post->create( $post_params );

		// when & then.
		$this->permalink_asserter->has_permalink( $created_post_id, '/cat/some-page-title/' );
	}

	/**
	 * Test case.
	 */
	function test_generates_permalink_with_multiple_values_separated_default() {
		// given.
		$this->permalink_steps->given_permalink_structure( '/%field_some_checkbox_field%/%postname%/' );
		$this->given_checkbox_field( 'some_checkbox_field' );
		$selected_values = array( 'cat', 'dog' );

		$post_params     = array(
			'post_title' => 'Some page title',
			'meta_input' => array(
				'some_checkbox_field' => $selected_values,
			),
		);
		$created_post_id = $this->factory()->post->create( $post_params );

		// when & then.
		$this->permalink_asserter->has_permalink( $created_post_id, '/cat-dog/some-page-title/' );
	}

	/**
	 * Test case.
	 */
	function test_generates_permalink_with_multiple_values_custom_separated() {
		// given.
		$this->permalink_steps->given_permalink_structure( '/%field_some_checkbox_field(separator="-and-")%/%postname%/' );
		$this->given_checkbox_field( 'some_checkbox_field' );
		$selected_values = array( 'cat', 'dog' );

		$post_params     = array(
			'post_title' => 'Some page title',
			'meta_input' => array(
				'some_checkbox_field' => $selected_values,
			),
		);
		$created_post_id = $this->factory()->post->create( $post_params );

		// when & then.
		$this->permalink_asserter->has_permalink( $created_post_id, '/cat-and-dog/some-page-title/' );
	}

	/**
	 * Test case.
	 */
	function test_generates_permalink_using_labels_with_single_value() {
		// given.
		$this->permalink_steps->given_permalink_structure( '/%field_some_checkbox_field(label)%/%postname%/' );
		$this->given_checkbox_field( 'some_checkbox_field' );
		$selected_values = array( 'cat' );

		$post_params     = array(
			'post_title' => 'Some page title',
			'meta_input' => array(
				'some_checkbox_field' => $selected_values,
			),
		);
		$created_post_id = $this->factory()->post->create( $post_params );

		// when & then.
		$this->permalink_asserter->has_permalink( $created_post_id, '/cat-label/some-page-title/' );
	}

	/**
	 * Test case.
	 */
	function test_generates_permalink_using_labels_with_multiple_values() {
		// given.
		$this->permalink_steps->given_permalink_structure( '/%field_some_checkbox_field(label)%/%postname%/' );
		$this->given_checkbox_field( 'some_checkbox_field' );
		$selected_values = array( 'cat', 'dog' );

		$post_params     = array(
			'post_title' => 'Some page title',
			'meta_input' => array(
				'some_checkbox_field' => $selected_values,
			),
		);
		$created_post_id = $this->factory()->post->create( $post_params );

		// when & then.
		$this->permalink_asserter->has_permalink( $created_post_id, '/cat-label-dog-label/some-page-title/' );
	}

	/**
	 * Test case.
	 */
	function test_generates_permalink_using_value_instead_of_label_when_value_does_not_exit_on_choice_list() {
		// given.
		$this->permalink_steps->given_permalink_structure( '/%field_some_checkbox_field(label)%/%postname%/' );
		$this->given_checkbox_field( 'some_checkbox_field' );
		$selected_values = array( 'unexisting-value' );

		$post_params     = array(
			'post_title' => 'Some page title',
			'meta_input' => array(
				'some_checkbox_field' => $selected_values,
			),
		);
		$created_post_id = $this->factory()->post->create( $post_params );

		// when & then.
		$this->permalink_asserter->has_permalink( $created_post_id, '/unexisting-value/some-page-title/' );
	}

	/**
	 * Define checkbox field.
	 *
	 * @param string $name Field name.
	 */
	private function given_checkbox_field( $name ) {
		$field_options = array(
			'choices' => array(
				'cat'      => 'Cat label',
				'dog'      => 'Dog label',
				'elephant' => 'Elephant label',
			),
		);

		$this->acf_steps->given_acf_field( $name, 'checkbox', $field_options );
	}
}
