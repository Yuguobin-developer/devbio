<?php

/**
 * Addon Name: Campaignmonitor
 * Version: 1.0
 * Plugin URI:  https://wpmudev.com/
 * Description: Integrate Forminator Custom Forms with Campaignmonitor to get notified in real time.
 * Author: WPMU DEV
 * Author URI: http://wpmudev.com
 */

define( 'FORMINATOR_ADDON_CAMPAIGNMONITOR_VERSION', '1.0' );

function forminator_addon_campaignmonitor_url() {
	return trailingslashit( forminator_plugin_url() . 'addons/pro/campaignmonitor' );
}

function forminator_addon_campaignmonitor_dir() {
	return trailingslashit( dirname( __FILE__ ) );
}

function forminator_addon_campaignmonitor_assets_url() {
	return trailingslashit( forminator_addon_campaignmonitor_url() . 'assets' );
}

require_once dirname( __FILE__ ) . '/class-forminator-addon-campaignmonitor.php';
require_once dirname( __FILE__ ) . '/class-forminator-addon-campaignmonitor-form-settings.php';
require_once dirname( __FILE__ ) . '/class-forminator-addon-campaignmonitor-form-hooks.php';

require_once dirname( __FILE__ ) . '/class-forminator-addon-campaignmonitor-quiz-settings.php';
require_once dirname( __FILE__ ) . '/class-forminator-addon-campaignmonitor-quiz-hooks.php';
//Direct Load
Forminator_Addon_Loader::get_instance()->register( 'Forminator_Addon_Campaignmonitor' );