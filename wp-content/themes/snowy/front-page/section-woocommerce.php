<?php
$snowy_woocommerce_sc = snowy_get_theme_option( 'front_page_woocommerce_products' );
if ( ! empty( $snowy_woocommerce_sc ) ) {
	?><div class="front_page_section front_page_section_woocommerce<?php
		$snowy_scheme = snowy_get_theme_option( 'front_page_woocommerce_scheme' );
		if ( ! empty( $snowy_scheme ) && ! snowy_is_inherit( $snowy_scheme ) ) {
			echo ' scheme_' . esc_attr( $snowy_scheme );
		}
		echo ' front_page_section_paddings_' . esc_attr( snowy_get_theme_option( 'front_page_woocommerce_paddings' ) );
		if ( snowy_get_theme_option( 'front_page_woocommerce_stack' ) ) {
			echo ' sc_stack_section_on';
		}
	?>"
			<?php
			$snowy_css      = '';
			$snowy_bg_image = snowy_get_theme_option( 'front_page_woocommerce_bg_image' );
			if ( ! empty( $snowy_bg_image ) ) {
				$snowy_css .= 'background-image: url(' . esc_url( snowy_get_attachment_url( $snowy_bg_image ) ) . ');';
			}
			if ( ! empty( $snowy_css ) ) {
				echo ' style="' . esc_attr( $snowy_css ) . '"';
			}
			?>
	>
	<?php
		// Add anchor
		$snowy_anchor_icon = snowy_get_theme_option( 'front_page_woocommerce_anchor_icon' );
		$snowy_anchor_text = snowy_get_theme_option( 'front_page_woocommerce_anchor_text' );
		if ( ( ! empty( $snowy_anchor_icon ) || ! empty( $snowy_anchor_text ) ) && shortcode_exists( 'trx_sc_anchor' ) ) {
			echo do_shortcode(
				'[trx_sc_anchor id="front_page_section_woocommerce"'
											. ( ! empty( $snowy_anchor_icon ) ? ' icon="' . esc_attr( $snowy_anchor_icon ) . '"' : '' )
											. ( ! empty( $snowy_anchor_text ) ? ' title="' . esc_attr( $snowy_anchor_text ) . '"' : '' )
											. ']'
			);
		}
	?>
		<div class="front_page_section_inner front_page_section_woocommerce_inner
			<?php
			if ( snowy_get_theme_option( 'front_page_woocommerce_fullheight' ) ) {
				echo ' snowy-full-height sc_layouts_flex sc_layouts_columns_middle';
			}
			?>
				"
				<?php
				$snowy_css      = '';
				$snowy_bg_mask  = snowy_get_theme_option( 'front_page_woocommerce_bg_mask' );
				$snowy_bg_color_type = snowy_get_theme_option( 'front_page_woocommerce_bg_color_type' );
				if ( 'custom' == $snowy_bg_color_type ) {
					$snowy_bg_color = snowy_get_theme_option( 'front_page_woocommerce_bg_color' );
				} elseif ( 'scheme_bg_color' == $snowy_bg_color_type ) {
					$snowy_bg_color = snowy_get_scheme_color( 'bg_color', $snowy_scheme );
				} else {
					$snowy_bg_color = '';
				}
				if ( ! empty( $snowy_bg_color ) && $snowy_bg_mask > 0 ) {
					$snowy_css .= 'background-color: ' . esc_attr(
						1 == $snowy_bg_mask ? $snowy_bg_color : snowy_hex2rgba( $snowy_bg_color, $snowy_bg_mask )
					) . ';';
				}
				if ( ! empty( $snowy_css ) ) {
					echo ' style="' . esc_attr( $snowy_css ) . '"';
				}
				?>
		>
			<div class="front_page_section_content_wrap front_page_section_woocommerce_content_wrap content_wrap woocommerce">
				<?php
				// Content wrap with title and description
				$snowy_caption     = snowy_get_theme_option( 'front_page_woocommerce_caption' );
				$snowy_description = snowy_get_theme_option( 'front_page_woocommerce_description' );
				if ( ! empty( $snowy_caption ) || ! empty( $snowy_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
					// Caption
					if ( ! empty( $snowy_caption ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
						?>
						<h2 class="front_page_section_caption front_page_section_woocommerce_caption front_page_block_<?php echo ! empty( $snowy_caption ) ? 'filled' : 'empty'; ?>">
						<?php
							echo wp_kses( $snowy_caption, 'snowy_kses_content' );
						?>
						</h2>
						<?php
					}

					// Description (text)
					if ( ! empty( $snowy_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
						?>
						<div class="front_page_section_description front_page_section_woocommerce_description front_page_block_<?php echo ! empty( $snowy_description ) ? 'filled' : 'empty'; ?>">
						<?php
							echo wp_kses( wpautop( $snowy_description ), 'snowy_kses_content' );
						?>
						</div>
						<?php
					}
				}

				// Content (widgets)
				?>
				<div class="front_page_section_output front_page_section_woocommerce_output list_products shop_mode_thumbs">
					<?php
					if ( 'products' == $snowy_woocommerce_sc ) {
						$snowy_woocommerce_sc_ids      = snowy_get_theme_option( 'front_page_woocommerce_products_per_page' );
						$snowy_woocommerce_sc_per_page = count( explode( ',', $snowy_woocommerce_sc_ids ) );
					} else {
						$snowy_woocommerce_sc_per_page = max( 1, (int) snowy_get_theme_option( 'front_page_woocommerce_products_per_page' ) );
					}
					$snowy_woocommerce_sc_columns = max( 1, min( $snowy_woocommerce_sc_per_page, (int) snowy_get_theme_option( 'front_page_woocommerce_products_columns' ) ) );
					echo do_shortcode(
						"[{$snowy_woocommerce_sc}"
										. ( 'products' == $snowy_woocommerce_sc
												? ' ids="' . esc_attr( $snowy_woocommerce_sc_ids ) . '"'
												: '' )
										. ( 'product_category' == $snowy_woocommerce_sc
												? ' category="' . esc_attr( snowy_get_theme_option( 'front_page_woocommerce_products_categories' ) ) . '"'
												: '' )
										. ( 'best_selling_products' != $snowy_woocommerce_sc
												? ' orderby="' . esc_attr( snowy_get_theme_option( 'front_page_woocommerce_products_orderby' ) ) . '"'
													. ' order="' . esc_attr( snowy_get_theme_option( 'front_page_woocommerce_products_order' ) ) . '"'
												: '' )
										. ' per_page="' . esc_attr( $snowy_woocommerce_sc_per_page ) . '"'
										. ' columns="' . esc_attr( $snowy_woocommerce_sc_columns ) . '"'
						. ']'
					);
					?>
				</div>
			</div>
		</div>
	</div>
	<?php
}
