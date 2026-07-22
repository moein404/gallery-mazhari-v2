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
$saadi_map_query = rawurlencode( 'تهران خیابان سعدی چهارراه مخبرالدوله کوچه رفاهی پلاک 16 گالری مظهری' );
$bride_map_query = rawurlencode( 'تهران چهارراه امیراکرم ابتدای خیابان لبافی نژاد پلاک 1 خانه عروس ایران' );
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
            <h2>شعبه سعدی</h2>
            <address>
                خیابان سعدی، چهارراه مخبرالدوله، روبه‌روی مترو سعدی، کوچه رفاهی، پلاک ۱۶
            </address>
            <a class="mds-site-footer__phone" href="tel:+982133961455" dir="ltr">021 3396 1455</a>
            <a
                class="mds-site-footer__map"
                href="https://www.google.com/maps/search/?api=1&amp;query=<?php echo esc_attr( $saadi_map_query ); ?>"
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
            <a
                class="mds-site-footer__map"
                href="https://www.google.com/maps/search/?api=1&amp;query=<?php echo esc_attr( $bride_map_query ); ?>"
                target="_blank"
                rel="noopener noreferrer"
            >مشاهده روی نقشه ←</a>
        </div>
    </div>

    <section class="mds-site-footer__channels mds-container" aria-labelledby="mds-footer-channels-title">
        <header>
            <span>ارتباط مستقیم</span>
            <h2 id="mds-footer-channels-title">راه ارتباطی مناسب شما</h2>
        </header>

        <div class="mds-site-footer__channels-grid">
            <article class="mds-site-footer__channel-card">
                <div>
                    <h3>فروش آنلاین و پشتیبانی</h3>
                    <a href="tel:+989352181200" dir="ltr">0935 218 1200</a>
                </div>
                <div class="mds-site-footer__channel-icons" aria-label="راه‌های ارتباط با فروش آنلاین و پشتیبانی">
                    <a href="tel:+989352181200" aria-label="تماس با فروش آنلاین و پشتیبانی">
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.79 19.79 0 0 1 2.12 4.18 2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.69 2.8a2 2 0 0 1-.45 2.11L8.08 9.9a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.9.33 1.84.56 2.8.69A2 2 0 0 1 22 16.92Z"/></svg>
                    </a>
                    <span role="img" aria-label="تلگرام؛ لینک به‌زودی اضافه می‌شود" title="لینک تلگرام به‌زودی اضافه می‌شود">
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="m21.6 3.2-3 16.4c-.22 1.16-.82 1.44-1.66.9l-4.57-3.37-2.2 2.12c-.25.24-.45.44-.93.44l.33-4.66 8.48-7.66c.37-.33-.08-.51-.57-.18L7 13.85l-4.5-1.4c-.98-.31-1-.98.2-1.45L20.3 4.22c.82-.3 1.53.18 1.3 1Z"/></svg>
                    </span>
                    <span role="img" aria-label="واتساپ؛ لینک به‌زودی اضافه می‌شود" title="لینک واتساپ به‌زودی اضافه می‌شود">
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20.5 3.5A11.8 11.8 0 0 0 12.1 0C5.55 0 .22 5.33.22 11.88c0 2.1.55 4.15 1.6 5.95L.12 24l6.31-1.65a11.9 11.9 0 0 0 5.67 1.44h.01C18.66 23.79 24 18.46 24 11.9c0-3.18-1.24-6.16-3.5-8.4Zm-8.4 18.28a9.86 9.86 0 0 1-5.02-1.37l-.36-.21-3.75.98 1-3.65-.24-.38a9.84 9.84 0 0 1-1.5-5.27c0-5.44 4.43-9.87 9.88-9.87a9.8 9.8 0 0 1 6.98 2.9 9.8 9.8 0 0 1 2.9 7c0 5.44-4.44 9.87-9.89 9.87Zm5.42-7.4c-.3-.15-1.76-.87-2.03-.97-.27-.1-.47-.15-.67.15-.2.3-.77.97-.94 1.17-.17.2-.35.22-.64.08-.3-.15-1.25-.46-2.38-1.47a8.9 8.9 0 0 1-1.65-2.05c-.17-.3-.02-.46.13-.6.13-.13.3-.34.44-.51.15-.17.2-.3.3-.5.1-.2.05-.37-.02-.52-.08-.15-.67-1.61-.92-2.2-.24-.58-.49-.5-.67-.51h-.57c-.2 0-.52.07-.8.37-.27.3-1.04 1.02-1.04 2.48 0 1.46 1.07 2.87 1.21 3.07.15.2 2.1 3.2 5.08 4.49.71.3 1.26.49 1.7.63.71.23 1.36.2 1.87.12.57-.08 1.76-.72 2-1.41.25-.7.25-1.3.18-1.42-.08-.13-.27-.2-.57-.35Z"/></svg>
                    </span>
                </div>
            </article>

            <article class="mds-site-footer__channel-card">
                <div>
                    <h3>عمده‌فروشی و همکاری</h3>
                    <a href="tel:+989373333150" dir="ltr">0937 333 3150</a>
                </div>
                <div class="mds-site-footer__channel-icons" aria-label="راه‌های ارتباط برای عمده‌فروشی و همکاری">
                    <a href="tel:+989373333150" aria-label="تماس برای عمده‌فروشی و همکاری">
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.79 19.79 0 0 1 2.12 4.18 2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.69 2.8a2 2 0 0 1-.45 2.11L8.08 9.9a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.9.33 1.84.56 2.8.69A2 2 0 0 1 22 16.92Z"/></svg>
                    </a>
                    <span role="img" aria-label="تلگرام؛ لینک به‌زودی اضافه می‌شود" title="لینک تلگرام به‌زودی اضافه می‌شود">
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="m21.6 3.2-3 16.4c-.22 1.16-.82 1.44-1.66.9l-4.57-3.37-2.2 2.12c-.25.24-.45.44-.93.44l.33-4.66 8.48-7.66c.37-.33-.08-.51-.57-.18L7 13.85l-4.5-1.4c-.98-.31-1-.98.2-1.45L20.3 4.22c.82-.3 1.53.18 1.3 1Z"/></svg>
                    </span>
                    <span role="img" aria-label="واتساپ؛ لینک به‌زودی اضافه می‌شود" title="لینک واتساپ به‌زودی اضافه می‌شود">
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20.5 3.5A11.8 11.8 0 0 0 12.1 0C5.55 0 .22 5.33.22 11.88c0 2.1.55 4.15 1.6 5.95L.12 24l6.31-1.65a11.9 11.9 0 0 0 5.67 1.44h.01C18.66 23.79 24 18.46 24 11.9c0-3.18-1.24-6.16-3.5-8.4Zm-8.4 18.28a9.86 9.86 0 0 1-5.02-1.37l-.36-.21-3.75.98 1-3.65-.24-.38a9.84 9.84 0 0 1-1.5-5.27c0-5.44 4.43-9.87 9.88-9.87a9.8 9.8 0 0 1 6.98 2.9 9.8 9.8 0 0 1 2.9 7c0 5.44-4.44 9.87-9.89 9.87Zm5.42-7.4c-.3-.15-1.76-.87-2.03-.97-.27-.1-.47-.15-.67.15-.2.3-.77.97-.94 1.17-.17.2-.35.22-.64.08-.3-.15-1.25-.46-2.38-1.47a8.9 8.9 0 0 1-1.65-2.05c-.17-.3-.02-.46.13-.6.13-.13.3-.34.44-.51.15-.17.2-.3.3-.5.1-.2.05-.37-.02-.52-.08-.15-.67-1.61-.92-2.2-.24-.58-.49-.5-.67-.51h-.57c-.2 0-.52.07-.8.37-.27.3-1.04 1.02-1.04 2.48 0 1.46 1.07 2.87 1.21 3.07.15.2 2.1 3.2 5.08 4.49.71.3 1.26.49 1.7.63.71.23 1.36.2 1.87.12.57-.08 1.76-.72 2-1.41.25-.7.25-1.3.18-1.42-.08-.13-.27-.2-.57-.35Z"/></svg>
                    </span>
                </div>
            </article>
        </div>
    </section>

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
