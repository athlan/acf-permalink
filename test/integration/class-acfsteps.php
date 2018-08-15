<?php
/**
 * Tests util file.
 *
 * @package WordPress_Custom_Fields_Permalink
 */

/**
 * Class AcfSteps contains utility methods to manage ACF fields.
 */
class AcfSteps {

	/**
	 * AcfSteps constructor.
	 */
	public function __construct() {
	}

	/**
	 * Define given field in ACF.
	 *
	 * @param string $name The name of field.
	 * @param string $type The type of field.
	 * @param array  $field_options Additional field options.
	 * @param array  $group_options Additional field group options.
	 */
	public function given_acf_field( $name, $type, array $field_options = array(), $group_options = array() ) {
		$random = md5( microtime() );
		$random = substr( $random, 0, 13 );

		$group_options_defaults = array(
			'id'         => 'acf_' . $random,
			'title'      => 'For ' . $name . ' field',
			'location'   => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'post',
						'order_no' => 0,
						'group_no' => 0,
					),
				),
			),
			'options'    => array(
				'position'       => 'normal',
				'layout'         => 'no_box',
				'hide_on_screen' => array(),
			),
			'menu_order' => 0,
		);

		$field_options_defaults = array(
			'key'           => 'field_' . $name,
			'label'         => $name,
			'name'          => $name,
			'type'          => $type,
			'default_value' => '',
			'placeholder'   => '',
			'maxlength'     => '',
			'rows'          => '',
			'formatting'    => 'br',
		);

		$final_group_options = $group_options + $group_options_defaults;
		$final_field_options = $field_options + $field_options_defaults;

		$final_group_options['fields'] = array( $final_field_options );

		register_field_group( $final_group_options );
	}
}
