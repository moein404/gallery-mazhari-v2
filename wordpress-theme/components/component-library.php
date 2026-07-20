 <?php
/**
 * Gallery Mazhari
 * Component Library
 */

?>

<section class="mds-section-lg">
    <div class="mds-container mds-stack">

        <span class="mds-overline">MAZHARI DESIGN SYSTEM</span>

        <h1 class="mds-display">
            Component Library
        </h1>

        <p class="mds-lead">
            مرجع مرکزی کامپوننت‌ها، تایپوگرافی، دکمه‌ها، کارت‌ها و فرم‌های
            وب‌سایت گالری مظهری.
        </p>

        <hr>

        <section class="mds-stack">
            <h2>Typography</h2>

            <h1>Heading Level 1</h1>
            <h2>Heading Level 2</h2>
            <h3>Heading Level 3</h3>

            <p>
                این یک متن معمولی برای آزمایش خوانایی و فاصله خطوط است.
            </p>

            <blockquote class="mds-quote">
                زیبایی واقعی در جزئیاتی است که بدون جلب توجه، احساس می‌شوند.
            </blockquote>
        </section>

        <hr>

        <section class="mds-stack">
            <h2>Buttons</h2>

            <div class="mds-row">
                <a href="#" class="mds-button mds-button-primary">
                    رزرو مشاوره
                </a>

                <a href="#" class="mds-button mds-button-secondary">
                    مشاهده کالکشن
                </a>

                <a href="#" class="mds-button mds-button-text">
                    مشاهده همه
                </a>
            </div>
        </section>

        <hr>

        <section class="mds-stack">
            <h2>Badges</h2>

            <div class="mds-row">
                <span class="mds-badge">جدید</span>
                <span class="mds-badge">پرفروش</span>
                <span class="mds-badge">اختصاصی</span>
                <span class="mds-badge">اروپایی</span>
            </div>
        </section>

        <hr>

        <section class="mds-stack">
    <h2>Product Cards</h2>

   <div class="mds-product-grid">

        <?php
        $args = array(
            'title'     => 'لباس عروس مدل آتنا',
            'meta'      => 'کالکشن اروپایی',
            'badge'     => 'جدید',
            'image'     => 'https://placehold.co/600x750?text=Athena',
            'image_alt' => 'لباس عروس مدل آتنا',
            'url'       => '#',
        );

        include __DIR__ . '/product-card.php';
        ?>

        <?php
        $args = array(
            'title'     => 'لباس عروس مدل رویال',
            'meta'      => 'کالکشن عربی',
            'badge'     => 'پرفروش',
            'image'     => 'https://placehold.co/600x750?text=Royal',
            'image_alt' => 'لباس عروس مدل رویال',
            'url'       => '#',
        );

        include __DIR__ . '/product-card.php';
        ?>

        <?php
        $args = array(
            'title'     => 'لباس عروس مدل سلین',
            'meta'      => 'کالکشن ماهی',
            'badge'     => '',
            'image'     => 'https://placehold.co/600x750?text=Celine',
            'image_alt' => 'لباس عروس مدل سلین',
            'url'       => '#',
        );

        include __DIR__ . '/product-card.php';
        ?>

    </div>
</section>

        <hr>

        <section class="mds-stack">
            <h2>Forms</h2>

            <div class="mds-form-group" style="max-width: 420px;">
                <label class="mds-label">
                    نام و نام خانوادگی
                </label>

                <input
                    class="mds-input"
                    type="text"
                    placeholder="نام خود را وارد کنید"
                >
            </div>
        </section>

    </div>
</section>
