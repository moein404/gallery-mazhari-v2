<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

function mazhari_enqueue_assets() {
    $base = get_stylesheet_directory();
    $uri  = get_stylesheet_directory_uri();

    wp_enqueue_style(
        'mazhari-foundation',
        $uri . '/assets/css/foundation.css',
        array(),
        filemtime( $base . '/assets/css/foundation.css' )
    );

    wp_enqueue_style(
        'mazhari-typography',
        $uri . '/assets/css/typography.css',
        array( 'mazhari-foundation' ),
        filemtime( $base . '/assets/css/typography.css' )
    );

    wp_enqueue_style(
        'mazhari-components',
        $uri . '/assets/css/components.css',
        array( 'mazhari-typography' ),
        filemtime( $base . '/assets/css/components.css' )
    );

    wp_enqueue_script(
        'mazhari-main',
        $uri . '/assets/js/main.js',
        array(),
        filemtime( $base . '/assets/js/main.js' ),
        true
    );
}
add_action( 'wp_enqueue_scripts', 'mazhari_enqueue_assets', 20 );

/**
 * Theme navigation locations.
 */
function mazhari_register_navigation() {
    add_theme_support( 'post-thumbnails' );

    register_nav_menus(
        array(
            'primary' => __( 'Primary Menu', 'mazhari' ),
        )
    );
}
add_action( 'after_setup_theme', 'mazhari_register_navigation' );

/**
 * Editorial bridal looks curated by Gallery Mazhari specialists.
 */
function mazhari_register_curated_look_post_type() {
    register_post_type(
        'mazhari_look',
        array(
            'labels' => array(
                'name'               => 'Curated Looks',
                'singular_name'      => 'Curated Look',
                'menu_name'          => 'Curated Looks',
                'add_new'            => 'Add Look',
                'add_new_item'       => 'Add Curated Look',
                'edit_item'          => 'Edit Curated Look',
                'new_item'           => 'New Curated Look',
                'view_item'          => 'View Curated Look',
                'search_items'       => 'Search Curated Looks',
                'not_found'          => 'No curated looks found.',
                'not_found_in_trash' => 'No curated looks found in Trash.',
            ),
            'public'             => true,
            'show_in_rest'       => true,
            'menu_icon'          => 'dashicons-art',
            'menu_position'      => 26,
            'has_archive'        => 'curated-looks',
            'rewrite'            => array(
                'slug'       => 'curated-looks',
                'with_front' => false,
            ),
            'supports'           => array(
                'title',
                'editor',
                'excerpt',
                'thumbnail',
                'page-attributes',
            ),
            'show_in_nav_menus'  => true,
            'exclude_from_search' => false,
        )
    );
}
add_action( 'init', 'mazhari_register_curated_look_post_type', 20 );

/**
 * Flush curated-look routes once after this feature is deployed.
 */
function mazhari_maybe_flush_curated_look_rewrites() {
    $rewrite_version = '1';

    if ( $rewrite_version === get_option( 'mazhari_curated_look_rewrite_version' ) ) {
        return;
    }

    flush_rewrite_rules( false );
    update_option( 'mazhari_curated_look_rewrite_version', $rewrite_version, false );
}
add_action( 'init', 'mazhari_maybe_flush_curated_look_rewrites', 40 );

/**
 * Curated-look editorial fields.
 */
function mazhari_get_curated_look_meta_fields() {
    return array(
        '_mazhari_look_style' => array(
            'label'       => 'Style',
            'placeholder' => 'Example: Modern Classic',
        ),
        '_mazhari_look_mood' => array(
            'label'       => 'Mood',
            'placeholder' => 'Example: Soft, luminous, timeless',
        ),
        '_mazhari_look_ceremony' => array(
            'label'       => 'Recommended ceremony',
            'placeholder' => 'Example: Wedding reception',
        ),
        '_mazhari_look_suitable_for' => array(
            'label'       => 'Suitable for',
            'placeholder' => 'Describe the bride, venue, season or styling preference.',
        ),
        '_mazhari_look_product_ids' => array(
            'label'       => 'WooCommerce product IDs',
            'placeholder' => 'Example: 128, 305, 411',
        ),
    );
}

function mazhari_register_curated_look_meta() {
    foreach ( mazhari_get_curated_look_meta_fields() as $meta_key => $field ) {
        register_post_meta(
            'mazhari_look',
            $meta_key,
            array(
                'type'              => 'string',
                'single'            => true,
                'sanitize_callback' => 'sanitize_text_field',
                'show_in_rest'      => true,
                'auth_callback'     => function() {
                    return current_user_can( 'edit_posts' );
                },
            )
        );
    }

    register_post_meta(
        'mazhari_look',
        '_mazhari_selection_featured',
        array(
            'type'              => 'boolean',
            'single'            => true,
            'sanitize_callback' => 'rest_sanitize_boolean',
            'show_in_rest'      => true,
            'auth_callback'     => function() {
                return current_user_can( 'edit_posts' );
            },
        )
    );
}
add_action( 'init', 'mazhari_register_curated_look_meta', 21 );

function mazhari_add_curated_look_meta_box() {
    add_meta_box(
        'mazhari-curated-look-details',
        'Look Details',
        'mazhari_render_curated_look_meta_box',
        'mazhari_look',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes_mazhari_look', 'mazhari_add_curated_look_meta_box' );

function mazhari_render_curated_look_meta_box( $post ) {
    wp_nonce_field( 'mazhari_save_curated_look', 'mazhari_curated_look_nonce' );

    foreach ( mazhari_get_curated_look_meta_fields() as $meta_key => $field ) {
        $field_value = get_post_meta( $post->ID, $meta_key, true );
        ?>
        <p>
            <label for="<?php echo esc_attr( $meta_key ); ?>">
                <strong><?php echo esc_html( $field['label'] ); ?></strong>
            </label>
        </p>
        <p>
            <input
                class="widefat"
                id="<?php echo esc_attr( $meta_key ); ?>"
                name="<?php echo esc_attr( $meta_key ); ?>"
                type="text"
                value="<?php echo esc_attr( $field_value ); ?>"
                placeholder="<?php echo esc_attr( $field['placeholder'] ); ?>"
            >
        </p>
        <?php
    }

    $is_featured = (bool) get_post_meta(
        $post->ID,
        '_mazhari_selection_featured',
        true
    );
    ?>
    <p>
        <label>
            <input
                type="checkbox"
                name="_mazhari_selection_featured"
                value="1"
                <?php checked( $is_featured ); ?>
            >
            Feature this look in The Mazhari Selection on the homepage
        </label>
    </p>
    <p class="description">
        Add a featured image and a short excerpt. Only published, featured looks with an image appear on the homepage.
    </p>
    <?php
}

function mazhari_save_curated_look_meta( $post_id ) {
    $nonce = isset( $_POST['mazhari_curated_look_nonce'] )
        ? sanitize_text_field( wp_unslash( $_POST['mazhari_curated_look_nonce'] ) )
        : '';

    if (
        ! wp_verify_nonce( $nonce, 'mazhari_save_curated_look' )
        || ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        || ! current_user_can( 'edit_post', $post_id )
    ) {
        return;
    }

    foreach ( mazhari_get_curated_look_meta_fields() as $meta_key => $field ) {
        $field_value = isset( $_POST[ $meta_key ] )
            ? sanitize_text_field( wp_unslash( $_POST[ $meta_key ] ) )
            : '';

        if ( '' === $field_value ) {
            delete_post_meta( $post_id, $meta_key );
            continue;
        }

        update_post_meta( $post_id, $meta_key, $field_value );
    }

    update_post_meta(
        $post_id,
        '_mazhari_selection_featured',
        isset( $_POST['_mazhari_selection_featured'] ) ? '1' : '0'
    );
}
add_action( 'save_post_mazhari_look', 'mazhari_save_curated_look_meta' );

/**
 * Product categories used across the storefront.
 */
function mazhari_get_product_category_definitions() {
    return array(
        'bridal-clothing' => array(
            'name'        => 'پوشاک عروس',
            'description' => 'لباس و پوشاک عروس برای مراسم عروسی، عقد و فرمالیته.',
        ),
        'bridal-veils' => array(
            'name'        => 'تور سر',
            'description' => 'مدل‌های متنوع تور سر برای تکمیل استایل عروس.',
        ),
        'bridal-shoes-bags' => array(
            'name'        => 'کفش، کتونی و کیف',
            'description' => 'کفش، کتونی و کیف هماهنگ با استایل و مراسم عروس.',
        ),
        'bridal-hair-accessories' => array(
            'name'        => 'اکسسوری مو',
            'description' => 'تاج، تل، ریسه و اکسسوری‌های تکمیل‌کننده استایل مو.',
        ),
        'bridal-jewelry' => array(
            'name'        => 'زیورآلات',
            'description' => 'زیورآلات و جزئیات درخشان برای استایل عروس.',
        ),
        'bridal-headwear' => array(
            'name'        => 'حجاب مو',
            'description' => 'کلاه، چادر، توربان و هدشال ویژه عروس.',
        ),
        'artificial-bridal-bouquets' => array(
            'name'        => 'دسته‌گل مصنوعی',
            'description' => 'دسته‌گل‌های مصنوعی ماندگار و هماهنگ با مراسم.',
        ),
        'special-bridal-accessories' => array(
            'name'        => 'اکسسوری خاص عروس',
            'description' => 'اکسسوری‌های متفاوت برای شخصی‌سازی استایل عروس.',
        ),
        'engagement-ceremony-essentials' => array(
            'name'        => 'ملزومات عقد و بله‌برون',
            'description' => 'ست‌ها، سبدها و ملزومات هماهنگ عقد و بله‌برون.',
        ),
    );
}

/**
 * Approved child categories, including the three bridal-dress collections.
 *
 * Definitions are ordered so every parent is available before its children.
 */
function mazhari_get_product_subcategory_definitions() {
    return array(
        'bridal-dresses' => array(
            'name'        => 'لباس عروس',
            'parent'      => 'bridal-clothing',
            'description' => 'مجموعه لباس‌های عروس در سبک‌ها و فرم‌های متنوع.',
        ),
        'european-bridal-dresses' => array(
            'name'        => 'اروپایی',
            'parent'      => 'bridal-dresses',
            'description' => 'لباس عروس با طراحی و استایل اروپایی.',
        ),
        'arabic-bridal-dresses' => array(
            'name'        => 'عربی',
            'parent'      => 'bridal-dresses',
            'description' => 'لباس عروس با طراحی مجلل و استایل عربی.',
        ),
        'mermaid-bridal-dresses' => array(
            'name'        => 'ماهی',
            'parent'      => 'bridal-dresses',
            'description' => 'لباس عروس با فرم اندامی و مدل ماهی.',
        ),
        'ceremony-suits' => array(
            'name'        => 'کت‌وشلوار عقد',
            'parent'      => 'bridal-clothing',
            'description' => 'کت‌وشلوارهای ویژه مراسم عقد و محضر.',
        ),
        'bridal-gloves' => array(
            'name'        => 'دستکش',
            'parent'      => 'bridal-clothing',
            'description' => 'دستکش‌های عروس هماهنگ با لباس و استایل مراسم.',
        ),
        'bridal-robes' => array(
            'name'        => 'روبدوشامبر',
            'parent'      => 'bridal-clothing',
            'description' => 'روبدوشامبر عروس برای آماده‌شدن و عکاسی روز مراسم.',
        ),
        'bridal-capes' => array(
            'name'        => 'شنل',
            'parent'      => 'bridal-clothing',
            'description' => 'شنل عروس برای تکمیل پوشش و استایل مراسم.',
        ),
        'bridal-shoes' => array(
            'name'        => 'کفش عروس',
            'parent'      => 'bridal-shoes-bags',
            'description' => 'کفش‌های عروس برای استایل‌های رسمی و مجلسی.',
        ),
        'bridal-sneakers' => array(
            'name'        => 'کتونی عروس',
            'parent'      => 'bridal-shoes-bags',
            'description' => 'کتونی‌های راحت و ویژه عروس برای مراسم و فرمالیته.',
        ),
        'bridal-bags' => array(
            'name'        => 'کیف عروس',
            'parent'      => 'bridal-shoes-bags',
            'description' => 'کیف‌های عروس هماهنگ با لباس، کفش و اکسسوری‌ها.',
        ),
        'bridal-tiaras' => array(
            'name'        => 'تاج',
            'parent'      => 'bridal-hair-accessories',
            'description' => 'تاج‌های عروس برای استایل‌های کلاسیک و مدرن.',
        ),
        'bridal-headbands' => array(
            'name'        => 'تل',
            'parent'      => 'bridal-hair-accessories',
            'description' => 'تل‌های ظریف و مجلسی برای تکمیل مدل موی عروس.',
        ),
        'imported-hair-vines' => array(
            'name'        => 'ریسه وارداتی',
            'parent'      => 'bridal-hair-accessories',
            'description' => 'ریسه‌های موی وارداتی برای استایل عروس.',
        ),
        'iranian-hair-vines' => array(
            'name'        => 'ریسه ایرانی',
            'parent'      => 'bridal-hair-accessories',
            'description' => 'ریسه‌های موی ایرانی برای استایل عروس.',
        ),
        'bridal-hairpins' => array(
            'name'        => 'سنجاق شینیون',
            'parent'      => 'bridal-hair-accessories',
            'description' => 'سنجاق‌های شینیون برای تزئین و تثبیت مدل موی عروس.',
        ),
        'bridal-flower-crowns' => array(
            'name'        => 'حلقه گل',
            'parent'      => 'bridal-hair-accessories',
            'description' => 'حلقه گل برای استایل‌های لطیف و فرمالیته عروس.',
        ),
        'bridal-jewelry-sets' => array(
            'name'        => 'سرویس',
            'parent'      => 'bridal-jewelry',
            'description' => 'سرویس‌های زیورآلات هماهنگ برای استایل عروس.',
        ),
        'bridal-half-sets' => array(
            'name'        => 'نیم‌ست',
            'parent'      => 'bridal-jewelry',
            'description' => 'نیم‌ست‌های ظریف و مجلسی ویژه عروس.',
        ),
        'bridal-earrings' => array(
            'name'        => 'گوشواره',
            'parent'      => 'bridal-jewelry',
            'description' => 'گوشواره‌های عروس در سبک‌های ظریف و درخشان.',
        ),
        'bridal-rings' => array(
            'name'        => 'انگشتر',
            'parent'      => 'bridal-jewelry',
            'description' => 'انگشترهای مجلسی برای تکمیل زیورآلات عروس.',
        ),
        'bridal-anklets' => array(
            'name'        => 'پابند',
            'parent'      => 'bridal-jewelry',
            'description' => 'پابندهای ظریف و هماهنگ با استایل عروس.',
        ),
        'bridal-bracelets' => array(
            'name'        => 'دستبند',
            'parent'      => 'bridal-jewelry',
            'description' => 'دستبندهای مجلسی و درخشان ویژه عروس.',
        ),
        'bridal-brooches' => array(
            'name'        => 'سنجاق سینه',
            'parent'      => 'bridal-jewelry',
            'description' => 'سنجاق سینه برای تکمیل جزئیات استایل عروس.',
        ),
        'bridal-caps' => array(
            'name'        => 'کلاه و کاپ کلاه',
            'parent'      => 'bridal-headwear',
            'description' => 'کلاه و کاپ کلاه ویژه استایل حجاب عروس.',
        ),
        'bridal-chadors' => array(
            'name'        => 'چادر عروس',
            'parent'      => 'bridal-headwear',
            'description' => 'چادرهای ویژه عقد، محضر و مراسم عروس.',
        ),
        'bridal-turbans' => array(
            'name'        => 'توربان',
            'parent'      => 'bridal-headwear',
            'description' => 'توربان‌های مجلسی برای استایل حجاب عروس.',
        ),
        'bridal-headscarves' => array(
            'name'        => 'هدشال',
            'parent'      => 'bridal-headwear',
            'description' => 'هدشال‌های عروس برای استایل‌های پوشیده و مجلسی.',
        ),
        'engagement-ceremony-sets' => array(
            'name'        => 'ست بله‌برون',
            'parent'      => 'engagement-ceremony-essentials',
            'description' => 'ست‌های هماهنگ و کامل برای مراسم بله‌برون.',
        ),
        'three-size-ceremony-baskets' => array(
            'name'        => 'سبد سه سایز',
            'parent'      => 'engagement-ceremony-essentials',
            'description' => 'سبدهای سه سایز برای چیدمان عقد و بله‌برون.',
        ),
    );
}

/**
 * Create or align a single WooCommerce product category.
 */
function mazhari_upsert_product_category( $slug, $category, $parent_id = 0 ) {
    $existing_term = get_term_by( 'slug', $slug, 'product_cat' );
    $term_data     = array(
        'name'        => $category['name'],
        'slug'        => $slug,
        'description' => $category['description'],
        'parent'      => (int) $parent_id,
    );

    if ( $existing_term ) {
        $term_changed = (
            $existing_term->name !== $term_data['name']
            || $existing_term->description !== $term_data['description']
            || (int) $existing_term->parent !== $term_data['parent']
        );

        if ( ! $term_changed ) {
            return (int) $existing_term->term_id;
        }

        $updated_term = wp_update_term(
            $existing_term->term_id,
            'product_cat',
            $term_data
        );

        if ( is_wp_error( $updated_term ) ) {
            return $updated_term;
        }

        return (int) $updated_term['term_id'];
    }

    $inserted_term = wp_insert_term(
        $category['name'],
        'product_cat',
        array(
            'slug'        => $slug,
            'description' => $category['description'],
            'parent'      => (int) $parent_id,
        )
    );

    if ( is_wp_error( $inserted_term ) ) {
        return $inserted_term;
    }

    return (int) $inserted_term['term_id'];
}

/**
 * Create the approved WooCommerce category structure once.
 */
function mazhari_install_product_categories() {
    $category_version = '2';

    if (
        ! taxonomy_exists( 'product_cat' )
        || $category_version === get_option( 'mazhari_product_categories_version' )
    ) {
        return;
    }

    $all_categories_ready = true;
    $category_term_ids    = array();

    foreach ( mazhari_get_product_category_definitions() as $slug => $category ) {
        $term_id = mazhari_upsert_product_category( $slug, $category );

        if ( is_wp_error( $term_id ) ) {
            $all_categories_ready = false;
            continue;
        }

        $category_term_ids[ $slug ] = $term_id;
    }

    foreach ( mazhari_get_product_subcategory_definitions() as $slug => $category ) {
        $parent_slug = $category['parent'];
        $parent_id   = isset( $category_term_ids[ $parent_slug ] )
            ? $category_term_ids[ $parent_slug ]
            : 0;

        if ( ! $parent_id ) {
            $all_categories_ready = false;
            continue;
        }

        $term_id = mazhari_upsert_product_category(
            $slug,
            $category,
            $parent_id
        );

        if ( is_wp_error( $term_id ) ) {
            $all_categories_ready = false;
            continue;
        }

        $category_term_ids[ $slug ] = $term_id;
    }

    if ( $all_categories_ready ) {
        update_option( 'mazhari_product_categories_version', $category_version, false );
    }
}
add_action( 'init', 'mazhari_install_product_categories', 30 );

/**
 * Resolve a product category archive, with the shop as a safe fallback.
 */
function mazhari_get_product_category_url( $slug ) {
    if ( taxonomy_exists( 'product_cat' ) ) {
        $term = get_term_by( 'slug', sanitize_title( $slug ), 'product_cat' );

        if ( $term ) {
            $term_url = get_term_link( $term );

            if ( ! is_wp_error( $term_url ) ) {
                return $term_url;
            }
        }
    }

    if ( function_exists( 'wc_get_page_permalink' ) ) {
        $shop_url = wc_get_page_permalink( 'shop' );

        if ( $shop_url ) {
            return $shop_url;
        }
    }

    return home_url( '/#appointment' );
}

/**
 * Build the main site header markup.
 */
function mazhari_get_site_header_markup() {
    $component_file = get_stylesheet_directory()
        . '/components/site-header.php';

    if ( ! file_exists( $component_file ) ) {
        return '';
    }

    ob_start();

    include $component_file;

    return ob_get_clean();
}

/**
 * Keep the shortcode available for previews outside the rendered Bricks header.
 * On the frontend the header is injected through bricks_before_header instead,
 * which avoids Bricks incorrectly treating the shortcode content as empty.
 */
function mazhari_header_shortcode() {
    return mazhari_get_site_header_markup();
}

add_shortcode( 'mazhari_header', 'mazhari_header_shortcode' );

/**
 * Replace an empty Bricks header render with the custom site header.
 */
function mazhari_filter_bricks_header( $header_html ) {
    if ( false !== strpos( $header_html, 'class="mds-site-header"' ) ) {
        return $header_html;
    }

    $header_markup = mazhari_get_site_header_markup();

    if ( '' === $header_markup ) {
        return $header_html;
    }

    $closing_tag_position = strpos( $header_html, '</header>' );

    if ( false !== $closing_tag_position ) {
        return substr_replace(
            $header_html,
            $header_markup,
            $closing_tag_position,
            0
        );
    }

    return $header_markup . $header_html;
}

add_filter( 'bricks/render_header', 'mazhari_filter_bricks_header', 10, 1 );

/**
 * Homepage hero shortcode for use inside the Bricks Home page.
 */
function mazhari_home_hero_shortcode() {
    $component_file = get_stylesheet_directory()
        . '/components/home-hero.php';

    if ( ! file_exists( $component_file ) ) {
        return '';
    }

    ob_start();

    include $component_file;

    return ob_get_clean();
}

add_shortcode( 'mazhari_home_hero', 'mazhari_home_hero_shortcode' );

/**
 * Homepage category showcase shortcode for use below the hero.
 */
function mazhari_home_categories_shortcode() {
    $component_file = get_stylesheet_directory()
        . '/components/home-categories.php';

    if ( ! file_exists( $component_file ) ) {
        return '';
    }

    ob_start();

    include $component_file;

    return ob_get_clean();
}

add_shortcode( 'mazhari_home_categories', 'mazhari_home_categories_shortcode' );

/**
 * Homepage value proposition shortcode for use below the categories.
 */
function mazhari_home_why_shortcode() {
    $component_file = get_stylesheet_directory()
        . '/components/home-why.php';

    if ( ! file_exists( $component_file ) ) {
        return '';
    }

    ob_start();

    include $component_file;

    return ob_get_clean();
}

add_shortcode( 'mazhari_home_why', 'mazhari_home_why_shortcode' );

/**
 * Consultation form option labels.
 */
function mazhari_get_consultation_category_options() {
    return array(
        'complete'    => 'انتخاب کامل محصولات عروس',
        'clothing'    => 'پوشاک عروس',
        'veil'        => 'تور سر و حجاب مو',
        'shoes-bags'  => 'کفش، کتونی و کیف',
        'hair'        => 'اکسسوری مو',
        'jewelry'     => 'زیورآلات',
        'bouquet'     => 'دسته‌گل و اکسسوری خاص',
        'ceremony'    => 'ملزومات عقد و بله‌برون',
    );
}

function mazhari_get_consultation_time_options() {
    return array(
        'anytime'   => 'هر زمان مناسب بود',
        'morning'   => 'صبح، ۹ تا ۱۲',
        'afternoon' => 'ظهر، ۱۲ تا ۱۶',
        'evening'   => 'عصر، ۱۶ تا ۲۰',
    );
}

/**
 * Homepage consultation form shortcode.
 */
function mazhari_home_appointment_shortcode() {
    $component_file = get_stylesheet_directory()
        . '/components/home-appointment.php';

    if ( ! file_exists( $component_file ) ) {
        return '';
    }

    ob_start();

    include $component_file;

    return ob_get_clean();
}

add_shortcode( 'mazhari_home_appointment', 'mazhari_home_appointment_shortcode' );

/**
 * Redirect consultation form submissions back to the homepage section.
 */
function mazhari_consultation_redirect( $status ) {
    $redirect_url = wp_get_referer();

    if ( ! $redirect_url ) {
        $redirect_url = home_url( '/' );
    }

    $redirect_url = remove_query_arg( 'consultation', $redirect_url );
    $redirect_url = add_query_arg( 'consultation', sanitize_key( $status ), $redirect_url );

    wp_safe_redirect( $redirect_url . '#appointment' );
    exit;
}

/**
 * Validate and email a consultation request to the WordPress administrator.
 */
function mazhari_handle_consultation_form() {
    $nonce = isset( $_POST['mazhari_consultation_nonce'] )
        ? sanitize_text_field( wp_unslash( $_POST['mazhari_consultation_nonce'] ) )
        : '';

    if ( ! wp_verify_nonce( $nonce, 'mazhari_consultation_submit' ) ) {
        mazhari_consultation_redirect( 'invalid' );
    }

    $honeypot = isset( $_POST['website'] )
        ? sanitize_text_field( wp_unslash( $_POST['website'] ) )
        : '';

    if ( '' !== $honeypot ) {
        mazhari_consultation_redirect( 'success' );
    }

    $full_name = isset( $_POST['full_name'] )
        ? sanitize_text_field( wp_unslash( $_POST['full_name'] ) )
        : '';
    $phone = isset( $_POST['phone'] )
        ? sanitize_text_field( wp_unslash( $_POST['phone'] ) )
        : '';
    $category = isset( $_POST['category'] )
        ? sanitize_key( wp_unslash( $_POST['category'] ) )
        : '';
    $contact_time = isset( $_POST['contact_time'] )
        ? sanitize_key( wp_unslash( $_POST['contact_time'] ) )
        : '';
    $message = isset( $_POST['message'] )
        ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) )
        : '';
    $consent = isset( $_POST['consent'] )
        ? sanitize_text_field( wp_unslash( $_POST['consent'] ) )
        : '';

    $category_options = mazhari_get_consultation_category_options();
    $time_options     = mazhari_get_consultation_time_options();

    if (
        '' === $full_name
        || '' === $phone
        || '1' !== $consent
        || ! isset( $category_options[ $category ] )
        || ! isset( $time_options[ $contact_time ] )
    ) {
        mazhari_consultation_redirect( 'required' );
    }

    if ( ! preg_match( '/^[0-9۰-۹+\-\s]{8,20}$/u', $phone ) ) {
        mazhari_consultation_redirect( 'invalid' );
    }

    $name_length = function_exists( 'mb_strlen' )
        ? mb_strlen( $full_name )
        : strlen( $full_name );
    $message_length = function_exists( 'mb_strlen' )
        ? mb_strlen( $message )
        : strlen( $message );

    if ( $name_length < 2 || $name_length > 80 || $message_length > 800 ) {
        mazhari_consultation_redirect( 'invalid' );
    }

    $remote_address = isset( $_SERVER['REMOTE_ADDR'] )
        ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) )
        : '';
    $rate_limit_key = '' !== $remote_address
        ? 'mazhari_consultation_' . md5( $remote_address )
        : '';

    if ( '' !== $rate_limit_key && get_transient( $rate_limit_key ) ) {
        mazhari_consultation_redirect( 'rate-limited' );
    }

    if ( '' !== $rate_limit_key ) {
        set_transient( $rate_limit_key, 1, MINUTE_IN_SECONDS );
    }

    $email_subject = sprintf(
        'درخواست مشاوره جدید از طرف %s',
        $full_name
    );
    $email_body = implode(
        PHP_EOL,
        array(
            'درخواست مشاوره جدید از وب‌سایت گالری مظهری',
            '',
            'نام: ' . $full_name,
            'شماره تماس: ' . $phone,
            'موضوع مشاوره: ' . $category_options[ $category ],
            'زمان مناسب تماس: ' . $time_options[ $contact_time ],
            'توضیحات: ' . ( '' !== $message ? $message : '—' ),
        )
    );
    $email_headers = array( 'Content-Type: text/plain; charset=UTF-8' );
    $sent          = wp_mail(
        get_option( 'admin_email' ),
        $email_subject,
        $email_body,
        $email_headers
    );

    mazhari_consultation_redirect( $sent ? 'success' : 'send-error' );
}

add_action( 'admin_post_mazhari_consultation', 'mazhari_handle_consultation_form' );
add_action( 'admin_post_nopriv_mazhari_consultation', 'mazhari_handle_consultation_form' );

/**
 * Homepage FAQ shortcode for use below the consultation form.
 */
function mazhari_home_faq_shortcode() {
    $component_file = get_stylesheet_directory()
        . '/components/home-faq.php';

    if ( ! file_exists( $component_file ) ) {
        return '';
    }

    ob_start();

    include $component_file;

    return ob_get_clean();
}

add_shortcode( 'mazhari_home_faq', 'mazhari_home_faq_shortcode' );

/**
 * Build the global site footer markup.
 */
function mazhari_get_site_footer_markup() {
    $component_file = get_stylesheet_directory()
        . '/components/site-footer.php';

    if ( ! file_exists( $component_file ) ) {
        return '';
    }

    ob_start();

    include $component_file;

    return ob_get_clean();
}

/**
 * Render one global footer before WordPress prints footer scripts.
 */
function mazhari_render_site_footer() {
    static $rendered = false;

    if ( $rendered ) {
        return;
    }

    $footer_markup = mazhari_get_site_footer_markup();

    if ( '' === $footer_markup ) {
        return;
    }

    $rendered = true;

    echo $footer_markup; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

add_action( 'wp_footer', 'mazhari_render_site_footer', 5 );

/**
 * Component Library Shortcode
 */
function mazhari_component_library_shortcode() {

    $component_file = get_stylesheet_directory()
        . '/components/component-library.php';

    if ( ! file_exists( $component_file ) ) {
        return '';
    }

    ob_start();

    include $component_file;

    return ob_get_clean();
}

add_shortcode(
    'mazhari_component_library',
    'mazhari_component_library_shortcode'
);
