<?php
/**
 * Gallery Mazhari
 * Reusable Badge Component
 *
 * Expected $badge_args keys:
 * - label: Badge text.
 * - variant: default, new, bestseller, or sale.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$badge_args = isset( $badge_args ) && is_array( $badge_args )
    ? $badge_args
    : array();

$badge = wp_parse_args(
    $badge_args,
    array(
        'label'   => '',
        'variant' => 'default',
    )
);

$allowed_variants = array( 'default', 'new', 'bestseller', 'sale' );
$badge_variant     = is_scalar( $badge['variant'] )
    ? sanitize_key( (string) $badge['variant'] )
    : 'default';
$badge_label       = is_scalar( $badge['label'] )
    ? trim( (string) $badge['label'] )
    : '';

if ( ! in_array( $badge_variant, $allowed_variants, true ) ) {
    $badge_variant = 'default';
}

if ( '' === $badge_label ) {
    return;
}
?>

<span class="mds-badge mds-badge--<?php echo esc_attr( $badge_variant ); ?>">
    <?php echo esc_html( $badge_label ); ?>
</span>
