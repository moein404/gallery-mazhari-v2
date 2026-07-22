<?php
/**
 * Dynamic homepage showcase for special bridal accessories.
 *
 * Included directly after the homepage category grid.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$special_title_id     = wp_unique_id( 'mds-home-special-title-' );
$special_category_url = mazhari_get_product_category_url( 'special-bridal-accessories' );
$special_products     = array();

if ( function_exists( 'wc_get_product' ) && taxonomy_exists( 'product_cat' ) ) {
    $special_product_query = new WP_Query(
        array(
            'post_type'              => 'product',
            'post_status'            => 'publish',
            'posts_per_page'         => 10,
            'fields'                 => 'ids',
            'orderby'                => 'date',
            'order'                  => 'DESC',
            'no_found_rows'          => true,
            'update_post_meta_cache' => false,
            'update_post_term_cache' => false,
            'tax_query'              => array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
                array(
                    'taxonomy'         => 'product_cat',
                    'field'            => 'slug',
                    'terms'            => array( 'special-bridal-accessories' ),
                    'include_children' => true,
                ),
            ),
        )
    );

    foreach ( $special_product_query->posts as $special_product_id ) {
        $special_product = wc_get_product( $special_product_id );

        if ( ! $special_product || ! $special_product->is_visible() ) {
            continue;
        }

        $special_products[] = $special_product;

        if ( 6 === count( $special_products ) ) {
            break;
        }
    }
}

if ( ! $special_products ) {
    return;
}
?>

<section
    class="mds-home-special"
    aria-labelledby="<?php echo esc_attr( $special_title_id ); ?>"
    dir="rtl"
>
    <div class="mds-home-special__inner mds-container">
        <header class="mds-home-special__header">
            <p class="mds-home-special__eyebrow" lang="en">
                The Finishing Touch
            </p>
            <h2 class="mds-home-special__title" id="<?php echo esc_attr( $special_title_id ); ?>">
                جزئیاتی که استایل را امضا می‌کنند
            </h2>
            <p class="mds-home-special__lead">
                بادبزن و اکسسوری‌های خاص؛ برای اینکه چیزی از قلم نیفتد.
            </p>
        </header>

        <div
            class="mds-home-special__track has-products"
            aria-label="اکسسوری‌های خاص عروس"
        >
            <?php foreach ( $special_products as $special_product ) : ?>
                <?php
                $special_product_name = $special_product->get_name();
                $special_product_url  = $special_product->get_permalink();
                $special_image_id     = $special_product->get_image_id();
                ?>
                <a
                    class="mds-special-card mds-special-card--product"
                    href="<?php echo esc_url( $special_product_url ); ?>"
                    aria-label="<?php echo esc_attr( 'مشاهده ' . $special_product_name ); ?>"
                >
                    <?php if ( $special_image_id ) : ?>
                        <?php
                        echo wp_get_attachment_image(
                            $special_image_id,
                            'woocommerce_thumbnail',
                            false,
                            array(
                                'class'    => 'mds-special-card__image',
                                'alt'      => $special_product_name,
                                'loading'  => 'lazy',
                                'decoding' => 'async',
                            )
                        );
                        ?>
                    <?php else : ?>
                        <img
                            class="mds-special-card__image"
                            src="<?php echo esc_url( wc_placeholder_img_src( 'woocommerce_thumbnail' ) ); ?>"
                            alt=""
                            loading="lazy"
                            decoding="async"
                        >
                    <?php endif; ?>

                    <span class="mds-special-card__shade" aria-hidden="true"></span>

                    <div class="mds-special-card__content">
                        <span>اکسسوری خاص</span>
                        <h3><?php echo esc_html( $special_product_name ); ?></h3>
                        <?php if ( $special_product->get_price_html() ) : ?>
                            <p class="mds-special-card__price">
                                <?php echo wp_kses_post( $special_product->get_price_html() ); ?>
                            </p>
                        <?php endif; ?>
                    </div>
                </a>
            <?php endforeach; ?>

            <a
                class="mds-special-card mds-special-card--more"
                href="<?php echo esc_url( $special_category_url ); ?>"
                aria-label="مشاهده همه اکسسوری‌های خاص عروس"
            >
                <span class="mds-special-card__more-label" lang="en">Discover More</span>
                <div>
                    <h3>ادامه مجموعه</h3>
                    <p>همه اکسسوری‌های خاص عروس</p>
                </div>
                <span class="mds-special-card__more-arrow" aria-hidden="true">←</span>
            </a>
        </div>
    </div>
</section>
