<?php
/**
 * Tests case.
 *
 * @package WordPress_ACF_Permalinks
 */

namespace AcfPermalinks\Tests\Integration\MetaKeyPermalinkStructure;

use BaseTestCase;

/**
 * Class PostFormatter
 */
class PostFormatter extends BaseTestCase {

	/**
	 * Test case.
	 */
	function test_generates_permalink_with_postname_by_default_single_value() {
		// given.
		$this->permalink_steps->given_permalink_structure( '/%field_some_post_object_field%/%postname%/' );
		$this->given_post_object_field( 'some_post_object_field' );
		$some_posts = $this->given_some_posts( 2 );

		$selected_values = $some_posts[0];

		$post_params     = array(
			'post_title' => 'Some page title',
			'meta_input' => array(
				'some_post_object_field' => $selected_values,
			),
		);
		$created_post_id = $this->factory()->post->create( $post_params );

		// when & then.
		$this->permalink_asserter->has_permalink( $created_post_id, '/some-post-title-1/some-page-title/' );
	}

	/**
	 * Test case.
	 */
	function test_generates_permalink_without_postname_by_default_when_post_not_exists() {
		// given.
		$this->permalink_steps->given_permalink_structure( '/%field_some_post_object_field%/%postname%/' );
		$this->given_post_object_field( 'some_post_object_field' );

		$selected_values = self::NOT_EXISTING_POST_ID;

		$post_params     = array(
			'post_title' => 'Some page title',
			'meta_input' => array(
				'some_post_object_field' => $selected_values,
			),
		);
		$created_post_id = $this->factory()->post->create( $post_params );

		// when & then.
		$this->permalink_asserter->has_permalink( $created_post_id, '/some-page-title/' );
	}

	/**
	 * Test case.
	 */
	function test_generates_permalink_with_postname_with_multiple_values_separated_default() {
		// given.
		$this->permalink_steps->given_permalink_structure( '/%field_some_post_object_field%/%postname%/' );
		$this->given_post_object_multiple_field( 'some_post_object_field' );
		$some_posts = $this->given_some_posts( 2 );

		$selected_values = array( $some_posts[0], $some_posts[1] );

		$post_params     = array(
			'post_title' => 'Some page title',
			'meta_input' => array(
				'some_post_object_field' => $selected_values,
			),
		);
		$created_post_id = $this->factory()->post->create( $post_params );

		// when & then.
		$this->permalink_asserter->has_permalink( $created_post_id, '/some-post-title-1-some-post-title-2/some-page-title/' );
	}

	/**
	 * Test case.
	 */
	function test_generates_permalink_with_postname_with_multiple_values_custom_separated() {
		// given.
		$this->permalink_steps->given_permalink_structure( '/%field_some_post_object_field(separator="-and-")%/%postname%/' );
		$this->given_post_object_multiple_field( 'some_post_object_field' );
		$some_posts = $this->given_some_posts( 2 );

		$selected_values = array( $some_posts[0], $some_posts[1] );

		$post_params     = array(
			'post_title' => 'Some page title',
			'meta_input' => array(
				'some_post_object_field' => $selected_values,
			),
		);
		$created_post_id = $this->factory()->post->create( $post_params );

		// when & then.
		$this->permalink_asserter->has_permalink( $created_post_id, '/some-post-title-1-and-some-post-title-2/some-page-title/' );
	}

	/**
	 * Test case.
	 */
	function test_generates_permalink_with_postname_with_multiple_values_ignoring_not_existing() {
		// given.
		$this->permalink_steps->given_permalink_structure( '/%field_some_post_object_field%/%postname%/' );
		$this->given_post_object_multiple_field( 'some_post_object_field' );
		$some_posts = $this->given_some_posts( 2 );

		$selected_values = array( self::NOT_EXISTING_POST_ID, $some_posts[1] );

		$post_params     = array(
			'post_title' => 'Some page title',
			'meta_input' => array(
				'some_post_object_field' => $selected_values,
			),
		);
		$created_post_id = $this->factory()->post->create( $post_params );

		// when & then.
		$this->permalink_asserter->has_permalink( $created_post_id, '/some-post-title-2/some-page-title/' );
	}

	/**
	 * Define post object field.
	 *
	 * @param string $name Field name.
	 */
	private function given_post_object_field( $name ) {
		$field_options = array(
			'post_type'  => array(
				0 => 'post',
			),
			'taxonomy'   => array(
				0 => 'all',
			),
			'allow_null' => 0,
			'multiple'   => 0,
		);

		$this->acf_steps->given_acf_field( $name, 'post_object', $field_options );
	}

	/**
	 * Define post object field.
	 *
	 * @param string $name Field name.
	 */
	private function given_post_object_multiple_field( $name ) {
		$field_options = array(
			'post_type'  => array(
				0 => 'post',
			),
			'taxonomy'   => array(
				0 => 'all',
			),
			'allow_null' => 0,
			'multiple'   => 1,
		);

		$this->acf_steps->given_acf_field( $name, 'post_object', $field_options );
	}

	/**
	 * Generates random posts.
	 *
	 * @param integer $number_of_posts The number of posts to generate.
	 *
	 * @return integer[] Created post's ids.
	 */
	private function given_some_posts( $number_of_posts ) {
		$i        = 0;
		$post_ids = array();

		while ( $i < $number_of_posts ) {
			++$i;

			$post_params     = array(
				'post_title' => 'Some post title ' . $i,
			);
			$created_post_id = $this->factory()->post->create( $post_params );
			$post_ids[]      = $created_post_id;
		}

		return $post_ids;
	}

	/**
	 * Not existing post id const.
	 *
	 * @var int
	 */
	const NOT_EXISTING_POST_ID = -1;
}
