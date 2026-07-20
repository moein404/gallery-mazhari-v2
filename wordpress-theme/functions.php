<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

function mazhari_enqueue_assets() {
    $base = get_stylesheet_directory();
    $uri  = get_stylesheet_directory_uri();

    wp_enqueue_style(
        'mazhari-foundation',
        $uri . '/assets/css/foundation.css',
        array(),
        filemtime( $base . '/assets/css/foundation.css' )
    );

    wp_enqueue_style(
        'mazhari-typography',
        $uri . '/assets/css/typography.css',
        array( 'mazhari-foundation' ),
        filemtime( $base . '/assets/css/typography.css' )
    );

    wp_enqueue_style(
        'mazhari-components',
        $uri . '/assets/css/components.css',
        array( 'mazhari-typography' ),
        filemtime( $base . '/assets/css/components.css' )
    );

    wp_enqueue_script(
        'mazhari-main',
        $uri . '/assets/js/main.js',
        array(),
        filemtime( $base . '/assets/js/main.js' ),
        true
    );
}
add_action( 'wp_enqueue_scripts', 'mazhari_enqueue_assets', 20 );

/**
 * Theme navigation locations.
 */
function mazhari_register_navigation() {
    register_nav_menus(
        array(
            'primary' => __( 'Primary Menu', 'mazhari' ),
        )
    );
}
add_action( 'after_setup_theme', 'mazhari_register_navigation' );

/**
 * Main site header shortcode for use inside a Bricks Header template.
 */
function mazhari_header_shortcode() {
    $component_file = get_stylesheet_directory()
        . '/components/site-header.php';

    if ( ! file_exists( $component_file ) ) {
        return '';
    }

    ob_start();

    include $component_file;

    return ob_get_clean();
}

add_shortcode( 'mazhari_header', 'mazhari_header_shortcode' );

/**
 * Component Library Shortcode
 */
function mazhari_component_library_shortcode() {

    $component_file = get_stylesheet_directory()
        . '/components/component-library.php';

    if ( ! file_exists( $component_file ) ) {
        return '';
    }

    ob_start();

    include $component_file;

    return ob_get_clean();
}

add_shortcode(
    'mazhari_component_library',
    'mazhari_component_library_shortcode'
);
