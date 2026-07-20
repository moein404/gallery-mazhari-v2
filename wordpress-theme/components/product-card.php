<?php
/**
 * Gallery Mazhari
 * Reusable Product Card Component
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/*
 * اطلاعاتی که هنگام فراخوانی کارت دریافت می‌شوند.
 * اگر اطلاعاتی ارسال نشود، مقادیر آزمایشی زیر نمایش داده می‌شوند.
 */
$args = isset( $args ) && is_array( $args ) ? $args : array();

$product = wp_parse_args(
    $args,
    array(
        'title'     => 'لباس عروس Signature',
        'meta'      => 'کالکشن اروپایی',
        'badge'     => 'جدید',
        'image'     => 'https://placehold.co/600x750',
        'image_alt' => 'لباس عروس Signature',
        'url'       => '#',
    )
);
?>

<article class="mds-product-card">

    <a
        class="mds-product-media"
        href="<?php echo esc_url( $product['url'] ); ?>"
        aria-label="<?php echo esc_attr( $product['title'] ); ?>"
    >
        <img
            src="<?php echo esc_url( $product['image'] ); ?>"
            alt="<?php echo esc_attr( $product['image_alt'] ); ?>"
            loading="lazy"
        >
    </a>

    <div class="mds-product-content">

        <?php if ( ! empty( $product['badge'] ) ) : ?>

            <div class="mds-product-badges">

                <span class="mds-badge">
                    <?php echo esc_html( $product['badge'] ); ?>
                </span>

            </div>

        <?php endif; ?>

        <h3 class="mds-product-title">

            <a href="<?php echo esc_url( $product['url'] ); ?>">
                <?php echo esc_html( $product['title'] ); ?>
            </a>

        </h3>

        <?php if ( ! empty( $product['meta'] ) ) : ?>

            <div class="mds-product-meta">
                <?php echo esc_html( $product['meta'] ); ?>
            </div>

        <?php endif; ?>

        <a
            href="<?php echo esc_url( $product['url'] ); ?>"
            class="mds-button mds-button-text"
        >
            مشاهده محصول
            <span aria-hidden="true">←</span>
        </a>

    </div>

</article>
