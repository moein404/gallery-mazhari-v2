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
 * Build the main site header markup.
 */
function mazhari_get_site_header_markup() {
    $component_file = get_stylesheet_directory()
        . '/components/site-header.php';

    if ( ! file_exists( $component_file ) ) {
        return '';
    }

    ob_start();

    include $component_file;

    return ob_get_clean();
}

/**
 * Keep the shortcode available for previews outside the rendered Bricks header.
 * On the frontend the header is injected through bricks_before_header instead,
 * which avoids Bricks incorrectly treating the shortcode content as empty.
 */
function mazhari_header_shortcode() {
    if ( ! empty( $GLOBALS['mazhari_site_header_rendered'] ) ) {
        return '';
    }

    return mazhari_get_site_header_markup();
}

add_shortcode( 'mazhari_header', 'mazhari_header_shortcode' );

/**
 * Render the site header independently of the Bricks Shortcode element.
 */
function mazhari_render_site_header() {
    if ( ! empty( $GLOBALS['mazhari_site_header_rendered'] ) ) {
        return;
    }

    $header_markup = mazhari_get_site_header_markup();

    if ( '' === $header_markup ) {
        return;
    }

    $GLOBALS['mazhari_site_header_rendered'] = true;

    echo $header_markup; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

add_action( 'bricks_before_header', 'mazhari_render_site_header', 10 );
add_action( 'bricks_body', 'mazhari_render_site_header', 20 );
add_action( 'wp_body_open', 'mazhari_render_site_header', 20 );

/**
 * Replace an empty Bricks header render with the custom site header.
 */
function mazhari_filter_bricks_header( $header_html ) {
    if ( false !== strpos( $header_html, 'class="mds-site-header"' ) ) {
        $GLOBALS['mazhari_site_header_rendered'] = true;

        return $header_html;
    }

    if ( ! empty( $GLOBALS['mazhari_site_header_rendered'] ) ) {
        return $header_html;
    }

    $header_markup = mazhari_get_site_header_markup();

    if ( '' === $header_markup ) {
        return $header_html;
    }

    $GLOBALS['mazhari_site_header_rendered'] = true;

    $closing_tag_position = strpos( $header_html, '</header>' );

    if ( false !== $closing_tag_position ) {
        return substr_replace(
            $header_html,
            $header_markup,
            $closing_tag_position,
            0
        );
    }

    return $header_markup . $header_html;
}

add_filter( 'bricks/render_header', 'mazhari_filter_bricks_header', 10, 1 );

/**
 * Homepage hero shortcode for use inside the Bricks Home page.
 */
function mazhari_home_hero_shortcode() {
    $component_file = get_stylesheet_directory()
        . '/components/home-hero.php';

    if ( ! file_exists( $component_file ) ) {
        return '';
    }

    ob_start();

    include $component_file;

    return ob_get_clean();
}

add_shortcode( 'mazhari_home_hero', 'mazhari_home_hero_shortcode' );

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
