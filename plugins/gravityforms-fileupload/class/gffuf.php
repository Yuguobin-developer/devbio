<?php

class GFFUF {

	protected $plugin_name;
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 */
	public function __construct() {

		if ( defined( 'GFFUF_VERSION' ) ) 
			$this->version = GFFUF_VERSION;
		else 
			$this->version = '1.0.0';

		$this->plugin_name = 'gravityforms-fileupload';

		$this->set_locale();
		$this->define_gravity_hooks();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 */
	private function set_locale() {

		load_plugin_textdomain(
			'gravityforms-fileupload',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}

	/**
	 * Register all of the hooks related to the Gravity Form
	 */
	private function define_gravity_hooks() {

		require_once  plugin_dir_path( dirname( __FILE__ ) ) . 'class/gffuf-hooks.php';

		$plugin_hook = new GFFUF_Hooks( $this->get_plugin_name(), $this->get_version() );

		add_action( 'admin_enqueue_scripts', array( $plugin_hook, 'admin_scripts' ) );
		add_filter( 'gform_noconflict_scripts', array( $plugin_hook, 'noconflict_scripts' ) );
		add_filter( 'gform_noconflict_styles', array( $plugin_hook, 'noconflict_styles' ) );

		add_action( 'gform_editor_js', array( $plugin_hook, 'editor_js' ) );
		add_action( 'gform_enqueue_scripts', array( $plugin_hook, 'enqueue_scripts' ), 10, 2 );
		add_action( 'gform_field_appearance_settings', array( $plugin_hook, 'field_appearance_settings' ), 10, 2 );

		add_filter( 'gform_tooltips', array( $plugin_hook, 'field_tooltips' ) );
		add_filter( 'gform_field_content', array( $plugin_hook, 'field_content' ), 10, 5 );

	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * Retrieve the version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
