<?php

/**
 * Copyright (C) 2015 MediaVidi.com, all rights reserved
 *
 * @link       https://mediavidi.com
 * @since      1.0.0
 *
 * @package    Mediavidi_https_social_migration
 * @subpackage Mediavidi_https_social_migration/includes
 * @author     MediaVidi
 */
class Mediavidi_https_social_migration {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Mediavidi_https_social_migration_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		$this->plugin_name = 'mediavidi_https_social_migration';
		$this->version = '1.0.0';

		$this->set_redirect();

		$this->load_dependencies();
		$this->define_admin_hooks();
	}

	/**
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-mediavidi_https_social_migration-loader.php';


		/**
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-mediavidi_https_social_migration-admin.php';

		$this->loader = new Mediavidi_https_social_migration_Loader();
	}


	/**
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Mediavidi_https_social_migration_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		$this->loader->add_action('admin_menu', $plugin_admin, 'add_plugin_admin_menu' );

		$plugin_basename = plugin_basename( plugin_dir_path( __DIR__ ) . $this->plugin_name . '.php' );
		$this->loader->add_filter( 'plugin_action_links_' . $plugin_basename, $plugin_admin, 'add_action_links' );

		$this->loader->add_action('admin_init', $plugin_admin, 'options_update');
	}

	private function set_redirect() {
		if (parse_url(get_option('siteurl'), PHP_URL_SCHEME) == "https" && !is_ssl()) {
			add_action( 'template_redirect', 'Mediavidi_https_social_migration::mediavidi_redirect', 1 );
		}
	}

	static function mediavidi_redirect() {
		wp_redirect('https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], 301 );
		exit();
	}

	/**
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 *
	 * @since     1.0.0
	 * @return    Mediavidi_https_social_migration_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
