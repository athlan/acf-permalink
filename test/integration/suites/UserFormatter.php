<?php
/**
 * Tests case.
 *
 * @package WordPress_ACF_Permalinks
 */

namespace AcfPermalinks\Tests\Integration\MetaKeyPermalinkStructure;

use BaseTestCase;

/**
 * Class UserFormatter
 */
class UserFormatter extends BaseTestCase {

	/**
	 * Test case.
	 */
	function test_generates_permalink_with_username_by_default_single_value() {
		// given.
		$this->permalink_steps->given_permalink_structure( '/%field_some_user_field%/%postname%/' );
		$this->given_user_field( 'some_user_field' );
		$some_users = $this->given_some_users( 2 );

		$selected_values = $some_users[0];

		$post_params     = array(
			'post_title' => 'Some page title',
			'meta_input' => array(
				'some_user_field' => $selected_values,
			),
		);
		$created_post_id = $this->factory()->post->create( $post_params );

		// when & then.
		$this->permalink_asserter->has_permalink( $created_post_id, '/user1/some-page-title/' );
	}

	/**
	 * Test case.
	 */
	function test_generates_permalink_without_username_by_default_when_user_not_exists() {
		// given.
		$this->permalink_steps->given_permalink_structure( '/%field_some_user_field%/%postname%/' );
		$this->given_user_field( 'some_user_field' );

		$selected_values = self::NOT_EXISTING_USER_ID;

		$post_params     = array(
			'post_title' => 'Some page title',
			'meta_input' => array(
				'some_user_field' => $selected_values,
			),
		);
		$created_post_id = $this->factory()->post->create( $post_params );

		// when & then.
		$this->permalink_asserter->has_permalink( $created_post_id, '/some-page-title/' );
	}

	/**
	 * Test case.
	 */
	function test_generates_permalink_with_username_with_multiple_values_separated_default() {
		// given.
		$this->permalink_steps->given_permalink_structure( '/%field_some_user_field%/%postname%/' );
		$this->given_user_multiple_field( 'some_user_field' );
		$some_users = $this->given_some_users( 2 );

		$selected_values = array( $some_users[0], $some_users[1] );

		$post_params     = array(
			'post_title' => 'Some page title',
			'meta_input' => array(
				'some_user_field' => $selected_values,
			),
		);
		$created_post_id = $this->factory()->post->create( $post_params );

		// when & then.
		$this->permalink_asserter->has_permalink( $created_post_id, '/user1-user2/some-page-title/' );
	}

	/**
	 * Test case.
	 */
	function test_generates_permalink_with_username_with_multiple_values_custom_separated() {
		// given.
		$this->permalink_steps->given_permalink_structure( '/%field_some_user_field(separator="-and-")%/%postname%/' );
		$this->given_user_multiple_field( 'some_user_field' );
		$some_users = $this->given_some_users( 2 );

		$selected_values = array( $some_users[0], $some_users[1] );

		$post_params     = array(
			'post_title' => 'Some page title',
			'meta_input' => array(
				'some_user_field' => $selected_values,
			),
		);
		$created_post_id = $this->factory()->post->create( $post_params );

		// when & then.
		$this->permalink_asserter->has_permalink( $created_post_id, '/user1-and-user2/some-page-title/' );
	}

	/**
	 * Test case.
	 */
	function test_generates_permalink_with_username_with_multiple_values_ignoring_not_existing() {
		// given.
		$this->permalink_steps->given_permalink_structure( '/%field_some_user_field%/%postname%/' );
		$this->given_user_multiple_field( 'some_user_field' );
		$some_users = $this->given_some_users( 2 );

		$selected_values = array( self::NOT_EXISTING_USER_ID, $some_users[1] );

		$post_params     = array(
			'post_title' => 'Some page title',
			'meta_input' => array(
				'some_user_field' => $selected_values,
			),
		);
		$created_post_id = $this->factory()->post->create( $post_params );

		// when & then.
		$this->permalink_asserter->has_permalink( $created_post_id, '/user2/some-page-title/' );
	}

	/**
	 * Define post object field.
	 *
	 * @param string $name Field name.
	 */
	private function given_user_field( $name ) {
		$field_options = array(
			'role' => array (
				0 => 'all',
			),
			'field_type' => 'select',
			'allow_null' => 0,
		);

		$this->acf_steps->given_acf_field( $name, 'user', $field_options );
	}

	/**
	 * Define post object field.
	 *
	 * @param string $name Field name.
	 */
	private function given_user_multiple_field( $name ) {
		$field_options = array(
			'role' => array (
				0 => 'all',
			),
			'field_type' => 'multi_select',
			'allow_null' => 0,
		);

		$this->acf_steps->given_acf_field( $name, 'user', $field_options );
	}

	/**
	 * Generates random users.
	 *
	 * @param integer $number_of_users The number of users to generate.
	 *
	 * @return integer[] Created user's ids.
	 */
	private function given_some_users( $number_of_users ) {
		$i        = 0;
		$user_ids = array();

		while ( $i < $number_of_users ) {
			++$i;

			$user_params     = array(
				'user_login' => 'user' . $i,
				'user_email' => 'user' . $i . '@example.com',
			);
			$created_user_id = $this->factory()->user->create( $user_params );
			$user_ids[]      = $created_user_id;
		}

		return $user_ids;
	}

	/**
	 * Not existing user id const.
	 *
	 * @var int
	 */
	const NOT_EXISTING_USER_ID = -1;
}
