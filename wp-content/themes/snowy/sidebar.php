<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package SNOWY
 * @since SNOWY 1.0
 */

if ( snowy_sidebar_present() ) {
	
	$snowy_sidebar_type = snowy_get_theme_option( 'sidebar_type' );
	if ( 'custom' == $snowy_sidebar_type && ! snowy_is_layouts_available() ) {
		$snowy_sidebar_type = 'default';
	}
	
	// Catch output to the buffer
	ob_start();
	if ( 'default' == $snowy_sidebar_type ) {
		// Default sidebar with widgets
		$snowy_sidebar_name = snowy_get_theme_option( 'sidebar_widgets' );
		snowy_storage_set( 'current_sidebar', 'sidebar' );
		if ( is_active_sidebar( $snowy_sidebar_name ) ) {
			dynamic_sidebar( $snowy_sidebar_name );
		}
	} else {
		// Custom sidebar from Layouts Builder
		$snowy_sidebar_id = snowy_get_custom_sidebar_id();
		do_action( 'snowy_action_show_layout', $snowy_sidebar_id );
	}
	$snowy_out = trim( ob_get_contents() );
	ob_end_clean();
	
	// If any html is present - display it
	if ( ! empty( $snowy_out ) ) {
		$snowy_sidebar_position    = snowy_get_theme_option( 'sidebar_position' );
		$snowy_sidebar_position_ss = snowy_get_theme_option( 'sidebar_position_ss' );
		?>
		<div class="sidebar widget_area
			<?php
			echo ' ' . esc_attr( $snowy_sidebar_position );
			echo ' sidebar_' . esc_attr( $snowy_sidebar_position_ss );
			echo ' sidebar_' . esc_attr( $snowy_sidebar_type );

			$snowy_sidebar_scheme = apply_filters( 'snowy_filter_sidebar_scheme', snowy_get_theme_option( 'sidebar_scheme' ) );
			if ( ! empty( $snowy_sidebar_scheme ) && ! snowy_is_inherit( $snowy_sidebar_scheme ) && 'custom' != $snowy_sidebar_type ) {
				echo ' scheme_' . esc_attr( $snowy_sidebar_scheme );
			}
			?>
		" role="complementary">
			<?php

			// Skip link anchor to fast access to the sidebar from keyboard
			?>
			<a id="sidebar_skip_link_anchor" class="snowy_skip_link_anchor" href="#"></a>
			<?php

			do_action( 'snowy_action_before_sidebar_wrap', 'sidebar' );

			// Button to show/hide sidebar on mobile
			if ( in_array( $snowy_sidebar_position_ss, array( 'above', 'float' ) ) ) {
				$snowy_title = apply_filters( 'snowy_filter_sidebar_control_title', 'float' == $snowy_sidebar_position_ss ? esc_html__( 'Show Sidebar', 'snowy' ) : '' );
				$snowy_text  = apply_filters( 'snowy_filter_sidebar_control_text', 'above' == $snowy_sidebar_position_ss ? esc_html__( 'Show Sidebar', 'snowy' ) : '' );
				?>
				<a href="#" class="sidebar_control" title="<?php echo esc_attr( $snowy_title ); ?>"><?php echo esc_html( $snowy_text ); ?></a>
				<?php
			}
			?>
			<div class="sidebar_inner">
				<?php
				do_action( 'snowy_action_before_sidebar', 'sidebar' );
				snowy_show_layout( preg_replace( "/<\/aside>[\r\n\s]*<aside/", '</aside><aside', $snowy_out ) );
				do_action( 'snowy_action_after_sidebar', 'sidebar' );
				?>
			</div>
			<?php

			do_action( 'snowy_action_after_sidebar_wrap', 'sidebar' );

			?>
		</div>
		<div class="clearfix"></div>
		<?php
	}
}
