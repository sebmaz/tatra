<?php
// Add plugin-specific colors and fonts to the custom CSS
if ( ! function_exists( 'snowy_cf7_get_css' ) ) {
	add_filter( 'snowy_filter_get_css', 'snowy_cf7_get_css', 10, 2 );
	function snowy_cf7_get_css( $css, $args ) {
		if ( isset( $css['fonts'] ) && isset( $args['fonts'] ) ) {
			$fonts         = $args['fonts'];
			$css['fonts'] .= <<<CSS
			.sc_item_descr {
				{$fonts['p_line-height']}
			}
			.post_item_single .post_tags_single a,
			.widget_tag_cloud a,
			.widget_product_tag_cloud a,
			.widget_product_tag_cloud {
				{$fonts['p_font-family']}
			}
			.elementor-accordion .elementor-tab-title .elementor-accordion-title {
				{$fonts['h5_font-family']}
			}
			
CSS;
		}

		return $css;
	}
}
