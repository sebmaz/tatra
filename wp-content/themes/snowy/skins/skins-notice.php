<?php
/**
 * The template to display Admin notices
 *
 * @package SNOWY
 * @since SNOWY 1.0.64
 */

$snowy_skins_url  = get_admin_url( null, 'admin.php?page=trx_addons_theme_panel#trx_addons_theme_panel_section_skins' );
$snowy_skins_args = get_query_var( 'snowy_skins_notice_args' );
?>
<div class="snowy_admin_notice snowy_skins_notice notice notice-info is-dismissible" data-notice="skins">
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
		<?php esc_html_e( 'New skins available', 'snowy' ); ?>
	</h3>
	<?php

	// Description
	$snowy_total      = $snowy_skins_args['update'];	// Store value to the separate variable to avoid warnings from ThemeCheck plugin!
	$snowy_skins_msg  = $snowy_total > 0
							// Translators: Add new skins number
							? '<strong>' . sprintf( _n( '%d new version', '%d new versions', $snowy_total, 'snowy' ), $snowy_total ) . '</strong>'
							: '';
	$snowy_total      = $snowy_skins_args['free'];
	$snowy_skins_msg .= $snowy_total > 0
							? ( ! empty( $snowy_skins_msg ) ? ' ' . esc_html__( 'and', 'snowy' ) . ' ' : '' )
								// Translators: Add new skins number
								. '<strong>' . sprintf( _n( '%d free skin', '%d free skins', $snowy_total, 'snowy' ), $snowy_total ) . '</strong>'
							: '';
	$snowy_total      = $snowy_skins_args['pay'];
	$snowy_skins_msg .= $snowy_skins_args['pay'] > 0
							? ( ! empty( $snowy_skins_msg ) ? ' ' . esc_html__( 'and', 'snowy' ) . ' ' : '' )
								// Translators: Add new skins number
								. '<strong>' . sprintf( _n( '%d paid skin', '%d paid skins', $snowy_total, 'snowy' ), $snowy_total ) . '</strong>'
							: '';
	?>
	<div class="snowy_notice_text">
		<p>
			<?php
			// Translators: Add new skins info
			echo wp_kses_data( sprintf( __( "We are pleased to announce that %s are available for your theme", 'snowy' ), $snowy_skins_msg ) );
			?>
		</p>
	</div>
	<?php

	// Buttons
	?>
	<div class="snowy_notice_buttons">
		<?php
		// Link to the theme dashboard page
		?>
		<a href="<?php echo esc_url( $snowy_skins_url ); ?>" class="button button-primary"><i class="dashicons dashicons-update"></i> 
			<?php
			// Translators: Add theme name
			esc_html_e( 'Go to Skins manager', 'snowy' );
			?>
		</a>
	</div>
</div>
