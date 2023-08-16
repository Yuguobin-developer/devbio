<?php
/*
Plugin Name: Gravity Forms File Upload Enhance UI
Plugin URI: https://codecanyon.net/user/butsokoy/portfolio
Description: Enhances the user interface of Gravity Forms file upload field.
Version: 1.2.1
Author: Butsokoy
Author URI: https://codecanyon.net/user/butsokoy
Text Domain: gravityforms-fileupload
Domain Path: /languages
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'GFFUF_VERSION', '1.2.1' );

function gffuf_init() {

	require_once plugin_dir_path( __FILE__ ) . 'class/gffuf.php';

	new GFFUF();

} 
add_action( 'gform_loaded', 'gffuf_init' );