<?php
/**
 * Gallery Mazhari homepage consultation form.
 *
 * Rendered by the [mazhari_home_appointment] shortcode.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$appointment_title_id = wp_unique_id( 'mds-home-appointment-title-' );
$appointment_image    = get_stylesheet_directory_uri() . '/assets/images/home-complete-selection.webp';
$form_status          = isset( $_GET['consultation'] )
    ? sanitize_key( wp_unslash( $_GET['consultation'] ) )
    : '';
$category_options     = mazhari_get_consultation_category_options();
$time_options         = mazhari_get_consultation_time_options();
$status_messages      = array(
    'success'      => array(
        'type' => 'success',
        'text' => 'درخواست شما ثبت شد. برای هماهنگی مشاوره با شما تماس می‌گیریم.',
    ),
    'required'     => array(
        'type' => 'error',
        'text' => 'لطفاً نام، شماره تماس و گزینه‌های ضروری را کامل کنید.',
    ),
    'invalid'      => array(
        'type' => 'error',
        'text' => 'اطلاعات فرم معتبر نیست. لطفاً دوباره بررسی و ارسال کنید.',
    ),
    'rate-limited' => array(
        'type' => 'error',
        'text' => 'درخواست قبلی شما دریافت شده است. لطفاً یک دقیقه بعد دوباره تلاش کنید.',
    ),
    'send-error'   => array(
        'type' => 'error',
        'text' => 'ارسال درخواست انجام نشد. لطفاً چند دقیقه دیگر دوباره تلاش کنید.',
    ),
);
?>

<section
    class="mds-home-appointment"
    id="appointment"
    dir="rtl"
    aria-labelledby="<?php echo esc_attr( $appointment_title_id ); ?>"
>
    <div class="mds-home-appointment__divider mds-container" aria-hidden="true">
        <span></span>
    </div>

    <div class="mds-home-appointment__inner mds-container">
        <aside class="mds-home-appointment__intro">
            <img
                class="mds-home-appointment__intro-image"
                src="<?php echo esc_url( $appointment_image ); ?>"
                alt=""
                width="1024"
                height="1536"
                loading="lazy"
                decoding="async"
            >

            <p class="mds-home-appointment__eyebrow">
                <span aria-hidden="true"></span>
                مشاوره انتخاب عروس
            </p>

            <h2 class="mds-home-appointment__title" id="<?php echo esc_attr( $appointment_title_id ); ?>">
                قبل از خرید،
                <span>تصویر کامل انتخابتان را بسازید</span>
            </h2>

            <p class="mds-home-appointment__description">
                چند جزئیات کوتاه بفرستید تا گفت‌وگو بر اساس مراسم، سلیقه و نیاز شما آغاز شود.
            </p>

            <ol class="mds-home-appointment__steps">
                <li><span>۱</span><p><strong>فرم کوتاه را تکمیل کنید</strong>کمتر از دو دقیقه زمان می‌برد.</p></li>
                <li><span>۲</span><p><strong>برای هماهنگی با شما تماس می‌گیریم</strong>زمان مناسب مشاوره مشخص می‌شود.</p></li>
                <li><span>۳</span><p><strong>انتخاب‌ها را کنار هم می‌چینیم</strong>از قطعه اصلی تا آخرین جزئیات.</p></li>
            </ol>

            <p class="mds-home-appointment__note">
                <span aria-hidden="true">✦</span>
                پس از ثبت، فقط برای هماهنگی زمان مناسب مشاوره با شما تماس می‌گیریم.
            </p>
        </aside>

        <div class="mds-home-appointment__form-card">
            <div class="mds-home-appointment__form-heading">
                <span>درخواست مشاوره</span>
                <strong>شروع یک انتخاب هماهنگ</strong>
            </div>

            <?php if ( isset( $status_messages[ $form_status ] ) ) : ?>
                <?php $status_message = $status_messages[ $form_status ]; ?>
                <div
                    class="mds-form-notice mds-form-notice--<?php echo esc_attr( $status_message['type'] ); ?>"
                    role="<?php echo 'error' === $status_message['type'] ? 'alert' : 'status'; ?>"
                >
                    <?php echo esc_html( $status_message['text'] ); ?>
                </div>
            <?php endif; ?>

            <form
                class="mds-consultation-form"
                method="post"
                action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>"
                accept-charset="UTF-8"
            >
                <input type="hidden" name="action" value="mazhari_consultation">
                <?php wp_nonce_field( 'mazhari_consultation_submit', 'mazhari_consultation_nonce' ); ?>

                <div class="mds-consultation-form__honeypot" aria-hidden="true">
                    <label for="mazhari-website">وب‌سایت</label>
                    <input id="mazhari-website" type="text" name="website" tabindex="-1" autocomplete="off">
                </div>

                <div class="mds-consultation-form__row">
                    <label class="mds-form-field">
                        <span>نام و نام خانوادگی <b aria-hidden="true">*</b></span>
                        <input
                            type="text"
                            name="full_name"
                            minlength="2"
                            maxlength="80"
                            autocomplete="name"
                            required
                        >
                    </label>

                    <label class="mds-form-field">
                        <span>شماره تماس <b aria-hidden="true">*</b></span>
                        <input
                            type="tel"
                            name="phone"
                            minlength="8"
                            maxlength="20"
                            inputmode="tel"
                            autocomplete="tel"
                            pattern="[0-9۰-۹+\-\s]{8,20}"
                            required
                        >
                    </label>
                </div>

                <div class="mds-consultation-form__row">
                    <label class="mds-form-field">
                        <span>برای چه محصولی مشاوره می‌خواهید؟ <b aria-hidden="true">*</b></span>
                        <select name="category" required>
                            <option value="">انتخاب کنید</option>
                            <?php foreach ( $category_options as $option_value => $option_label ) : ?>
                                <option value="<?php echo esc_attr( $option_value ); ?>">
                                    <?php echo esc_html( $option_label ); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </label>

                    <label class="mds-form-field">
                        <span>زمان پیشنهادی تماس <b aria-hidden="true">*</b></span>
                        <select name="contact_time" required>
                            <?php foreach ( $time_options as $option_value => $option_label ) : ?>
                                <option
                                    value="<?php echo esc_attr( $option_value ); ?>"
                                    <?php selected( 'anytime', $option_value ); ?>
                                >
                                    <?php echo esc_html( $option_label ); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                </div>

                <label class="mds-form-field">
                    <span>توضیحات شما <small>(اختیاری)</small></span>
                    <textarea
                        name="message"
                        rows="4"
                        maxlength="800"
                        placeholder="مثلاً تاریخ مراسم، سبک موردنظر یا محصولاتی که انتخاب کرده‌اید"
                    ></textarea>
                </label>

                <label class="mds-consultation-form__consent">
                    <input type="checkbox" name="consent" value="1" required>
                    <span>با تماس گالری مظهری برای هماهنگی این درخواست موافقم.</span>
                </label>

                <p class="mds-consultation-form__assurance">
                    رایگان <span aria-hidden="true">·</span> بدون تعهد <span aria-hidden="true">·</span> کمتر از دو دقیقه
                </p>

                <button class="mds-btn mds-btn--primary" type="submit">
                    ثبت درخواست مشاوره
                    <span aria-hidden="true">←</span>
                </button>
            </form>
        </div>
    </div>
</section>
