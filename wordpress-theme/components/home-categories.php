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
$categories          = array(
    array(
        'number'      => '۰۱',
        'slug'        => 'bridal-clothing',
        'title'       => 'پوشاک عروس',
        'description' => 'لباس عروس اروپایی، عربی و ماهی؛ کت‌وشلوار عقد، شنل، دستکش و روبدوشامبر',
        'featured'    => true,
    ),
    array(
        'number'      => '۰۲',
        'slug'        => 'bridal-veils',
        'title'       => 'تور سر',
        'description' => 'مدل‌های متنوع برای تکمیل فرم لباس و استایل مو',
    ),
    array(
        'number'      => '۰۳',
        'slug'        => 'bridal-shoes-bags',
        'title'       => 'کفش، کتونی و کیف',
        'description' => 'انتخاب‌های راحت و هماهنگ برای مراسم و فرمالیته',
    ),
    array(
        'number'      => '۰۴',
        'slug'        => 'bridal-hair-accessories',
        'title'       => 'اکسسوری مو',
        'description' => 'تاج، تل، ریسه ایرانی و وارداتی، سنجاق شینیون و حلقه گل',
    ),
    array(
        'number'      => '۰۵',
        'slug'        => 'bridal-jewelry',
        'title'       => 'زیورآلات',
        'description' => 'سرویس، نیم‌ست، گوشواره، انگشتر، پابند، دستبند و سنجاق سینه',
    ),
    array(
        'number'      => '۰۶',
        'slug'        => 'bridal-headwear',
        'title'       => 'حجاب مو',
        'description' => 'کلاه و کاپ کلاه، چادر عروس، توربان و هدشال',
    ),
    array(
        'number'      => '۰۷',
        'slug'        => 'artificial-bridal-bouquets',
        'title'       => 'دسته‌گل مصنوعی',
        'description' => 'ترکیب‌های ماندگار و ظریف، هماهنگ با رنگ و حال‌وهوای مراسم',
    ),
    array(
        'number'      => '۰۸',
        'slug'        => 'special-bridal-accessories',
        'title'       => 'اکسسوری خاص عروس',
        'description' => 'جزئیات متفاوت برای شخصی‌سازی استایل و ساختن امضای شما',
    ),
    array(
        'number'      => '۰۹',
        'slug'        => 'engagement-ceremony-essentials',
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
            <div>
                <p class="mds-home-categories__eyebrow">
                    <span aria-hidden="true"></span>
                    از سر تا پای عروس
                </p>
                <h2 class="mds-home-categories__title" id="<?php echo esc_attr( $categories_title_id ); ?>">
                    هر آنچه برای کامل‌شدن
                    <span>انتخاب شما لازم است</span>
                </h2>
            </div>

            <p class="mds-home-categories__intro">
                مجموعه‌ای یکپارچه از پوشاک، اکسسوری و ملزومات مراسم؛ برای اینکه تمام جزئیات را هماهنگ، مطمئن و در یک مقصد انتخاب کنید.
            </p>
        </header>

        <div class="mds-home-categories__grid">
            <?php foreach ( $categories as $category ) : ?>
                <a
                    class="mds-category-card<?php echo ! empty( $category['featured'] ) ? ' mds-category-card--featured' : ''; ?>"
                    href="<?php echo esc_url( mazhari_get_product_category_url( $category['slug'] ) ); ?>"
                    aria-label="<?php echo esc_attr( 'مشاهده محصولات ' . $category['title'] ); ?>"
                >
                    <div class="mds-category-card__top" aria-hidden="true">
                        <span class="mds-category-card__number"><?php echo esc_html( $category['number'] ); ?></span>
                        <span class="mds-category-card__ornament"></span>
                    </div>

                    <div class="mds-category-card__content">
                        <h3><?php echo esc_html( $category['title'] ); ?></h3>
                        <p><?php echo esc_html( $category['description'] ); ?></p>
                    </div>

                    <span class="mds-category-card__seal" aria-hidden="true">✦</span>
                </a>
            <?php endforeach; ?>
        </div>

        <footer class="mds-home-categories__footer">
            <p>
                <strong>۹ خانواده محصول</strong>
                برای یک انتخاب هماهنگ و کامل
            </p>
            <a class="mds-btn mds-btn--secondary" href="#appointment">راهنمای انتخاب و مشاوره</a>
        </footer>
    </div>
</section>
