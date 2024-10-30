<?php

/**
 * Copyright (C) 2015 MediaVidi.com, all rights reserved
 *
 * @link              https://mediavidi.com
 * @since             1.0.0
 * @package           mediavidi_https_social_migration
 *
 * @wordpress-plugin
 * Plugin Name:       HTTPS Social Migration
 * Plugin URI:        https://mediavidi.com
 * Description:       Preserve your Social Media presence when moving your WordPress site to HTTPS
 * Version:           1.0.0
 * Author:            MediaVidi
 * Author URI:        https://mediavidi.com
 * License:           Copyright (C) 2015 MediaVidi.com, all rights reserved
 * License URI:       https://mediavidi.com
 * Text Domain:       mediavidi_https_social_migration
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 */
function activate_mediavidi_https_social_migration() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mediavidi_https_social_migration-activator.php';
	Mediavidi_https_social_migration_Activator::activate();
}

/**
 */
function deactivate_mediavidi_https_social_migration() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mediavidi_https_social_migration-deactivator.php';
	Mediavidi_https_social_migration_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_mediavidi_https_social_migration' );
register_deactivation_hook( __FILE__, 'deactivate_mediavidi_https_social_migration' );

/**
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-mediavidi_https_social_migration.php';

/**
 *
 * @since    1.0.0
 */
function run_mediavidi_https_social_migration() {
	$options = get_option("mediavidi_https_social_migration_pro");
	if ($options === false || !isset($options['active']) || $options['active'] === false) {
		$plugin = new Mediavidi_https_social_migration();
		$plugin->run();
	}
}

run_mediavidi_https_social_migration();
