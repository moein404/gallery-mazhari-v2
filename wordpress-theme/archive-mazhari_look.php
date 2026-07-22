<?php
/**
 * Editorial archive for Gallery Mazhari Curated Looks.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();

$home_url = home_url( '/' );
?>

<main class="mds-looks-archive" id="main-content" dir="rtl">
    <section class="mds-looks-archive__hero" aria-labelledby="mds-looks-archive-title">
        <div class="mds-container">
            <nav class="mds-looks-archive__breadcrumb" aria-label="مسیر صفحه">
                <a href="<?php echo esc_url( $home_url ); ?>">خانه</a>
                <span aria-hidden="true">/</span>
                <span aria-current="page">استایل‌های منتخب</span>
            </nav>

            <p class="mds-looks-archive__eyebrow" lang="en">Gallery Mazhari Curated Looks</p>
            <h1 id="mds-looks-archive-title">استایل‌هایی که با یک نگاه کامل می‌شوند</h1>
            <p class="mds-looks-archive__lead">
                هر انتخاب، روایتی کامل از لباس تا آخرین اکسسوری؛ طراحی‌شده توسط متخصصان گالری مظهری برای سبک‌ها و مراسم‌های متفاوت.
            </p>
        </div>
    </section>

    <section class="mds-looks-archive__collection" aria-label="فهرست استایل‌های منتخب">
        <div class="mds-container">
            <?php if ( have_posts() ) : ?>
                <div class="mds-looks-archive__grid">
                    <?php while ( have_posts() ) : ?>
                        <?php
                        the_post();
                        $look_id       = get_the_ID();
                        $look_title    = get_the_title();
                        $look_style    = get_post_meta( $look_id, '_mazhari_look_style', true );
                        $look_ceremony = get_post_meta( $look_id, '_mazhari_look_ceremony', true );
                        $look_excerpt  = get_the_excerpt();
                        ?>
                        <article class="mds-looks-archive-card">
                            <a href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr( 'مشاهده استایل ' . $look_title ); ?>">
                                <figure>
                                    <?php
                                    echo get_the_post_thumbnail(
                                        $look_id,
                                        'large',
                                        array(
                                            'alt'      => $look_title,
                                            'loading'  => 'lazy',
                                            'decoding' => 'async',
                                        )
                                    );
                                    ?>
                                    <span aria-hidden="true"></span>
                                </figure>

                                <div class="mds-looks-archive-card__content">
                                    <?php if ( $look_style ) : ?>
                                        <p lang="en"><?php echo esc_html( $look_style ); ?></p>
                                    <?php endif; ?>
                                    <h2><?php echo esc_html( $look_title ); ?></h2>
                                    <?php if ( $look_excerpt ) : ?>
                                        <div><?php echo esc_html( $look_excerpt ); ?></div>
                                    <?php endif; ?>
                                    <?php if ( $look_ceremony ) : ?>
                                        <small><?php echo esc_html( $look_ceremony ); ?></small>
                                    <?php endif; ?>
                                    <strong>مشاهده استایل کامل <span aria-hidden="true">←</span></strong>
                                </div>
                            </a>
                        </article>
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
            <?php endif; ?>
        </div>
    </section>

    <section class="mds-looks-archive__consultation">
        <div class="mds-container">
            <div>
                <span>انتخاب میان چند استایل آسان نیست؟</span>
                <h2>متخصصان گالری، Look مناسب شما را پیدا می‌کنند.</h2>
            </div>
            <a class="mds-btn mds-btn--primary" href="<?php echo esc_url( $home_url . '#appointment' ); ?>">
                دریافت مشاوره
                <span aria-hidden="true">←</span>
            </a>
        </div>
    </section>
</main>

<?php
get_footer();
