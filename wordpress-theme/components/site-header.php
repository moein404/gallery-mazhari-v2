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

$mobile_menu_links = array(
    array(
        'label' => 'خانه',
        'hint'  => 'شروع از صفحه اصلی',
        'url'   => $home_url,
    ),
    array(
        'label' => 'دسته‌بندی محصولات',
        'hint'  => 'تمام نیازهای عروس در یک مجموعه',
        'url'   => $home_url . '#collections',
    ),
    array(
        'label' => 'کالکشن‌های لباس',
        'hint'  => 'لباس عروس و کت‌وشلوار عقد',
        'url'   => function_exists( 'mazhari_get_product_category_url' )
            ? mazhari_get_product_category_url( 'bridal-clothing' )
            : $home_url . '#collections',
    ),
    array(
        'label' => 'استایل‌های منتخب',
        'hint'  => 'ترکیب‌های پیشنهادی گالری مظهری',
        'url'   => get_post_type_archive_link( 'mazhari_look' ) ?: $home_url . '#selection',
    ),
);

$mobile_category_links = array(
    'bridal-veils'                       => 'تور عروس',
    'bridal-shoes-bags'                  => 'کفش، کتونی و کیف',
    'bridal-hair-accessories'            => 'اکسسوری مو',
    'bridal-jewelry'                     => 'زیورآلات',
    'special-bridal-accessories'         => 'اکسسوری خاص',
    'engagement-ceremony-essentials'     => 'ملزومات عقد',
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
            <div class="mds-site-header__desktop-nav">
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
            </div>

            <div class="mds-site-header__mobile-menu" dir="rtl">
                <header class="mds-site-header__mobile-intro">
                    <span lang="en">The Bridal Destination</span>
                    <strong>مسیر انتخاب شما</strong>
                    <p>از اولین ایده تا آخرین جزئیات، همه‌چیز اینجاست.</p>
                </header>

                <ul class="mds-site-header__mobile-primary">
                    <?php foreach ( $mobile_menu_links as $index => $item ) : ?>
                        <li>
                            <a href="<?php echo esc_url( $item['url'] ); ?>">
                                <span class="mds-site-header__mobile-number" aria-hidden="true">
                                    <?php echo esc_html( str_pad( (string) ( $index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?>
                                </span>
                                <span>
                                    <strong><?php echo esc_html( $item['label'] ); ?></strong>
                                    <small><?php echo esc_html( $item['hint'] ); ?></small>
                                </span>
                                <span class="mds-site-header__mobile-arrow" aria-hidden="true">←</span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <section class="mds-site-header__mobile-categories" aria-labelledby="<?php echo esc_attr( $header_id . '-categories-title' ); ?>">
                    <h2 id="<?php echo esc_attr( $header_id . '-categories-title' ); ?>">دسته‌های محبوب</h2>
                    <div>
                        <?php foreach ( $mobile_category_links as $category_slug => $category_label ) : ?>
                            <a href="<?php echo esc_url( mazhari_get_product_category_url( $category_slug ) ); ?>">
                                <?php echo esc_html( $category_label ); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </section>

                <div class="mds-site-header__mobile-footer">
                    <a class="mds-site-header__mobile-cta" href="<?php echo esc_url( $home_url . '#appointment' ); ?>">
                        راهنمای انتخاب و مشاوره
                        <span aria-hidden="true">←</span>
                    </a>
                    <a class="mds-site-header__mobile-contact" href="<?php echo esc_url( $home_url . '#contact' ); ?>">
                        شعبه‌ها و راه‌های ارتباطی
                    </a>
                </div>
            </div>
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
