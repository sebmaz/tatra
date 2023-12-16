<div class="front_page_section front_page_section_googlemap<?php
	$snowy_scheme = snowy_get_theme_option( 'front_page_googlemap_scheme' );
	if ( ! empty( $snowy_scheme ) && ! snowy_is_inherit( $snowy_scheme ) ) {
		echo ' scheme_' . esc_attr( $snowy_scheme );
	}
	echo ' front_page_section_paddings_' . esc_attr( snowy_get_theme_option( 'front_page_googlemap_paddings' ) );
	if ( snowy_get_theme_option( 'front_page_googlemap_stack' ) ) {
		echo ' sc_stack_section_on';
	}
?>"
		<?php
		$snowy_css      = '';
		$snowy_bg_image = snowy_get_theme_option( 'front_page_googlemap_bg_image' );
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
	$snowy_anchor_icon = snowy_get_theme_option( 'front_page_googlemap_anchor_icon' );
	$snowy_anchor_text = snowy_get_theme_option( 'front_page_googlemap_anchor_text' );
if ( ( ! empty( $snowy_anchor_icon ) || ! empty( $snowy_anchor_text ) ) && shortcode_exists( 'trx_sc_anchor' ) ) {
	echo do_shortcode(
		'[trx_sc_anchor id="front_page_section_googlemap"'
									. ( ! empty( $snowy_anchor_icon ) ? ' icon="' . esc_attr( $snowy_anchor_icon ) . '"' : '' )
									. ( ! empty( $snowy_anchor_text ) ? ' title="' . esc_attr( $snowy_anchor_text ) . '"' : '' )
									. ']'
	);
}
?>
	<div class="front_page_section_inner front_page_section_googlemap_inner
		<?php
		$snowy_layout = snowy_get_theme_option( 'front_page_googlemap_layout' );
		echo ' front_page_section_layout_' . esc_attr( $snowy_layout );
		if ( snowy_get_theme_option( 'front_page_googlemap_fullheight' ) ) {
			echo ' snowy-full-height sc_layouts_flex sc_layouts_columns_middle';
		}
		?>
		"
			<?php
			$snowy_css      = '';
			$snowy_bg_mask  = snowy_get_theme_option( 'front_page_googlemap_bg_mask' );
			$snowy_bg_color_type = snowy_get_theme_option( 'front_page_googlemap_bg_color_type' );
			if ( 'custom' == $snowy_bg_color_type ) {
				$snowy_bg_color = snowy_get_theme_option( 'front_page_googlemap_bg_color' );
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
		<div class="front_page_section_content_wrap front_page_section_googlemap_content_wrap
		<?php
		if ( 'fullwidth' != $snowy_layout ) {
			echo ' content_wrap';
		}
		?>
		">
			<?php
			// Content wrap with title and description
			$snowy_caption     = snowy_get_theme_option( 'front_page_googlemap_caption' );
			$snowy_description = snowy_get_theme_option( 'front_page_googlemap_description' );
			if ( ! empty( $snowy_caption ) || ! empty( $snowy_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				if ( 'fullwidth' == $snowy_layout ) {
					?>
					<div class="content_wrap">
					<?php
				}
					// Caption
				if ( ! empty( $snowy_caption ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
					?>
					<h2 class="front_page_section_caption front_page_section_googlemap_caption front_page_block_<?php echo ! empty( $snowy_caption ) ? 'filled' : 'empty'; ?>">
					<?php
					echo wp_kses( $snowy_caption, 'snowy_kses_content' );
					?>
					</h2>
					<?php
				}

					// Description (text)
				if ( ! empty( $snowy_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
					?>
					<div class="front_page_section_description front_page_section_googlemap_description front_page_block_<?php echo ! empty( $snowy_description ) ? 'filled' : 'empty'; ?>">
					<?php
					echo wp_kses( wpautop( $snowy_description ), 'snowy_kses_content' );
					?>
					</div>
					<?php
				}
				if ( 'fullwidth' == $snowy_layout ) {
					?>
					</div>
					<?php
				}
			}

			// Content (text)
			$snowy_content = snowy_get_theme_option( 'front_page_googlemap_content' );
			if ( ! empty( $snowy_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				if ( 'columns' == $snowy_layout ) {
					?>
					<div class="front_page_section_columns front_page_section_googlemap_columns columns_wrap">
						<div class="column-1_3">
					<?php
				} elseif ( 'fullwidth' == $snowy_layout ) {
					?>
					<div class="content_wrap">
					<?php
				}

				?>
				<div class="front_page_section_content front_page_section_googlemap_content front_page_block_<?php echo ! empty( $snowy_content ) ? 'filled' : 'empty'; ?>">
				<?php
					echo wp_kses( $snowy_content, 'snowy_kses_content' );
				?>
				</div>
				<?php

				if ( 'columns' == $snowy_layout ) {
					?>
					</div><div class="column-2_3">
					<?php
				} elseif ( 'fullwidth' == $snowy_layout ) {
					?>
					</div>
					<?php
				}
			}

			// Widgets output
			?>
			<div class="front_page_section_output front_page_section_googlemap_output">
				<?php
				if ( is_active_sidebar( 'front_page_googlemap_widgets' ) ) {
					dynamic_sidebar( 'front_page_googlemap_widgets' );
				} elseif ( current_user_can( 'edit_theme_options' ) ) {
					if ( ! snowy_exists_trx_addons() ) {
						snowy_customizer_need_trx_addons_message();
					} else {
						snowy_customizer_need_widgets_message( 'front_page_googlemap_caption', 'ThemeREX Addons - Google map' );
					}
				}
				?>
			</div>
			<?php

			if ( 'columns' == $snowy_layout && ( ! empty( $snowy_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) ) {
				?>
				</div></div>
				<?php
			}
			?>
		</div>
	</div>
</div>
