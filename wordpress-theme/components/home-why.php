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
                به‌جای خرید پراکنده،
                <span>یک انتخاب هماهنگ</span>
            </h2>

            <p class="mds-home-why__lead">
                تمام جزئیات استایل عروس را کنار هم ببینید، مقایسه کنید و مطمئن‌تر انتخاب کنید.
            </p>

            <div class="mds-home-why__comparison" aria-label="تفاوت انتخاب در گالری مظهری">
                <p>
                    <span>چند فروشگاه</span>
                    <span class="mds-home-why__comparison-arrow" aria-hidden="true">←</span>
                    <strong>یک مقصد کامل</strong>
                </p>
                <p>
                    <span>انتخاب‌های جدا</span>
                    <span class="mds-home-why__comparison-arrow" aria-hidden="true">←</span>
                    <strong>استایل هماهنگ</strong>
                </p>
                <p>
                    <span>تصمیم‌گیری سخت</span>
                    <span class="mds-home-why__comparison-arrow" aria-hidden="true">←</span>
                    <strong>مشاوره تخصصی</strong>
                </p>
            </div>

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

            <p class="mds-home-why__image-caption">
                <span lang="en">9 Collections · One Destination</span>
                <strong>از تور تا آخرین اکسسوری</strong>
            </p>
        </div>
    </div>
</section>
