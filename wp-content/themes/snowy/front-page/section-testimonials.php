<div class="front_page_section front_page_section_testimonials<?php
	$snowy_scheme = snowy_get_theme_option( 'front_page_testimonials_scheme' );
	if ( ! empty( $snowy_scheme ) && ! snowy_is_inherit( $snowy_scheme ) ) {
		echo ' scheme_' . esc_attr( $snowy_scheme );
	}
	echo ' front_page_section_paddings_' . esc_attr( snowy_get_theme_option( 'front_page_testimonials_paddings' ) );
	if ( snowy_get_theme_option( 'front_page_testimonials_stack' ) ) {
		echo ' sc_stack_section_on';
	}
?>"
		<?php
		$snowy_css      = '';
		$snowy_bg_image = snowy_get_theme_option( 'front_page_testimonials_bg_image' );
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
	$snowy_anchor_icon = snowy_get_theme_option( 'front_page_testimonials_anchor_icon' );
	$snowy_anchor_text = snowy_get_theme_option( 'front_page_testimonials_anchor_text' );
if ( ( ! empty( $snowy_anchor_icon ) || ! empty( $snowy_anchor_text ) ) && shortcode_exists( 'trx_sc_anchor' ) ) {
	echo do_shortcode(
		'[trx_sc_anchor id="front_page_section_testimonials"'
									. ( ! empty( $snowy_anchor_icon ) ? ' icon="' . esc_attr( $snowy_anchor_icon ) . '"' : '' )
									. ( ! empty( $snowy_anchor_text ) ? ' title="' . esc_attr( $snowy_anchor_text ) . '"' : '' )
									. ']'
	);
}
?>
	<div class="front_page_section_inner front_page_section_testimonials_inner
	<?php
	if ( snowy_get_theme_option( 'front_page_testimonials_fullheight' ) ) {
		echo ' snowy-full-height sc_layouts_flex sc_layouts_columns_middle';
	}
	?>
			"
			<?php
			$snowy_css      = '';
			$snowy_bg_mask  = snowy_get_theme_option( 'front_page_testimonials_bg_mask' );
			$snowy_bg_color_type = snowy_get_theme_option( 'front_page_testimonials_bg_color_type' );
			if ( 'custom' == $snowy_bg_color_type ) {
				$snowy_bg_color = snowy_get_theme_option( 'front_page_testimonials_bg_color' );
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
		<div class="front_page_section_content_wrap front_page_section_testimonials_content_wrap content_wrap">
			<?php
			// Caption
			$snowy_caption = snowy_get_theme_option( 'front_page_testimonials_caption' );
			if ( ! empty( $snowy_caption ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<h2 class="front_page_section_caption front_page_section_testimonials_caption front_page_block_<?php echo ! empty( $snowy_caption ) ? 'filled' : 'empty'; ?>"><?php echo wp_kses( $snowy_caption, 'snowy_kses_content' ); ?></h2>
				<?php
			}

			// Description (text)
			$snowy_description = snowy_get_theme_option( 'front_page_testimonials_description' );
			if ( ! empty( $snowy_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<div class="front_page_section_description front_page_section_testimonials_description front_page_block_<?php echo ! empty( $snowy_description ) ? 'filled' : 'empty'; ?>"><?php echo wp_kses( wpautop( $snowy_description ), 'snowy_kses_content' ); ?></div>
				<?php
			}

			// Content (widgets)
			?>
			<div class="front_page_section_output front_page_section_testimonials_output">
				<?php
				if ( is_active_sidebar( 'front_page_testimonials_widgets' ) ) {
					dynamic_sidebar( 'front_page_testimonials_widgets' );
				} elseif ( current_user_can( 'edit_theme_options' ) ) {
					if ( ! snowy_exists_trx_addons() ) {
						snowy_customizer_need_trx_addons_message();
					} else {
						snowy_customizer_need_widgets_message( 'front_page_testimonials_caption', 'ThemeREX Addons - Testimonials' );
					}
				}
				?>
			</div>
		</div>
	</div>
</div>
