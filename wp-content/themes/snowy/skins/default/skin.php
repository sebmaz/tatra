<?php
/**
 * Skins support: Main skin file for the skin 'Default'
 *
 * Load scripts and styles,
 * and other operations that affect the appearance and behavior of the theme
 * when the skin is activated
 *
 * @package SNOWY
 * @since SNOWY 1.0.46
 */



// SKIN SETUP
//--------------------------------------------------------------------

// Setup fonts, colors, blog and single styles, etc.
$snowy_skin_path = snowy_get_file_dir( snowy_skins_get_current_skin_dir() . 'skin-setup.php' );
if ( ! empty( $snowy_skin_path ) ) {
	require_once $snowy_skin_path;
}

// Skin options
$snowy_skin_path = snowy_get_file_dir( snowy_skins_get_current_skin_dir() . 'skin-options.php' );
if ( ! empty( $snowy_skin_path ) ) {
	require_once $snowy_skin_path;
}

// Required plugins
$snowy_skin_path = snowy_get_file_dir( snowy_skins_get_current_skin_dir() . 'skin-plugins.php' );
if ( ! empty( $snowy_skin_path ) ) {
	require_once $snowy_skin_path;
}

// Demo import
$snowy_skin_path = snowy_get_file_dir( snowy_skins_get_current_skin_dir() . 'skin-demo-importer.php' );
if ( ! empty( $snowy_skin_path ) ) {
	require_once $snowy_skin_path;
}


// TRX_ADDONS SETUP
//--------------------------------------------------------------------

// Filter to add in the required plugins list
// Priority 11 to add new plugins to the end of the list
if ( ! function_exists( 'snowy_skin_tgmpa_required_plugins' ) ) {
	add_filter( 'snowy_filter_tgmpa_required_plugins', 'snowy_skin_tgmpa_required_plugins', 11 );
	function snowy_skin_tgmpa_required_plugins( $list = array() ) {
		// ToDo: Check if plugin is in the 'required_plugins' and add his parameters to the TGMPA-list
		//       Replace 'skin-specific-plugin-slug' to the real slug of the plugin
		if ( snowy_storage_isset( 'required_plugins', 'skin-specific-plugin-slug' ) ) {
			$list[] = array(
				'name'     => snowy_storage_get_array( 'required_plugins', 'skin-specific-plugin-slug', 'title' ),
				'slug'     => 'skin-specific-plugin-slug',
				'required' => false,
			);
		}
		return $list;
	}
}

// Filter to add/remove components of ThemeREX Addons when current skin is active
if ( ! function_exists( 'snowy_skin_trx_addons_default_components' ) ) {
    add_filter('trx_addons_filter_load_options', 'snowy_skin_trx_addons_default_components', 20);
	function snowy_skin_trx_addons_default_components($components) {
        // ToDo: Set key value in the array $components to 0 (disable component) or 1 (enable component)
		//---> For example (enable reviews for posts):
		//---> $components['components_components_reviews'] = 1;
		return $components;
	}
}

// Filter to add/remove CPT
if ( ! function_exists( 'snowy_skin_trx_addons_cpt_list' ) ) {
	add_filter('trx_addons_cpt_list', 'snowy_skin_trx_addons_cpt_list');
	function snowy_skin_trx_addons_cpt_list( $list = array() ) {
		// ToDo: Unset CPT slug from list to disable CPT when current skin is active
		//---> For example to disable CPT 'Portfolio':
		//---> unset( $list['portfolio'] );
		return $list;
	}
}

// Filter to add/remove shortcodes
if ( ! function_exists( 'snowy_skin_trx_addons_sc_list' ) ) {
	add_filter('trx_addons_sc_list', 'snowy_skin_trx_addons_sc_list');
	function snowy_skin_trx_addons_sc_list( $list = array() ) {

		unset( $list['blogger']['templates']['default']['classic_2']);
		unset( $list['blogger']['templates']['default']['over_centered']);
		unset( $list['blogger']['templates']['news']['announce']);

        $list['blogger']['templates']['portestate']['default'] = array(
            'title'  => esc_html__('default', 'snowy'),
            'layout' => array(
                'featured' => array(
                ),
                'content' => array(
                    'title','meta_categories'
                )
            )
        );
        $list['blogger']['templates']['portmodern']['image-over'] = array(
            'title'  => esc_html__('Image over', 'snowy'),
            'args' => array( 'image_ratio' =>  '10:9' ),
            'layout' => array(
                'content' => array(
                    'title'
                )
            )
        );
        $list['blogger']['templates']['lay_portfolio']['style-1'] = array(
            'title'  => esc_html__('Style 1', 'snowy'),
            'layout' => array(
                'featured' => array(
                ),
                'content' => array(
                    'title', 'meta_categories', 'meta', 'excerpt', 'readmore'
                )
            )
        );
        $list['blogger']['templates']['lay_portfolio']['style_5'] = array (
            'title'  => esc_html__('Style 5', 'snowy'),
            'args' => array( 'image_ratio' =>  '10:9', 'hover' => 'link' ),
            'layout' => array (
                'featured' => array (
                    'bl' => array (
                        'title', 'meta_categories', 'meta', 'excerpt', 'readmore'
                    )
                )
            )
        );
        $list['blogger']['templates']['lay_portfolio']['style_6'] = array (
            'title'  => esc_html__('Style 6', 'snowy'),
            'args' => array( 'image_ratio' =>  '10:9', 'hover' => 'link' ),
            'layout' => array (
                'featured' => array (
                    'bc' => array (
                        'title', 'meta_categories', 'meta', 'excerpt', 'readmore'
                    )
                )
            )
        );
        $list['blogger']['templates']['lay_portfolio']['style_7'] = array (
            'title'  => esc_html__('Style 7', 'snowy'),
            'args' => array( 'image_ratio' =>  '1:1', 'hover' => 'link' ),
            'layout' => array (
                'featured' => array (
                    'bl' => array (
                        'title', 'meta_categories'
                    )
                )
            )
        );
        $list['blogger']['templates']['lay_portfolio']['style-8'] = array(
            'title'  => esc_html__('Style 8', 'snowy'),
            'layout' => array(
                'featured' => array(
                ),
                'content' => array(
                    'title', 'meta_categories', 'meta', 'excerpt', 'readmore'
                )
            )
        );
        $list['blogger']['templates']['lay_portfolio']['style_14'] = array (
            'title'  => esc_html__('Style 14', 'snowy'),
            'args' => array( 'image_ratio' =>  '10:7','no_links'  => false, 'hover' => 'link' ),
            'layout' => array (
                'featured' => array (
                    'bc' => array (
                        'title', 'meta_categories'
                    )
                )
            )
        );
        $list['blogger']['templates']['lay_portfolio']['style_15'] = array (
            'title'  => esc_html__('Style 15', 'snowy'),
            'args' => array( 'image_ratio' =>  '1:1','no_links'  => false, 'hover' => 'link' ),
            'layout' => array (
                'featured' => array (
                    'bc' => array (
                        'title', 'meta_categories'
                    )
                )
            )
        );
        $list['blogger']['templates']['lay_portfolio']['style_16'] = array (
            'title'  => esc_html__('Style 16', 'snowy'),
            'args' => array( 'image_ratio' =>  '10:9','hover' => 'link' ),
            'layout' => array (
                'featured' => array (
                    'bl' => array (
                        'title', 'meta_categories', 'readmore'
                    )
                )
            )
        );

        // Grid portfolio
        // Grid Style 3
        $list['blogger']['templates']['lay_portfolio_grid']['grid_style_3'] = array (
            'title'  => esc_html__('Grid style 3', 'snowy'),
            'args'  => array(  'hover' => 'link' ),
            'grid'  => array(
                // One post
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Two posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Three posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Four posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Five posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                    )
                ),
                // Six posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                    )
                ),
                // Seven posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Eight posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Nine posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Ten posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Eleven posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Twelve posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                    )
                ),
            )
        );

        // grid Style 4
        $list['blogger']['templates']['lay_portfolio_grid']['grid_style_4'] = array (
            'title'  => esc_html__('Grid style 4', 'snowy'),
            'args'  => array( 'hover' => 'link' ),
            'grid'  => array(
                // One post
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Two posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Three posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Four posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Five posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                    )
                ),
                // Six posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Seven posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Eight posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Nine posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Ten posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Eleven posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'big' )
                        ),
                    )
                ),
                // Twelve posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'big' )
                        ),
                    )
                ),
            )
        );

        // Grid Style 5
        $list['blogger']['templates']['lay_portfolio_grid']['grid_style_5'] = array (
            'title'  => esc_html__('Grid style 5', 'snowy'),
            'args'  => array(  'hover' => 'link' ),
            'grid'  => array(
                // One post
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Two posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Three posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Four posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Five posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Six posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                    )
                ),
            )
        );

        // Grid Style 7
        $list['blogger']['templates']['lay_portfolio_grid']['grid_style_7'] = array(
            'title'  => esc_html__('Grid style 7', 'snowy'),
            'args' => array( /*'hover' => 'link' - specific hovers work satisfactorily*/ ),
            'grid'  => array(
                // One post
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Two posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Three posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Four posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Five posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Six posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                    )
                ),
                // Seven posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Eight posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Nine posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Ten posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Eleven posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Twelve posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                    )
                ),
            )
        );

        // Grid Style 8
        $list['blogger']['templates']['lay_portfolio_grid']['grid_style_8'] = array (
            'title'  => esc_html__('Grid style 8', 'snowy'),
            'args' => array( 'hover' => 'link' ),
            'grid'  => array(
                // One post
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Two posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Three posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Four posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Five posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                    )
                ),
                // Six posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                    )
                ),
                // Seven posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Eight posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                )
                ),
                // Nine posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Ten posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Eleven posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Twelve posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        )
                    )
                ),
            )
        );

        // Grid Style 9
        $list['blogger']['templates']['lay_portfolio_grid']['grid_style_9'] = array (
            'title'  => esc_html__('Grid style 9', 'snowy'),
            'args'  => array(  /*'hover' => 'link' - specific hovers work satisfactorily*/ ),
            'grid'  => array(
                // One post
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Two posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Three posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Four posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Five posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Six posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                    )
                ),
                // Seven posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                    )
                ),
                // Eight posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Nine posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Ten posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Eleven posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Twelve posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                    )
                ),
            )
        );

        // grid Style 13
        $list['blogger']['templates']['lay_portfolio_grid']['grid_style_13'] = array (
            'title'  => esc_html__('Grid style 13', 'snowy'),
            'args'  => array(  'hover' => 'link' ),
            'grid'  => array(
                // One post
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Two posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Three posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Four posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Five posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                    )
                ),
                // Six posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'masonry-big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'masonry-big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'masonry-big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Seven posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'masonry-big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Eight posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'masonry-big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Nine posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'masonry-big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'big' )
                        ),
                    )
                ),
                // Ten posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'masonry-big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'masonry-big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'masonry-big' )
                        ),
                    )
                ),
                // Eleven posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'masonry-big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'masonry-big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Twelve posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'masonry-big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'masonry-big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'masonry-big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'masonry-big' )
                        ),
                    )
                ),
            )
        );



		$list['blogger']['templates']['list']['simple'] = array(
			'title'  => esc_html__('Simple', 'snowy'),
			'layout' => array(
				'content' => array(
					'meta', 'title', 'readmore'
				)
			)
		);
		$list['blogger']['templates']['list']['hover'] = array(
			'title'  => esc_html__('Simple (hover)', 'snowy'),
			'layout' => array(
				'content' => array(
					'meta', 'title', 'readmore'
				)
			)
		);
		$list['blogger']['templates']['list']['hover_2'] = array(
			'title'  => esc_html__('Simple (hover 2)', 'snowy'),
			'layout' => array(
				'content' => array(
					'meta', 'title', 'excerpt', 'readmore'
				)
			)
		);
		$list['blogger']['templates']['list']['with_image'] = array(
			'title'  => esc_html__('With image', 'snowy'),
			'layout' => array(
				'featured' => array(
				),
				'content' => array(
					'meta', 'title', 'readmore'
				)
			)
		);
		$list['blogger']['templates']['default']['classic_simple'] = array(
			'title'  => esc_html__('Classic Grid (simple)', 'snowy'),
			'layout' => array(
				'featured' => array(
				),
				'content' => array(
					'meta', 'title', 'excerpt', 'readmore'
				)
			)
		);
		$list['blogger']['templates']['default']['classic_3'] = array(
			'title'  => esc_html__('Classic with header above', 'snowy'),
			'layout' => array(
				'header' => array(
					'meta', 'title'
				),
				'featured' => array(
				),
				'content' => array(
					'excerpt', 'readmore'
				)
			)
		);
		$list['blogger']['templates']['default']['classic_time'] = array(
			'title'  => esc_html__('Classic Grid (date)', 'snowy'),
			'layout' => array(
				'featured' => array(
				),
				'content' => array(
					'meta_date', 'meta', 'title', 'excerpt', 'readmore'
				)
			)
		);
		$list['blogger']['templates']['default']['classic_time_2'] = array(
			'title'  => esc_html__('Classic Grid (date 2)', 'snowy'),
			'layout' => array(
				'featured' => array(
					'tl' => array(
						'meta_categories'
					)
				),
				'content' => array(
					'meta_date', 'title', 'excerpt', 'meta', 'readmore'
				)
			)
		);
		$list['blogger']['templates']['default']['over_bottom'] = array(
			'title'  => esc_html__('Info over image (bottom)', 'snowy'),
			'layout' => array(
				'featured' => array(
					'bc' => array(
						'meta', 'title', 'readmore'
					)
				),
			)
		);
		$list['blogger']['templates']['default']['over_centered_hover'] = array(
			'title'  => esc_html__('Info over image (hover)', 'snowy'),
			'layout' => array(
				'featured' => array(
					'mc' => array(
						'meta', 'title', 'excerpt', 'readmore'
					)
				),
			)
		);
		$list['blogger']['templates']['default']['over_centered_hover_2'] = array(
			'title'  => esc_html__('Info over image (hover 2)', 'snowy'),
			'layout' => array(
				'featured' => array(
					'mc' => array(
						'meta_categories', 'title', 'meta'
					)
				),
			)
		);
		$list['blogger']['templates']['default']['over_centered_hover_3'] = array(
			'title'  => esc_html__('Info over image (hover 3)', 'snowy'),
			'layout' => array(
				'featured' => array(
					'mc' => array(
						'meta_categories', 'title', 'meta'
					)
				),
			)
		);
		$list['blogger']['templates']['default']['over_centered_hover'] = array(
			'title'  => esc_html__('Info over image (hover)', 'snowy'),
			'layout' => array(
				'featured' => array(
					'mc' => array(
						'meta', 'title', 'excerpt', 'readmore'
					)
				),
			)
		);

		return $list;
	}
}

// Filter to add/remove widgets
if ( ! function_exists( 'snowy_skin_trx_addons_widgets_list' ) ) {
	add_filter('trx_addons_widgets_list', 'snowy_skin_trx_addons_widgets_list');
	function snowy_skin_trx_addons_widgets_list( $list = array() ) {
		// ToDo: Unset widget's slug from list to disable widget when current skin is active
		//---> For example to disable widget 'About Me':
		//---> unset( $list['aboutme'] );

		$list['categories_list']['layouts_sc'][4] = esc_html__('Extra 1', 'snowy');
		$list['categories_list']['layouts_sc'][5] = esc_html__('Extra 2', 'snowy');
		$list['categories_list']['layouts_sc'][6] = esc_html__('Extra 3', 'snowy');
		$list['categories_list']['layouts_sc'][7] = esc_html__('Grid 1', 'snowy');
		$list['categories_list']['layouts_sc'][8] = esc_html__('Grid 2', 'snowy');

		return $list;
	}
}


// SCRIPTS AND STYLES
//--------------------------------------------------

// Localize a theme-specific scripts: add variables to use in JS in the frontend.
if ( ! function_exists( 'snowy_skin_localize_script' ) ) {
	add_action( 'snowy_filter_localize_script', 'snowy_skin_localize_script' );
	function snowy_skin_localize_script( $vars = array() ) {
		$vars['msg_copied'] = addslashes(esc_html__("Copied!", 'snowy'));
        return $vars;
	}
}


// Enqueue skin-specific scripts
// Priority 1050 -  before main theme plugins-specific (1100)
if ( ! function_exists( 'snowy_skin_frontend_scripts' ) ) {
	add_action( 'wp_enqueue_scripts', 'snowy_skin_frontend_scripts', 1050 );
	function snowy_skin_frontend_scripts() {
		$snowy_url = snowy_get_file_url( snowy_skins_get_current_skin_dir() . 'css/style.css' );
		if ( '' != $snowy_url ) {
			wp_enqueue_style( 'snowy-skin-' . esc_attr( snowy_skins_get_current_skin_name() ), $snowy_url, array(), null );
		}
		$snowy_url = snowy_get_file_url( snowy_skins_get_current_skin_dir() . 'skin.js' );
		if ( '' != $snowy_url ) {
			wp_enqueue_script( 'snowy-skin-' . esc_attr( snowy_skins_get_current_skin_name() ), $snowy_url, array( 'jquery' ), null, true );
		}
	}
}


// Enqueue additional responsive styles for frontend
// Priority 2050 -  after main theme plugins-specific responsive (2000)
if ( ! function_exists( 'snowy_skin_trx_addons_responsive_styles' ) ) {
	add_action( 'wp_enqueue_scripts', 'snowy_skin_trx_addons_responsive_styles', 2050 );
	function snowy_skin_trx_addons_responsive_styles() {
		if ( snowy_is_on( snowy_get_theme_option( 'debug_mode' ) ) ) {
			$snowy_url_additional_1 = snowy_get_file_url( 'plugins/trx_addons/trx_addons-additional-responsive-1.css' );
			$snowy_url_additional_2 = snowy_get_file_url( 'plugins/trx_addons/trx_addons-additional-responsive-2.css' );
			$snowy_url_additional_3 = snowy_get_file_url( 'plugins/trx_addons/trx_addons-additional-responsive-3.css' );
            if ( '' != $snowy_url_additional_1 ) {
                wp_enqueue_style( 'snowy-trx-addons-additional-responsive-1', $snowy_url_additional_1, array(), null, snowy_media_for_load_css_responsive( 'trx-addons-1' ) );
			}
            if ( '' != $snowy_url_additional_2 ) {
                wp_enqueue_style( 'snowy-trx-addons-additional-responsive-2', $snowy_url_additional_2, array(), null, snowy_media_for_load_css_responsive( 'trx-addons-2' ) );
            }
            if ( '' != $snowy_url_additional_3 ) {
                wp_enqueue_style( 'snowy-trx-addons-additional-responsive-3', $snowy_url_additional_3, array(), null, snowy_media_for_load_css_responsive( 'trx-addons-3' ) );
            }
		}
	}
}

// Merge responsive styles
if ( ! function_exists( 'snowy_skin_trx_addons_merge_styles_responsive' ) ) {
	add_filter('snowy_filter_merge_styles_responsive', 'snowy_skin_trx_addons_merge_styles_responsive', 20);
	function snowy_skin_trx_addons_merge_styles_responsive( $list ) {
		$list[] = 'plugins/trx_addons/trx_addons-additional-responsive-1.css';
		$list[] = 'plugins/trx_addons/trx_addons-additional-responsive-2.css';
		$list[] = 'plugins/trx_addons/trx_addons-additional-responsive-3.css';
		return $list;
	}
}


// Custom styles
$snowy_style_path = snowy_get_file_dir( snowy_skins_get_current_skin_dir() . 'css/style.php' );
if ( ! empty( $snowy_style_path ) ) {
	require_once $snowy_style_path;
}



// ADD NEW PARAMS
//--------------------------------------------------


// Add new output types (layouts) in the shortcodes
if ( ! function_exists( 'snowy_skin_trx_addons_sc_type' ) ) {
	add_filter( 'trx_addons_sc_type', 'snowy_skin_trx_addons_sc_type', 10, 2 );
	function snowy_skin_trx_addons_sc_type( $list, $sc ) {

		if ( 'trx_sc_button' == $sc ) {
			$list['decoration'] = esc_html__( 'Decoration', 'snowy' );
			$list['hover'] = esc_html__( 'Hover', 'snowy' );
		}
        if ( 'trx_sc_title' == $sc ) {
            $list['icon'] = esc_html__( 'Icon', 'snowy' );
            $list['icon_bottom'] = esc_html__( 'Icon (bottom)', 'snowy' );
        }
        if ( 'trx_sc_price' == $sc ) {
            $list['light'] = esc_html__( 'Light', 'snowy' );
            $list['simple'] = esc_html__( 'Simple', 'snowy' );
            $list['simple_shadow'] = esc_html__( 'Simple (shadow)', 'snowy' );
            $list['plain'] = esc_html__( 'Plain', 'snowy' );
            $list['focus'] = esc_html__( 'Focus', 'snowy' );
            $list['metro'] = esc_html__( 'Metro', 'snowy' );
        }
        if ( 'trx_sc_skills' == $sc ) {
            $list['alter'] = esc_html__( 'Alter', 'snowy' );
            $list['extra'] = esc_html__( 'Extra', 'snowy' );
            $list['modern'] = esc_html__( 'Modern', 'snowy' );
            $list['simple'] = esc_html__( 'Simple', 'snowy' );
        }
        if ( 'trx_sc_icons' == $sc ) {
            $list['alter'] = esc_html__( 'Alter', 'snowy' );
            $list['light'] = esc_html__( 'Light', 'snowy' );
            $list['hover'] = esc_html__( 'Hover', 'snowy' );
            $list['hover2'] = esc_html__( 'Hover 2', 'snowy' );
            $list['simple'] = esc_html__( 'Simple', 'snowy' );
            $list['plate'] = esc_html__( 'Plate', 'snowy' );
            $list['extra'] = esc_html__( 'Extra', 'snowy' );
            $list['plain'] = esc_html__( 'Plain', 'snowy' );
            $list['bordered'] = esc_html__( 'Bordered', 'snowy' );
            $list['card'] = esc_html__( 'Card', 'snowy' );
            $list['creative'] = esc_html__( 'Creative', 'snowy' );
            $list['accent'] = esc_html__( 'Accent', 'snowy' );
            $list['accent2'] = esc_html__( 'Accent 2', 'snowy' );
            $list['motley'] = esc_html__( 'Motley', 'snowy' );
            $list['decoration'] = esc_html__( 'Decoration', 'snowy' );
            $list['figure'] = esc_html__( 'Figure', 'snowy' );
            $list['number'] = esc_html__( 'Number', 'snowy' );
            $list['rounded'] = esc_html__( 'Rounded', 'snowy' );
            $list['common'] = esc_html__( 'Common', 'snowy' );
            $list['divider'] = esc_html__( 'Divider', 'snowy' );
            $list['divider2'] = esc_html__( 'Divider 2', 'snowy' );
            $list['divider3'] = esc_html__( 'Divider 3', 'snowy' );
            $list['divider4'] = esc_html__( 'Divider 4', 'snowy' );
            $list['partners'] = esc_html__( 'Partners', 'snowy' );
            $list['fill'] = esc_html__( 'Fill', 'snowy' );
        }

        if ( 'trx_sc_services' == $sc ) {
            $list['alter'] = esc_html__( 'Alter', 'snowy' );
            $list['modern'] = esc_html__( 'Modern', 'snowy' );
            $list['breezy'] = esc_html__( 'Breezy', 'snowy' );
            $list['cool'] = esc_html__( 'Cool', 'snowy' );
            $list['extra'] = esc_html__( 'Extra', 'snowy' );
            $list['strong'] = esc_html__( 'Strong', 'snowy' );
            $list['minimal'] = esc_html__( 'Minimal', 'snowy' );
            $list['creative'] = esc_html__( 'Creative', 'snowy' );
            $list['shine'] = esc_html__( 'Shine', 'snowy' );
            $list['motley'] = esc_html__( 'Motley', 'snowy' );
            $list['classic'] = esc_html__( 'Classic', 'snowy' );
            $list['fashion'] = esc_html__( 'Fashion', 'snowy' );
            $list['backward'] = esc_html__( 'Backward', 'snowy' );
            $list['accent'] = esc_html__( 'Accent', 'snowy' );
            $list['strange'] = esc_html__( 'Strange', 'snowy' );
            $list['unusual'] = esc_html__( 'Unusual', 'snowy' );
            $list['price'] = esc_html__( 'Price', 'snowy' );
            $list['price2'] = esc_html__( 'Price 2', 'snowy' );
        }
		if ( 'trx_sc_team' == $sc ) {
			$list['alter'] = esc_html__( 'Alter', 'snowy' );
			$list['3d'] = esc_html__( '3D', 'snowy' );
			$list['3d-simple'] = esc_html__( '3D (simple)', 'snowy' );
			$list['plain'] = esc_html__( 'Plain', 'snowy' );
			$list['list'] = esc_html__( 'List', 'snowy' );
			$list['metro'] = esc_html__( 'Metro', 'snowy' );
			$list['hover'] = esc_html__( 'Hover', 'snowy' );
			$list['creative'] = esc_html__( 'Creative', 'snowy' );
			$list['accent'] = esc_html__( 'Accent', 'snowy' );
			$list['light'] = esc_html__( 'Light', 'snowy' );
		}
		if ( 'trx_sc_testimonials' == $sc ) {
			$list['classic'] = esc_html__( 'Classic', 'snowy' );
			$list['plain'] = esc_html__( 'Plain', 'snowy' );
			$list['extra'] = esc_html__( 'Plain (extra)', 'snowy' );
			$list['light'] = esc_html__( 'Light', 'snowy' );
			$list['list'] = esc_html__( 'List', 'snowy' );
			$list['common'] = esc_html__( 'Common', 'snowy' );
			$list['modern'] = esc_html__( 'Modern', 'snowy' );
			$list['hover'] = esc_html__( 'Hover', 'snowy' );
			$list['accent'] = esc_html__( 'Accent', 'snowy' );
			$list['accent2'] = esc_html__( 'Accent 2', 'snowy' );
			$list['creative'] = esc_html__( 'Creative', 'snowy' );
			$list['fashion'] = esc_html__( 'Fashion', 'snowy' );
			$list['alter'] = esc_html__( 'Alter', 'snowy' );
			$list['alter2'] = esc_html__( 'Alter 2', 'snowy' );
			$list['decoration'] = esc_html__( 'Decoration', 'snowy' );
			$list['chit'] = esc_html__( 'Chit', 'snowy' );
			$list['bred'] = esc_html__( 'Bred', 'snowy' );
		}
        if ( 'trx_sc_blogger' == $sc ) {
            $list['lay_portfolio'] = esc_html__('Layout Portfolio', 'snowy' );
            $list['lay_portfolio_grid'] = esc_html__('Layout Portfolio grid', 'snowy' );
            $list['portmodern'] = esc_html__('Portfolio Modern', 'snowy' );
            $list['portestate'] = esc_html__('Portfolio Real Estate', 'snowy' );
        }
        if ( 'trx_sc_portfolio' == $sc ) {
            $list['extra'] = esc_html__('Extra', 'snowy' );
            $list['eclipse'] = esc_html__('Eclipse', 'snowy' );
            $list['simple'] = esc_html__('Simple', 'snowy' );
            $list['band'] = esc_html__('Band', 'snowy' );
            $list['fill'] = esc_html__('Fill', 'snowy' );
        }
        if ( 'trx_sc_layouts_search' == $sc ) {
            $list['modern'] = esc_html__('Modern', 'snowy' );
        }
		if ( 'trx_sc_socials' == $sc ) {
			$list['modern'] = esc_html__('Modern', 'snowy' );
			$list['modern_2'] = esc_html__('Modern 2', 'snowy' );
			$list['alter'] = esc_html__('Alter (icon+name)', 'snowy' );
			$list['extra'] = esc_html__('Extra (icon+name)', 'snowy' );
			$list['simple'] = esc_html__('Simple', 'snowy' );
		}
		if ( 'trx_sc_layouts_cart' == $sc ) {
			$list['modern'] = esc_html__('Modern', 'snowy' );
		}
        if ( 'trx_sc_events' == $sc ) {
            $list['modern'] = esc_html__('Modern', 'snowy' );
            $list['alter'] = esc_html__('Alter', 'snowy' );
        }
        if ( 'trx_widget_instagram' == $sc ) {
            $list['simple'] = esc_html__('Simple', 'snowy' );
            $list['alter'] = esc_html__('Alter', 'snowy' );
            $list['modern'] = esc_html__('Modern', 'snowy' );
        }

        return $list;
	}
}

// Add new params to the default shortcode's atts
if ( ! function_exists( 'snowy_skin_trx_addons_sc_atts' ) ) {
    add_filter('trx_addons_sc_atts', 'snowy_skin_trx_addons_sc_atts', 10, 2);
    function snowy_skin_trx_addons_sc_atts($atts, $sc)  {
        if ( 'trx_sc_skills' == $sc ) {
            $atts['align'] = 'none';
            $atts['show_divider'] = '';
        }
        if ('trx_sc_icons' == $sc ) {
            $atts['link_text'] = '';
        }
        if ( 'trx_sc_services' == $sc ) {
            $atts['show_subtitle'] = '';
        }
        if ( 'trx_sc_layouts' == $sc ) {
            $atts['panel_menu_style'] = '';
            $atts['vertical_menu_style'] = '';
        }
        if ( 'trx_sc_layouts_search' == $sc ) {
            $atts['logo_search'] = 'url';
            $atts['logo_search_retina'] = 'url';
            $atts['scheme_search'] = '';
        }
        if ( 'trx_sc_events' == $sc ) {
            $atts['hide_excerpt'] = '';
            $atts['more_text'] = '';
        }
        return $atts;
    }
}

// Add item params to icons
if ( ! function_exists( 'snowy_skin_filter_icons_add_param' ) ) {
    add_filter( 'trx_addons_sc_param_group_params', 'snowy_skin_filter_icons_add_param', 10, 2 );
    function snowy_skin_filter_icons_add_param( $params, $sc ) {

        if ( in_array( $sc, array( 'trx_sc_icons' ) ) ) {
            if ( isset( $params[0]['name'] ) && isset( $params[0]['label'] ) ) {
                array_splice($params, 6, 0, array( array(
                    'name'        => 'link_text',
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'label'       => esc_html__( 'Link text', 'snowy' ),
                    'label_block' => false,
                    'default' => esc_html__('Read more', 'snowy'),
                ) ) );
            }
        }
        return $params;
    }
}


// Add/Remove params
if (!function_exists('snowy_add_portfolio_params_to_elements')) {
    add_action( 'elementor/element/before_section_end', 'snowy_add_portfolio_params_to_elements', 11, 3 );
    function snowy_add_portfolio_params_to_elements($element, $section_id, $args)  {
        if ( is_object( $element ) ) {
            $el_name = $element->get_name();
            if ( 'trx_sc_portfolio' == $el_name  && 'section_sc_portfolio' === $section_id ) {
                $element->remove_control( 'use_masonry' );
                $element->remove_control( 'use_gallery' );

                if ( 'trx_sc_portfolio' == $el_name  && 'section_sc_portfolio' === $section_id ) {
                    $element->add_control(
                        'use_masonry', array(
                            'label' => esc_html__('Use masonry', 'snowy'),
                            'label_block' => false,
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'label_off' => esc_html__('Off', 'snowy'),
                            'label_on' => esc_html__('On', 'snowy'),
                            'return_value' => '1',
                            'condition' => [
                                'type' => ['eclipse']
                            ],
                        )
                    );
                    $element->add_control(
                        'use_gallery', array(
                            'label' => esc_html__('Use gallery', 'snowy'),
                            'label_block' => false,
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'label_off' => esc_html__('Off', 'snowy'),
                            'label_on' => esc_html__('On', 'snowy'),
                            'default' => trx_addons_is_on(trx_addons_get_option('portfolio_use_gallery')) ? '1' : '',
                            'return_value' => '1',
                            'condition' => [
                                'type' => ['eclipse']
                            ],
                        )
                    );
                }

            }
        }
    }
}


// Add/Remove params to the existings sections: use templates as Tab content
if (!function_exists('snowy_skin_elm_add_params_new_set_after')) {
    add_action('elementor/element/after_section_start', 'snowy_skin_elm_add_params_new_set_after', 10, 3);
    function snowy_skin_elm_add_params_new_set_after($element, $section_id, $args)  {
        if (is_object($element)) {
            $el_name = $element->get_name();
            if ('trx_sc_skills' == $el_name && $section_id == 'section_sc_skills') {
                $element->add_control(
                    'align', array(
                        'label_block' => false,
                        'type' => \Elementor\Controls_Manager::SELECT,
                        'label' => __("Skills alignment", 'snowy'),
                        'options' => array(
                            'none' => esc_html__("Default", 'snowy'),
                            'left' => esc_html__('Left', 'snowy'),
                            'center' => esc_html__('Center', 'snowy'),
                            'right' => esc_html__('Right', 'snowy'),
                        ),
                        'default' => 'none',
                        'condition' => array(
                            'type' => array('counter','alter','extra', 'simple')
                        )
                    )
                );
            }

            if ('trx_sc_services' == $el_name && $section_id == 'section_sc_services_details') {
                $element->add_control(
                    'show_subtitle', array(
                        'type' => \Elementor\Controls_Manager::SWITCHER,
                        'label' => esc_html__('Subtitle', 'snowy'),
                        'label_off' => esc_html__('Show', 'snowy'),
                        'label_on' => esc_html__('Hide', 'snowy'),
                        'return_value' => '1',
                        'condition' => array(
                            'type' => array('default', 'panel', 'alter', 'extra', 'price', 'price2', 'modern', 'hover', 'breezy', 'creative', 'shine', 'motley', 'classic', 'fashion', 'backward', 'accent', 'strange', 'unusual', 'cool', 'strong', 'minimal')
                        )
                    )
                );
            }
        }
    }
}

// Add Tab section and params to shortcode events
if (!function_exists('snowy_skin_events_elm_add_params_new_set')) {
    add_action('elementor/element/before_section_start', 'snowy_skin_events_elm_add_params_new_set', 10, 3);
    function snowy_skin_events_elm_add_params_new_set($element, $section_id, $args) {

        if (!is_object($element)) return;
        $el_name = $element->get_name();

        // Add control 'More Text' Events
        if ('trx_sc_events' == $el_name && $section_id == 'section_slider_params') {

            $element->start_controls_section(
                'section_sc_events_details', array(
                    'label' => esc_html__('Details', 'snowy'),
                    'tab' => \Elementor\Controls_Manager::TAB_LAYOUT
                )
            );
            $element->add_control(
                'more_text', array(
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'label' => esc_html__('More text', 'snowy'),
                    'label_block' => false,
                    'default' => esc_html__('Read more', 'snowy'),
                    'condition' => array(
                        'type' => array('default', 'classic', 'modern', 'alter')
                    )
                )
            );
            $element->add_control(
                'hide_excerpt', array(
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label' => esc_html__('Hide excerpt', 'snowy'),
                    'label_off' => __( 'Off', 'snowy' ),
                    'label_on' => __( 'On', 'snowy' ),
                    'return_value' => '1',
                    'condition' => array(
                        'type' => array('default', 'classic', 'modern', 'alter')
                    )
                )
            );


            $element->end_controls_section();
        }
    }
}

// Add/Remove params to the existings sections: use templates as Tab content
if (!function_exists('snowy_elm_add_params_new_set')) {
	add_action( 'elementor/element/before_section_end', 'snowy_elm_add_params_new_set', 10, 3 );
	function snowy_elm_add_params_new_set($element, $section_id, $args) {

		if ( ! is_object($element) ) return;
		$el_name = $element->get_name();

		// Add template selector
		if ( $el_name == 'trx_sc_button' && $section_id == 'section_sc_button' ) {
			$control   = $element->get_controls( 'buttons' );
			$fields    = $control['fields'];
			$default   = $control['default'];
			if ( is_array( $default ) ) {
				for( $i=0; $i < count($default); $i++ ) {
					$default[$i]['shadow'] = 0;
				}
			}
			$fields['shadow'] = array(
				'name' => 'shadow',
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label'        => esc_html__( 'Shadow', 'snowy' ),
				'label_block'  => false,
				'label_off'    => esc_html__( 'Off', 'snowy' ),
				'label_on'     => esc_html__( 'On', 'snowy' ),
				'condition'    => array(
					'type' => array('default', 'decoration', 'hover')
				)
			);
			$element->update_control( 'buttons', array(
					'default' => $default,
					'fields' => $fields
				)
			);
		}

		if ( $el_name == 'trx_sc_price' && $section_id == 'section_sc_price' ) {
			$control   = $element->get_controls( 'prices' );
			$fields    = $control['fields'];
			$default   = $control['default'];
			if ( is_array( $default ) ) {
				for( $i=0; $i < count($default); $i++ ) {
					$default[$i]['price_active'] = 0;
				}
			}
			$fields['price_active'] = array(
				'name' => 'price_active',
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label'        => esc_html__( 'Price Active', 'snowy' ),
				'label_block'  => false,
				'label_off'    => esc_html__( 'Off', 'snowy' ),
				'label_on'     => esc_html__( 'On', 'snowy' ),
			);
			$element->update_control( 'prices', array(
					'default' => $default,
					'fields' => $fields
				)
			);
		}

		if ( $section_id == 'section_sc_title' ) {
			$element->add_control( 'sc_button_shadow', array(
				'label_block'  => false,
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label' => esc_html__("Shadow", 'snowy'),
				'label_on' => esc_html__( 'On', 'snowy' ),
				'label_off' => esc_html__( 'Off', 'snowy' ),
				'condition'    => array(
					'link_style' => array('default', 'decoration', 'hover')
				)
			) );
		}

        if ('trx_sc_skills' == $el_name && $section_id == 'section_sc_skills') {
            $element->add_control(
                'show_divider', array(
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label' => esc_html__('Skills divider', 'snowy'),
                    'label_on' => esc_html__( 'On', 'snowy' ),
                    'label_off' => esc_html__( 'Off', 'snowy' ),
                    'return_value' => '1',
                    'condition' => array(
                        'type' => array('alter', 'simple')
                    )
                )
            );
        }

        if ('trx_sc_services' == $el_name && $section_id == 'section_sc_services') {
            $element->update_control(
                'featured', array(
                    'description' => wp_kses_data( __('Please note: some options might be incompatible with certain layouts.', 'snowy') ),
                    'condition' => [
                        'type' => ['default', 'panel', 'alter', 'extra', 'price', 'price2', 'modern', 'breezy', 'cool', 'creative', 'shine', 'motley', 'classic', 'fashion', 'backward', 'accent', 'unusual', 'strong', 'minimal', 'callouts', 'hover', 'light', 'list', 'iconed', 'tabs', 'tabs_simple']
                    ],
                )
            );
            $element->update_control(
                'featured_position', array(
                    'description' => '',
                    'condition' => [
                        'type' => ['default', 'modern', 'callouts', 'light', 'list', 'iconed', 'tabs', 'tabs_simple']
                    ],
                )
            );
            $element->update_responsive_control(
                'columns', array(
                    'condition' => [
                        'type' => ['default', 'panel', 'alter', 'extra', 'price', 'price2', 'modern', 'breezy', 'cool', 'creative', 'shine', 'motley', 'classic', 'fashion', 'backward', 'accent', 'strange', 'unusual', 'strong', 'minimal', 'callouts', 'light', 'list', 'iconed', 'hover', 'chess']
                    ],
                )
            );

        }

        if ('trx_sc_services' == $el_name && $section_id == 'section_slider_params') {
            $element->update_control(
                'slider', array(
                    'condition' => [
                        'type' => ['default', 'alter', 'extra', 'price', 'price2', 'modern', 'breezy', 'cool', 'creative', 'shine', 'motley', 'classic', 'fashion', 'backward', 'accent', 'strange', 'unusual', 'strong', 'minimal', 'callouts', 'light', 'list', 'iconed', 'hover', 'chess']
                    ],
                )
            );
        }
        if ('trx_sc_services' == $el_name && $section_id == 'section_sc_services_details') {
            $element->update_control(
                'more_text', array(
                    'condition' => [
                        'type' => ['default', 'panel', 'alter', 'extra', 'price', 'price2', 'modern', 'shine', 'motley', 'classic', 'backward', 'accent', 'strange', 'unusual', 'cool', 'strong', 'minimal', 'chess', 'callouts', 'light', 'list', 'iconed', 'tabs', 'tabs_simple', 'timeline']
                    ],
                )
            );
            $element->update_control(
                'hide_bg_image', array(
                    'description' => '',
                    'condition' => [
                        'type' => ['shine', 'motley', 'breezy', 'cool', 'creative', 'hover', 'classic', 'fashion', 'extra', 'strong', 'minimal']
                    ],
                )
            );
        }
        /* Add control for filter blogger */
        if ( 'trx_sc_blogger' == $el_name  && 'section_sc_blogger' === $section_id ) {
            $element->add_control(
                'filter_style', array(
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'label' => esc_html__( "Filter style", 'snowy' ),
                    'label_block' => false,
                    'options' => array(
                        'default' => esc_html__('Default', 'snowy'),
                        'toggle' => esc_html__('Toggle', 'snowy'),
                    ),
                    'default' => 'default',
                    'prefix_class' => 'sc_style_',
                    'condition' => ['filters_tabs_position' => 'top'],
                )
            );
        }

        if ('trx_sc_layouts' == $el_name && $section_id == 'section_sc_layouts') {
            $element->update_control(
                'popup_id', array(
                    'condition' => array(
                        'type' => array('popup', 'panel', 'panel-menu')
                    )
                )
            );

            $element->add_control(
                'panel_menu_style', array(
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'label' => esc_html__( 'Select panel menu style', 'snowy' ),
                    'label_block' => false,
                    'options' => array(
                        'fullscreen' => esc_html__('Fullscreen', 'snowy'),
                        'narrow' => esc_html__('Narrow', 'snowy'),
                    ),
                    'default' => 'fullscreen',
                    'condition' => array(
                         'type' => array('panel-menu')
                    )
                )
            );
            $element->add_control(
                'vertical_menu_style', array(
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'label' => esc_html__( 'Select vertical menu style', 'snowy' ),
                    'description' => esc_html__( 'If the vertical menu(dropdown) in the "Panel menu" is used, then some styles are applied to it', 'snowy' ),
                    'label_block' => false,
                    'options' => array(
                        'default' => esc_html__('Default', 'snowy'),
                        'extra' => esc_html__('Extra', 'snowy'),
                    ),
                    'default' => 'default',
                    'condition' => array(
                        'type' => array('panel-menu')
                    )
                )
            );
        }
        //Search controls & dependencies
        if ('trx_sc_layouts_search' == $element->get_name() && 'section_sc_layouts_search' == $section_id) {

            $element->update_control(
                'style',
                [
                    'condition' => [
                        'type' => ['default'],
                    ]
                ]
            );

            $element->add_control(
                'logo_search', array(
                    'label' => esc_html__( 'Logo', 'snowy' ),
                    'description' => esc_html__( "Select or upload image for site's logo. If empty - theme-specific logo is used", 'snowy'),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                    'default' => array(
                        'url' => ''
                    ),
                    'condition' => array(
                        'type' => array('modern')
                    )
                )
            );

            $element->add_control(
                'logo_search_retina', array(
                    'label' => esc_html__( 'Logo Retina', 'snowy' ),
                    'description' => esc_html__( "Select or upload image for site's logo on the Retina displays", 'snowy'),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                    'default' => array(
                        'url' => ''
                    ),
                    'condition' => array(
                        'type' => array('modern')
                    )
                )
            );

            $element->add_control(
                'scheme_search', array(
                    'type'         => \Elementor\Controls_Manager::SELECT,
                    'label'        => esc_html__( 'Search Color scheme', 'snowy' ),
                    'label_block'  => false,
                    'options'      => snowy_array_merge( array( '' => esc_html__( 'Inherit', 'snowy' ) ), snowy_get_list_schemes() ),
                    'render_type'  => 'template',	// ( none | ui | template ) - reload template after parameter is changed
                    'default'      => '',
                    'condition' => array(
                        'type' => array('modern')
                    )
                )
            );


        }

		/* categories list */
		if ('trx_widget_categories_list' == $el_name && $section_id == 'section_sc_categories_list') {
			$element->update_control(
				'show_thumbs', array(
					'condition' => [
						'style' => [1, '1', '2', '3']
					],
				)
			);
			$element->update_control(
				'columns', array(
					'condition' => [
						'style' => [1, '1', '2', '3', '4', '5', '6']
					],
				)
			);
		}

        /* Portfolio Fill Hide Columns */
        if ('trx_sc_portfolio' == $el_name && $section_id == 'section_sc_portfolio') {
            $element->update_control(
                'columns', array(
                    'condition' => [
                        'type' => ['default', 'eclipse', 'band', 'extra']
                    ],
                )
            );
            $element->update_control(
                'more_text', array(
                    'condition' => [
                        'type' => ['band']
                    ],
                )
            );
        }
        /* Hide style 'List' in Trx Booked Calendar layout */
        if ('trx_sc_booked_calendar' == $el_name && $section_id == 'section_sc_booked') {
            $element->update_control(
                'style', array(
                    'options' => [
                        'calendar' => esc_html__('Calendar', 'snowy'),
                    ],
                )
            );
        }

        /* Columns gap dependencies */
        if ('trx_widget_instagram' == $el_name && $section_id == 'section_sc_instagram') {
            $element->update_control(
                'columns_gap', array(
                    'condition' => [
                        'type' => ['default', 'simple']
                    ],
                )
            );
        }
        /*
        if ('trx_widget_slider' == $el_name && $section_id == 'section_sc_slider_controller' ) {
            $element->update_control(
                'controller_height', array(
                    'label' => wp_kses_data( __('Min. height of the TOC', 'snowy') ),
                )
            );
        }
        if ('trx_widget_slider' == $el_name && $section_id == 'section_sc_slider_controller' ) {
            $element->update_control(
                'controller_effect', array(
                    'description' => wp_kses_data( __('Please note: some effects might be incompatible with multiple items per view.', 'snowy') ),
                )
            );
        }
        if ('trx_widget_controller' == $el_name && $section_id == 'section_sc_slider_controller' ) {
            $element->update_control(
                'effect', array(
                    'description' => wp_kses_data( __('Please note: some effects might be incompatible with multiple items per view.', 'snowy') ),
                )
            );
        }
        */
  	}
}

// Substitute tab content with layout
if (!function_exists('snowy_elm_add_params_class_new_set')) {
	add_filter( 'elementor/widget/render_content', 'snowy_elm_add_params_class_new_set', 10, 2 );
	function snowy_elm_add_params_class_new_set($html, $element) {
		if ( is_object($element) ) {
			$el_name = $element->get_name();
			$settings = $element->get_settings();
			if ( $el_name == 'trx_sc_button' ) {
				if ( is_array( $settings['buttons'] ) ) {
					foreach( $settings['buttons'] as $k => $tab ) {
						if ( ! empty( $tab['shadow'] ) && ($tab['type'] == 'default' || $tab['type'] == 'decoration' || $tab['type'] == 'hover') ) {
							$parts = explode( 'class="sc_button ', $html );
							$parts[ $k + 1 ] = 'sc_button_shadow ' . $parts[ $k + 1 ];
							$html = join( 'class="sc_button ', $parts );
						}
					}
				}
			}

			if ( $el_name == 'trx_sc_price' ) {
				if ( is_array( $settings['prices'] ) ) {
					foreach( $settings['prices'] as $k => $tab ) {
						if ( ! empty( $tab['price_active'] ) ) {
							$parts = explode( 'class="sc_price_item ', $html );
							$parts[ $k + 1 ] = 'sc_price_active ' . $parts[ $k + 1 ];
							$html = join( 'class="sc_price_item ', $parts );
						}
					}
				}
			}

			$settings = $element->get_settings();
			if ( ! empty( $settings['sc_button_shadow'] ) ) {
				$html = preg_replace('/(class="sc_button sc_button_)(default|hover|decoration) /', '$1$2 sc_button_shadow ', $html);
			}

		}
		return $html;
	}
}
// Enqueue script tilt for some Shortcodes
if ( ! function_exists( 'snowy_skin_filter_trx_addons_sc_output' ) ) {
    add_filter('trx_addons_sc_output', 'snowy_skin_filter_trx_addons_sc_output', 10, 4);
    function snowy_skin_filter_trx_addons_sc_output($output, $sc, $atts, $content)   {
        if (
        	( 'trx_sc_services' == $sc && ( 'hover' == $atts['type'] || 'creative' == $atts['type'] ) )
		  	|| ( 'trx_sc_team' == $sc && ( '3d' == $atts['type'] || '3d-simple' == $atts['type'] ) )
		) {
            wp_enqueue_script('tilt', snowy_get_file_url('js/tilt/vanilla-tilt.min.js'), array('jquery'), null, true);
        }
        // Change Output Panel Menu
        if  ( 'trx_sc_layouts' == $sc && 'panel-menu' == $atts['type'] ) {
            trx_addons_add_inline_html($output);
            return '';
        }

        return $output;
    }
}

// Add parameter to the list controls styles
if ( ! function_exists( 'snowy_skin_filter_get_list_sc_slider_controls_styles' ) ) {
	add_filter( 'trx_addons_filter_get_list_sc_slider_controls_styles', 'snowy_skin_filter_get_list_sc_slider_controls_styles', 10, 2 );
	function snowy_skin_filter_get_list_sc_slider_controls_styles( $list ) {
		$list['light'] = esc_html__( 'Light', 'snowy' );
		$list['alter'] = esc_html__( 'Alter', 'snowy' );
		return $list;
	}
}
// Add parameter to the list controls styles
if ( ! function_exists( 'snowy_skin_filter_get_list_sc_slider_paginations_types' ) ) {
	//add_filter( 'trx_addons_filter_get_list_sc_slider_paginations_types', 'snowy_skin_filter_get_list_sc_slider_paginations_types', 10 );
	add_filter( 'trx_addons_filter_get_list_sc_slider_controls_paginations_types', 'snowy_skin_filter_get_list_sc_slider_paginations_types', 10 );
	function snowy_skin_filter_get_list_sc_slider_paginations_types( $list ) {
		$list['title'] = esc_html__( 'Title', 'snowy' );
		return $list;
	}
}


// Add parameter to the list layouts type
if ( ! function_exists( 'snowy_skin_filter_get_list_sc_layouts_type' ) ) {
    add_filter( 'trx_addons_filter_get_list_sc_layouts_type', 'snowy_skin_filter_get_list_sc_layouts_type', 10, 2 );
    function snowy_skin_filter_get_list_sc_layouts_type( $list ) {
        $list['panel-menu'] = esc_html__( 'Panel Menu', 'snowy' );
        return $list;
    }
}

// Add parameter to the list Extend background
if ( ! function_exists( 'snowy_skin_filter_get_list_sc_content_extra_bg' ) ) {
	add_filter( 'trx_addons_filter_get_list_sc_content_extra_bg', 'snowy_skin_filter_get_list_sc_content_extra_bg', 10, 2 );
	function snowy_skin_filter_get_list_sc_content_extra_bg( $list ) {
		$list['large_left'] = esc_html__( 'Large Left', 'snowy' );
		$list['extra_left'] = esc_html__( 'Extra Left', 'snowy' );
		$list['large_right'] = esc_html__( 'Large Right', 'snowy' );
		return $list;
	}
}
// Remove 'Bottom' item from list Services
if ( ! function_exists( 'snowy_skin_filter_get_list_sc_services_featured_positions' ) ) {
    add_filter( 'trx_addons_filter_get_list_sc_services_featured_positions', 'snowy_skin_filter_get_list_sc_services_featured_positions', 10, 2 );
    function snowy_skin_filter_get_list_sc_services_featured_positions( $list ) {
        unset( $list['bottom'] );
        return $list;
    }
}

// Show post link 'Read more' in the blog posts
if ( ! function_exists( 'snowy_show_post_more_link' ) ) {
	function snowy_show_post_more_link( $args = array(), $otag='', $ctag='' ) {
		if ( ! isset( $args['more_button'] ) || $args['more_button'] ) {
			snowy_show_layout(
				'<a class="post-more-link" href="' . esc_url( get_permalink() ) . '"><span class="link-text">'
				. ( ! empty( $args['more_text'] )
					? esc_html( $args['more_text'] )
					: esc_html__( 'Read More', 'snowy' )
				)
				. '</span><span class="more-link-icon"></span></a>',
				$otag,
				$ctag
			);
		}
	}
}


if (!function_exists('snowy_elm_add_script')) {
	add_filter( 'elementor/frontend/widget/before_render', 'snowy_elm_add_script', 10, 2 );
	function snowy_elm_add_script($content, $widget=null) {
			$setting_class = $content->get_settings('_css_classes');
			$cheack = strpos($setting_class, 'VanillaTiltHover');    
			if(isset($cheack) && $cheack !== false) {
				wp_enqueue_script('tilt', snowy_get_file_url('js/tilt/vanilla-tilt.min.js'), array('jquery'), null, true);
			}
		return $content;
	}
}


// Add default prefix in Blogger toggle filter
if (!function_exists('snowy_localize_scripts_skin')) {
    add_filter( 'snowy_filter_localize_script', 'snowy_localize_scripts_skin', 2 );
    function snowy_localize_scripts_skin($arg) {
        $arg['toggle_title'] = esc_html__( "Filter by ", 'snowy' );
        return $arg;
    }
}


// Add cat_sep in meta single
if (!function_exists('snowy_filter_post_meta_args_single')) {
	add_filter( 'snowy_filter_post_meta_args', 'snowy_filter_post_meta_args_single', 2, 2 );
	function snowy_filter_post_meta_args_single($arg, $type) {
		if('single' == $type)
			$arg['cat_sep'] = false;
		return $arg;
	}
}


// cpt_team -> wrap contact form fns info des
if ( !function_exists( 'snowy_cpt_team_contact_form_after_article_before' ) ) {
	add_action('trx_addons_action_after_article', 'snowy_cpt_team_contact_form_after_article_before', 49, 2);
	function snowy_cpt_team_contact_form_after_article_before( $mode, $out='' ) {
		if ($mode == 'team.single') {
			$class = "comments_close";
			if ( comments_open() || get_comments_number() ) {
				$class = "comments_open";
			}
			snowy_show_layout('<section class="team_page_wrap_info '.esc_attr($class).'"><div class="team_page_wrap_info_over">'.$out);
		}
	}
}
if ( !function_exists( 'snowy_cpt_team_contact_form_after_article_after' ) ) {
	add_action('trx_addons_action_after_article', 'snowy_cpt_team_contact_form_after_article_after', 51, 1);
	function snowy_cpt_team_contact_form_after_article_after( $mode ) {
		if ($mode == 'team.single') {
			echo '</div></section>';
		}
	}
}
if ( !function_exists( 'snowy_cpt_team_contact_form_posts_title' ) ) {
	add_filter('trx_addons_filter_team_posts_title', 'snowy_cpt_team_contact_form_posts_title');
	function snowy_cpt_team_contact_form_posts_title() {
		return esc_html__( "Contact Form", 'snowy' );
	}
}

// Return tag SVG from specified file
if (!function_exists('snowy_get_svg_from_file')) {
	function snowy_get_svg_from_file($svg) {
		$content = snowy_fgc($svg);
		preg_match("#<\s*?svg\b[^>]*>(.*?)</svg\b[^>]*>#s", $content, $matches);
		return !empty($matches[0]) ? str_replace(array("\r", "\n"), array('', ' '), $matches[0]) : '';
	}
}

// Modified Scroll To Top
if (!function_exists('snowy_skin_filter_scroll_to_top')) {
    add_filter('trx_addons_filter_scroll_to_top', 'snowy_skin_filter_scroll_to_top');
    function snowy_skin_filter_scroll_to_top( $output ) {
        if ( snowy_get_theme_option( 'scroll_to_top_style') == 'modern' )  {
            $output = '<a href="#" class="trx_addons_scroll_to_top scroll_to_top_style_' . esc_attr(snowy_get_theme_option( 'scroll_to_top_style')) . esc_attr(snowy_is_on(snowy_get_theme_option('scroll_to_top_scheme_watchers')) ? ' watch_scheme' : '') . '" title="' . esc_attr__('Scroll to top', 'snowy') . '">'
                      . '<span class="scroll_to_top_text">' . esc_html__('Go to Top', 'snowy') . '</span>'
                      . '<span class="scroll_to_top_icon"></span>'
                      . '</a>';

        } else {
            $output = '<a href="#" class="trx_addons_scroll_to_top trx_addons_icon-up scroll_to_top_style_' . esc_attr(snowy_get_theme_option( 'scroll_to_top_style')) . '" title="' . esc_attr__('Scroll to top', 'snowy') . '">'
                      . ( ! empty( $type )
                          ? '<span class="trx_addons_scroll_progress trx_addons_scroll_progress_type_' . esc_attr( $type ) . '"></span>'
                          : ''
                        )
                      . '</a>';
        }
        return $output;
    }
}

// Add sticky socials
if ( !function_exists( 'snowy_skin_wp_footer' ) ) {
    add_action('wp_footer', 'snowy_skin_wp_footer');
    function snowy_skin_wp_footer() {

        if (( snowy_exists_trx_addons() && trx_addons_get_socials_links() != '') && snowy_is_on( snowy_get_theme_option( 'sticky_socials' ) ) ) {

            $wrap_start = '<div class="sticky_socials_wrap sticky_socials_' . esc_attr( snowy_get_theme_option( 'sticky_socials_style' ) ) . esc_attr( snowy_is_on( snowy_get_theme_option( 'sticky_socials_scheme_watchers' ) ) ? ' watch_scheme' : '') . '">';
            $wrap_end   = '</div>';

            if ( snowy_get_theme_option( 'sticky_socials_style' ) == 'modern' ) {
                // Social icons
                snowy_show_layout(trx_addons_get_socials_links($style = 'icons', $show = 'icons_names'),
                    $wrap_start, $wrap_end);
            } else {
                snowy_show_layout(trx_addons_get_socials_links($style = 'icons', $show = 'icons'),
                    $wrap_start, $wrap_end);
            }
        }
    }
}


// Detect blog mode 404
if (!function_exists('snowy_filter_detect_blog_mode_404')) {
	add_filter( 'snowy_filter_detect_blog_mode', 'snowy_filter_detect_blog_mode_404' );
	function snowy_filter_detect_blog_mode_404($mode) {
		return is_404() ? '404' : $mode;
	}
}

// TweenMax library for 404
if (!function_exists('trx_addons_filter_load_tweenmax_404')) {
	add_filter('trx_addons_filter_load_tweenmax', 'trx_addons_filter_load_tweenmax_404');
	function trx_addons_filter_load_tweenmax_404($status) {
		return is_404() ? true : $status;
	}
}
// Add single portfolio navigation
if ( !function_exists( 'snowy_single_portfolio_navigation' ) ) {
    add_filter('trx_addons_action_after_article', 'snowy_single_portfolio_navigation');
    function snowy_single_portfolio_navigation( $args ) {
        if( snowy_get_theme_option( 'cpt_navigation_portfolio' ) && 'portfolio.single' == $args ) {
            $post_nav = get_the_post_navigation( array(
                'next_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__('Next Project', 'snowy') . '</span> ',
                'prev_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__('Prev Project', 'snowy') . '</span> ',
            ) );
            snowy_show_layout($post_nav);
        }
    }
}
// Display begin of the slider layout for some shortcodes
if (!function_exists('snowy_skin_filter_sc_show_slider_args')) {
    add_filter( 'trx_addons_filter_sc_show_slider_args', 'snowy_skin_filter_sc_show_slider_args' );
    function snowy_skin_filter_sc_show_slider_args( $args = array() ) {
        if ('sc_events' == $args['sc']) {
            $args['args']['slides_min_width'] = 220;
        }
        if ('sc_portfolio' == $args['sc']) {
            $args['args']['slides_min_width'] = 220;
        }
        return  $args;
    }
}

// Remove input hover effects
if ( !function_exists( 'snowy_skin_filter_get_list_input_hover' ) ) {
    add_filter( 'trx_addons_filter_get_list_input_hover', 'snowy_skin_filter_get_list_input_hover');
    function snowy_skin_filter_get_list_input_hover($list) {
        unset($list['accent']);
        unset($list['path']);
        unset($list['jump']);
        unset($list['underline']);
        unset($list['iconed']);
        return $list;
    }
}

// Add new image's hovers
if ( ! function_exists( 'snowy_skin_filter_get_list_hovers' ) ) {
	add_filter(	'snowy_filter_list_hovers', 'snowy_skin_filter_get_list_hovers' );
	function snowy_skin_filter_get_list_hovers( $list ) {
		$list['link'] = esc_html__( 'Link', 'snowy' );
		return $list;
	}
}

// New Functions
//--------------------------------------------------
if ( ! function_exists( 'snowy_skin_theme_specific_setup9' ) ) {
    add_action( 'after_setup_theme', 'snowy_skin_theme_specific_setup9', 9 );
    function snowy_skin_theme_specific_setup9() {
        if ( snowy_exists_trx_addons() ) {
            remove_action( 'trx_addons_action_before_single_post_video', 'trx_addons_cpt_post_before_video_sticky' );
        }
    }
}
// Open wrapper around single post video
if (!function_exists('snowy_skin_trx_addons_cpt_post_before_video_sticky')) {
    add_action( 'trx_addons_action_before_single_post_video', 'snowy_skin_trx_addons_cpt_post_before_video_sticky', 10, 1 );
    function snowy_skin_trx_addons_cpt_post_before_video_sticky( $args = array() ) {
        if ( ! empty( $args['singular'] ) || ! empty( $args['singular_extra'] ) ) {
            $post_meta = get_post_meta( get_the_ID(), 'trx_addons_options', true );
            if ( ! empty( $post_meta['video_sticky'] ) ) {
                ?>
                <div class="trx_addons_video_sticky">
                <div class="trx_addons_video_sticky_inner">
                <h5 class="trx_addons_video_sticky_title">
                    <?php echo esc_html(get_the_title(get_the_ID())); ?></h5>
                <?php
                $GLOBALS['TRX_ADDONS_STORAGE']['video_sticky_opened'] = true;
            }
        }
    }
}

// Display prices with tags in ALL places
if ( false && ! function_exists( 'snowy_skin_trx_addons_filter_custom_meta_value_strip_tags_new' ) ) {
    add_filter( 'trx_addons_filter_custom_meta_value_strip_tags', 'snowy_skin_trx_addons_filter_custom_meta_value_strip_tags_new', 11, 3 );
    function snowy_skin_trx_addons_filter_custom_meta_value_strip_tags_new( $arr, $key, $value ) {
		foreach ($arr as $k => $v) 
    		if ($v === 'price') unset($arr[$k]);
        return $arr;
    }
}

// Change "load more" button text 
if ( ! function_exists( 'snowy_skin_load_more_text_new' ) ) {
    add_filter( 'snowy_filter_load_more_text', 'snowy_skin_load_more_text_new' );
    function snowy_skin_load_more_text_new() {
		$text = esc_html__('Load More', 'snowy');
        return $text;
    }
}

// Change option 'Not selected' for all tag select
if ( ! function_exists( 'snowy_skin_not_selected_mask' ) ) {
    add_filter( 'trx_addons_filter_not_selected_mask', 'snowy_skin_not_selected_mask' );
    function snowy_skin_not_selected_mask() {
        return __( '%s', 'snowy' );
    }
}

// Activation methods
if ( ! function_exists( 'snowy_skin_filter_activation_methods' ) ) {
    add_filter( 'trx_addons_filter_activation_methods', 'snowy_skin_filter_activation_methods', 10, 1 );
    function snowy_skin_filter_activation_methods( $args ) {
        $args['elements_key'] = false;
        return $args;
    }
}