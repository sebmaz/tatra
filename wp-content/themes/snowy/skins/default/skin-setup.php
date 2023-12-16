<?php
/**
 * Skin Setup
 *
 * @package SNOWY
 * @since SNOWY 1.76.0
 */


//--------------------------------------------
// SKIN DEFAULTS
//--------------------------------------------

// Return theme's (skin's) default value for the specified parameter
if ( ! function_exists( 'snowy_theme_defaults' ) ) {
	function snowy_theme_defaults( $name='', $value='' ) {
		$defaults = array(
			'page_width'          => 1290,
			'page_boxed_extra'  => 60,
			'page_fullwide_max' => 1920,
			'page_fullwide_extra' => 130,
			'sidebar_width'       => 410,
			'sidebar_gap'       => 40,
			'grid_gap'          => 30,
			'rad'               => 0,
		);
		if ( empty( $name ) ) {
			return $defaults;
		} else {
			if ( empty( $value ) && isset( $defaults[ $name ] ) ) {
				$value = $defaults[ $name ];
			}
			return $value;
		}
	}
}



// Theme init priorities:
// Action 'after_setup_theme'
// 1 - register filters to add/remove lists items in the Theme Options
// 2 - create Theme Options
// 3 - add/remove Theme Options elements
// 5 - load Theme Options. Attention! After this step you can use only basic options (not overriden)
// 9 - register other filters (for installer, etc.)
//10 - standard Theme init procedures (not ordered)
// Action 'wp_loaded'
// 1 - detect override mode. Attention! Only after this step you can use overriden options (separate values for the shop, courses, etc.)


//--------------------------------------------
// SKIN SETTINGS
//--------------------------------------------
if ( ! function_exists( 'snowy_skin_setup' ) ) {
	add_action( 'after_setup_theme', 'snowy_skin_setup', 1 );
	function snowy_skin_setup() {

		$GLOBALS['SNOWY_STORAGE'] = array_merge( $GLOBALS['SNOWY_STORAGE'], array(

			// Key validator: market[env|loc]-vendor[axiom|ancora|themerex]
			'theme_pro_key'       => 'env-themerex',

			'theme_doc_url'       => '//snowy.themerex.net/doc',

			'theme_demofiles_url' => '//demofiles.themerex.net/snowy/',
			
			'theme_rate_url'      => '//themeforest.net/download',

			'theme_custom_url'    => '//themerex.net/offers/?utm_source=offers&utm_medium=click&utm_campaign=themeinstall',

			'theme_support_url'   => '//themerex.net/support/',

			'theme_download_url'  => '//themeforest.net/item/snowy-ski-resort-snowboarding-wordpress-theme/45919272',        // themerex

			'theme_video_url'     => '//www.youtube.com/channel/UCdIjRh7-lPVHqTTKpaf8PLA',   // themerex

			'theme_privacy_url'   => '//themerex.net/privacy-policy/',                   // themerex

			'portfolio_url'       => '//themeforest.net/user/themerex/portfolio',        // themerex

			// Comma separated slugs of theme-specific categories (for get relevant news in the dashboard widget)
			// (i.e. 'children,kindergarten')
			'theme_categories'    => '',
		) );
	}
}


// Add/remove/change Theme Settings
if ( ! function_exists( 'snowy_skin_setup_settings' ) ) {
	add_action( 'after_setup_theme', 'snowy_skin_setup_settings', 1 );
	function snowy_skin_setup_settings() {
		// Example: enable (true) / disable (false) thumbs in the prev/next navigation
		snowy_storage_set_array( 'settings', 'thumbs_in_navigation', false );

		snowy_storage_set_array2( 'required_plugins', 'booked', 'install', true);
		snowy_storage_set_array2( 'required_plugins', 'instagram-feed', 'install', true);
		snowy_storage_set_array2( 'required_plugins', 'the-events-calendar', 'install', true);
	}
}



//--------------------------------------------
// SKIN FONTS
//--------------------------------------------
if ( ! function_exists( 'snowy_skin_setup_fonts' ) ) {
	add_action( 'after_setup_theme', 'snowy_skin_setup_fonts', 1 );
	function snowy_skin_setup_fonts() {
		// Fonts to load when theme start
		// It can be:
		// - Google fonts (specify name, family and styles)
		// - Adobe fonts (specify name, family and link URL)
		// - uploaded fonts (specify name, family), placed in the folder css/font-face/font-name inside the skin folder
		// Attention! Font's folder must have name equal to the font's name, with spaces replaced on the dash '-'
		// example: font name 'TeX Gyre Termes', folder 'TeX-Gyre-Termes'
		snowy_storage_set(
			'load_fonts', array(
				array(
					'name'   => 'DM Sans',
					'family' => 'sans-serif',
					'link'   => '',
					'styles' => 'ital,wght@0,400;0,500;0,700;1,400;1,500;1,700'
				),
				array(
					'name'   => 'termina',
					'family' => 'sans-serif',
					'link'   => 'https://use.typekit.net/zau2ogq.css',
					'styles' => ''
				),
			)
		);

		// Characters subset for the Google fonts. Available values are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese
		snowy_storage_set( 'load_fonts_subset', 'latin,latin-ext' );

		// Settings of the main tags.
		// Default value of 'font-family' may be specified as reference to the array $load_fonts (see above)
		// or as comma-separated string.
		// In the second case (if 'font-family' is specified manually as comma-separated string):
		//    1) Font name with spaces in the parameter 'font-family' will be enclosed in the quotes and no spaces after comma!
		//    2) If font-family inherit a value from the 'Main text' - specify 'inherit' as a value
		// example:
		// Correct:   'font-family' => basekit_get_load_fonts_family_string( $load_fonts[0] )
		// Correct:   'font-family' => 'Roboto,sans-serif'
		// Correct:   'font-family' => '"PT Serif",sans-serif'
		// Incorrect: 'font-family' => 'Roboto, sans-serif'
		// Incorrect: 'font-family' => 'PT Serif,sans-serif'

		$font_description = esc_html__( 'Font settings for the %s of the site. To ensure that the elements scale properly on mobile devices, please use only the following units: "rem", "em" or "ex"', 'snowy' );

		snowy_storage_set(
			'theme_fonts', array(
				'p'       => array(
					'title'           => esc_html__( 'Main text', 'snowy' ),
					'description'     => sprintf( $font_description, esc_html__( 'main text', 'snowy' ) ),
					'font-family'     => '"DM Sans",sans-serif',
					'font-size'       => '1rem',
					'font-weight'     => '400',
					'font-style'      => 'normal',
					'line-height'     => '1.647em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
					'margin-top'      => '0em',
					'margin-bottom'   => '1.65em',
				),
				'post'    => array(
					'title'           => esc_html__( 'Article text', 'snowy' ),
					'description'     => sprintf( $font_description, esc_html__( 'article text', 'snowy' ) ),
					'font-family'     => '',			// Example: '"PR Serif",serif',
					'font-size'       => '',			// Example: '1.286rem',
					'font-weight'     => '',			// Example: '400',
					'font-style'      => '',			// Example: 'normal',
					'line-height'     => '',			// Example: '1.75em',
					'text-decoration' => '',			// Example: 'none',
					'text-transform'  => '',			// Example: 'none',
					'letter-spacing'  => '',			// Example: '',
					'margin-top'      => '',			// Example: '0em',
					'margin-bottom'   => '',			// Example: '1.4em',
				),
				'h1'      => array(
					'title'           => esc_html__( 'Heading 1', 'snowy' ),
					'description'     => sprintf( $font_description, esc_html__( 'tag H1', 'snowy' ) ),
					'font-family'     => 'termina,sans-serif',
					'font-size'       => '3.353rem',
					'font-weight'     => '600',
					'font-style'      => 'normal',
					'line-height'     => '1em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => 'normal',
					'margin-top'      => '1.1em',
					'margin-bottom'   => '0.43em',
				),
				'h2'      => array(
					'title'           => esc_html__( 'Heading 2', 'snowy' ),
					'description'     => sprintf( $font_description, esc_html__( 'tag H2', 'snowy' ) ),
					'font-family'     => 'termina,sans-serif',
					'font-size'       => '2.765rem',
					'font-weight'     => '600',
					'font-style'      => 'normal',
					'line-height'     => '1.021em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => 'normal',
					'margin-top'      => '0.76em',
					'margin-bottom'   => '0.48em',
				),
				'h3'      => array(
					'title'           => esc_html__( 'Heading 3', 'snowy' ),
					'description'     => sprintf( $font_description, esc_html__( 'tag H3', 'snowy' ) ),
					'font-family'     => 'termina,sans-serif',
					'font-size'       => '2.059rem',
					'font-weight'     => '600',
					'font-style'      => 'normal',
					'line-height'     => '1.086em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => 'normal',
					'margin-top'      => '1.12em',
					'margin-bottom'   => '0.65em',
				),
				'h4'      => array(
					'title'           => esc_html__( 'Heading 4', 'snowy' ),
					'description'     => sprintf( $font_description, esc_html__( 'tag H4', 'snowy' ) ),
					'font-family'     => 'termina,sans-serif',
					'font-size'       => '1.647rem',
					'font-weight'     => '600',
					'font-style'      => 'normal',
					'line-height'     => '1.214em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => 'normal',
					'margin-top'      => '1.15em',
					'margin-bottom'   => '0.83em',
				),
				'h5'      => array(
					'title'           => esc_html__( 'Heading 5', 'snowy' ),
					'description'     => sprintf( $font_description, esc_html__( 'tag H5', 'snowy' ) ),
					'font-family'     => 'termina,sans-serif',
					'font-size'       => '1.412rem',
					'font-weight'     => '600',
					'font-style'      => 'normal',
					'line-height'     => '1.208em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => 'normal',
					'margin-top'      => '1.3em',
					'margin-bottom'   => '0.84em',
				),
				'h6'      => array(
					'title'           => esc_html__( 'Heading 6', 'snowy' ),
					'description'     => sprintf( $font_description, esc_html__( 'tag H6', 'snowy' ) ),
					'font-family'     => 'termina,sans-serif',
					'font-size'       => '1.118rem',
					'font-weight'     => '600',
					'font-style'      => 'normal',
					'line-height'     => '1.474em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => 'normal',
					'margin-top'      => '1.75em',
					'margin-bottom'   => '1.1em',
				),
				'logo'    => array(
					'title'           => esc_html__( 'Logo text', 'snowy' ),
					'description'     => sprintf( $font_description, esc_html__( 'text of the logo', 'snowy' ) ),
					'font-family'     => 'termina,sans-serif',
					'font-size'       => '1.7rem',
					'font-weight'     => '600',
					'font-style'      => 'normal',
					'line-height'     => '1.25em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
				),
				'button'  => array(
					'title'           => esc_html__( 'Buttons', 'snowy' ),
					'description'     => sprintf( $font_description, esc_html__( 'buttons', 'snowy' ) ),
					'font-family'     => 'termina,sans-serif',
					'font-size'       => '15px',
					'font-weight'     => '500',
					'font-style'      => 'normal',
					'line-height'     => '20px',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
				),
				'input'   => array(
					'title'           => esc_html__( 'Input fields', 'snowy' ),
					'description'     => sprintf( $font_description, esc_html__( 'input fields, dropdowns and textareas', 'snowy' ) ),
					'font-family'     => 'inherit',
					'font-size'       => '16px',
					'font-weight'     => '400',
					'font-style'      => 'normal',
					'line-height'     => '1.5em',     // Attention! Firefox don't allow line-height less then 1.5em in the select
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
				),
				'info'    => array(
					'title'           => esc_html__( 'Post meta', 'snowy' ),
					'description'     => sprintf( $font_description, esc_html__( 'post meta (author, categories, publish date, counters, share, etc.)', 'snowy' ) ),
					'font-family'     => 'inherit',
					'font-size'       => '14px',  // Old value '13px' don't allow using 'font zoom' in the custom blog items
					'font-weight'     => '400',
					'font-style'      => 'normal',
					'line-height'     => '1.5em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
					'margin-top'      => '0.4em',
					'margin-bottom'   => '',
				),
				'menu'    => array(
					'title'           => esc_html__( 'Main menu', 'snowy' ),
					'description'     => sprintf( $font_description, esc_html__( 'main menu items', 'snowy' ) ),
					'font-family'     => 'termina,sans-serif',
					'font-size'       => '14px',
					'font-weight'     => '600',
					'font-style'      => 'normal',
					'line-height'     => '1.5em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
				),
				'submenu' => array(
					'title'           => esc_html__( 'Dropdown menu', 'snowy' ),
					'description'     => sprintf( $font_description, esc_html__( 'dropdown menu items', 'snowy' ) ),
					'font-family'     => '"DM Sans",sans-serif',
					'font-size'       => '15px',
					'font-weight'     => '400',
					'font-style'      => 'normal',
					'line-height'     => '1.5em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
				),
				'other' => array(
					'title'           => esc_html__( 'Other', 'snowy' ),
					'description'     => sprintf( $font_description, esc_html__( 'specific elements', 'snowy' ) ),
					'font-family'     => '"DM Sans",sans-serif',
				),
			)
		);

		// Font presets
		snowy_storage_set(
			'font_presets', array(
				'karla' => array(
								'title'  => esc_html__( 'Karla', 'snowy' ),
								'load_fonts' => array(
													// Google font
													array(
														'name'   => 'Dancing Script',
														'family' => 'fantasy',
														'link'   => '',
														'styles' => '300,400,700',
													),
													// Google font
													array(
														'name'   => 'Sansita Swashed',
														'family' => 'fantasy',
														'link'   => '',
														'styles' => '300,400,700',
													),
												),
								'theme_fonts' => array(
													'p'       => array(
														'font-family'     => '"Dancing Script",fantasy',
														'font-size'       => '1.25rem',
													),
													'post'    => array(
														'font-family'     => '',
													),
													'h1'      => array(
														'font-family'     => '"Sansita Swashed",fantasy',
														'font-size'       => '4em',
													),
													'h2'      => array(
														'font-family'     => '"Sansita Swashed",fantasy',
													),
													'h3'      => array(
														'font-family'     => '"Sansita Swashed",fantasy',
													),
													'h4'      => array(
														'font-family'     => '"Sansita Swashed",fantasy',
													),
													'h5'      => array(
														'font-family'     => '"Sansita Swashed",fantasy',
													),
													'h6'      => array(
														'font-family'     => '"Sansita Swashed",fantasy',
													),
													'logo'    => array(
														'font-family'     => '"Sansita Swashed",fantasy',
													),
													'button'  => array(
														'font-family'     => '"Sansita Swashed",fantasy',
													),
													'input'   => array(
														'font-family'     => 'inherit',
													),
													'info'    => array(
														'font-family'     => 'inherit',
													),
													'menu'    => array(
														'font-family'     => '"Sansita Swashed",fantasy',
													),
													'submenu' => array(
														'font-family'     => '"Sansita Swashed",fantasy',
													),
												),
							),
				'roboto' => array(
								'title'  => esc_html__( 'Roboto', 'snowy' ),
								'load_fonts' => array(
													// Google font
													array(
														'name'   => 'Noto Sans JP',
														'family' => 'serif',
														'link'   => '',
														'styles' => '300,300italic,400,400italic,700,700italic',
													),
													// Google font
													array(
														'name'   => 'Merriweather',
														'family' => 'sans-serif',
														'link'   => '',
														'styles' => '300,300italic,400,400italic,700,700italic',
													),
												),
								'theme_fonts' => array(
													'p'       => array(
														'font-family'     => '"Noto Sans JP",serif',
													),
													'post'    => array(
														'font-family'     => '',
													),
													'h1'      => array(
														'font-family'     => 'Merriweather,sans-serif',
													),
													'h2'      => array(
														'font-family'     => 'Merriweather,sans-serif',
													),
													'h3'      => array(
														'font-family'     => 'Merriweather,sans-serif',
													),
													'h4'      => array(
														'font-family'     => 'Merriweather,sans-serif',
													),
													'h5'      => array(
														'font-family'     => 'Merriweather,sans-serif',
													),
													'h6'      => array(
														'font-family'     => 'Merriweather,sans-serif',
													),
													'logo'    => array(
														'font-family'     => 'Merriweather,sans-serif',
													),
													'button'  => array(
														'font-family'     => 'Merriweather,sans-serif',
													),
													'input'   => array(
														'font-family'     => 'inherit',
													),
													'info'    => array(
														'font-family'     => 'inherit',
													),
													'menu'    => array(
														'font-family'     => 'Merriweather,sans-serif',
													),
													'submenu' => array(
														'font-family'     => 'Merriweather,sans-serif',
													),
												),
							),
				'garamond' => array(
								'title'  => esc_html__( 'Garamond', 'snowy' ),
								'load_fonts' => array(
													// Adobe font
													array(
														'name'   => 'Europe',
														'family' => 'sans-serif',
														'link'   => 'https://use.typekit.net/qmj1tmx.css',
														'styles' => '',
													),
													// Adobe font
													array(
														'name'   => 'Sofia Pro',
														'family' => 'sans-serif',
														'link'   => 'https://use.typekit.net/qmj1tmx.css',
														'styles' => '',
													),
												),
								'theme_fonts' => array(
													'p'       => array(
														'font-family'     => '"Sofia Pro",sans-serif',
													),
													'post'    => array(
														'font-family'     => '',
													),
													'h1'      => array(
														'font-family'     => 'Europe,sans-serif',
													),
													'h2'      => array(
														'font-family'     => 'Europe,sans-serif',
													),
													'h3'      => array(
														'font-family'     => 'Europe,sans-serif',
													),
													'h4'      => array(
														'font-family'     => 'Europe,sans-serif',
													),
													'h5'      => array(
														'font-family'     => 'Europe,sans-serif',
													),
													'h6'      => array(
														'font-family'     => 'Europe,sans-serif',
													),
													'logo'    => array(
														'font-family'     => 'Europe,sans-serif',
													),
													'button'  => array(
														'font-family'     => 'Europe,sans-serif',
													),
													'input'   => array(
														'font-family'     => 'inherit',
													),
													'info'    => array(
														'font-family'     => 'inherit',
													),
													'menu'    => array(
														'font-family'     => 'Europe,sans-serif',
													),
													'submenu' => array(
														'font-family'     => 'Europe,sans-serif',
													),
												),
							),
			)
		);
	}
}


//--------------------------------------------
// COLOR SCHEMES
//--------------------------------------------
if ( ! function_exists( 'snowy_skin_setup_schemes' ) ) {
	add_action( 'after_setup_theme', 'snowy_skin_setup_schemes', 1 );
	function snowy_skin_setup_schemes() {

		// Theme colors for customizer
		// Attention! Inner scheme must be last in the array below
		snowy_storage_set(
			'scheme_color_groups', array(
				'main'    => array(
					'title'       => esc_html__( 'Main', 'snowy' ),
					'description' => esc_html__( 'Colors of the main content area', 'snowy' ),
				),
				'alter'   => array(
					'title'       => esc_html__( 'Alter', 'snowy' ),
					'description' => esc_html__( 'Colors of the alternative blocks (sidebars, etc.)', 'snowy' ),
				),
				'extra'   => array(
					'title'       => esc_html__( 'Extra', 'snowy' ),
					'description' => esc_html__( 'Colors of the extra blocks (dropdowns, price blocks, table headers, etc.)', 'snowy' ),
				),
				'inverse' => array(
					'title'       => esc_html__( 'Inverse', 'snowy' ),
					'description' => esc_html__( 'Colors of the inverse blocks - when link color used as background of the block (dropdowns, blockquotes, etc.)', 'snowy' ),
				),
				'input'   => array(
					'title'       => esc_html__( 'Input', 'snowy' ),
					'description' => esc_html__( 'Colors of the form fields (text field, textarea, select, etc.)', 'snowy' ),
				),
			)
		);

		snowy_storage_set(
			'scheme_color_names', array(
				'bg_color'    => array(
					'title'       => esc_html__( 'Background color', 'snowy' ),
					'description' => esc_html__( 'Background color of this block in the normal state', 'snowy' ),
				),
				'bg_hover'    => array(
					'title'       => esc_html__( 'Background hover', 'snowy' ),
					'description' => esc_html__( 'Background color of this block in the hovered state', 'snowy' ),
				),
				'bd_color'    => array(
					'title'       => esc_html__( 'Border color', 'snowy' ),
					'description' => esc_html__( 'Border color of this block in the normal state', 'snowy' ),
				),
				'bd_hover'    => array(
					'title'       => esc_html__( 'Border hover', 'snowy' ),
					'description' => esc_html__( 'Border color of this block in the hovered state', 'snowy' ),
				),
				'text'        => array(
					'title'       => esc_html__( 'Text', 'snowy' ),
					'description' => esc_html__( 'Color of the text inside this block', 'snowy' ),
				),
				'text_dark'   => array(
					'title'       => esc_html__( 'Text dark', 'snowy' ),
					'description' => esc_html__( 'Color of the dark text (bold, header, etc.) inside this block', 'snowy' ),
				),
				'text_light'  => array(
					'title'       => esc_html__( 'Text light', 'snowy' ),
					'description' => esc_html__( 'Color of the light text (post meta, etc.) inside this block', 'snowy' ),
				),
				'text_link'   => array(
					'title'       => esc_html__( 'Link', 'snowy' ),
					'description' => esc_html__( 'Color of the links inside this block', 'snowy' ),
				),
				'text_hover'  => array(
					'title'       => esc_html__( 'Link hover', 'snowy' ),
					'description' => esc_html__( 'Color of the hovered state of links inside this block', 'snowy' ),
				),
				'text_link2'  => array(
					'title'       => esc_html__( 'Accent 2', 'snowy' ),
					'description' => esc_html__( 'Color of the accented texts (areas) inside this block', 'snowy' ),
				),
				'text_hover2' => array(
					'title'       => esc_html__( 'Accent 2 hover', 'snowy' ),
					'description' => esc_html__( 'Color of the hovered state of accented texts (areas) inside this block', 'snowy' ),
				),
				'text_link3'  => array(
					'title'       => esc_html__( 'Accent 3', 'snowy' ),
					'description' => esc_html__( 'Color of the other accented texts (buttons) inside this block', 'snowy' ),
				),
				'text_hover3' => array(
					'title'       => esc_html__( 'Accent 3 hover', 'snowy' ),
					'description' => esc_html__( 'Color of the hovered state of other accented texts (buttons) inside this block', 'snowy' ),
				),
			)
		);

		// Default values for each color scheme
		$schemes = array(

			// Color scheme: 'default'
			'default' => array(
				'title'    => esc_html__( 'Default', 'snowy' ),
				'internal' => true,
				'colors'   => array(

					// Whole block border and background
					'bg_color'         => '#F4F8FA', // ok
					'bd_color'         => '#DCDCDC', // ok

					// Text and links colors
					'text'             => '#5F5F65', // ok
					'text_light'       => '#76797B', // ok
					'text_dark'        => '#181D4E', // ok
					'text_link'        => '#FD661E', // ok
					'text_hover'       => '#E65915', // ok
					'text_link2'       => '#661EFD', // ok
					'text_hover2'      => '#4809CC', // ok
					'text_link3'       => '#053755', // ok
					'text_hover3'      => '#001F31', // ok

					// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
					'alter_bg_color'   => '#ffffff', //
					'alter_bg_hover'   => '#F9F9F9', //
					'alter_bd_color'   => '#DCDCDC', // ok
					'alter_bd_hover'   => '#BEBCB5', //
					'alter_text'       => '#5F5F65', //
					'alter_light'      => '#76797B', // ok
					'alter_dark'       => '#181D4E', // ok
					'alter_link'       => '#FD661E', // ok
					'alter_hover'      => '#E65915', //
					'alter_link2'      => '#661EFD', // ok
					'alter_hover2'     => '#4809CC', // ok
					'alter_link3'      => '#053755', // ok
					'alter_hover3'     => '#001F31', // ok

					// Extra blocks (submenu, tabs, color blocks, etc.)
					'extra_bg_color'   => '#181D4E', // ok
					'extra_bg_hover'   => '#3f3d47',
					'extra_bd_color'   => '#313131',
					'extra_bd_hover'   => '#575757',
					'extra_text'       => '#B5B6C5', // ok
					'extra_light'      => '#afafaf',
					'extra_dark'       => '#ffffff', //
					'extra_link'       => '#FD661E', // ok
					'extra_hover'      => '#ffffff', //
					'extra_link2'      => '#80d572',
					'extra_hover2'     => '#8be77c',
					'extra_link3'      => '#ddb837',
					'extra_hover3'     => '#eec432',

					// Input fields (form's fields and textarea)
					'input_bg_color'   => 'transparent', //
					'input_bg_hover'   => 'transparent', //
					'input_bd_color'   => '#DCDCDC', // ok
					'input_bd_hover'   => '#181D4E', // ok
					'input_text'       => '#76797B', // ok
					'input_light'      => '#76797B', // ok
					'input_dark'       => '#181D4E', // ok

					// Inverse blocks (text and links on the 'text_link' background)
					'inverse_bd_color' => '#67bcc1',
					'inverse_bd_hover' => '#5aa4a9',
					'inverse_text'     => '#1d1d1d',
					'inverse_light'    => '#333333',
					'inverse_dark'     => '#0B0D26', // ok
					'inverse_link'     => '#ffffff', //
					'inverse_hover'    => '#ffffff', //

					// Additional (skin-specific) colors.
					// Attention! Set of colors must be equal in all color schemes.
					//---> For example:
					//---> 'new_color1'         => '#rrggbb',
					//---> 'alter_new_color1'   => '#rrggbb',
					//---> 'inverse_new_color1' => '#rrggbb',
				),
			),

			// Color scheme: 'dark'
			'dark'    => array(
				'title'    => esc_html__( 'Dark', 'snowy' ),
				'internal' => true,
				'colors'   => array(

					// Whole block border and background
					'bg_color'         => '#171C4B', // ok
					'bd_color'         => '#DCDCDC', // ok

					// Text and links colors
					'text'             => '#B5B6C5', // ok
					'text_light'       => '#D6D6D6', // ok
					'text_dark'        => '#F8F8F8', // ok
					'text_link'        => '#FD661E', // ok
					'text_hover'       => '#E65915', // ok
					'text_link2'       => '#661EFD', // ok
					'text_hover2'      => '#4809CC', // ok
					'text_link3'       => '#053755', // ok
					'text_hover3'      => '#001F31', // ok

					// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
					'alter_bg_color'   => '#141841', // ok
					'alter_bg_hover'   => '#0D102B', //
					'alter_bd_color'   => '#DCDCDC', // ok
					'alter_bd_hover'   => '#53535C', // 
					'alter_text'       => '#B5B6C5', // ok
					'alter_light'      => '#D6D6D6', // ok
					'alter_dark'       => '#F8F8F8', // ok
					'alter_link'       => '#FD661E', // ok
					'alter_hover'      => '#E65915', // ok
					'alter_link2'      => '#661EFD', // ok
					'alter_hover2'     => '#4809CC', // ok
					'alter_link3'      => '#053755', // ok
					'alter_hover3'     => '#001F31', // ok

					// Extra blocks (submenu, tabs, color blocks, etc.)
					'extra_bg_color'   => '#04050D', // ok
					'extra_bg_hover'   => '#3f3d47',
					'extra_bd_color'   => '#313131',
					'extra_bd_hover'   => '#575757',
					'extra_text'       => '#B5B6C5', //ok
					'extra_light'      => '#afafaf',
					'extra_dark'       => '#F8F8F8',
					'extra_link'       => '#FD661E', // ok
					'extra_hover'      => '#ffffff',
					'extra_link2'      => '#80d572',
					'extra_hover2'     => '#8be77c',
					'extra_link3'      => '#ddb837',
					'extra_hover3'     => '#eec432',

					// Input fields (form's fields and textarea)
					'input_bg_color'   => 'transparent', //
					'input_bg_hover'   => 'transparent', //
					'input_bd_color'   => '#DCDCDC', // ok
					'input_bd_hover'   => '#ffffff', // ok
					'input_text'       => '#B5B6C5', // ok
					'input_light'      => '#B5B6C5', // ok
					'input_dark'       => '#ffffff',

					// Inverse blocks (text and links on the 'text_link' background)
					'inverse_bd_color' => '#e36650',
					'inverse_bd_hover' => '#cb5b47',
					'inverse_text'     => '#FFFFFF', // ok
					'inverse_light'    => '#6f6f6f',
					'inverse_dark'     => '#181D4E', // ok
					'inverse_link'     => '#ffffff', //
					'inverse_hover'    => '#181D4E', // ok

					// Additional (skin-specific) colors.
					// Attention! Set of colors must be equal in all color schemes.
					//---> For example:
					//---> 'new_color1'         => '#rrggbb',
					//---> 'alter_new_color1'   => '#rrggbb',
					//---> 'inverse_new_color1' => '#rrggbb',
				),
			),

			// Color scheme: 'default'
			'light' => array(
				'title'    => esc_html__( 'Light', 'snowy' ),
				'internal' => true,
				'colors'   => array(

					// Whole block border and background
					'bg_color'         => '#ffffff', //
					'bd_color'         => '#DCDCDC', // ok

					// Text and links colors
					'text'             => '#5F5F65', // ok
					'text_light'       => '#76797B', // ok
					'text_dark'        => '#181D4E', // ok
					'text_link'        => '#FD661E', // ok
					'text_hover'       => '#E65915', // ok
					'text_link2'       => '#661EFD', // ok
					'text_hover2'      => '#4809CC', // ok
					'text_link3'       => '#053755', // ok
					'text_hover3'      => '#001F31', // ok

					// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
					'alter_bg_color'   => '#F4F8FA', // ok
					'alter_bg_hover'   => '#ffffff', //
					'alter_bd_color'   => '#DCDCDC', // ok
					'alter_bd_hover'   => '#BEBCB5', //
					'alter_text'       => '#5F5F65', //
					'alter_light'      => '#76797B', // ok
					'alter_dark'       => '#181D4E', // ok
					'alter_link'       => '#FD661E', // ok
					'alter_hover'      => '#E65915', // ok
					'alter_link2'      => '#661EFD', // ok
					'alter_hover2'     => '#4809CC', // ok
					'alter_link3'      => '#053755', // ok
					'alter_hover3'     => '#001F31', // ok

					// Extra blocks (submenu, tabs, color blocks, etc.)
					'extra_bg_color'   => '#181D4E', // ok
					'extra_bg_hover'   => '#3f3d47',
					'extra_bd_color'   => '#313131',
					'extra_bd_hover'   => '#575757',
					'extra_text'       => '#B5B6C5', // ok
					'extra_light'      => '#afafaf',
					'extra_dark'       => '#ffffff', //
					'extra_link'       => '#FD661E', // ok
					'extra_hover'      => '#ffffff', //
					'extra_link2'      => '#80d572',
					'extra_hover2'     => '#8be77c',
					'extra_link3'      => '#ddb837',
					'extra_hover3'     => '#eec432',

					// Input fields (form's fields and textarea)
					'input_bg_color'   => 'transparent', //
					'input_bg_hover'   => 'transparent', //
					'input_bd_color'   => '#DCDCDC', // ok
					'input_bd_hover'   => '#181D4E', // ok
					'input_text'       => '#76797B', // ok
					'input_light'      => '#76797B', // ok
					'input_dark'       => '#181D4E', // ok

					// Inverse blocks (text and links on the 'text_link' background)
					'inverse_bd_color' => '#67bcc1',
					'inverse_bd_hover' => '#5aa4a9',
					'inverse_text'     => '#1d1d1d',
					'inverse_light'    => '#333333',
					'inverse_dark'     => '#181D4E', // ok
					'inverse_link'     => '#ffffff', //
					'inverse_hover'    => '#ffffff', //

					// Additional (skin-specific) colors.
					// Attention! Set of colors must be equal in all color schemes.
					//---> For example:
					//---> 'new_color1'         => '#rrggbb',
					//---> 'alter_new_color1'   => '#rrggbb',
					//---> 'inverse_new_color1' => '#rrggbb',
				),
			),
		);
		snowy_storage_set( 'schemes', $schemes );
		snowy_storage_set( 'schemes_original', $schemes );

		// Add names of additional colors
		//---> For example:
		//---> snowy_storage_set_array( 'scheme_color_names', 'new_color1', array(
		//---> 	'title'       => __( 'New color 1', 'snowy' ),
		//---> 	'description' => __( 'Description of the new color 1', 'snowy' ),
		//---> ) );


		// Additional colors for each scheme
		// Parameters:	'color' - name of the color from the scheme that should be used as source for the transformation
		//				'alpha' - to make color transparent (0.0 - 1.0)
		//				'hue', 'saturation', 'brightness' - inc/dec value for each color's component
		snowy_storage_set(
			'scheme_colors_add', array(
				'bg_color_0'        => array(
					'color' => 'bg_color',
					'alpha' => 0,
				),
				'bg_color_02'       => array(
					'color' => 'bg_color',
					'alpha' => 0.2,
				),
				'bg_color_07'       => array(
					'color' => 'bg_color',
					'alpha' => 0.7,
				),
				'bg_color_08'       => array(
					'color' => 'bg_color',
					'alpha' => 0.8,
				),
				'bg_color_09'       => array(
					'color' => 'bg_color',
					'alpha' => 0.9,
				),
				'alter_bg_color_07' => array(
					'color' => 'alter_bg_color',
					'alpha' => 0.7,
				),
				'alter_bg_color_04' => array(
					'color' => 'alter_bg_color',
					'alpha' => 0.4,
				),
				'alter_bg_color_00' => array(
					'color' => 'alter_bg_color',
					'alpha' => 0,
				),
				'alter_bg_color_02' => array(
					'color' => 'alter_bg_color',
					'alpha' => 0.2,
				),
				'alter_bd_color_02' => array(
					'color' => 'alter_bd_color',
					'alpha' => 0.2,
				),
                'alter_dark_015'     => array(
                    'color' => 'alter_dark',
                    'alpha' => 0.15,
                ),
                'alter_dark_02'     => array(
                    'color' => 'alter_dark',
                    'alpha' => 0.2,
                ),
                'alter_dark_05'     => array(
                    'color' => 'alter_dark',
                    'alpha' => 0.5,
                ),
                'alter_dark_08'     => array(
                    'color' => 'alter_dark',
                    'alpha' => 0.8,
                ),
				'alter_link_02'     => array(
					'color' => 'alter_link',
					'alpha' => 0.2,
				),
				'alter_link_07'     => array(
					'color' => 'alter_link',
					'alpha' => 0.7,
				),
				'extra_bg_color_05' => array(
					'color' => 'extra_bg_color',
					'alpha' => 0.5,
				),
				'extra_bg_color_07' => array(
					'color' => 'extra_bg_color',
					'alpha' => 0.7,
				),
				'extra_link_02'     => array(
					'color' => 'extra_link',
					'alpha' => 0.2,
				),
				'extra_link_07'     => array(
					'color' => 'extra_link',
					'alpha' => 0.7,
				),
                'text_dark_003'      => array(
                    'color' => 'text_dark',
                    'alpha' => 0.03,
                ),
                'text_dark_005'      => array(
                    'color' => 'text_dark',
                    'alpha' => 0.05,
                ),
                'text_dark_008'      => array(
                    'color' => 'text_dark',
                    'alpha' => 0.08,
                ),
				'text_dark_015'      => array(
					'color' => 'text_dark',
					'alpha' => 0.15,
				),
				'text_dark_02'      => array(
					'color' => 'text_dark',
					'alpha' => 0.2,
				),
                'text_dark_03'      => array(
                    'color' => 'text_dark',
                    'alpha' => 0.3,
                ),
                'text_dark_05'      => array(
                    'color' => 'text_dark',
                    'alpha' => 0.5,
                ),
				'text_dark_07'      => array(
					'color' => 'text_dark',
					'alpha' => 0.7,
				),
                'text_dark_08'      => array(
                    'color' => 'text_dark',
                    'alpha' => 0.8,
                ),
                'text_link_007'      => array(
                    'color' => 'text_link',
                    'alpha' => 0.07,
                ),
				'text_link_02'      => array(
					'color' => 'text_link',
					'alpha' => 0.2,
				),
                'text_link_03'      => array(
                    'color' => 'text_link',
                    'alpha' => 0.3,
                ),
				'text_link_04'      => array(
					'color' => 'text_link',
					'alpha' => 0.4,
				),
				'text_link_07'      => array(
					'color' => 'text_link',
					'alpha' => 0.7,
				),
				'text_link2_08'      => array(
                    'color' => 'text_link2',
                    'alpha' => 0.8,
                ),
                'text_link2_007'      => array(
                    'color' => 'text_link2',
                    'alpha' => 0.07,
                ),
				'text_link2_02'      => array(
					'color' => 'text_link2',
					'alpha' => 0.2,
				),
                'text_link2_03'      => array(
                    'color' => 'text_link2',
                    'alpha' => 0.3,
                ),
				'text_link2_05'      => array(
					'color' => 'text_link2',
					'alpha' => 0.5,
				),
                'text_link3_007'      => array(
                    'color' => 'text_link3',
                    'alpha' => 0.07,
                ),
				'text_link3_02'      => array(
					'color' => 'text_link3',
					'alpha' => 0.2,
				),
                'text_link3_03'      => array(
                    'color' => 'text_link3',
                    'alpha' => 0.3,
                ),
                'inverse_text_03'      => array(
                    'color' => 'inverse_text',
                    'alpha' => 0.3,
                ),
                'inverse_link_08'      => array(
                    'color' => 'inverse_link',
                    'alpha' => 0.8,
                ),
                'inverse_hover_08'      => array(
                    'color' => 'inverse_hover',
                    'alpha' => 0.8,
                ),
				'text_dark_blend'   => array(
					'color'      => 'text_dark',
					'hue'        => 2,
					'saturation' => -5,
					'brightness' => 5,
				),
				'text_link_blend'   => array(
					'color'      => 'text_link',
					'hue'        => 2,
					'saturation' => -5,
					'brightness' => 5,
				),
				'alter_link_blend'  => array(
					'color'      => 'alter_link',
					'hue'        => 2,
					'saturation' => -5,
					'brightness' => 5,
				),
			)
		);

		// Simple scheme editor: lists the colors to edit in the "Simple" mode.
		// For each color you can set the array of 'slave' colors and brightness factors that are used to generate new values,
		// when 'main' color is changed
		// Leave 'slave' arrays empty if your scheme does not have a color dependency
		snowy_storage_set(
			'schemes_simple', array(
				'text_link'        => array(),
				'text_hover'       => array(),
				'text_link2'       => array(),
				'text_hover2'      => array(),
				'text_link3'       => array(),
				'text_hover3'      => array(),
				'alter_link'       => array(),
				'alter_hover'      => array(),
				'alter_link2'      => array(),
				'alter_hover2'     => array(),
				'alter_link3'      => array(),
				'alter_hover3'     => array(),
				'extra_link'       => array(),
				'extra_hover'      => array(),
				'extra_link2'      => array(),
				'extra_hover2'     => array(),
				'extra_link3'      => array(),
				'extra_hover3'     => array(),
			)
		);

		// Parameters to set order of schemes in the css
		snowy_storage_set(
			'schemes_sorted', array(
				'color_scheme',
				'header_scheme',
				'menu_scheme',
				'sidebar_scheme',
				'footer_scheme',
			)
		);

		// Color presets
		snowy_storage_set(
			'color_presets', array(
				'autumn' => array(
								'title'  => esc_html__( 'Autumn', 'snowy' ),
								'colors' => array(
												'default' => array(
																	'text_link'  => '#d83938',
																	'text_hover' => '#f2b232',
																	),
												'dark' => array(
																	'text_link'  => '#d83938',
																	'text_hover' => '#f2b232',
																	)
												)
							),
				'green' => array(
								'title'  => esc_html__( 'Natural Green', 'snowy' ),
								'colors' => array(
												'default' => array(
																	'text_link'  => '#75ac78',
																	'text_hover' => '#378e6d',
																	),
												'dark' => array(
																	'text_link'  => '#75ac78',
																	'text_hover' => '#378e6d',
																	)
												)
							),
			)
		);
	}
}

// Enqueue clone specific style
if ( ! function_exists( 'snowy_clone_frontend_scripts' ) ) {
	add_action( 'wp_enqueue_scripts', 'snowy_clone_frontend_scripts', 2150 );
	function snowy_clone_frontend_scripts() {
		$snowy_url = snowy_get_file_url( snowy_skins_get_current_skin_dir() . 'extra-styles.css' );
		if ( '' != $snowy_url ) {
			wp_enqueue_style( 'snowy-extra-styles-' . esc_attr( snowy_skins_get_current_skin_name() ), $snowy_url, array(), null );
		}
	}
}

// Custom styles
$snowy_clone_style_path = snowy_get_file_dir( snowy_skins_get_current_skin_dir() . 'extra-styles.php' );
if ( ! empty( $snowy_clone_style_path ) ) {
	require_once $snowy_clone_style_path;
}

// Activation methods
if ( ! function_exists( 'snowy_skin_filter_activation_methods' ) ) {
    add_filter( 'trx_addons_filter_activation_methods', 'snowy_skin_filter_activation_methods', 10, 1 );
    function snowy_skin_filter_activation_methods( $args ) {
        $args['elements_key'] = true;
        return $args;
    }
}