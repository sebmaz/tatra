<?php
/* Booked Appointments support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'snowy_booked_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'snowy_booked_theme_setup9', 9 );
	function snowy_booked_theme_setup9() {
		if ( snowy_exists_booked() ) {
			add_action( 'wp_enqueue_scripts', 'snowy_booked_frontend_scripts', 1100 );
			add_action( 'trx_addons_action_load_scripts_front_booked', 'snowy_booked_frontend_scripts', 10, 1 );
			add_action( 'wp_enqueue_scripts', 'snowy_booked_frontend_scripts_responsive', 2000 );
			add_action( 'trx_addons_action_load_scripts_front_booked', 'snowy_booked_frontend_scripts_responsive', 10, 1 );
			add_filter( 'snowy_filter_merge_styles', 'snowy_booked_merge_styles' );
			add_filter( 'snowy_filter_merge_styles_responsive', 'snowy_booked_merge_styles_responsive' );
		}
		if ( is_admin() ) {
			add_filter( 'snowy_filter_tgmpa_required_plugins', 'snowy_booked_tgmpa_required_plugins' );
			add_filter( 'snowy_filter_theme_plugins', 'snowy_booked_theme_plugins' );
		}
	}
}


// Filter to add in the required plugins list
if ( ! function_exists( 'snowy_booked_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('snowy_filter_tgmpa_required_plugins',	'snowy_booked_tgmpa_required_plugins');
	function snowy_booked_tgmpa_required_plugins( $list = array() ) {
		if ( snowy_storage_isset( 'required_plugins', 'booked' ) && snowy_storage_get_array( 'required_plugins', 'booked', 'install' ) !== false && snowy_is_theme_activated() ) {
			$path = snowy_get_plugin_source_path( 'plugins/booked/booked.zip' );
			if ( ! empty( $path ) || snowy_get_theme_setting( 'tgmpa_upload' ) ) {
				$list[] = array(
					'name'     => snowy_storage_get_array( 'required_plugins', 'booked', 'title' ),
					'slug'     => 'booked',
					'source'   => ! empty( $path ) ? $path : 'upload://booked.zip',
					'version'  => '2.3',
					'required' => false,
				);
			}
		}
		return $list;
	}
}


// Filter theme-supported plugins list
if ( ! function_exists( 'snowy_booked_theme_plugins' ) ) {
	//Handler of the add_filter( 'snowy_filter_theme_plugins', 'snowy_booked_theme_plugins' );
	function snowy_booked_theme_plugins( $list = array() ) {
		return snowy_add_group_and_logo_to_slave( $list, 'booked', 'booked-' );
	}
}


// Check if plugin installed and activated
if ( ! function_exists( 'snowy_exists_booked' ) ) {
	function snowy_exists_booked() {
		return class_exists( 'booked_plugin' );
	}
}


// Return a relative path to the plugin styles depend the version
if ( ! function_exists( 'snowy_booked_get_styles_dir' ) ) {
	function snowy_booked_get_styles_dir( $file ) {
		$base_dir = 'plugins/booked/';
		return $base_dir
				. ( defined( 'BOOKED_VERSION' ) && version_compare( BOOKED_VERSION, '2.4', '<' ) && snowy_get_folder_dir( $base_dir . 'old' )
					? 'old/'
					: ''
					)
				. $file;
	}
}


// Enqueue styles for frontend
if ( ! function_exists( 'snowy_booked_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'snowy_booked_frontend_scripts', 1100 );
	//Handler of the add_action( 'trx_addons_action_load_scripts_front_booked', 'snowy_booked_frontend_scripts', 10, 1 );
	function snowy_booked_frontend_scripts( $force = false ) {
		static $loaded = false;
		if ( ! $loaded && (
			current_action() == 'wp_enqueue_scripts' && snowy_need_frontend_scripts( 'booked' )
			||
			current_action() != 'wp_enqueue_scripts' && $force === true
			)
		) {
			$loaded = true;
			$snowy_url = snowy_get_file_url( snowy_booked_get_styles_dir( 'booked.css' ) );
			if ( '' != $snowy_url ) {
				wp_enqueue_style( 'snowy-booked', $snowy_url, array(), null );
			}
		}
	}
}


// Enqueue responsive styles for frontend
if ( ! function_exists( 'snowy_booked_frontend_scripts_responsive' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'snowy_booked_frontend_scripts_responsive', 2000 );
	//Handler of the add_action( 'trx_addons_action_load_scripts_front_booked', 'snowy_booked_frontend_scripts_responsive', 10, 1 );
	function snowy_booked_frontend_scripts_responsive( $force = false ) {
		static $loaded = false;
		if ( ! $loaded && (
			current_action() == 'wp_enqueue_scripts' && snowy_need_frontend_scripts( 'booked' )
			||
			current_action() != 'wp_enqueue_scripts' && $force === true
			)
		) {
			$loaded = true;
			$snowy_url = snowy_get_file_url( snowy_booked_get_styles_dir( 'booked-responsive.css' ) );
			if ( '' != $snowy_url ) {
				wp_enqueue_style( 'snowy-booked-responsive', $snowy_url, array(), null, snowy_media_for_load_css_responsive( 'booked' ) );
			}
		}
	}
}


// Merge custom styles
if ( ! function_exists( 'snowy_booked_merge_styles' ) ) {
	//Handler of the add_filter('snowy_filter_merge_styles', 'snowy_booked_merge_styles');
	function snowy_booked_merge_styles( $list ) {
		$list[ snowy_booked_get_styles_dir( 'booked.css' ) ] = false;
		return $list;
	}
}


// Merge responsive styles
if ( ! function_exists( 'snowy_booked_merge_styles_responsive' ) ) {
	//Handler of the add_filter('snowy_filter_merge_styles_responsive', 'snowy_booked_merge_styles_responsive');
	function snowy_booked_merge_styles_responsive( $list ) {
		$list[ snowy_booked_get_styles_dir( 'booked-responsive.css' ) ] = false;
		return $list;
	}
}


// Add plugin-specific colors and fonts to the custom CSS
if ( snowy_exists_booked() ) {
	$snowy_fdir = snowy_get_file_dir( snowy_booked_get_styles_dir( 'booked-style.php' ) );
	if ( ! empty( $snowy_fdir ) ) {
		require_once $snowy_fdir;
	}
}
