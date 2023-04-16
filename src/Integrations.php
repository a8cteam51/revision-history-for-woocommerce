<?php

namespace WPcomSpecialProjects\RevisionHistoryForWooCommerce;

use WPcomSpecialProjects\RevisionHistoryForWooCommerce\Integrations\WooCommerce;

defined( 'ABSPATH' ) || exit;

/**
 * Logical node for all integration functionalities.
 *
 * @since   1.0.0
 * @version 1.0.0
 */
final class Integrations {
	// region FIELDS AND CONSTANTS

	/**
	 * The WooCommerce Subscriptions integration instance.
	 *
	 * @since   1.0.0
	 * @version 1.0.0
	 *
	 * @var     WooCommerce|null
	 */
	public ?WooCommerce $woocommerce = null;

	// endregion

	// region METHODS

	/**
	 * Initializes the integrations.
	 *
	 * @since   1.0.0
	 * @version 1.0.0
	 *
	 * @return  void
	 */
	public function initialize(): void {
		$this->woocommerce = new WooCommerce();
		$this->woocommerce->initialize();
	}

	// endregion
}
