<?php
/**
 * The template to show mobile menu (used only header_style == 'default')
 *
 * @package SNOWY
 * @since SNOWY 1.0
 */

$snowy_show_widgets = snowy_get_theme_option( 'widgets_menu_mobile_fullscreen' );
$snowy_show_socials = snowy_get_theme_option( 'menu_mobile_socials' );

?>
<div class="menu_mobile_overlay scheme_dark"></div>
<div class="menu_mobile menu_mobile_<?php echo esc_attr( snowy_get_theme_option( 'menu_mobile_fullscreen' ) > 0 ? 'fullscreen' : 'narrow' ); ?> scheme_dark">
	<div class="menu_mobile_inner<?php echo esc_attr( $snowy_show_widgets == 1  ? ' with_widgets' : '' ); ?>">
        <div class="menu_mobile_header_wrap">
            <?php
            // Logo
            set_query_var( 'snowy_logo_args', array( 'type' => 'mobile' ) );
            get_template_part( apply_filters( 'snowy_filter_get_template_part', 'templates/header-logo' ) );
            set_query_var( 'snowy_logo_args', array() ); ?>

            <a class="menu_mobile_close menu_button_close" tabindex="0"><span class="menu_button_close_text"><?php esc_html_e('Close', 'snowy')?></span><span class="menu_button_close_icon"></span></a>
        </div>
        <div class="menu_mobile_content_wrap content_wrap">
            <div class="menu_mobile_content_wrap_inner<?php echo esc_attr($snowy_show_socials ? '' : ' without_socials'); ?>"><?php
            // Mobile menu
            $snowy_menu_mobile = snowy_get_nav_menu( 'menu_mobile' );
            if ( empty( $snowy_menu_mobile ) ) {
                $snowy_menu_mobile = apply_filters( 'snowy_filter_get_mobile_menu', '' );
                if ( empty( $snowy_menu_mobile ) ) {
                    $snowy_menu_mobile = snowy_get_nav_menu( 'menu_main' );
                    if ( empty( $snowy_menu_mobile ) ) {
                        $snowy_menu_mobile = snowy_get_nav_menu();
                    }
                }
            }
            if ( ! empty( $snowy_menu_mobile ) ) {
                $snowy_menu_mobile = str_replace(
                    array( 'menu_main',   'id="menu-',        'sc_layouts_menu_nav', 'sc_layouts_menu ', 'sc_layouts_hide_on_mobile', 'hide_on_mobile' ),
                    array( 'menu_mobile', 'id="menu_mobile-', '',                    ' ',                '',                          '' ),
                    $snowy_menu_mobile
                );
                if ( strpos( $snowy_menu_mobile, '<nav ' ) === false ) {
                    $snowy_menu_mobile = sprintf( '<nav class="menu_mobile_nav_area" itemscope="itemscope" itemtype="%1$s//schema.org/SiteNavigationElement">%2$s</nav>', esc_attr( snowy_get_protocol( true ) ), $snowy_menu_mobile );
                }
                snowy_show_layout( apply_filters( 'snowy_filter_menu_mobile_layout', $snowy_menu_mobile ) );
            }
        echo '<div class="socials_mobile">';
            echo '<h1 style="font-size: 15px;line-height: 25px;">Wypożyczalnia sprzętu górskiego i skiturowego w Zakopanem</h1>';
            echo '<a class="elementor-button elementor-button-link elementor-size-sm" href="tel:784580412" style="background-color: #FD661E;color: #fff;margin: 10px;">
						<span class="elementor-button-content-wrapper">
						<span class="elementor-button-icon elementor-align-icon-left">
				<svg aria-hidden="true" class="e-font-icon-svg e-fas-phone-square-alt" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg"><path d="M400 32H48A48 48 0 0 0 0 80v352a48 48 0 0 0 48 48h352a48 48 0 0 0 48-48V80a48 48 0 0 0-48-48zm-16.39 307.37l-15 65A15 15 0 0 1 354 416C194 416 64 286.29 64 126a15.7 15.7 0 0 1 11.63-14.61l65-15A18.23 18.23 0 0 1 144 96a16.27 16.27 0 0 1 13.79 9.09l30 70A17.9 17.9 0 0 1 189 181a17 17 0 0 1-5.5 11.61l-37.89 31a231.91 231.91 0 0 0 110.78 110.78l31-37.89A17 17 0 0 1 299 291a17.85 17.85 0 0 1 5.91 1.21l70 30A16.25 16.25 0 0 1 384 336a17.41 17.41 0 0 1-.39 3.37z"></path></svg>			</span>
						<span class="elementor-button-text">784 580 412</span>
		</span>
					</a>';

                       echo '<a class="elementor-button elementor-button-link elementor-size-sm" href="tel:668643883" style="background-color: #FD661E;color: #fff;margin: 10px;">
						<span class="elementor-button-content-wrapper">
						<span class="elementor-button-icon elementor-align-icon-left">
				<svg aria-hidden="true" class="e-font-icon-svg e-fas-phone-square-alt" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg"><path d="M400 32H48A48 48 0 0 0 0 80v352a48 48 0 0 0 48 48h352a48 48 0 0 0 48-48V80a48 48 0 0 0-48-48zm-16.39 307.37l-15 65A15 15 0 0 1 354 416C194 416 64 286.29 64 126a15.7 15.7 0 0 1 11.63-14.61l65-15A18.23 18.23 0 0 1 144 96a16.27 16.27 0 0 1 13.79 9.09l30 70A17.9 17.9 0 0 1 189 181a17 17 0 0 1-5.5 11.61l-37.89 31a231.91 231.91 0 0 0 110.78 110.78l31-37.89A17 17 0 0 1 299 291a17.85 17.85 0 0 1 5.91 1.21l70 30A16.25 16.25 0 0 1 384 336a17.41 17.41 0 0 1-.39 3.37z"></path></svg>			</span>
						<span class="elementor-button-text">668 643 883</span>
		</span>
					</a>';
					echo '</div>';

            // Social icons
            if($snowy_show_socials) {
                snowy_show_layout( snowy_get_socials_links(), '<div class="socials_mobile">', '</div>' );
            }            
            ?>
            </div>
		</div><?php

        if ( $snowy_show_widgets == 1 )  {
            ?><div class="menu_mobile_widgets_area"><?php
            // Create Widgets Area
            snowy_create_widgets_area( 'widgets_additional_menu_mobile_fullscreen' );
            ?></div><?php
        } ?>

    </div>
</div>
