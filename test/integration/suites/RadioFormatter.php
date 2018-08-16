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
class RadioFormatter extends BaseTestCase {

	/**
	 * Test case.
	 */
	function test_generates_permalink_with_single_value() {
		// given.
		$this->permalink_steps->given_permalink_structure( '/%field_some_radio_field%/%postname%/' );
		$this->given_radio_field( 'some_radio_field' );
		$selected_value = 'cat';

		$post_params     = array(
			'post_title' => 'Some page title',
			'meta_input' => array(
				'some_radio_field' => $selected_value,
			),
		);
		$created_post_id = $this->factory()->post->create( $post_params );

		// when & then.
		$this->permalink_asserter->has_permalink( $created_post_id, '/cat/some-page-title/' );
	}

	/**
	 * Test case.
	 */
	function test_generates_permalink_when_value_does_not_exit_on_choice_list() {
		// given.
		$this->permalink_steps->given_permalink_structure( '/%field_some_radio_field%/%postname%/' );
		$this->given_radio_field( 'some_radio_field' );
		$selected_value = 'unexisting-value';

		$post_params     = array(
			'post_title' => 'Some page title',
			'meta_input' => array(
				'some_radio_field' => $selected_value,
			),
		);
		$created_post_id = $this->factory()->post->create( $post_params );

		// when & then.
		$this->permalink_asserter->has_permalink( $created_post_id, '/unexisting-value/some-page-title/' );
	}

	/**
	 * Test case.
	 */
	function test_generates_permalink_using_labels_with_single_value() {
		// given.
		$this->permalink_steps->given_permalink_structure( '/%field_some_radio_field(label)%/%postname%/' );
		$this->given_radio_field( 'some_radio_field' );
		$selected_value = 'cat';

		$post_params     = array(
			'post_title' => 'Some page title',
			'meta_input' => array(
				'some_radio_field' => $selected_value,
			),
		);
		$created_post_id = $this->factory()->post->create( $post_params );

		// when & then.
		$this->permalink_asserter->has_permalink( $created_post_id, '/cat-label/some-page-title/' );
	}

	/**
	 * Test case.
	 */
	function test_generates_permalink_using_value_instead_of_label_when_value_does_not_exit_on_choice_list() {
		// given.
		$this->permalink_steps->given_permalink_structure( '/%field_some_radio_field(label)%/%postname%/' );
		$this->given_radio_field( 'some_radio_field' );
		$selected_value = 'unexisting-value';

		$post_params     = array(
			'post_title' => 'Some page title',
			'meta_input' => array(
				'some_radio_field' => $selected_value,
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
	private function given_radio_field( $name ) {
		$field_options = array(
			'choices'           => array(
				'cat'      => 'Cat label',
				'dog'      => 'Dog label',
				'elephant' => 'Elephant label',
			),
			'other_choice'      => 0,
			'save_other_choice' => 0,
		);

		$this->acf_steps->given_acf_field( $name, 'radio', $field_options );
	}
}
