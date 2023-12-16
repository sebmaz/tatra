<?php
/**
 * The Header: Logo and main menu
 *
 * @package SNOWY
 * @since SNOWY 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js<?php
	// Class scheme_xxx need in the <html> as context for the <body>!
	echo ' scheme_' . esc_attr( snowy_get_theme_option( 'color_scheme' ) );
?>">

<head>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php
	if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	} else {
		do_action( 'wp_body_open' );
	}
	do_action( 'snowy_action_before_body' );
	?>

	<div class="<?php echo esc_attr( apply_filters( 'snowy_filter_body_wrap_class', 'body_wrap' ) ); ?>" <?php do_action('snowy_action_body_wrap_attributes'); ?>>

		<?php do_action( 'snowy_action_before_page_wrap' ); ?>

		<div class="<?php echo esc_attr( apply_filters( 'snowy_filter_page_wrap_class', 'page_wrap' ) ); ?>" <?php do_action('snowy_action_page_wrap_attributes'); ?>>

			<?php do_action( 'snowy_action_page_wrap_start' ); ?>

			<?php
			$snowy_full_post_loading = ( snowy_is_singular( 'post' ) || snowy_is_singular( 'attachment' ) ) && snowy_get_value_gp( 'action' ) == 'full_post_loading';
			$snowy_prev_post_loading = ( snowy_is_singular( 'post' ) || snowy_is_singular( 'attachment' ) ) && snowy_get_value_gp( 'action' ) == 'prev_post_loading';

			// Don't display the header elements while actions 'full_post_loading' and 'prev_post_loading'
			if ( ! $snowy_full_post_loading && ! $snowy_prev_post_loading ) {

				// Short links to fast access to the content, sidebar and footer from the keyboard
				?>
				<a class="snowy_skip_link skip_to_content_link" href="#content_skip_link_anchor" tabindex="<?php echo esc_attr( apply_filters( 'snowy_filter_skip_links_tabindex', 1 ) ); ?>"><?php esc_html_e( "Skip to content", 'snowy' ); ?></a>
				<?php if ( snowy_sidebar_present() ) { ?>
				<a class="snowy_skip_link skip_to_sidebar_link" href="#sidebar_skip_link_anchor" tabindex="<?php echo esc_attr( apply_filters( 'snowy_filter_skip_links_tabindex', 1 ) ); ?>"><?php esc_html_e( "Skip to sidebar", 'snowy' ); ?></a>
				<?php } ?>
				<a class="snowy_skip_link skip_to_footer_link" href="#footer_skip_link_anchor" tabindex="<?php echo esc_attr( apply_filters( 'snowy_filter_skip_links_tabindex', 1 ) ); ?>"><?php esc_html_e( "Skip to footer", 'snowy' ); ?></a>

				<?php
				do_action( 'snowy_action_before_header' );

				// Header
				$snowy_header_type = snowy_get_theme_option( 'header_type' );
				if ( 'custom' == $snowy_header_type && ! snowy_is_layouts_available() ) {
					$snowy_header_type = 'default';
				}
				get_template_part( apply_filters( 'snowy_filter_get_template_part', "templates/header-" . sanitize_file_name( $snowy_header_type ) ) );

				// Side menu
				if ( in_array( snowy_get_theme_option( 'menu_side' ), array( 'left', 'right' ) ) ) {
					get_template_part( apply_filters( 'snowy_filter_get_template_part', 'templates/header-navi-side' ) );
				}

				// Mobile menu
				get_template_part( apply_filters( 'snowy_filter_get_template_part', 'templates/header-navi-mobile' ) );

				do_action( 'snowy_action_after_header' );

			}
			?>

			<?php do_action( 'snowy_action_before_page_content_wrap' ); ?>

			<div class="page_content_wrap<?php
				if ( snowy_is_off( snowy_get_theme_option( 'remove_margins' ) ) ) {
					if ( empty( $snowy_header_type ) ) {
						$snowy_header_type = snowy_get_theme_option( 'header_type' );
					}
					if ( 'custom' == $snowy_header_type && snowy_is_layouts_available() ) {
						$snowy_header_id = snowy_get_custom_header_id();
						if ( $snowy_header_id > 0 ) {
							$snowy_header_meta = snowy_get_custom_layout_meta( $snowy_header_id );
							if ( ! empty( $snowy_header_meta['margin'] ) ) {
								?> page_content_wrap_custom_header_margin<?php
							}
						}
					}
					$snowy_footer_type = snowy_get_theme_option( 'footer_type' );
					if ( 'custom' == $snowy_footer_type && snowy_is_layouts_available() ) {
						$snowy_footer_id = snowy_get_custom_footer_id();
						if ( $snowy_footer_id ) {
							$snowy_footer_meta = snowy_get_custom_layout_meta( $snowy_footer_id );
							if ( ! empty( $snowy_footer_meta['margin'] ) ) {
								?> page_content_wrap_custom_footer_margin<?php
							}
						}
					}
				}
				do_action( 'snowy_action_page_content_wrap_class', $snowy_prev_post_loading );
				?>"<?php
				if ( apply_filters( 'snowy_filter_is_prev_post_loading', $snowy_prev_post_loading ) ) {
					?> data-single-style="<?php echo esc_attr( snowy_get_theme_option( 'single_style' ) ); ?>"<?php
				}
				do_action( 'snowy_action_page_content_wrap_data', $snowy_prev_post_loading );
			?>>
				<?php
				do_action( 'snowy_action_page_content_wrap', $snowy_full_post_loading || $snowy_prev_post_loading );

				// Single posts banner
				if ( apply_filters( 'snowy_filter_single_post_header', snowy_is_singular( 'post' ) || snowy_is_singular( 'attachment' ) ) ) {
					if ( $snowy_prev_post_loading ) {
						if ( snowy_get_theme_option( 'posts_navigation_scroll_which_block' ) != 'article' ) {
							do_action( 'snowy_action_between_posts' );
						}
					}
					// Single post thumbnail and title
					$snowy_path = apply_filters( 'snowy_filter_get_template_part', 'templates/single-styles/' . snowy_get_theme_option( 'single_style' ) );
					if ( snowy_get_file_dir( $snowy_path . '.php' ) != '' ) {
						get_template_part( $snowy_path );
					}
				}

				// Widgets area above page
				$snowy_body_style   = snowy_get_theme_option( 'body_style' );
				$snowy_widgets_name = snowy_get_theme_option( 'widgets_above_page' );
				$snowy_show_widgets = ! snowy_is_off( $snowy_widgets_name ) && is_active_sidebar( $snowy_widgets_name );
				if ( $snowy_show_widgets ) {
					if ( 'fullscreen' != $snowy_body_style ) {
						?>
						<div class="content_wrap">
							<?php
					}
					snowy_create_widgets_area( 'widgets_above_page' );
					if ( 'fullscreen' != $snowy_body_style ) {
						?>
						</div>
						<?php
					}
				}

				// Content area
				do_action( 'snowy_action_before_content_wrap' );
				?>
				<div class="content_wrap<?php echo 'fullscreen' == $snowy_body_style ? '_fullscreen' : ''; ?>">

					<?php do_action( 'snowy_action_content_wrap_start' ); ?>

					<div class="content">
						<?php
						do_action( 'snowy_action_page_content_start' );

						// Skip link anchor to fast access to the content from keyboard
						?>
						<a id="content_skip_link_anchor" class="snowy_skip_link_anchor" href="#"></a>
						<?php
						// Single posts banner between prev/next posts
						if ( ( snowy_is_singular( 'post' ) || snowy_is_singular( 'attachment' ) )
							&& $snowy_prev_post_loading 
							&& snowy_get_theme_option( 'posts_navigation_scroll_which_block' ) == 'article'
						) {
							do_action( 'snowy_action_between_posts' );
						}

						// Widgets area above content
						snowy_create_widgets_area( 'widgets_above_content' );

						do_action( 'snowy_action_page_content_start_text' );
