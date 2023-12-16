<?php
/**
 * The template to display Admin notices
 *
 * @package SNOWY
 * @since SNOWY 1.0.1
 */

$snowy_theme_slug = get_option( 'template' );
$snowy_theme_obj  = wp_get_theme( $snowy_theme_slug );
?>
<div class="snowy_admin_notice snowy_welcome_notice notice notice-info is-dismissible" data-notice="admin">
	<?php
	// Theme image
	$snowy_theme_img = snowy_get_file_url( 'screenshot.jpg' );
	if ( '' != $snowy_theme_img ) {
		?>
		<div class="snowy_notice_image"><img src="<?php echo esc_url( $snowy_theme_img ); ?>" alt="<?php esc_attr_e( 'Theme screenshot', 'snowy' ); ?>"></div>
		<?php
	}

	// Title
	?>
	<h3 class="snowy_notice_title">
		<?php
		echo esc_html(
			sprintf(
				// Translators: Add theme name and version to the 'Welcome' message
				__( 'Welcome to %1$s v.%2$s', 'snowy' ),
				$snowy_theme_obj->get( 'Name' ) . ( SNOWY_THEME_FREE ? ' ' . __( 'Free', 'snowy' ) : '' ),
				$snowy_theme_obj->get( 'Version' )
			)
		);
		?>
	</h3>
	<?php

	// Description
	?>
	<div class="snowy_notice_text">
		<p class="snowy_notice_text_description">
			<?php
			echo str_replace( '. ', '.<br>', wp_kses_data( $snowy_theme_obj->description ) );
			?>
		</p>
		<p class="snowy_notice_text_info">
			<?php
			echo wp_kses_data( __( 'Attention! Plugin "ThemeREX Addons" is required! Please, install and activate it!', 'snowy' ) );
			?>
		</p>
	</div>
	<?php

	// Buttons
	?>
	<div class="snowy_notice_buttons">
		<?php
		// Link to the page 'About Theme'
		?>
		<a href="<?php echo esc_url( admin_url() . 'themes.php?page=snowy_about' ); ?>" class="button button-primary"><i class="dashicons dashicons-nametag"></i> 
			<?php
			echo esc_html__( 'Install plugin "ThemeREX Addons"', 'snowy' );
			?>
		</a>
	</div>
</div>
