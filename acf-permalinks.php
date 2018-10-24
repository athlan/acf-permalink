<?php
/**
 * ACF Permalinks.
 *
 * @package WordPress_ACF_Permalink
 *
 * @wordpress-plugin
 * Plugin Name: ACF Permalinks
 * Plugin URI: https://github.com/athlan/acf-permalink
 * Description: Plugin allows to use ACF values in permalink structure by adding %field_fieldname%, for posts, pages and custom post types. This is an extenion for the plugin <a href="https://wordpress.org/plugins/custom-fields-permalink-redux/">Custom Fields Permalink 2</a>.
 * Author: Piotr Pelczar
 * Version: 1.0.0
 * Author URI: http://athlan.pl/
 */

// Require main entry point.
define( 'ACF_PERMALINK_VERSION', '1.0.0' );
require __DIR__ . '/includes/main.php';
