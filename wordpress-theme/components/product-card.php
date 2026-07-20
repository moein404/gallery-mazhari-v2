<?php
/**
 * Gallery Mazhari
 * Reusable Product Card Component
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$args = isset( $args ) && is_array( $args ) ? $args : array();

$product = wp_parse_args(
    $args,
    array(
        'title'         => 'لباس عروس Signature',
        'meta'          => 'کالکشن اروپایی',
        'badge'         => 'جدید',
        'badge_variant' => 'new',
        'image'         => 'https://placehold.co/600x750',
        'image_alt'     => 'لباس عروس Signature',
        'url'           => '#',
    )
);
?>

<article class="mds-product-card">

    <a
        class="mds-product-card__media"
        href="<?php echo esc_url( $product['url'] ); ?>"
        aria-label="<?php echo esc_attr( $product['title'] ); ?>"
    >
        <img
            src="<?php echo esc_url( $product['image'] ); ?>"
            alt="<?php echo esc_attr( $product['image_alt'] ); ?>"
            loading="lazy"
        >

        <?php if ( ! empty( $product['badge'] ) ) : ?>

            <span class="mds-product-card__badge">
                <?php
                $badge_args = array(
                    'label'   => $product['badge'],
                    'variant' => $product['badge_variant'],
                );

                include __DIR__ . '/badge.php';

                unset( $badge_args );
                ?>
            </span>

        <?php endif; ?>
    </a>

    <div class="mds-product-card__content">

        <?php if ( ! empty( $product['meta'] ) ) : ?>

            <div class="mds-product-card__category">
                <?php echo esc_html( $product['meta'] ); ?>
            </div>

        <?php endif; ?>

        <h3 class="mds-product-card__title">

            <a href="<?php echo esc_url( $product['url'] ); ?>">
                <?php echo esc_html( $product['title'] ); ?>
            </a>

        </h3>

        <a
            href="<?php echo esc_url( $product['url'] ); ?>"
            class="mds-btn mds-btn--text"
        >
            مشاهده محصول
            <span aria-hidden="true">←</span>
        </a>

    </div>

</article>
