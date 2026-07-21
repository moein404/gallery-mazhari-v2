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
        'question' => 'آیا قبل از خرید می‌توانم مشاوره بگیرم؟',
        'answer'   => 'بله. هدف مشاوره این است که پیش از تصمیم نهایی، لباس، تور، کفش، کیف و اکسسوری‌ها در کنار هم دیده شوند و انتخابی هماهنگ شکل بگیرد.',
    ),
    array(
        'question' => 'برای هماهنگ‌کردن اکسسوری با لباس چه اطلاعاتی لازم است؟',
        'answer'   => 'عکس یا مشخصات لباس، رنگ و مدل آن، نوع مراسم، تاریخ مراسم و سبک موردعلاقه شما کمک می‌کند پیشنهادها دقیق‌تر و هماهنگ‌تر باشند.',
    ),
    array(
        'question' => 'برای مراسم عقد و بله‌برون هم محصول دارید؟',
        'answer'   => 'بله. پوشاک عقد، چادر عروس، هدشال و توربان، ست بله‌برون و سبدهای سه‌سایز در میان دسته‌های گالری قرار دارند.',
    ),
    array(
        'question' => 'چطور از موجودی و قیمت روز محصولات مطلع شوم؟',
        'answer'   => 'به‌دلیل تغییر موجودی مدل‌ها، دقیق‌ترین راه ثبت درخواست مشاوره است. گروه محصول را انتخاب کنید تا اطلاعات به‌روز همان دسته در اختیار شما قرار بگیرد.',
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
                پاسخ کوتاه به سؤال‌هایی که معمولاً پیش از شروع مشاوره و انتخاب محصولات عروس مطرح می‌شوند.
            </p>

            <div class="mds-home-faq__contact">
                <span aria-hidden="true">✦</span>
                <p>
                    <strong>پاسخ سؤال خود را پیدا نکردید؟</strong>
                    درخواست مشاوره را ثبت کنید تا راهنمایی دقیق‌تری دریافت کنید.
                </p>
                <a href="#appointment">درخواست مشاوره ←</a>
            </div>
        </header>

        <div class="mds-home-faq__list">
            <?php foreach ( $faqs as $index => $faq ) : ?>
                <details class="mds-faq-item"<?php echo 0 === $index ? ' open' : ''; ?>>
                    <summary>
                        <span class="mds-faq-item__number" aria-hidden="true">
                            <?php echo esc_html( str_pad( (string) ( $index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?>
                        </span>
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
