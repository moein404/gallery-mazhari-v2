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
                از سال ۱۳۳۷
            </p>

            <h2 class="mds-home-why__title" id="<?php echo esc_attr( $why_title_id ); ?>">
                تجربه‌ای که با شناخت عروس شکل گرفته؛
                <span>و هنوز شخصی باقی مانده است</span>
            </h2>

            <p class="mds-home-why__lead">
                گالری مظهری نسل‌هاست که انتخاب عروس را نه یک خرید ساده، بلکه ساختن تصویری کامل برای یک روز ماندگار می‌داند.
            </p>

            <ul class="mds-home-why__proofs" aria-label="اعتماد به گالری مظهری">
                <li><strong>مشاوره تخصصی</strong><span>برای انتخابی متناسب با شما و مراسمتان</span></li>
                <li><strong>مجموعه کامل</strong><span>از قطعه اصلی تا آخرین جزئیات استایل</span></li>
                <li><strong>دو شعبه حضوری</strong><span>برای دیدن، مقایسه‌کردن و انتخاب مطمئن‌تر</span></li>
            </ul>
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

            <p class="mds-home-why__image-caption">
                <span lang="en">Since 1337 · Gallery Mazhari</span>
                <strong>انتخاب حرفه‌ای، تجربه‌ای شخصی</strong>
            </p>
        </div>
    </div>
</section>
