<?php
/**
 * Register hooks in WordPress
 *
 * @package WordPress_ACF_Permalinks
 */

// Require main class.
require 'class-acf-permalink-adapter.php';
require 'class-field-permalink-formatter.php';
require 'class-field-permalink-formatter-context.php';

require 'formatter/class-multivalue-formatter-helper.php';
require 'formatter/class-default-formatter.php';
require 'formatter/class-checkbox-formatter.php';
require 'formatter/class-radio-formatter.php';
require 'formatter/class-datepicker-formatter.php';
require 'formatter/class-post-formatter.php';
require 'formatter/class-user-formatter.php';

require 'preconditions/class-preconditions.php';
require 'preconditions/class-acf-preconditions.php';
require 'preconditions/class-cfp-preconditions.php';

$main = function () {
	$preconditions = new \AcfPermalinks\Preconditions();
	$preconditions->add_precondition( 'acf', array( '\AcfPermalinks\Acf_Preconditions', 'check_acf_installed' ) );
	$preconditions->add_precondition( 'cfp', array( '\AcfPermalinks\Cfp_Preconditions', 'check_cfp_installed' ) );
	$preconditions->add_precondition( 'cfp_min_version', array( '\AcfPermalinks\Cfp_Preconditions', 'check_cfp_min_version' ) );

	$precondition_result = $preconditions->check();

	if ( $precondition_result['result'] ) {
		$adapter = new \AcfPermalinks\Acf_Permalink_Adapter();

		$adapter->add_formatter( new \AcfPermalinks\Formatter\Checkbox_Formatter() );
		$adapter->add_formatter( new \AcfPermalinks\Formatter\Radio_Formatter() );
		$adapter->add_formatter( new \AcfPermalinks\Formatter\Datepicker_Formatter() );
		$adapter->add_formatter( new \AcfPermalinks\Formatter\Post_Formatter() );
		$adapter->add_formatter( new \AcfPermalinks\Formatter\User_Formatter() );
		$adapter->add_formatter( new \AcfPermalinks\Formatter\Default_Formatter() );

		add_filter( 'wpcfp_get_post_metadata_single', array( $adapter, 'get_post_metadata_single' ), 1, 4 );
	} else {
		require 'admin/plugin-dependency-notice.php';
	}
};

add_action( 'plugins_loaded', $main );
