<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: //codex.wordpress.org/Template_Hierarchy
 *
 * @package SNOWY
 * @since SNOWY 1.0
 */

$snowy_template = apply_filters( 'snowy_filter_get_template_part', snowy_blog_archive_get_template() );

if ( ! empty( $snowy_template ) && 'index' != $snowy_template ) {

	get_template_part( $snowy_template );

} else {

	snowy_storage_set( 'blog_archive', true );

	get_header();

	if ( have_posts() ) {

		// Query params
		$snowy_stickies   = is_home()
								|| ( in_array( snowy_get_theme_option( 'post_type' ), array( '', 'post' ) )
									&& (int) snowy_get_theme_option( 'parent_cat' ) == 0
									)
										? get_option( 'sticky_posts' )
										: false;
		$snowy_post_type  = snowy_get_theme_option( 'post_type' );
		$snowy_args       = array(
								'blog_style'     => snowy_get_theme_option( 'blog_style' ),
								'post_type'      => $snowy_post_type,
								'taxonomy'       => snowy_get_post_type_taxonomy( $snowy_post_type ),
								'parent_cat'     => snowy_get_theme_option( 'parent_cat' ),
								'posts_per_page' => snowy_get_theme_option( 'posts_per_page' ),
								'sticky'         => snowy_get_theme_option( 'sticky_style' ) == 'columns'
															&& is_array( $snowy_stickies )
															&& count( $snowy_stickies ) > 0
															&& get_query_var( 'paged' ) < 1
								);

		snowy_blog_archive_start();

		do_action( 'snowy_action_blog_archive_start' );

		if ( is_author() ) {
			do_action( 'snowy_action_before_page_author' );
			get_template_part( apply_filters( 'snowy_filter_get_template_part', 'templates/author-page' ) );
			do_action( 'snowy_action_after_page_author' );
		}

		if ( snowy_get_theme_option( 'show_filters' ) ) {
			do_action( 'snowy_action_before_page_filters' );
			snowy_show_filters( $snowy_args );
			do_action( 'snowy_action_after_page_filters' );
		} else {
			do_action( 'snowy_action_before_page_posts' );
			snowy_show_posts( array_merge( $snowy_args, array( 'cat' => $snowy_args['parent_cat'] ) ) );
			do_action( 'snowy_action_after_page_posts' );
		}

		do_action( 'snowy_action_blog_archive_end' );

		snowy_blog_archive_end();

	} else {

		if ( is_search() ) {
			get_template_part( apply_filters( 'snowy_filter_get_template_part', 'templates/content', 'none-search' ), 'none-search' );
		} else {
			get_template_part( apply_filters( 'snowy_filter_get_template_part', 'templates/content', 'none-archive' ), 'none-archive' );
		}
	}

	get_footer();
}
