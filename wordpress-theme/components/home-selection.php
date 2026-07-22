<?php
/**
 * Monthly editorial selection of complete bridal looks.
 *
 * The section stays hidden until at least one published, featured look has a
 * featured image. This prevents placeholders from weakening the homepage.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$selection_candidates = get_posts(
    array(
        'post_type'              => 'mazhari_look',
        'post_status'            => 'publish',
        'posts_per_page'         => 9,
        'orderby'                => array(
            'menu_order' => 'ASC',
            'date'       => 'DESC',
        ),
        'meta_key'               => '_mazhari_selection_featured', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
        'meta_value'             => '1', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_value
        'no_found_rows'          => true,
        'update_post_meta_cache' => true,
        'update_post_term_cache' => false,
    )
);
$selection_looks      = array();

foreach ( $selection_candidates as $selection_candidate ) {
    if ( ! has_post_thumbnail( $selection_candidate ) ) {
        continue;
    }

    $selection_looks[] = $selection_candidate;

    if ( 3 === count( $selection_looks ) ) {
        break;
    }
}

if ( ! $selection_looks ) {
    return;
}

$selection_title_id = wp_unique_id( 'mds-home-selection-title-' );
$selection_archive  = get_post_type_archive_link( 'mazhari_look' );
?>

<section
    class="mds-home-selection"
    id="selection"
    dir="rtl"
    aria-labelledby="<?php echo esc_attr( $selection_title_id ); ?>"
>
    <div class="mds-home-selection__divider" aria-hidden="true">
        <span></span>
    </div>

    <div class="mds-home-selection__inner mds-container">
        <header class="mds-home-selection__header">
            <p class="mds-home-selection__eyebrow" lang="en">
                The Mazhari Selection
            </p>
            <h2 class="mds-home-selection__title" id="<?php echo esc_attr( $selection_title_id ); ?>">
                استایل‌های منتخب ماه
            </h2>
            <p class="mds-home-selection__lead">
                ترکیب‌هایی که متخصصان گالری، از قطعه اصلی تا آخرین جزئیات، برای یک مراسم هماهنگ انتخاب کرده‌اند.
            </p>
        </header>

        <div class="mds-home-selection__browse">
            <span>برای دیدن مدل‌های بیشتر ورق بزنید</span>
            <button type="button" data-mds-selection-next aria-label="نمایش استایل بعدی">
                <span aria-hidden="true">←</span>
            </button>
        </div>

        <div class="mds-home-selection__grid" data-mds-selection-track>
            <?php foreach ( $selection_looks as $look_index => $selection_look ) : ?>
                <?php
                $look_id       = $selection_look->ID;
                $look_title    = get_the_title( $look_id );
                $look_url      = get_permalink( $look_id );
                $look_style    = get_post_meta( $look_id, '_mazhari_look_style', true );
                $look_mood     = get_post_meta( $look_id, '_mazhari_look_mood', true );
                $look_ceremony = get_post_meta( $look_id, '_mazhari_look_ceremony', true );
                $look_excerpt  = get_the_excerpt( $look_id );

                if ( '' === trim( $look_excerpt ) ) {
                    $look_excerpt = wp_trim_words(
                        wp_strip_all_tags( $selection_look->post_content ),
                        18,
                        '…'
                    );
                }
                ?>
                <article class="mds-selection-card<?php echo 0 === $look_index ? ' mds-selection-card--lead' : ''; ?>">
                    <a
                        class="mds-selection-card__link"
                        href="<?php echo esc_url( $look_url ); ?>"
                        aria-label="<?php echo esc_attr( 'مشاهده استایل ' . $look_title ); ?>"
                    >
                        <figure class="mds-selection-card__visual">
                            <?php
                            echo wp_get_attachment_image(
                                get_post_thumbnail_id( $look_id ),
                                'large',
                                false,
                                array(
                                    'class'    => 'mds-selection-card__image',
                                    'alt'      => $look_title,
                                    'loading'  => 'lazy',
                                    'decoding' => 'async',
                                )
                            );
                            ?>
                            <span class="mds-selection-card__shade" aria-hidden="true"></span>
                            <span class="mds-selection-card__index" aria-hidden="true">
                                <?php echo esc_html( str_pad( (string) ( $look_index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?>
                            </span>
                        </figure>

                        <div class="mds-selection-card__content">
                            <?php if ( $look_style ) : ?>
                                <p class="mds-selection-card__style" lang="en">
                                    <?php echo esc_html( $look_style ); ?>
                                </p>
                            <?php endif; ?>

                            <h3><?php echo esc_html( $look_title ); ?></h3>

                            <?php if ( $look_excerpt ) : ?>
                                <p class="mds-selection-card__story">
                                    <?php echo esc_html( $look_excerpt ); ?>
                                </p>
                            <?php endif; ?>

                            <?php if ( $look_mood || $look_ceremony ) : ?>
                                <p class="mds-selection-card__details">
                                    <?php if ( $look_mood ) : ?>
                                        <span><?php echo esc_html( $look_mood ); ?></span>
                                    <?php endif; ?>
                                    <?php if ( $look_ceremony ) : ?>
                                        <span><?php echo esc_html( $look_ceremony ); ?></span>
                                    <?php endif; ?>
                                </p>
                            <?php endif; ?>

                            <span class="mds-selection-card__cta">
                                مشاهده استایل کامل
                                <span aria-hidden="true">←</span>
                            </span>
                        </div>
                    </a>
                </article>
            <?php endforeach; ?>
        </div>

        <?php if ( $selection_archive ) : ?>
            <div class="mds-home-selection__footer">
                <p>هر ماه، انتخابی تازه از استایل‌های کامل گالری مظهری.</p>
                <a href="<?php echo esc_url( $selection_archive ); ?>">
                    مشاهده همه استایل‌ها
                    <span aria-hidden="true">←</span>
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>
