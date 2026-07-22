<?php
/**
 * Editorial clothing spotlight shown before the homepage category grid.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$clothing_spotlight_title_id = wp_unique_id( 'mds-clothing-spotlight-title-' );
$clothing_collection_url     = mazhari_get_product_category_url( 'bridal-clothing' );
$clothing_images_uri         = get_stylesheet_directory_uri() . '/assets/images/';
$clothing_collections        = array(
    'european-bridal-dresses' => 'اروپایی',
    'arabic-bridal-dresses'   => 'عربی',
    'mermaid-bridal-dresses'  => 'ماهی',
    'ceremony-suits'          => 'کت‌وشلوار عقد',
);
?>

<article
    class="mds-clothing-spotlight"
    aria-labelledby="<?php echo esc_attr( $clothing_spotlight_title_id ); ?>"
>
    <div class="mds-clothing-spotlight__content">
        <p class="mds-clothing-spotlight__eyebrow" lang="en">
            Bridal &amp; Ceremony
        </p>

        <h2
            class="mds-clothing-spotlight__title"
            id="<?php echo esc_attr( $clothing_spotlight_title_id ); ?>"
        >
            انتخاب لباس،
            <span>شروع یک استایل کامل است</span>
        </h2>

        <p class="mds-clothing-spotlight__lead">
            کالکشن‌های لباس عروس و کت‌وشلوار عقد را بر اساس فرم، سبک و حال‌وهوای مراسم ببینید.
        </p>

        <ul class="mds-clothing-spotlight__collections" aria-label="کالکشن‌های پوشاک عروس">
            <?php foreach ( $clothing_collections as $collection_slug => $collection_name ) : ?>
                <li>
                    <a href="<?php echo esc_url( mazhari_get_product_category_url( $collection_slug ) ); ?>">
                        <?php echo esc_html( $collection_name ); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>

        <div class="mds-clothing-spotlight__actions">
            <a
                class="mds-btn mds-btn--primary"
                href="<?php echo esc_url( $clothing_collection_url ); ?>"
            >
                مشاهده کالکشن‌ها
                <span aria-hidden="true">←</span>
            </a>
        </div>
    </div>

    <div class="mds-clothing-spotlight__visual" aria-hidden="true">
        <figure class="mds-clothing-spotlight__image mds-clothing-spotlight__image--dress">
            <img
                src="<?php echo esc_url( $clothing_images_uri . 'bridal-clothing.webp' ); ?>"
                alt=""
                width="720"
                height="944"
                loading="lazy"
                decoding="async"
            >
        </figure>
        <figure class="mds-clothing-spotlight__image mds-clothing-spotlight__image--suit">
            <img
                src="<?php echo esc_url( $clothing_images_uri . 'bridal-suit-soli-editorial.webp' ); ?>"
                alt=""
                width="720"
                height="960"
                loading="lazy"
                decoding="async"
            >
        </figure>
        <p class="mds-clothing-spotlight__visual-label" lang="en">
            European · Arabic · Mermaid · Ceremony Suit
        </p>
    </div>
</article>
