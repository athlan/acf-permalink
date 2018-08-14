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
class DatepickerFormatter extends BaseTestCase {

	/**
	 * Test case.
	 */
	function test_generates_permalink_with_default_date_format() {
		// given.
		$this->permalink_steps->given_permalink_structure( '/%field_some_datepicker_field%/%postname%/' );
		$this->acf_steps->given_acf_field('some_datepicker_field', 'date_picker');

		$post_params = array(
			'post_title' => 'Some page title',
			'meta_input' => array(
				'some_datepicker_field' => '20180721',
			)
		);
		$created_post_id = $this->factory()->post->create( $post_params );

		// when & then.
		$this->permalink_asserter->has_permalink( $created_post_id, '/2018-07-21/some-page-title/' );
	}

	/**
	 * Test case.
	 */
	function test_generates_permalink_with_custom_format() {
		// given.
		$this->permalink_steps->given_permalink_structure( '/%field_some_datepicker_field(format="d-m-y")%/%postname%/' );
		$this->acf_steps->given_acf_field('some_datepicker_field', 'date_picker');

		$post_params = array(
			'post_title' => 'Some page title',
			'meta_input' => array(
				'some_datepicker_field' => '20180721',
			)
		);
		$created_post_id = $this->factory()->post->create( $post_params );

		// when & then.
		$this->permalink_asserter->has_permalink( $created_post_id, '/21-07-18/some-page-title/' );
	}

	/**
	 * Test case.
	 */
	function test_generates_permalink_with_year_only() {
		// given.
		$this->permalink_steps->given_permalink_structure( '/%field_some_datepicker_field(year)%/%postname%/' );
		$this->acf_steps->given_acf_field('some_datepicker_field', 'date_picker');

		$post_params = array(
			'post_title' => 'Some page title',
			'meta_input' => array(
				'some_datepicker_field' => '20180721',
			)
		);
		$created_post_id = $this->factory()->post->create( $post_params );

		// when & then.
		$this->permalink_asserter->has_permalink( $created_post_id, '/2018/some-page-title/' );
	}

	/**
	 * Test case.
	 */
	function test_generates_permalink_with_month_only() {
		// given.
		$this->permalink_steps->given_permalink_structure( '/%field_some_datepicker_field(month)%/%postname%/' );
		$this->acf_steps->given_acf_field('some_datepicker_field', 'date_picker');

		$post_params = array(
			'post_title' => 'Some page title',
			'meta_input' => array(
				'some_datepicker_field' => '20180721',
			)
		);
		$created_post_id = $this->factory()->post->create( $post_params );

		// when & then.
		$this->permalink_asserter->has_permalink( $created_post_id, '/07/some-page-title/' );
	}

	/**
	 * Test case.
	 */
	function test_generates_permalink_with_day_only() {
		// given.
		$this->permalink_steps->given_permalink_structure( '/%field_some_datepicker_field(day)%/%postname%/' );
		$this->acf_steps->given_acf_field('some_datepicker_field', 'date_picker');

		$post_params = array(
			'post_title' => 'Some page title',
			'meta_input' => array(
				'some_datepicker_field' => '20180721',
			)
		);
		$created_post_id = $this->factory()->post->create( $post_params );

		// when & then.
		$this->permalink_asserter->has_permalink( $created_post_id, '/21/some-page-title/' );
	}
}
