<?php
/* Mail Chimp support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'snowy_mailchimp_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'snowy_mailchimp_theme_setup9', 9 );
	function snowy_mailchimp_theme_setup9() {
		if ( snowy_exists_mailchimp() ) {
			add_action( 'wp_enqueue_scripts', 'snowy_mailchimp_frontend_scripts', 1100 );
			add_action( 'trx_addons_action_load_scripts_front_mailchimp', 'snowy_mailchimp_frontend_scripts', 10, 1 );
			add_filter( 'snowy_filter_merge_styles', 'snowy_mailchimp_merge_styles' );
		}
		if ( is_admin() ) {
			add_filter( 'snowy_filter_tgmpa_required_plugins', 'snowy_mailchimp_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'snowy_mailchimp_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('snowy_filter_tgmpa_required_plugins',	'snowy_mailchimp_tgmpa_required_plugins');
	function snowy_mailchimp_tgmpa_required_plugins( $list = array() ) {
		if ( snowy_storage_isset( 'required_plugins', 'mailchimp-for-wp' ) && snowy_storage_get_array( 'required_plugins', 'mailchimp-for-wp', 'install' ) !== false ) {
			$list[] = array(
				'name'     => snowy_storage_get_array( 'required_plugins', 'mailchimp-for-wp', 'title' ),
				'slug'     => 'mailchimp-for-wp',
				'required' => false,
			);
		}
		return $list;
	}
}

// Check if plugin installed and activated
if ( ! function_exists( 'snowy_exists_mailchimp' ) ) {
	function snowy_exists_mailchimp() {
		return function_exists( '__mc4wp_load_plugin' ) || defined( 'MC4WP_VERSION' );
	}
}



// Custom styles and scripts
//------------------------------------------------------------------------

// Enqueue styles for frontend
if ( ! function_exists( 'snowy_mailchimp_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'snowy_mailchimp_frontend_scripts', 1100 );
	//Handler of the add_action( 'trx_addons_action_load_scripts_front_mailchimp', 'snowy_mailchimp_frontend_scripts', 10, 1 );
	function snowy_mailchimp_frontend_scripts( $force = false ) {
		static $loaded = false;
		if ( ! $loaded && (
			current_action() == 'wp_enqueue_scripts' && snowy_need_frontend_scripts( 'mailchimp' )
			||
			current_action() != 'wp_enqueue_scripts' && $force === true
			)
		) {
			$loaded = true;
			$snowy_url = snowy_get_file_url( 'plugins/mailchimp-for-wp/mailchimp-for-wp.css' );
			if ( '' != $snowy_url ) {
				wp_enqueue_style( 'snowy-mailchimp-for-wp', $snowy_url, array(), null );
			}
		}
	}
}

// Merge custom styles
if ( ! function_exists( 'snowy_mailchimp_merge_styles' ) ) {
	//Handler of the add_filter( 'snowy_filter_merge_styles', 'snowy_mailchimp_merge_styles');
	function snowy_mailchimp_merge_styles( $list ) {
		$list[ 'plugins/mailchimp-for-wp/mailchimp-for-wp.css' ] = false;
		return $list;
	}
}


// Add plugin-specific colors and fonts to the custom CSS
if ( snowy_exists_mailchimp() ) {
	$snowy_fdir = snowy_get_file_dir( 'plugins/mailchimp-for-wp/mailchimp-for-wp-style.php' );
	if ( ! empty( $snowy_fdir ) ) {
		require_once $snowy_fdir;
	}
}

