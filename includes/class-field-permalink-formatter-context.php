<?php
/**
 * Interface definition for formatters.
 *
 * @package WordPress_ACF_Permalinks
 */

namespace AcfPermalinks;

use WP_Post;

/**
 * Field_Permalink_Formatter_Context.
 */
class Field_Permalink_Formatter_Context {

	/**
	 * Indicates if processing loop is terminated.
	 *
	 * @var boolean
	 */
	private $terminate;

	/**
	 * Field name.
	 *
	 * @var string
	 */
	private $field_name;

	/**
	 * Field value.
	 *
	 * @var array
	 */
	private $value;

	/**
	 * Field original value.
	 *
	 * @var array
	 */
	private $value_original;

	/**
	 * Permalink options.
	 *
	 * @var array
	 */
	private $permalink_options;

	/**
	 * ACF field options.
	 *
	 * @var array
	 */
	private $acf_field_options;

	/**
	 * Post.
	 *
	 * @var WP_Post
	 */
	private $post;

	/**
	 * Resets and initializes formatting context.
	 *
	 * @param string  $field_name         Field name.
	 * @param array   $value              Field value.
	 * @param array   $value_original     Field original value.
	 * @param array   $permalink_options  Permalink options.
	 * @param array   $acf_field_options  ACF field options.
	 * @param WP_Post $post               Post.
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

	/**
	 * Terminates the processing loop.
	 */
	public function terminate() {
		$this->terminate = true;
	}

	/**
	 * Indicates if processing loop is terminated.
	 *
	 * @return boolean
	 */
	public function is_terminated() {
		return $this->terminate;
	}

	/**
	 * Field name.
	 *
	 * @return string
	 */
	public function field_name() {
		return $this->field_name;
	}

	/**
	 * Field value.
	 *
	 * @return array
	 */
	public function value() {
		return $this->value;
	}

	/**
	 * Field original value.
	 *
	 * @return array
	 */
	public function value_original() {
		return $this->value_original;
	}

	/**
	 * Permalink options.
	 *
	 * @return array
	 */
	public function permalink_options() {
		return $this->permalink_options;
	}

	/**
	 * ACF field options.
	 *
	 * @return array
	 */
	public function acf_field_options() {
		return $this->acf_field_options;
	}

	/**
	 * Post.
	 *
	 * @return WP_Post
	 */
	public function post() {
		return $this->post;
	}
}
