<?php
/**
 * ACF to Permalink Adapter
 *
 * @package WordPress_ACF_Permalinks
 */

namespace AcfPermalinks;
use WP_Post;

/**
 * Class Acf_Permalink_Adapter
 */
class Acf_Permalink_Adapter {

	/**
	 * List of formatters.
	 *
	 * @var Field_Permalink_Formatter[]
	 */
	private $field_formatters = array();

	/**
	 * Register the formatter.
	 *
	 * @param Field_Permalink_Formatter $formatter Formatter to register.
	 */
	public function add_formatter( Field_Permalink_Formatter $formatter ) {
		$this->field_formatters[] = $formatter;
	}

	/**
	 * Hook for wpcfp_get_post_metadata_single.
	 *
	 * @param array   $values Post meta values.
	 * @param string  $field_name Field name.
	 * @param array   $field_attr Permalink options.
	 * @param WP_Post $post Post.
	 *
	 * @return array
	 */
	function get_post_metadata_single( $values, $field_name, array $field_attr, $post = null ) {
		$context = new Field_Permalink_Formatter_Context();

		if ( ! isset( $values ) || $this->is_meta_field( $field_name ) ) {
			return $values;
		}

		$new_values = array();
		foreach ( $values as $value_key => $value ) {
			$permalink_options = $field_attr;

			$value                    = $this->format_value( $context, $field_name, $value, $permalink_options, $post );
			$new_values[ $value_key ] = $value;
		}

		return $new_values;
	}

	/**
	 * Checks whether postmeta is meta key or not.
	 *
	 * @param string $key Meta key.
	 *
	 * @return bool
	 */
	private function is_meta_field( $key ) {
		return '_' === $key[0];
	}

	/**
	 * Formats the value.
	 *
	 * @param Field_Permalink_Formatter_Context $context Formatting context.
	 * @param string                            $field_name Field name.
	 * @param mixed                             $value Field value.
	 * @param array                             $options Permalink options.
	 * @param WP_Post                           $post Post.
	 *
	 * @return mixed
	 */
	private function format_value( Field_Permalink_Formatter_Context $context, $field_name, $value, $options, $post ) {
		$acf_field_options = $this->get_acf_field( $field_name, $post );

		$value_original = $value;

		foreach ( $this->field_formatters as $formatter ) {
			$context->initialize( $field_name, $value, $value_original, $options, $acf_field_options, $post );

			if ( $formatter->supports( $context ) ) {
				$value = $formatter->format( $context );

				if ( $context->is_terminated() ) {
					break;
				}
			}
		}

		return $value;
	}

	/**
	 * Gets ACF field info.
	 *
	 * @param string  $field_name Field name.
	 * @param WP_Post $post Post.
	 *
	 * @return array|bool|mixed
	 */
	private function get_acf_field( $field_name, $post ) {
		// Support for ACF >= 5.2.3.
		if ( function_exists( 'acf_maybe_get_field' ) ) {
			$info = acf_maybe_get_field( $field_name, $post->ID, false );
		} else {
			$info = get_field_object( $field_name, $post->ID );
		}

		return ( $info ) ? $info : array();
	}
}
