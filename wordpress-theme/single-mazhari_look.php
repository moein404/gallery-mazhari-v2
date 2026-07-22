<?php
/**
 * Single editorial Curated Look template.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();

while ( have_posts() ) :
    the_post();

    $look_id           = get_the_ID();
    $look_title        = get_the_title();
    $look_excerpt      = get_the_excerpt();
    $look_style        = get_post_meta( $look_id, '_mazhari_look_style', true );
    $look_mood         = get_post_meta( $look_id, '_mazhari_look_mood', true );
    $look_ceremony     = get_post_meta( $look_id, '_mazhari_look_ceremony', true );
    $look_suitable_for = get_post_meta( $look_id, '_mazhari_look_suitable_for', true );
    $product_ids_raw   = get_post_meta( $look_id, '_mazhari_look_product_ids', true );
    $product_ids       = array_values(
        array_unique(
            array_filter(
                array_map(
                    'absint',
                    preg_split( '/[\s,]+/', (string) $product_ids_raw )
                )
            )
        )
    );
    $look_products     = array();
    $archive_url       = get_post_type_archive_link( 'mazhari_look' );
    $home_url          = home_url( '/' );
    $all_look_ids      = get_posts(
        array(
            'post_type'      => 'mazhari_look',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'fields'         => 'ids',
            'orderby'        => array(
                'menu_order' => 'ASC',
                'date'       => 'DESC',
            ),
        )
    );
    $next_look_id      = 0;

    if ( function_exists( 'wc_get_product' ) ) {
        foreach ( $product_ids as $product_id ) {
            $look_product = wc_get_product( $product_id );

            if ( $look_product && $look_product->is_visible() ) {
                $look_products[] = $look_product;
            }
        }
    }

    if ( count( $all_look_ids ) > 1 ) {
        $current_position = array_search( $look_id, $all_look_ids, true );

        if ( false !== $current_position ) {
            $next_position = ( $current_position + 1 ) % count( $all_look_ids );
            $next_look_id  = (int) $all_look_ids[ $next_position ];
        }
    }
    ?>

    <main class="mds-look" id="main-content" dir="rtl">
        <nav class="mds-look__breadcrumb mds-container" aria-label="مسیر صفحه">
            <a href="<?php echo esc_url( $home_url ); ?>">خانه</a>
            <span aria-hidden="true">/</span>
            <?php if ( $archive_url ) : ?>
                <a href="<?php echo esc_url( $archive_url ); ?>">استایل‌های منتخب</a>
                <span aria-hidden="true">/</span>
            <?php endif; ?>
            <span aria-current="page"><?php echo esc_html( $look_title ); ?></span>
        </nav>

        <section class="mds-look-hero" aria-labelledby="mds-look-title">
            <div class="mds-look-hero__inner mds-container">
                <figure class="mds-look-hero__visual">
                    <?php
                    echo get_the_post_thumbnail(
                        $look_id,
                        'full',
                        array(
                            'class'         => 'mds-look-hero__image',
                            'alt'           => $look_title,
                            'decoding'      => 'async',
                            'fetchpriority' => 'high',
                        )
                    );
                    ?>
                    <figcaption lang="en">
                        Gallery Mazhari · Curated Look
                    </figcaption>
                </figure>

                <div class="mds-look-hero__content">
                    <p class="mds-look-hero__eyebrow" lang="en">The Curated Look</p>
                    <h1 id="mds-look-title"><?php echo esc_html( $look_title ); ?></h1>

                    <?php if ( $look_excerpt ) : ?>
                        <p class="mds-look-hero__lead"><?php echo esc_html( $look_excerpt ); ?></p>
                    <?php endif; ?>

                    <dl class="mds-look-hero__facts">
                        <?php if ( $look_style ) : ?>
                            <div><dt>سبک</dt><dd lang="en"><?php echo esc_html( $look_style ); ?></dd></div>
                        <?php endif; ?>
                        <?php if ( $look_mood ) : ?>
                            <div><dt>حال‌وهوا</dt><dd><?php echo esc_html( $look_mood ); ?></dd></div>
                        <?php endif; ?>
                        <?php if ( $look_ceremony ) : ?>
                            <div><dt>مراسم پیشنهادی</dt><dd><?php echo esc_html( $look_ceremony ); ?></dd></div>
                        <?php endif; ?>
                    </dl>

                    <div class="mds-look-hero__actions">
                        <a class="mds-btn mds-btn--primary" href="<?php echo esc_url( $home_url . '#appointment' ); ?>">
                            مشاوره برای این استایل
                            <span aria-hidden="true">←</span>
                        </a>
                        <?php if ( $archive_url ) : ?>
                            <a class="mds-look-hero__back" href="<?php echo esc_url( $archive_url ); ?>">
                                همه استایل‌ها
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>

        <section class="mds-look-story" aria-labelledby="mds-look-story-title">
            <div class="mds-look-story__inner mds-container">
                <header>
                    <span aria-hidden="true">01</span>
                    <p lang="en">The Story</p>
                    <h2 id="mds-look-story-title">روایت این انتخاب</h2>
                </header>

                <div class="mds-look-story__body">
                    <?php the_content(); ?>
                </div>

                <?php if ( $look_suitable_for ) : ?>
                    <aside class="mds-look-story__suitable">
                        <span>برای چه عروسی؟</span>
                        <p><?php echo esc_html( $look_suitable_for ); ?></p>
                    </aside>
                <?php endif; ?>
            </div>
        </section>

        <?php if ( $look_products ) : ?>
            <section class="mds-look-products" aria-labelledby="mds-look-products-title">
                <div class="mds-look-products__inner mds-container">
                    <header>
                        <p lang="en">Complete The Look</p>
                        <h2 id="mds-look-products-title">اجزای این استایل</h2>
                        <span>هر قطعه برای ساختن یک تصویر هماهنگ انتخاب شده است.</span>
                    </header>

                    <div class="mds-look-products__grid">
                        <?php foreach ( $look_products as $look_product ) : ?>
                            <?php
                            $product_name     = $look_product->get_name();
                            $product_url      = $look_product->get_permalink();
                            $product_image_id = $look_product->get_image_id();
                            ?>
                            <article class="mds-look-product-card">
                                <a href="<?php echo esc_url( $product_url ); ?>">
                                    <figure>
                                        <?php if ( $product_image_id ) : ?>
                                            <?php
                                            echo wp_get_attachment_image(
                                                $product_image_id,
                                                'woocommerce_thumbnail',
                                                false,
                                                array(
                                                    'alt'      => $product_name,
                                                    'loading'  => 'lazy',
                                                    'decoding' => 'async',
                                                )
                                            );
                                            ?>
                                        <?php endif; ?>
                                    </figure>
                                    <div>
                                        <h3><?php echo esc_html( $product_name ); ?></h3>
                                        <?php if ( $look_product->get_price_html() ) : ?>
                                            <p><?php echo wp_kses_post( $look_product->get_price_html() ); ?></p>
                                        <?php endif; ?>
                                        <span>مشاهده محصول ←</span>
                                    </div>
                                </a>
                            </article>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <?php if ( $next_look_id && $next_look_id !== $look_id ) : ?>
            <section class="mds-look-next" aria-label="استایل منتخب بعدی">
                <a href="<?php echo esc_url( get_permalink( $next_look_id ) ); ?>">
                    <?php
                    echo get_the_post_thumbnail(
                        $next_look_id,
                        'large',
                        array(
                            'alt'      => get_the_title( $next_look_id ),
                            'loading'  => 'lazy',
                            'decoding' => 'async',
                        )
                    );
                    ?>
                    <span class="mds-look-next__shade" aria-hidden="true"></span>
                    <span class="mds-look-next__content">
                        <small>استایل بعدی</small>
                        <strong><?php echo esc_html( get_the_title( $next_look_id ) ); ?></strong>
                        <em>مشاهده روایت کامل ←</em>
                    </span>
                </a>
            </section>
        <?php endif; ?>
    </main>
    <?php
endwhile;

get_footer();
