<?php

defined( 'ABSPATH' ) || exit;

use WPCOMSpecialProjects\RevisionHistoryForWooCommerce\Plugin;

// region

/**
 * Returns the plugin's main class instance.
 *
 * @since   1.0.0
 * @version 1.0.0
 *
 * @return  Plugin
 */
function rhfw_get_plugin_instance(): Plugin {
	return Plugin::get_instance();
}

/**
 * Returns the plugin's slug.
 *
 * @since   1.0.0
 * @version 1.0.0
 *
 * @return  string
 */
function rhfw_get_plugin_slug(): string {
	return sanitize_key( WPCOMSP_RHFW_METADATA['TextDomain'] );
}

// endregion
