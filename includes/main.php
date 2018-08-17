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

$adapter = new \AcfPermalinks\Acf_Permalink_Adapter();

$adapter->add_formatter( new \AcfPermalinks\Formatter\Checkbox_Formatter() );
$adapter->add_formatter( new \AcfPermalinks\Formatter\Radio_Formatter() );
$adapter->add_formatter( new \AcfPermalinks\Formatter\Datepicker_Formatter() );
$adapter->add_formatter( new \AcfPermalinks\Formatter\Post_Formatter() );
$adapter->add_formatter( new \AcfPermalinks\Formatter\User_Formatter() );
$adapter->add_formatter( new \AcfPermalinks\Formatter\Default_Formatter() );

add_filter( 'wpcfp_get_post_metadata_single', array( $adapter, 'get_post_metadata_single' ), 1, 4 );
