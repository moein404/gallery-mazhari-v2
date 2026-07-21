<?php
/**
 * Gallery Mazhari homepage hero.
 *
 * Rendered by the [mazhari_home_hero] shortcode inside the Bricks Home page.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$hero_title_id = wp_unique_id( 'mds-home-hero-title-' );
$home_url      = home_url( '/' );
$hero_image    = get_stylesheet_directory_uri() . '/assets/images/home-hero-bride.webp';
?>

<section class="mds-home-hero" aria-labelledby="<?php echo esc_attr( $hero_title_id ); ?>">
    <div class="mds-home-hero__inner mds-container">
        <div class="mds-home-hero__content">
            <p class="mds-home-hero__eyebrow">
                <span aria-hidden="true"></span>
                مرجع کامل محصولات عروس
            </p>

            <h1 class="mds-home-hero__title" id="<?php echo esc_attr( $hero_title_id ); ?>">
                انتخابی برای یک روز؛
                <span>خاطره‌ای برای تمام عمر</span>
            </h1>

            <p class="mds-home-hero__description">
                از پوشاک و تور سر تا کفش، کیف، اکسسوری مو، زیورآلات و ملزومات عقد؛ مجموعه‌ای کامل برای ساختن هماهنگ‌ترین انتخاب عروس.
            </p>

            <div class="mds-home-hero__actions">
                <a class="mds-btn mds-btn--primary" href="<?php echo esc_url( $home_url . '#collections' ); ?>">
                    مشاهده دسته‌بندی‌ها
                    <span aria-hidden="true">←</span>
                </a>
            </div>

            <p class="mds-home-hero__signature" lang="en">
                The Bridal Edit <span aria-hidden="true">·</span> Gallery Mazhari
            </p>
        </div>

        <div class="mds-home-hero__visual">
            <div class="mds-home-hero__image-frame">
                <img
                    src="<?php echo esc_url( $hero_image ); ?>"
                    alt="عروس با استایل کامل و ظریف در فضای روشن"
                    width="1003"
                    height="1568"
                    fetchpriority="high"
                    decoding="async"
                >
            </div>
        </div>
    </div>
</section>
