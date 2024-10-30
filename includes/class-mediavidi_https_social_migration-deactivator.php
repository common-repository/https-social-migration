<?php

/**
 * Fired during plugin deactivation
 * Copyright (C) 2015 MediaVidi.com, all rights reserved
 *
 * @link       https://mediavidi.com
 * @since      1.0.0
 *
 * @package    Mediavidi_https_social_migration
 * @subpackage Mediavidi_https_social_migration/includes
 * @author     MediaVidi
 */
class Mediavidi_https_social_migration_Deactivator {

	/**
	 * @since    1.0.0
	 */
	public static function deactivate() {
		global $wpdb;
		
		$options = get_option("mediavidi_https_social_migration");
		$options['active'] = false;
		update_option("mediavidi_https_social_migration", $options);

		$site_url = get_site_url('', '', "http");
		$wpdb->update($wpdb->options, array("option_value" => $site_url), array("option_name" => "siteurl"));
		$home_url = get_home_url('', '', "http");
		$wpdb->update($wpdb->options, array("option_value" => $home_url), array("option_name" => "home"));
	}
}
