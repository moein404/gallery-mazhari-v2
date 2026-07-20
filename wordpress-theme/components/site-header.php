<?php
/**
 * Gallery Mazhari main site header.
 *
 * Rendered by the [mazhari_header] shortcode inside a Bricks Header template.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$header_id  = wp_unique_id( 'mds-site-header-' );
$nav_id     = $header_id . '-navigation';
$search_id  = $header_id . '-search';
$home_url   = home_url( '/' );
$logo_url   = get_stylesheet_directory_uri() . '/assets/images/gallery-mazhari-logo.png';
$account_url = function_exists( 'wc_get_page_permalink' )
    ? wc_get_page_permalink( 'myaccount' )
    : home_url( '/my-account/' );
$cart_url = function_exists( 'wc_get_cart_url' )
    ? wc_get_cart_url()
    : home_url( '/cart/' );
$cart_count = 0;

if ( function_exists( 'WC' ) && WC()->cart ) {
    $cart_count = WC()->cart->get_cart_contents_count();
}

$fallback_menu = array(
    array(
        'label' => 'خانه',
        'url'   => $home_url,
    ),
    array(
        'label' => 'مجموعه‌ها',
        'url'   => $home_url . '#collections',
    ),
    array(
        'label' => 'درباره ما',
        'url'   => $home_url . '#about',
    ),
    array(
        'label' => 'تماس با ما',
        'url'   => $home_url . '#contact',
    ),
);
?>

<div class="mds-site-header" id="<?php echo esc_attr( $header_id ); ?>" data-mds-header>
    <div class="mds-site-header__inner mds-container">
        <a class="mds-site-header__brand" href="<?php echo esc_url( $home_url ); ?>" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
            <img
                class="mds-site-header__logo"
                src="<?php echo esc_url( $logo_url ); ?>"
                alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"
                width="1314"
                height="820"
                decoding="async"
            >
        </a>

        <nav class="mds-site-header__nav" id="<?php echo esc_attr( $nav_id ); ?>" aria-label="منوی اصلی" data-mds-nav>
            <?php if ( has_nav_menu( 'primary' ) ) : ?>
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'primary',
                        'container'      => false,
                        'menu_class'     => 'mds-site-header__menu',
                        'fallback_cb'    => false,
                        'depth'          => 2,
                    )
                );
                ?>
            <?php else : ?>
                <ul class="mds-site-header__menu">
                    <?php foreach ( $fallback_menu as $item ) : ?>
                        <li class="menu-item">
                            <a href="<?php echo esc_url( $item['url'] ); ?>">
                                <?php echo esc_html( $item['label'] ); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </nav>

        <div class="mds-site-header__actions">
            <button
                class="mds-site-header__icon-button"
                type="button"
                aria-label="جستجو"
                aria-controls="<?php echo esc_attr( $search_id ); ?>"
                aria-expanded="false"
                data-mds-search-toggle
            >
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <circle cx="11" cy="11" r="6.5"></circle>
                    <path d="m16 16 4 4"></path>
                </svg>
            </button>

            <a class="mds-site-header__icon-button mds-site-header__account" href="<?php echo esc_url( $account_url ); ?>" aria-label="حساب کاربری">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <circle cx="12" cy="8" r="3.5"></circle>
                    <path d="M5 20c.6-4 3.1-6 7-6s6.4 2 7 6"></path>
                </svg>
            </a>

            <a class="mds-site-header__icon-button mds-site-header__cart" href="<?php echo esc_url( $cart_url ); ?>" aria-label="سبد خرید">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M4 6h2l1.4 8.1a2 2 0 0 0 2 1.7h6.9a2 2 0 0 0 2-1.6L19.5 8H7"></path>
                    <circle cx="10" cy="20" r="1"></circle>
                    <circle cx="17" cy="20" r="1"></circle>
                </svg>
                <span class="mds-site-header__cart-count"<?php echo 0 === $cart_count ? ' hidden' : ''; ?>>
                    <?php echo esc_html( (string) $cart_count ); ?>
                </span>
            </a>

            <button
                class="mds-site-header__icon-button mds-site-header__menu-toggle"
                type="button"
                aria-label="باز کردن منو"
                aria-controls="<?php echo esc_attr( $nav_id ); ?>"
                aria-expanded="false"
                data-mds-menu-toggle
            >
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </div>

    <div class="mds-site-header__search-panel" id="<?php echo esc_attr( $search_id ); ?>" data-mds-search-panel hidden>
        <form class="mds-site-header__search-form mds-container" role="search" method="get" action="<?php echo esc_url( $home_url ); ?>">
            <label class="screen-reader-text" for="<?php echo esc_attr( $search_id . '-input' ); ?>">جستجو در سایت</label>
            <input
                id="<?php echo esc_attr( $search_id . '-input' ); ?>"
                type="search"
                name="s"
                placeholder="جستجو در محصولات..."
                autocomplete="off"
                data-mds-search-input
            >
            <button class="mds-site-header__search-submit" type="submit">جستجو</button>
        </form>
    </div>
</div>
