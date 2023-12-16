<?php
/**
 * Required plugins
 *
 * @package SNOWY
 * @since SNOWY 1.76.0
 */

// THEME-SUPPORTED PLUGINS
// If plugin not need - remove its settings from next array
//----------------------------------------------------------
$snowy_theme_required_plugins_groups = array(
	'core'          => esc_html__( 'Core', 'snowy' ),
	'page_builders' => esc_html__( 'Page Builders', 'snowy' ),
	'ecommerce'     => esc_html__( 'E-Commerce & Donations', 'snowy' ),
	'socials'       => esc_html__( 'Socials and Communities', 'snowy' ),
	'events'        => esc_html__( 'Events and Appointments', 'snowy' ),
	'content'       => esc_html__( 'Content', 'snowy' ),
	'other'         => esc_html__( 'Other', 'snowy' ),
);
$snowy_theme_required_plugins        = array(
	'trx_addons'                 => array(
		'title'       => esc_html__( 'ThemeREX Addons', 'snowy' ),
		'description' => esc_html__( "Will allow you to install recommended plugins, demo content, and improve the theme's functionality overall with multiple theme options", 'snowy' ),
		'required'    => true,
		'logo'        => 'trx_addons.png',
		'group'       => $snowy_theme_required_plugins_groups['core'],
	),
	'elementor'                  => array(
		'title'       => esc_html__( 'Elementor', 'snowy' ),
		'description' => esc_html__( "Is a beautiful PageBuilder, even the free version of which allows you to create great pages using a variety of modules.", 'snowy' ),
		'required'    => false,
		'logo'        => 'elementor.png',
		'group'       => $snowy_theme_required_plugins_groups['page_builders'],
	),
	'gutenberg'                  => array(
		'title'       => esc_html__( 'Gutenberg', 'snowy' ),
		'description' => esc_html__( "It's a posts editor coming in place of the classic TinyMCE. Can be installed and used in parallel with Elementor", 'snowy' ),
		'required'    => false,
		'install'     => false,          // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
		'logo'        => 'gutenberg.png',
		'group'       => $snowy_theme_required_plugins_groups['page_builders'],
	),
	'js_composer'                => array(
		'title'       => esc_html__( 'WPBakery PageBuilder', 'snowy' ),
		'description' => esc_html__( "Popular PageBuilder which allows you to create excellent pages", 'snowy' ),
		'required'    => false,
		'install'     => false,          // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
		'logo'        => 'js_composer.jpg',
		'group'       => $snowy_theme_required_plugins_groups['page_builders'],
	),
	'woocommerce'                => array(
		'title'       => esc_html__( 'WooCommerce', 'snowy' ),
		'description' => esc_html__( "Connect the store to your website and start selling now", 'snowy' ),
		'required'    => false,
		'logo'        => 'woocommerce.png',
		'group'       => $snowy_theme_required_plugins_groups['ecommerce'],
	),
	'elegro-payment'             => array(
		'title'       => esc_html__( 'Elegro Crypto Payment', 'snowy' ),
		'description' => esc_html__( "Extends WooCommerce Payment Gateways with an elegro Crypto Payment", 'snowy' ),
		'required'    => false,
		'logo'        => 'elegro-payment.png',
		'group'       => $snowy_theme_required_plugins_groups['ecommerce'],
	),
	'instagram-feed'             => array(
		'title'       => esc_html__( 'Instagram Feed', 'snowy' ),
		'description' => esc_html__( "Displays the latest photos from your profile on Instagram", 'snowy' ),
		'required'    => false,
		'logo'        => 'instagram-feed.png',
		'group'       => $snowy_theme_required_plugins_groups['socials'],
	),
	'mailchimp-for-wp'           => array(
		'title'       => esc_html__( 'MailChimp for WP', 'snowy' ),
		'description' => esc_html__( "Allows visitors to subscribe to newsletters", 'snowy' ),
		'required'    => false,
		'logo'        => 'mailchimp-for-wp.png',
		'group'       => $snowy_theme_required_plugins_groups['socials'],
	),
	'booked'                     => array(
		'title'       => esc_html__( 'Booked Appointments', 'snowy' ),
		'description' => '',
		'required'    => false,
		'install'     => false,
		'logo'        => 'booked.png',
		'group'       => $snowy_theme_required_plugins_groups['events'],
	),
	'the-events-calendar'        => array(
		'title'       => esc_html__( 'The Events Calendar', 'snowy' ),
		'description' => '',
		'required'    => false,
		'install'     => false,
		'logo'        => 'the-events-calendar.png',
		'group'       => $snowy_theme_required_plugins_groups['events'],
	),
	'contact-form-7'             => array(
		'title'       => esc_html__( 'Contact Form 7', 'snowy' ),
		'description' => esc_html__( "CF7 allows you to create an unlimited number of contact forms", 'snowy' ),
		'required'    => false,
		'logo'        => 'contact-form-7.png',
		'group'       => $snowy_theme_required_plugins_groups['content'],
	),

	'latepoint'                  => array(
		'title'       => esc_html__( 'LatePoint', 'snowy' ),
		'description' => '',
		'install'     => false,
		'required'    => false,
		'logo'        => snowy_get_file_url( 'plugins/latepoint/latepoint.png' ),
		'group'       => $snowy_theme_required_plugins_groups['events'],
	),
	'advanced-popups'                  => array(
		'title'       => esc_html__( 'Advanced Popups', 'snowy' ),
		'description' => '',
		'required'    => false,
		'logo'        => snowy_get_file_url( 'plugins/advanced-popups/advanced-popups.jpg' ),
		'group'       => $snowy_theme_required_plugins_groups['content'],
	),
	'devvn-image-hotspot'                  => array(
		'title'       => esc_html__( 'Image Hotspot by DevVN', 'snowy' ),
		'description' => '',
		'required'    => false,
		'install'     => false,
		'logo'        => snowy_get_file_url( 'plugins/devvn-image-hotspot/devvn-image-hotspot.png' ),
		'group'       => $snowy_theme_required_plugins_groups['content'],
	),
	'ti-woocommerce-wishlist'                  => array(
		'title'       => esc_html__( 'TI WooCommerce Wishlist', 'snowy' ),
		'description' => '',
		'required'    => false,
		'logo'        => snowy_get_file_url( 'plugins/ti-woocommerce-wishlist/ti-woocommerce-wishlist.png' ),
		'group'       => $snowy_theme_required_plugins_groups['ecommerce'],
	),
	'woo-smart-quick-view'                  => array(
		'title'       => esc_html__( 'WPC Smart Quick View for WooCommerce', 'snowy' ),
		'description' => '',
		'required'    => false,
		'install'     => false,
		'logo'        => snowy_get_file_url( 'plugins/woo-smart-quick-view/woo-smart-quick-view.png' ),
		'group'       => $snowy_theme_required_plugins_groups['ecommerce'],
	),
	'twenty20'                  => array(
		'title'       => esc_html__( 'Twenty20 Image Before-After', 'snowy' ),
		'description' => '',
		'required'    => false,
		'install'     => false,
		'logo'        => snowy_get_file_url( 'plugins/twenty20/twenty20.png' ),
		'group'       => $snowy_theme_required_plugins_groups['content'],
	),
	'essential-grid'             => array(
		'title'       => esc_html__( 'Essential Grid', 'snowy' ),
		'description' => '',
		'required'    => false,
		'install'     => false,
		'logo'        => 'essential-grid.png',
		'group'       => $snowy_theme_required_plugins_groups['content'],
	),
	'revslider'                  => array(
		'title'       => esc_html__( 'Revolution Slider', 'snowy' ),
		'description' => '',
		'required'    => false,
		'logo'        => 'revslider.png',
		'group'       => $snowy_theme_required_plugins_groups['content'],
	),
	'sitepress-multilingual-cms' => array(
		'title'       => esc_html__( 'WPML - Sitepress Multilingual CMS', 'snowy' ),
		'description' => esc_html__( "Allows you to make your website multilingual", 'snowy' ),
		'required'    => false,
		'install'     => false,      // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
		'logo'        => 'sitepress-multilingual-cms.png',
		'group'       => $snowy_theme_required_plugins_groups['content'],
	),
	'wp-gdpr-compliance'         => array(
		'title'       => esc_html__( 'Cookie Information', 'snowy' ),
		'description' => esc_html__( "Allow visitors to decide for themselves what personal data they want to store on your site", 'snowy' ),
		'required'    => false,
		'logo'        => 'wp-gdpr-compliance.png',
		'group'       => $snowy_theme_required_plugins_groups['other'],
	),
	'trx_updater'                => array(
		'title'       => esc_html__( 'ThemeREX Updater', 'snowy' ),
		'description' => esc_html__( "Update theme and theme-specific plugins from developer's upgrade server.", 'snowy' ),
		'required'    => false,
		'logo'        => 'trx_updater.png',
		'group'       => $snowy_theme_required_plugins_groups['other'],
	),
);

if ( SNOWY_THEME_FREE ) {
	unset( $snowy_theme_required_plugins['js_composer'] );
	unset( $snowy_theme_required_plugins['booked'] );
	unset( $snowy_theme_required_plugins['the-events-calendar'] );
	unset( $snowy_theme_required_plugins['calculated-fields-form'] );
	unset( $snowy_theme_required_plugins['essential-grid'] );
	unset( $snowy_theme_required_plugins['revslider'] );
	unset( $snowy_theme_required_plugins['sitepress-multilingual-cms'] );
	unset( $snowy_theme_required_plugins['trx_updater'] );
	unset( $snowy_theme_required_plugins['trx_popup'] );
}

// Add plugins list to the global storage
snowy_storage_set( 'required_plugins', $snowy_theme_required_plugins );
