<?php
/**
 * The Revision History for WooCommerce bootstrap file.
 *
 * @since       1.0.0
 * @version     1.0.0
 * @author      WordPress.com Special Projects
 * @license     GPL-3.0-or-later
 *
 * @noinspection    ALL
 *
 * @wordpress-plugin
 * Plugin Name:             Revision History for WooCommerce
 * Plugin URI:              https://wpspecialprojects.wordpress.com
 * Description:             Adds revision history support for content on WooCommerce products.
 * Version:                 1.0.0
 * Requires at least:       6.2
 * Tested up to:            6.2
 * Requires PHP:            8.0
 * Author:                  WordPress.com Special Projects
 * Author URI:              https://wpspecialprojects.wordpress.com
 * License:                 GPL v3 or later
 * License URI:             https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:             rhfw
 * Domain Path:             /languages
 * WC requires at least:    7.4
 * WC tested up to:         7.4
 **/

defined( 'ABSPATH' ) || exit;

// Define plugin constants.
function_exists( 'get_plugin_data' ) || require_once ABSPATH . 'wp-admin/includes/plugin.php';
define( 'RHFW_METADATA', get_plugin_data( __FILE__, false, false ) );

define( 'RHFW_BASENAME', plugin_basename( __FILE__ ) );
define( 'RHFW_PATH', plugin_dir_path( __FILE__ ) );
define( 'RHFW_URL', plugin_dir_url( __FILE__ ) );

// Load plugin translations so they are available even for the error admin notices.
add_action(
	'init',
	static function() {
		load_plugin_textdomain(
			RHFW_METADATA['TextDomain'],
			false,
			dirname( RHFW_BASENAME ) . RHFW_METADATA['DomainPath']
		);
	}
);

// Load the autoloader.
if ( ! is_file( RHFW_PATH . '/vendor/autoload.php' ) ) {
	add_action(
		'admin_notices',
		static function() {
			$message      = __( 'It seems like <strong>Revision History for WooCommerce</strong> is corrupted. Please reinstall!', 'rhfw' );
			$html_message = wp_sprintf( '<div class="error notice rhfw-error">%s</div>', wpautop( $message ) );
			echo wp_kses_post( $html_message );
		}
	);
	return;
}
require_once RHFW_PATH . '/vendor/autoload.php';

// Initialize the plugin if system requirements check out.
$rhfw_requirements = validate_plugin_requirements( RHFW_BASENAME );
define( 'RHFW_REQUIREMENTS', $rhfw_requirements );

if ( $rhfw_requirements instanceof WP_Error ) {
	add_action(
		'admin_notices',
		static function() use ( $rhfw_requirements ) {
			$html_message = wp_sprintf( '<div class="error notice rhfw-error">%s</div>', $rhfw_requirements->get_error_message() );
			echo wp_kses_post( $html_message );
		}
	);
} else {
	require_once RHFW_PATH . 'functions.php';
	add_action( 'plugins_loaded', array( rhfw_get_plugin_instance(), 'maybe_initialize' ) );
}
