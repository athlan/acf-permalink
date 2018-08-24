<?php
/**
 * Shows missing dependencies warnings.
 *
 * @package WordPress_ACF_Permalinks
 */

namespace AcfPermalinks;

$admin_notice__error = function() use ( $precondition_result ) {
	$class = 'notice notice-warning';

	$message = '<p>Thank you for using <strong>ACF Permalink</strong> plugin.</p>';

	if ( ! $precondition_result['checks']['acf']['result'] ) {
		$url_install_cfp = admin_url( 'plugin-install.php?tab=plugin-information&plugin=advanced-custom-fields' );
		$message        .= "<p>It requires <strong>Advanced Custom Fields</strong> plugin to be installed, <a href='$url_install_cfp' target='_blank'>click here</a> to proceed.</p>";
	}

	if ( ! $precondition_result['checks']['cfp']['result'] ) {
		$url_install_cfp = admin_url( 'plugin-install.php?tab=plugin-information&plugin=custom-fields-permalink-redux' );
		$message        .= "<p>It requires <strong>Custom Fields Permalink 2</strong> plugin to be installed, <a href='$url_install_cfp' target='_blank'>click here</a> to proceed.</p>";
	} elseif ( ! $precondition_result['checks']['cfp_min_version']['result'] ) {
		$message .= sprintf(
			'<p>It requires <strong>Custom Fields Permalink 2</strong> plugin to be in version %s, while you have %s installed. Please upgrade this plugin.</p>',
			$precondition_result['checks']['cfp_min_version']['extra_info']['expected_version'],
			$precondition_result['checks']['cfp_min_version']['extra_info']['current_version']
		);
	}

	printf( '<div class="%1$s"><p>%2$s</p></div>', $class, $message );
};

add_action( 'admin_notices', $admin_notice__error );
