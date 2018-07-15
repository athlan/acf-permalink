<?php
/**
 * ACF to Permalink Adapter
 *
 * @package WordPress_ACF_Permalinks
 */

namespace AcfPermalinks;

/**
 * Class AcfPermalinkAdapter
 */
class AcfPermalinkAdapter {

	/**
	 * @var FieldPermalinkFormatter[]
	 */
	private $field_formatters = array();

	public function add_formatter( FieldPermalinkFormatter $formatter ) {
		$this->field_formatters[] = $formatter;
	}

	function get_post_metadata( $post_meta = null, $post = null ) {
		$context = new FieldPermalinkFormatterContext();

		foreach ( $post_meta as $field_name => $values ) {
			if ( $this->is_meta_field( $field_name ) ) {
				continue;
			}

			$new_values = [];
			foreach ( $values as $value_key => $value ) {
				$permalink_options = [];

				$value                    = $this->format_value( $context, $field_name, $value, $permalink_options, $post );
				$new_values[ $value_key ] = $value;
			}

			$post_meta[ $field_name ] = $new_values;
		}

		return $post_meta;
	}

	private function is_meta_field( $key ) {
		return $key[0] == "_";
	}

	private function format_value( FieldPermalinkFormatterContext $context, $field_name, $value, $options, $post ) {
		$acf_field_options = get_field_object( $field_name, $post->ID );

		$value_original = $value;

		foreach ( $this->field_formatters as $formatter ) {
			$context->initialize( $field_name, $value, $value_original, $options, $acf_field_options, $post );

			if ( $formatter->supports( $context ) ) {
				$value = $formatter->format( $context );

				if ($context->isTerminated()) {
					break;
				}
			}
		}

		return $value;
	}
}
