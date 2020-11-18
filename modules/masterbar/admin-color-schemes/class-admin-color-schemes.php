<?php
/**
 * Unifies admin color scheme selection across WP.com sites.
 *
 * @package Jetpack
 */

namespace Automattic\Jetpack\Dashboard_Customizations;

/**
 * Unifies admin color scheme selection across WP.com sites.
 */
class Admin_Color_Schemes {

	/**
	 * Admin_Color_Schemes constructor.
	 */
	public function __construct() {
		add_action( 'admin_init', array( $this, 'register_admin_color_schemes' ) );
		add_action( 'rest_api_init', array( $this, 'register_admin_color_meta' ) );
	}

	/**
	 * Makes admin_color available in users REST API endpoint.
	 */
	public function register_admin_color_meta() {
		register_meta(
			'user',
			'admin_color',
			array(
				'auth_callback' => array( $this, 'update_admin_color_permissions_check' ),
				'description'   => __( 'Slug of the admin color scheme.', 'jetpack' ),
				'single'        => true,
				'show_in_rest'  => array(
					'schema' => array( 'default' => 'fresh' ),
				),
				'type'          => 'string',
			)
		);
	}

	/**
	 * Permission callback to edit the `admin_color` user meta.
	 *
	 * @param bool   $allowed   Whether the given user is allowed to edit this meta value.
	 * @param string $meta_key  Meta key. In this case `admin_color`.
	 * @param int    $object_id Queried user ID.
	 * @return bool
	 */
	public function update_admin_color_permissions_check( $allowed, $meta_key, $object_id ) { // phpcs:ignore Generic.CodeAnalysis.UnusedFunctionParameter, VariableAnalysis.CodeAnalysis.VariableAnalysis.UnusedVariable
		return current_user_can( 'edit_user', $object_id );
	}

	/**
	 * Registers new admin color schemes
	 */
	public function register_admin_color_schemes() {

		wp_admin_css_color(
			'aquatic',
			__( 'Aquatic', 'jetpack' ),
			plugins_url( 'colors/aquatic/colors.css', __FILE__ ),
			array( '#135e96', '#043959', '#ffffff', '#646970' ),
			array(
				'base'    => '#646970',
				'focus'   => '#fff',
				'current' => '#fff',
			)
		);

		wp_admin_css_color(
			'classic-blue',
			__( 'Classic Blue', 'jetpack' ),
			plugins_url( 'colors/classic-blue/colors.css', __FILE__ ),
			array( '#135e96', '#dcdcde', '#ffffff', '#646970' ),
			array(
				'base'    => '#646970',
				'focus'   => '#fff',
				'current' => '#fff',
			)
		);

		wp_admin_css_color(
			'classic-bright',
			__( 'Classic Bright', 'jetpack' ),
			plugins_url( 'colors/classic-bright/colors.css', __FILE__ ),
			array( '#135e96', '#c9256e', '#ffffff', '#646970' ),
			array(
				'base'    => '#646970',
				'focus'   => '#fff',
				'current' => '#fff',
			)
		);

		wp_admin_css_color(
			'classic-dark',
			__( 'Classic Dark', 'jetpack' ),
			plugins_url( 'colors/classic-dark/colors.css', __FILE__ ),
			array( '#101517', '#23282d', '#ffffff', '#646970' ),
			array(
				'base'    => '#646970',
				'focus'   => '#fff',
				'current' => '#fff',
			)
		);

	}
}
