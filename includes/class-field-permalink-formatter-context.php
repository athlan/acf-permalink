<?php
/**
 * Interface definition for formatters.
 *
 * @package WordPress_ACF_Permalinks
 */

namespace AcfPermalinks;

use WP_Post;

/**
 * FieldPermalinkFormatter.
 */
class FieldPermalinkFormatterContext {

	/**
	 * @var boolean
	 */
	private $terminate;

	/**
	 * @var string
	 */
	private $field_name;

	/**
	 * @var array
	 */
	private $value;

	/**
	 * @var array
	 */
	private $value_original;

	/**
	 * @var array
	 */
	private $permalink_options;

	/**
	 * @var array
	 */
	private $acf_field_options;

	/**
	 * @var WP_Post
	 */
	private $post;

	/**
	 * @param string $field_name
	 * @param array $value
	 * @param array $value_original
	 * @param array $permalink_options
	 * @param array $acf_field_options
	 * @param WP_Post $post
	 *
	 * @return void
	 */
	public function initialize( $field_name, $value, $value_original, $permalink_options, $acf_field_options, $post ) {
		$this->terminate         = false;
		$this->field_name        = $field_name;
		$this->value             = $value;
		$this->value_original    = $value_original;
		$this->permalink_options = $permalink_options;
		$this->acf_field_options = $acf_field_options;
		$this->post              = $post;
	}

	public function terminate() {
		$this->terminate = true;
	}

	/**
	 * @return boolean
	 */
	public function isTerminated() {
		return $this->terminate;
	}

	/**
	 * @return string
	 */
	public function getFieldName() {
		return $this->field_name;
	}

	/**
	 * @return array
	 */
	public function getValue() {
		return $this->value;
	}

	/**
	 * @return array
	 */
	public function getValueOriginal() {
		return $this->value_original;
	}

	/**
	 * @return array
	 */
	public function getPermalinkOptions() {
		return $this->permalink_options;
	}

	/**
	 * @return array
	 */
	public function getAcfFieldOptions() {
		return $this->acf_field_options;
	}

	/**
	 * @return WP_Post
	 */
	public function getPost() {
		return $this->post;
	}
}
