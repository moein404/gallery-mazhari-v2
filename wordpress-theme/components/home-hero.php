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
                گالری تخصصی لباس عروس
            </p>

            <h1 class="mds-home-hero__title" id="<?php echo esc_attr( $hero_title_id ); ?>">
                لباسی برای
                <span>زیباترین روایت شما</span>
            </h1>

            <p class="mds-home-hero__description">
                مجموعه‌ای منتخب از لباس‌های عروس با طراحی ماندگار؛ برای انتخابی شخصی، آرام و درخور لحظه‌ای که همیشه به یاد می‌ماند.
            </p>

            <div class="mds-home-hero__actions">
                <a class="mds-btn mds-btn--primary" href="<?php echo esc_url( $home_url . '#collections' ); ?>">
                    مشاهده کالکشن‌ها
                    <span aria-hidden="true">←</span>
                </a>
                <a class="mds-btn mds-btn--secondary" href="<?php echo esc_url( $home_url . '#appointment' ); ?>">
                    رزرو مشاوره
                </a>
            </div>

            <ul class="mds-home-hero__features" aria-label="مزایای گالری مظهری">
                <li>مشاوره تخصصی</li>
                <li>انتخاب شخصی‌سازی‌شده</li>
                <li>پرو با آرامش</li>
            </ul>
        </div>

        <div class="mds-home-hero__visual">
            <div class="mds-home-hero__image-frame">
                <img
                    src="<?php echo esc_url( $hero_image ); ?>"
                    alt="عروس با لباس بلند و ظریف در فضای روشن"
                    width="1003"
                    height="1568"
                    fetchpriority="high"
                    decoding="async"
                >
            </div>

            <p class="mds-home-hero__image-note">
                <span>کالکشن منتخب</span>
                ۱۴۰۵
            </p>
        </div>
    </div>
</section>
