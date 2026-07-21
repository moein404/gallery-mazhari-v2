<?php
/**
 * Gallery Mazhari homepage value proposition.
 *
 * Rendered by the [mazhari_home_why] shortcode.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$why_title_id = wp_unique_id( 'mds-home-why-title-' );
$why_image    = get_stylesheet_directory_uri() . '/assets/images/home-complete-selection.webp';
?>

<section
    class="mds-home-why"
    id="about"
    dir="rtl"
    aria-labelledby="<?php echo esc_attr( $why_title_id ); ?>"
>
    <div class="mds-home-why__inner mds-container">
        <div class="mds-home-why__content">
            <p class="mds-home-why__eyebrow">
                <span aria-hidden="true"></span>
                تفاوت گالری مظهری
            </p>

            <h2 class="mds-home-why__title" id="<?php echo esc_attr( $why_title_id ); ?>">
                تمام جزئیات یک استایل،
                <span>در یک مقصد</span>
            </h2>

            <p class="mds-home-why__lead">
                انتخاب عروس فقط پیدا کردن یک لباس نیست. وقتی تور، کفش، کیف، اکسسوری و زیورآلات کنار هم دیده شوند، نتیجه هماهنگ‌تر و تصمیم‌گیری مطمئن‌تر می‌شود.
            </p>

            <ol class="mds-home-why__benefits">
                <li>
                    <span class="mds-home-why__benefit-number">۱</span>
                    <div>
                        <h3>انتخاب هماهنگ، نه خرید پراکنده</h3>
                        <p>جزئیات استایل را هم‌زمان مقایسه کنید تا رنگ، فرم و حال‌وهوای همه‌چیز با هم هماهنگ باشد.</p>
                    </div>
                </li>
                <li>
                    <span class="mds-home-why__benefit-number">۲</span>
                    <div>
                        <h3>مشاوره برای ساختن یک استایل کامل</h3>
                        <p>از انتخاب قطعه اصلی تا آخرین اکسسوری، تصمیم‌ها بر اساس سلیقه و نیاز شما کنار هم قرار می‌گیرند.</p>
                    </div>
                </li>
                <li>
                    <span class="mds-home-why__benefit-number">۳</span>
                    <div>
                        <h3>از مراسم عقد تا روز عروسی</h3>
                        <p>پوشاک، ملزومات بله‌برون و اکسسوری‌های مراسم در یک مسیر یکپارچه در دسترس شماست.</p>
                    </div>
                </li>
            </ol>

            <a class="mds-btn mds-btn--primary" href="#appointment">
                دریافت مشاوره انتخاب
                <span aria-hidden="true">←</span>
            </a>
        </div>

        <div class="mds-home-why__visual">
            <div class="mds-home-why__image-frame">
                <img
                    src="<?php echo esc_url( $why_image ); ?>"
                    alt="چیدمان هماهنگ تور، تاج، زیورآلات، کفش، کیف، دسته‌گل و ملزومات عروس"
                    width="1024"
                    height="1536"
                    loading="lazy"
                    decoding="async"
                >
            </div>

            <p class="mds-home-why__image-note">
                <strong>۹ خانواده محصول</strong>
                همه‌چیز کنار هم
            </p>
        </div>
    </div>

    <div class="mds-home-why__promise" aria-label="خدمات گالری مظهری">
        <div class="mds-container">
            <p><strong>انتخاب یکپارچه</strong><span>برای تمام جزئیات عروس</span></p>
            <p><strong>مشاوره تخصصی</strong><span>متناسب با استایل شما</span></p>
            <p><strong>تنوع کامل</strong><span>از عقد تا روز عروسی</span></p>
        </div>
    </div>
</section>
