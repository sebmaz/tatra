<?php
/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress
 */



if ($_SERVER['REMOTE_ADDR'] != '77.255.152.52') {
    echo '<div style="
    width: 100%;
    height: 100%;
    display: flex;
    margin: auto;
    flex-direction: column;
    align-items: center;
    justify-content: center;
">
<img src="http://tatra.pixelbit.pl/wp-content/uploads/2023/12/logo-dark.png" class="skip-lazy logoimg bg--light" alt="">

    Strona w budowie
</div>';

    exit;
}


/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */
define( 'WP_USE_THEMES', true );

/** Loads the WordPress Environment and Template */
require __DIR__ . '/wp-blog-header.php';
