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
    return mazhari_get_site_header_markup();
}

add_shortcode( 'mazhari_header', 'mazhari_header_shortcode' );

/**
 * Replace an empty Bricks header render with the custom site header.
 */
function mazhari_filter_bricks_header( $header_html ) {
    if ( false !== strpos( $header_html, 'class="mds-site-header"' ) ) {
        return $header_html;
    }

    $header_markup = mazhari_get_site_header_markup();

    if ( '' === $header_markup ) {
        return $header_html;
    }

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
 * Homepage category showcase shortcode for use below the hero.
 */
function mazhari_home_categories_shortcode() {
    $component_file = get_stylesheet_directory()
        . '/components/home-categories.php';

    if ( ! file_exists( $component_file ) ) {
        return '';
    }

    ob_start();

    include $component_file;

    return ob_get_clean();
}

add_shortcode( 'mazhari_home_categories', 'mazhari_home_categories_shortcode' );

/**
 * Homepage value proposition shortcode for use below the categories.
 */
function mazhari_home_why_shortcode() {
    $component_file = get_stylesheet_directory()
        . '/components/home-why.php';

    if ( ! file_exists( $component_file ) ) {
        return '';
    }

    ob_start();

    include $component_file;

    return ob_get_clean();
}

add_shortcode( 'mazhari_home_why', 'mazhari_home_why_shortcode' );

/**
 * Consultation form option labels.
 */
function mazhari_get_consultation_category_options() {
    return array(
        'complete'    => 'انتخاب کامل محصولات عروس',
        'clothing'    => 'پوشاک عروس',
        'veil'        => 'تور سر و حجاب مو',
        'shoes-bags'  => 'کفش، کتونی و کیف',
        'hair'        => 'اکسسوری مو',
        'jewelry'     => 'زیورآلات',
        'bouquet'     => 'دسته‌گل و اکسسوری خاص',
        'ceremony'    => 'ملزومات عقد و بله‌برون',
    );
}

function mazhari_get_consultation_time_options() {
    return array(
        'morning'   => 'صبح، ۹ تا ۱۲',
        'afternoon' => 'ظهر، ۱۲ تا ۱۶',
        'evening'   => 'عصر، ۱۶ تا ۲۰',
        'anytime'   => 'هر زمان مناسب بود',
    );
}

/**
 * Homepage consultation form shortcode.
 */
function mazhari_home_appointment_shortcode() {
    $component_file = get_stylesheet_directory()
        . '/components/home-appointment.php';

    if ( ! file_exists( $component_file ) ) {
        return '';
    }

    ob_start();

    include $component_file;

    return ob_get_clean();
}

add_shortcode( 'mazhari_home_appointment', 'mazhari_home_appointment_shortcode' );

/**
 * Redirect consultation form submissions back to the homepage section.
 */
function mazhari_consultation_redirect( $status ) {
    $redirect_url = wp_get_referer();

    if ( ! $redirect_url ) {
        $redirect_url = home_url( '/' );
    }

    $redirect_url = remove_query_arg( 'consultation', $redirect_url );
    $redirect_url = add_query_arg( 'consultation', sanitize_key( $status ), $redirect_url );

    wp_safe_redirect( $redirect_url . '#appointment' );
    exit;
}

/**
 * Validate and email a consultation request to the WordPress administrator.
 */
function mazhari_handle_consultation_form() {
    $nonce = isset( $_POST['mazhari_consultation_nonce'] )
        ? sanitize_text_field( wp_unslash( $_POST['mazhari_consultation_nonce'] ) )
        : '';

    if ( ! wp_verify_nonce( $nonce, 'mazhari_consultation_submit' ) ) {
        mazhari_consultation_redirect( 'invalid' );
    }

    $honeypot = isset( $_POST['website'] )
        ? sanitize_text_field( wp_unslash( $_POST['website'] ) )
        : '';

    if ( '' !== $honeypot ) {
        mazhari_consultation_redirect( 'success' );
    }

    $full_name = isset( $_POST['full_name'] )
        ? sanitize_text_field( wp_unslash( $_POST['full_name'] ) )
        : '';
    $phone = isset( $_POST['phone'] )
        ? sanitize_text_field( wp_unslash( $_POST['phone'] ) )
        : '';
    $category = isset( $_POST['category'] )
        ? sanitize_key( wp_unslash( $_POST['category'] ) )
        : '';
    $contact_time = isset( $_POST['contact_time'] )
        ? sanitize_key( wp_unslash( $_POST['contact_time'] ) )
        : '';
    $message = isset( $_POST['message'] )
        ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) )
        : '';
    $consent = isset( $_POST['consent'] )
        ? sanitize_text_field( wp_unslash( $_POST['consent'] ) )
        : '';

    $category_options = mazhari_get_consultation_category_options();
    $time_options     = mazhari_get_consultation_time_options();

    if (
        '' === $full_name
        || '' === $phone
        || '1' !== $consent
        || ! isset( $category_options[ $category ] )
        || ! isset( $time_options[ $contact_time ] )
    ) {
        mazhari_consultation_redirect( 'required' );
    }

    if ( ! preg_match( '/^[0-9۰-۹+\-\s]{8,20}$/u', $phone ) ) {
        mazhari_consultation_redirect( 'invalid' );
    }

    $name_length = function_exists( 'mb_strlen' )
        ? mb_strlen( $full_name )
        : strlen( $full_name );
    $message_length = function_exists( 'mb_strlen' )
        ? mb_strlen( $message )
        : strlen( $message );

    if ( $name_length < 2 || $name_length > 80 || $message_length > 800 ) {
        mazhari_consultation_redirect( 'invalid' );
    }

    $remote_address = isset( $_SERVER['REMOTE_ADDR'] )
        ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) )
        : '';
    $rate_limit_key = '' !== $remote_address
        ? 'mazhari_consultation_' . md5( $remote_address )
        : '';

    if ( '' !== $rate_limit_key && get_transient( $rate_limit_key ) ) {
        mazhari_consultation_redirect( 'rate-limited' );
    }

    if ( '' !== $rate_limit_key ) {
        set_transient( $rate_limit_key, 1, MINUTE_IN_SECONDS );
    }

    $email_subject = sprintf(
        'درخواست مشاوره جدید از طرف %s',
        $full_name
    );
    $email_body = implode(
        PHP_EOL,
        array(
            'درخواست مشاوره جدید از وب‌سایت گالری مظهری',
            '',
            'نام: ' . $full_name,
            'شماره تماس: ' . $phone,
            'موضوع مشاوره: ' . $category_options[ $category ],
            'زمان مناسب تماس: ' . $time_options[ $contact_time ],
            'توضیحات: ' . ( '' !== $message ? $message : '—' ),
        )
    );
    $email_headers = array( 'Content-Type: text/plain; charset=UTF-8' );
    $sent          = wp_mail(
        get_option( 'admin_email' ),
        $email_subject,
        $email_body,
        $email_headers
    );

    mazhari_consultation_redirect( $sent ? 'success' : 'send-error' );
}

add_action( 'admin_post_mazhari_consultation', 'mazhari_handle_consultation_form' );
add_action( 'admin_post_nopriv_mazhari_consultation', 'mazhari_handle_consultation_form' );

/**
 * Homepage FAQ shortcode for use below the consultation form.
 */
function mazhari_home_faq_shortcode() {
    $component_file = get_stylesheet_directory()
        . '/components/home-faq.php';

    if ( ! file_exists( $component_file ) ) {
        return '';
    }

    ob_start();

    include $component_file;

    return ob_get_clean();
}

add_shortcode( 'mazhari_home_faq', 'mazhari_home_faq_shortcode' );

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
