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
		// TODO Create ACF field definition.

		$page_params     = array(
			'post_type'  => 'page',
			'post_title' => 'Some page title',
			'meta_input' => array(
				'some_datepicker_field' => 'Some meta value',
			),
		);
		$created_page_id = $this->factory()->post->create( $page_params );

		// when & then.
		$this->permalink_asserter->has_permalink( $created_page_id, '/some-meta-value/some-page-title/' );
	}
}
