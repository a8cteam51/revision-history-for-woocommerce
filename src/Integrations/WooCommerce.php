<?php

namespace WPCOMSpecialProjects\RevisionHistoryForWooCommerce\Integrations;

defined( 'ABSPATH' ) || exit;

/**
 * Handles the integration with WooCommerce.
 *
 * @since   1.0.0
 * @version 1.0.0
 */
class WooCommerce {
	// region METHODS

	/**
	 * Initializes the integration.
	 *
	 * @since   1.0.0
	 * @version 1.0.0
	 *
	 * @return  void
	 */
	public function initialize(): void {
		add_filter( 'woocommerce_register_post_type_product', array( $this, 'add_revision_support' ) );
	}

	// endregion

	// region HOOKS

	/**
	 * Adds revision support to products.
	 *
	 * @since   1.0.0
	 * @version 1.0.0
	 *
	 * @param   array $args The post type arguments.
	 *
	 * @return  array
	 */
	public function add_revision_support( array $args ): array {
		$args['supports'][] = 'revisions';

		return $args;
	}

	// endregion
}
