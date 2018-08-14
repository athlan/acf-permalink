<?php
/**
 * Tests bootstrap file.
 *
 * @package WordPress_Custom_Fields_Permalink
 */

$_tests_dir = getenv( 'WP_TESTS_DIR' );

if ( ! $_tests_dir ) {
	$_tests_dir = rtrim( sys_get_temp_dir(), '/\\' ) . '/wordpress-tests-lib';
}

if ( ! file_exists( $_tests_dir . '/includes/functions.php' ) ) {
	echo "Could not find $_tests_dir/includes/functions.php, have you run bin/install-wp-tests.sh ?" . PHP_EOL;
	exit( 1 );
}

// Give access to tests_add_filter() function.
require_once $_tests_dir . '/includes/functions.php';

/**
 * Manually load the plugin being tested.
 */
function _manually_load_plugin() {
	// Dependencies.
	require __DIR__ . '/../../target/plugins/advanced-custom-fields/acf.php';
	require __DIR__ . '/../../target/plugins/custom-fields-permalink-redux/wordpress-custom-fields-permalink-plugin.php';

	// Plugin.
	require __DIR__ . '/../../acf-permalinks.php';

}
tests_add_filter( 'muplugins_loaded', '_manually_load_plugin' );

// Start up the WP testing environment.
require $_tests_dir . '/includes/bootstrap.php';

require 'class-basetestcase.php';
require 'class-permalinksteps.php';
require 'class-permalinkasserter.php';
require 'class-acfsteps.php';

define( 'WP_RUN_CORE_TESTS', true );