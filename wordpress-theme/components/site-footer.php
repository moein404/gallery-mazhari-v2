<?php
/**
 * Gallery Mazhari global site footer.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$home_url     = home_url( '/' );
$logo_url     = get_stylesheet_directory_uri() . '/assets/images/gallery-mazhari-logo.png';
$current_year = wp_date( 'Y' );
$map_query    = rawurlencode( 'تهران خیابان سعدی چهارراه مخبرالدوله کوچه رفاهی پلاک 16 گالری مظهری' );
?>

<footer class="mds-site-footer" id="contact" dir="rtl" aria-label="پاورقی سایت گالری مظهری">
    <?php if ( ! is_front_page() ) : ?>
        <div class="mds-site-footer__cta mds-container">
            <div>
                <span>برای یک انتخاب هماهنگ آماده‌اید؟</span>
                <strong>از اولین تصمیم تا آخرین جزئیات، کنار شما هستیم.</strong>
            </div>
            <a class="mds-btn mds-btn--footer" href="<?php echo esc_url( $home_url . '#appointment' ); ?>">
                درخواست مشاوره
                <span aria-hidden="true">←</span>
            </a>
        </div>
    <?php endif; ?>

    <div class="mds-site-footer__main mds-container">
        <div class="mds-site-footer__brand">
            <a href="<?php echo esc_url( $home_url ); ?>" aria-label="صفحه اصلی گالری مظهری">
                <img
                    src="<?php echo esc_url( $logo_url ); ?>"
                    alt="گالری مظهری"
                    width="1314"
                    height="820"
                    loading="lazy"
                    decoding="async"
                >
            </a>
            <p>
                مقصد کامل انتخاب عروس؛ از پوشاک و تور تا کفش، کیف، زیورآلات، اکسسوری و ملزومات عقد و بله‌برون.
            </p>
        </div>

        <nav class="mds-site-footer__nav" aria-label="دسترسی سریع">
            <h2>دسترسی سریع</h2>
            <ul>
                <li><a href="<?php echo esc_url( $home_url ); ?>">خانه</a></li>
                <li><a href="<?php echo esc_url( $home_url . '#collections' ); ?>">دسته‌بندی محصولات</a></li>
                <li><a href="<?php echo esc_url( $home_url . '#about' ); ?>">درباره گالری</a></li>
                <li><a href="<?php echo esc_url( $home_url . '#appointment' ); ?>">درخواست مشاوره</a></li>
                <li><a href="<?php echo esc_url( $home_url . '#faq' ); ?>">پرسش‌های متداول</a></li>
            </ul>
        </nav>

        <div class="mds-site-footer__contact">
            <h2>گالری مظهری</h2>
            <address>
                خیابان سعدی، چهارراه مخبرالدوله، روبه‌روی مترو سعدی، کوچه رفاهی، پلاک ۱۶
            </address>
            <a class="mds-site-footer__phone" href="tel:+982133961455" dir="ltr">021 3396 1455</a>
            <a class="mds-site-footer__phone" href="tel:+989352181200" dir="ltr">0935 218 1200</a>
            <a
                class="mds-site-footer__map"
                href="https://www.google.com/maps/search/?api=1&amp;query=<?php echo esc_attr( $map_query ); ?>"
                target="_blank"
                rel="noopener noreferrer"
            >مشاهده روی نقشه ←</a>
        </div>

        <div class="mds-site-footer__contact">
            <h2>شعبه خانه عروس</h2>
            <address>
                چهارراه امیراکرم، ابتدای خیابان لبافی‌نژاد، پلاک ۱، خانه عروس ایران
            </address>
            <a class="mds-site-footer__phone" href="tel:+982133966476" dir="ltr">021 3396 6476</a>
            <p class="mds-site-footer__support">فروش آنلاین و پشتیبانی: <span dir="ltr">0935 218 1200</span></p>
        </div>
    </div>

    <div class="mds-site-footer__bottom">
        <div class="mds-container">
            <p>© <?php echo esc_html( $current_year ); ?> گالری مظهری؛ تمامی حقوق محفوظ است.</p>
            <a href="#" aria-label="بازگشت به ابتدای صفحه">
                بازگشت به بالا
                <span aria-hidden="true">↑</span>
            </a>
        </div>
    </div>
</footer>
