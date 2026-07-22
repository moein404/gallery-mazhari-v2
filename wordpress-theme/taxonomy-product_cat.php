<?php
/**
 * Premium WooCommerce product-category archive.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();

$home_url         = home_url( '/' );
$current_category = get_queried_object();
$category_name    = $current_category instanceof WP_Term
    ? $current_category->name
    : single_term_title( '', false );
$category_slug    = $current_category instanceof WP_Term
    ? $current_category->slug
    : '';
$category_id      = $current_category instanceof WP_Term
    ? (int) $current_category->term_id
    : 0;
$category_intro   = $current_category instanceof WP_Term
    ? term_description( $current_category->term_id, 'product_cat' )
    : '';
$category_intro   = trim( wp_strip_all_tags( $category_intro ) );

$category_children = $category_id
    ? get_terms(
        array(
            'taxonomy'   => 'product_cat',
            'parent'     => $category_id,
            'hide_empty' => false,
            'orderby'    => 'term_id',
            'order'      => 'ASC',
        )
    )
    : array();

if ( is_wp_error( $category_children ) ) {
    $category_children = array();
}

$top_category = $current_category;

if ( $current_category instanceof WP_Term && $current_category->parent ) {
    $ancestor_ids = get_ancestors( $current_category->term_id, 'product_cat', 'taxonomy' );
    $top_id       = $ancestor_ids ? (int) end( $ancestor_ids ) : 0;
    $top_term     = $top_id ? get_term( $top_id, 'product_cat' ) : false;

    if ( $top_term instanceof WP_Term ) {
        $top_category = $top_term;
    }
}

$category_images = array(
    'bridal-clothing'                  => 'bridal-clothing.webp',
    'bridal-veils'                     => 'bridal-veils.webp',
    'bridal-shoes-bags'                => 'bridal-shoes-bags.webp',
    'bridal-hair-accessories'          => 'bridal-hair-accessories.webp',
    'bridal-jewelry'                   => 'bridal-jewelry.webp',
    'bridal-headwear'                  => 'bridal-headwear.webp',
    'artificial-bridal-bouquets'       => 'artificial-bridal-bouquets.webp',
    'special-bridal-accessories'       => 'special-bridal-accessories.webp',
    'engagement-ceremony-essentials'   => 'engagement-ceremony-essentials.webp',
);

$hero_image_url = '';
$thumbnail_id   = $category_id ? (int) get_term_meta( $category_id, 'thumbnail_id', true ) : 0;

if ( $thumbnail_id ) {
    $hero_image_url = wp_get_attachment_image_url( $thumbnail_id, 'large' );
}

if ( ! $hero_image_url && $top_category instanceof WP_Term && isset( $category_images[ $top_category->slug ] ) ) {
    $hero_image_url = get_stylesheet_directory_uri()
        . '/assets/images/'
        . $category_images[ $top_category->slug ];
}

$breadcrumbs = array();

if ( $current_category instanceof WP_Term ) {
    $ancestor_ids = array_reverse(
        get_ancestors( $current_category->term_id, 'product_cat', 'taxonomy' )
    );

    foreach ( $ancestor_ids as $ancestor_id ) {
        $ancestor = get_term( $ancestor_id, 'product_cat' );

        if ( ! $ancestor instanceof WP_Term ) {
            continue;
        }

        $ancestor_url = get_term_link( $ancestor );

        if ( is_wp_error( $ancestor_url ) ) {
            continue;
        }

        $breadcrumbs[] = array(
            'name' => $ancestor->name,
            'url'  => $ancestor_url,
        );
    }
}
?>

<main class="mds-category-archive" id="main-content" dir="rtl">
    <section class="mds-category-archive__hero" aria-labelledby="mds-category-archive-title">
        <div class="mds-category-archive__hero-inner mds-container">
            <div class="mds-category-archive__hero-content">
                <nav class="mds-category-archive__breadcrumb" aria-label="مسیر صفحه">
                    <a href="<?php echo esc_url( $home_url ); ?>">خانه</a>
                    <span aria-hidden="true">/</span>
                    <?php foreach ( $breadcrumbs as $breadcrumb ) : ?>
                        <a href="<?php echo esc_url( $breadcrumb['url'] ); ?>">
                            <?php echo esc_html( $breadcrumb['name'] ); ?>
                        </a>
                        <span aria-hidden="true">/</span>
                    <?php endforeach; ?>
                    <span aria-current="page"><?php echo esc_html( $category_name ); ?></span>
                </nav>

                <p class="mds-category-archive__eyebrow" lang="en">Gallery Mazhari Collection</p>
                <h1 id="mds-category-archive-title"><?php echo esc_html( $category_name ); ?></h1>

                <?php if ( $category_intro ) : ?>
                    <p class="mds-category-archive__lead"><?php echo esc_html( $category_intro ); ?></p>
                <?php else : ?>
                    <p class="mds-category-archive__lead">
                        مجموعه‌ای منتخب برای ساختن استایلی هماهنگ، شخصی و ماندگار.
                    </p>
                <?php endif; ?>

                <a class="mds-category-archive__hero-link" href="#category-collection">
                    مشاهده مجموعه
                    <span aria-hidden="true">↓</span>
                </a>
            </div>

            <?php if ( $hero_image_url ) : ?>
                <figure class="mds-category-archive__hero-visual">
                    <img
                        src="<?php echo esc_url( $hero_image_url ); ?>"
                        alt="<?php echo esc_attr( 'مجموعه ' . $category_name . ' گالری مظهری' ); ?>"
                        width="720"
                        height="960"
                        fetchpriority="high"
                        decoding="async"
                    >
                    <span aria-hidden="true"></span>
                    <figcaption lang="en">Since 1337 · Tehran</figcaption>
                </figure>
            <?php endif; ?>
        </div>
    </section>

    <?php if ( $category_children ) : ?>
        <section class="mds-category-archive__subcategories" aria-labelledby="mds-category-subcategories-title">
            <div class="mds-container">
                <header class="mds-category-archive__section-heading">
                    <p lang="en">Explore the Collection</p>
                    <h2 id="mds-category-subcategories-title">انتخاب دقیق‌تر، در مسیر کوتاه‌تر</h2>
                    <span>زیرمجموعه موردنظرتان را انتخاب کنید.</span>
                </header>

                <div class="mds-category-archive__subcategory-grid">
                    <?php foreach ( $category_children as $index => $child_category ) : ?>
                        <?php
                        $child_url = get_term_link( $child_category );

                        if ( is_wp_error( $child_url ) ) {
                            continue;
                        }

                        $grandchildren = get_terms(
                            array(
                                'taxonomy'   => 'product_cat',
                                'parent'     => $child_category->term_id,
                                'hide_empty' => false,
                                'orderby'    => 'term_id',
                                'order'      => 'ASC',
                            )
                        );

                        if ( is_wp_error( $grandchildren ) ) {
                            $grandchildren = array();
                        }
                        ?>
                        <article class="mds-category-subcard<?php echo 0 === $index ? ' is-featured' : ''; ?>">
                            <span class="mds-category-subcard__number" aria-hidden="true">
                                <?php echo esc_html( str_pad( (string) ( $index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?>
                            </span>
                            <h3>
                                <a href="<?php echo esc_url( $child_url ); ?>">
                                    <?php echo esc_html( $child_category->name ); ?>
                                </a>
                            </h3>

                            <?php if ( $child_category->description ) : ?>
                                <p><?php echo esc_html( $child_category->description ); ?></p>
                            <?php endif; ?>

                            <?php if ( $grandchildren ) : ?>
                                <div class="mds-category-subcard__children" aria-label="زیرمجموعه‌های <?php echo esc_attr( $child_category->name ); ?>">
                                    <?php foreach ( $grandchildren as $grandchild ) : ?>
                                        <?php $grandchild_url = get_term_link( $grandchild ); ?>
                                        <?php if ( ! is_wp_error( $grandchild_url ) ) : ?>
                                            <a href="<?php echo esc_url( $grandchild_url ); ?>">
                                                <?php echo esc_html( $grandchild->name ); ?>
                                            </a>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>

                            <a class="mds-category-subcard__link" href="<?php echo esc_url( $child_url ); ?>">
                                مشاهده مجموعه
                                <span aria-hidden="true">←</span>
                            </a>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <section class="mds-category-archive__collection" id="category-collection" aria-labelledby="mds-category-products-title">
        <div class="mds-container">
            <header class="mds-category-archive__collection-heading">
                <div>
                    <p lang="en">The Collection</p>
                    <h2 id="mds-category-products-title">محصولات <?php echo esc_html( $category_name ); ?></h2>
                </div>

                <?php if ( have_posts() ) : ?>
                    <div class="mds-category-archive__toolbar">
                        <?php woocommerce_result_count(); ?>
                        <?php woocommerce_catalog_ordering(); ?>
                    </div>
                <?php endif; ?>
            </header>

            <?php if ( have_posts() ) : ?>
                <div class="mds-product-grid mds-category-archive__product-grid">
                    <?php while ( have_posts() ) : ?>
                        <?php
                        the_post();
                        $wc_product = wc_get_product( get_the_ID() );

                        if ( ! $wc_product ) {
                            continue;
                        }

                        $product_image_id = $wc_product->get_image_id();
                        $product_image    = $product_image_id
                            ? wp_get_attachment_image_url( $product_image_id, 'woocommerce_thumbnail' )
                            : '';
                        $product_alt      = $product_image_id
                            ? get_post_meta( $product_image_id, '_wp_attachment_image_alt', true )
                            : '';
                        $product_created  = $wc_product->get_date_created();
                        $product_badge    = '';
                        $badge_variant    = 'default';

                        if ( $wc_product->is_on_sale() ) {
                            $product_badge = 'ویژه';
                            $badge_variant = 'sale';
                        } elseif ( $wc_product->is_featured() ) {
                            $product_badge = 'منتخب';
                            $badge_variant = 'bestseller';
                        } elseif ( $product_created && $product_created->getTimestamp() > strtotime( '-30 days' ) ) {
                            $product_badge = 'جدید';
                            $badge_variant = 'new';
                        }

                        $args = array(
                            'title'         => $wc_product->get_name(),
                            'meta'          => $category_name,
                            'badge'         => $product_badge,
                            'badge_variant' => $badge_variant,
                            'image'         => $product_image,
                            'image_alt'     => $product_alt ?: $wc_product->get_name(),
                            'price'         => $wc_product->get_price_html(),
                            'url'           => $wc_product->get_permalink(),
                        );

                        include get_stylesheet_directory() . '/components/product-card.php';
                        unset( $args );
                        ?>
                    <?php endwhile; ?>
                </div>

                <?php
                the_posts_pagination(
                    array(
                        'mid_size'  => 1,
                        'prev_text' => 'قبلی',
                        'next_text' => 'بعدی',
                    )
                );
                ?>
            <?php else : ?>
                <div class="mds-category-archive__empty">
                    <p lang="en">A Collection in Progress</p>
                    <h2>انتخاب‌های این مجموعه در حال تکمیل است.</h2>
                    <span>
                        برای دیدن مدل‌های موجود یا انتخاب هماهنگ با مراسمتان، با متخصصان گالری در ارتباط باشید.
                    </span>
                    <a class="mds-btn mds-btn--primary" href="<?php echo esc_url( $home_url . '#appointment' ); ?>">
                        راهنمایی برای انتخاب
                        <span aria-hidden="true">←</span>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php
get_footer();
