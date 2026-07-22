<?php
/**
 * Gallery Mazhari homepage frequently asked questions.
 *
 * Rendered by the [mazhari_home_faq] shortcode.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$faq_title_id = wp_unique_id( 'mds-home-faq-title-' );
$faqs         = array(
    array(
        'question' => 'آیا گالری مظهری فقط لباس عروس دارد؟',
        'answer'   => 'خیر. گالری مظهری یک مجموعه کامل برای انتخاب عروس است؛ از پوشاک و تور سر تا کفش، کیف، اکسسوری مو، زیورآلات، حجاب مو، دسته‌گل و ملزومات عقد و بله‌برون.',
    ),
    array(
        'question' => 'برای شروع انتخاب از کجا اقدام کنم؟',
        'answer'   => 'فرم مشاوره همین صفحه را تکمیل کنید و گروه محصول موردنظرتان را مشخص کنید. پس از ثبت درخواست، برای هماهنگی زمان مناسب مشاوره با شما تماس می‌گیریم.',
    ),
    array(
        'question' => 'آیا مشاوره رایگان و بدون تعهد است؟',
        'answer'   => 'بله. مشاوره برای این است که پیش از تصمیم نهایی، انتخاب‌ها را کنار هم ببینید و با اطمینان بیشتری تصمیم بگیرید؛ ثبت درخواست هیچ تعهدی برای خرید ایجاد نمی‌کند.',
    ),
    array(
        'question' => 'برای دیدن هر محصول به کدام شعبه مراجعه کنم؟',
        'answer'   => 'پیش از مراجعه، گروه محصول موردنظرتان را در فرم مشخص کنید. همکاران ما نزدیک‌ترین شعبه دارای آن مجموعه را معرفی می‌کنند تا مسیر انتخاب شما کوتاه‌تر و دقیق‌تر باشد.',
    ),
);
?>

<section
    class="mds-home-faq"
    id="faq"
    dir="rtl"
    aria-labelledby="<?php echo esc_attr( $faq_title_id ); ?>"
>
    <div class="mds-home-faq__inner mds-container">
        <header class="mds-home-faq__header">
            <p class="mds-home-faq__eyebrow">
                <span aria-hidden="true"></span>
                پرسش‌های پیش از انتخاب
            </p>

            <h2 class="mds-home-faq__title" id="<?php echo esc_attr( $faq_title_id ); ?>">
                قبل از تصمیم،
                <span>پاسخ‌های روشن</span>
            </h2>

            <p class="mds-home-faq__intro">
                پاسخ کوتاه به سؤال‌هایی که معمولاً پیش از شروع انتخاب مطرح می‌شوند.
            </p>
        </header>

        <div class="mds-home-faq__list">
            <?php foreach ( $faqs as $index => $faq ) : ?>
                <details class="mds-faq-item"<?php echo 0 === $index ? ' open' : ''; ?>>
                    <summary>
                        <span class="mds-faq-item__question"><?php echo esc_html( $faq['question'] ); ?></span>
                        <span class="mds-faq-item__toggle" aria-hidden="true"></span>
                    </summary>
                    <div class="mds-faq-item__answer">
                        <p><?php echo esc_html( $faq['answer'] ); ?></p>
                    </div>
                </details>
            <?php endforeach; ?>
        </div>
    </div>
</section>
