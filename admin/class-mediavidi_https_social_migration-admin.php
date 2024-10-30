<?php

/**
 * Copyright (C) 2015 MediaVidi.com, all rights reserved
 *
 *
 * @link       https://mediavidi.com
 * @since      1.0.0
 *
 * @package    Mediavidi_https_social_migration
 * @subpackage Mediavidi_https_social_migration/admin
 * @author     MediaVidi
 */
class Mediavidi_https_social_migration_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/mediavidi_https_social_migration-admin.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/mediavidi_https_social_migration-admin.js', array( 'jquery' ), $this->version, false );
	}

	public function add_plugin_admin_menu() {
		add_options_page( 
			'HTTPS Social Migration Setup', 
			'HTTPS Social Migration', 
			'manage_options', 
			$this->plugin_name, 
			array($this, 'display_plugin_setup_page')
		);
	}

	public function add_action_links( $links ) {
		$settings_link = array(
			'<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_name ) . '">' . __('Settings', $this->plugin_name) . '</a>',
		);
		return array_merge(  $settings_link, $links );
	}

	public function display_plugin_setup_page() {
		include_once( 'partials/mediavidi_https_social_migration-display.php' );
	}

	function validate($input) {
		if (! isset($_POST['mediavidi_https_social_migration_phase'])) {
			return;
		}
		global $wpdb;
		$options = get_option("mediavidi_https_social_migration");
		$results = array();
		$results['canonical_homepage'] = (isset($options['canonical_homepage'])) ? $options['canonical_homepage'] : false;
		$results['first_run'] = (isset($options['first_run'])) ? $options['first_run'] : false;


		$phase = $_POST['mediavidi_https_social_migration_phase'];

		if ($phase == "1") {
			$site_url = get_site_url('', '', "https");
			$wpdb->update($wpdb->options, array("option_value" => $site_url), array("option_name" => "siteurl"));
			$home_url = get_home_url('', '', "https");
			$wpdb->update($wpdb->options, array("option_value" => $home_url), array("option_name" => "home"));			
			$results['first_run'] = true;
		}
		$results['active'] = true;

		return $results;
	}

	public function options_update() {
    		register_setting($this->plugin_name, $this->plugin_name, array($this, 'validate'));
	}
}
