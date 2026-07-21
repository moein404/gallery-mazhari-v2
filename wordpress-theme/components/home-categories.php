<?php
/**
 * Gallery Mazhari homepage category showcase.
 *
 * Rendered by the [mazhari_home_categories] shortcode.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$categories_title_id = wp_unique_id( 'mds-home-categories-title-' );
$category_images_uri = get_stylesheet_directory_uri() . '/assets/images/categories/';
$categories          = array(
    array(
        'number'      => '۰۱',
        'slug'        => 'bridal-clothing',
        'image'       => 'bridal-clothing.webp',
        'title'       => 'پوشاک عروس',
        'description' => 'لباس عروس اروپایی، عربی و ماهی؛ کت‌وشلوار عقد، شنل، دستکش و روبدوشامبر',
    ),
    array(
        'number'      => '۰۲',
        'slug'        => 'bridal-veils',
        'image'       => 'bridal-veils.webp',
        'title'       => 'تور سر',
        'description' => 'مدل‌های متنوع برای تکمیل فرم لباس و استایل مو',
    ),
    array(
        'number'      => '۰۳',
        'slug'        => 'bridal-shoes-bags',
        'image'       => 'bridal-shoes-bags.webp',
        'title'       => 'کفش، کتونی و کیف',
        'description' => 'انتخاب‌های راحت و هماهنگ برای مراسم و فرمالیته',
    ),
    array(
        'number'      => '۰۴',
        'slug'        => 'bridal-hair-accessories',
        'image'       => 'bridal-hair-accessories.webp',
        'title'       => 'اکسسوری مو',
        'description' => 'تاج، تل، ریسه ایرانی و وارداتی، سنجاق شینیون و حلقه گل',
    ),
    array(
        'number'      => '۰۵',
        'slug'        => 'bridal-jewelry',
        'image'       => 'bridal-jewelry.webp',
        'title'       => 'زیورآلات',
        'description' => 'سرویس، نیم‌ست، گوشواره، انگشتر، پابند، دستبند و سنجاق سینه',
    ),
    array(
        'number'      => '۰۶',
        'slug'        => 'bridal-headwear',
        'image'       => 'bridal-headwear.webp',
        'title'       => 'حجاب مو',
        'description' => 'کلاه و کاپ کلاه، چادر عروس، توربان و هدشال',
    ),
    array(
        'number'      => '۰۷',
        'slug'        => 'artificial-bridal-bouquets',
        'image'       => 'artificial-bridal-bouquets.webp',
        'title'       => 'دسته‌گل مصنوعی',
        'description' => 'ترکیب‌های ماندگار و ظریف، هماهنگ با رنگ و حال‌وهوای مراسم',
    ),
    array(
        'number'      => '۰۸',
        'slug'        => 'special-bridal-accessories',
        'image'       => 'special-bridal-accessories.webp',
        'title'       => 'اکسسوری خاص عروس',
        'description' => 'جزئیات متفاوت برای شخصی‌سازی استایل و ساختن امضای شما',
    ),
    array(
        'number'      => '۰۹',
        'slug'        => 'engagement-ceremony-essentials',
        'image'       => 'engagement-ceremony-essentials.webp',
        'title'       => 'ملزومات عقد و بله‌برون',
        'description' => 'ست بله‌برون و سبدهای سه‌سایز برای یک چیدمان کامل و هماهنگ',
    ),
);
?>

<section
    class="mds-home-categories"
    id="collections"
    dir="rtl"
    aria-labelledby="<?php echo esc_attr( $categories_title_id ); ?>"
>
    <div class="mds-home-categories__inner mds-container">
        <header class="mds-home-categories__header">
            <p class="mds-home-categories__eyebrow" lang="en">
                Collections <span aria-hidden="true">09</span>
            </p>
            <h2 class="mds-home-categories__title" id="<?php echo esc_attr( $categories_title_id ); ?>">
                دسته‌بندی محصولات
            </h2>
        </header>

        <div class="mds-home-categories__grid">
            <?php foreach ( $categories as $category ) : ?>
                <a
                    class="mds-category-card"
                    href="<?php echo esc_url( mazhari_get_product_category_url( $category['slug'] ) ); ?>"
                    aria-label="<?php echo esc_attr( 'مشاهده محصولات ' . $category['title'] ); ?>"
                >
                    <img
                        class="mds-category-card__image"
                        src="<?php echo esc_url( $category_images_uri . $category['image'] ); ?>"
                        alt=""
                        width="720"
                        height="960"
                        loading="lazy"
                        decoding="async"
                    >

                    <span class="mds-category-card__number" aria-hidden="true"><?php echo esc_html( $category['number'] ); ?></span>

                    <div class="mds-category-card__content">
                        <h3><?php echo esc_html( $category['title'] ); ?></h3>
                        <p><?php echo esc_html( $category['description'] ); ?></p>
                    </div>

                    <span class="mds-category-card__arrow" aria-hidden="true">↖</span>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
