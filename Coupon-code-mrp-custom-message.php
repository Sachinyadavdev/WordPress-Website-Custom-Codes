<?php
// ---------------------------
// Force coupons to use regular price
// ---------------------------
add_filter( 'woocommerce_product_get_price', 'desby_force_coupon_on_regular_price', 20, 2 );
add_filter( 'woocommerce_product_variation_get_price', 'desby_force_coupon_on_regular_price', 20, 2 );

function desby_force_coupon_on_regular_price( $price, $product ) {
    if ( is_admin() && ! defined( 'DOING_AJAX' ) ) {
        return $price;
    }

    if ( WC()->cart && ! empty( WC()->cart->applied_coupons ) ) {
        $regular_price = $product->get_regular_price();
        if ( $regular_price !== '' && $regular_price !== null ) {
            return $regular_price;
        }
    }
    return $price;
}

// ---------------------------
// Show "applied on MRP only" message (once)
// ---------------------------
add_action( 'woocommerce_applied_coupon', 'desby_show_mrp_coupon_notice', 10, 1 );

function desby_show_mrp_coupon_notice( $coupon_code ) {
    // 🔹 If empty, message applies to ALL coupons
    // 🔹 If not empty, message applies ONLY to listed coupon codes
    $target_coupons = array( 'mrpdiscount', 'regularonly' ); // lowercase coupon codes

    $apply_to_all = empty( $target_coupons );

    if ( $apply_to_all || in_array( strtolower( $coupon_code ), $target_coupons, true ) ) {
        $message = __( 'Note: This coupon is applied on the MRP (regular price) only.', 'your-text-domain' );

        // Save it in session (do not show immediately here)
        if ( WC()->session ) {
            WC()->session->set( 'desby_mrp_coupon_notice', $message );
        }
    }
}

// ---------------------------
// Print and clear the message (only once)
// ---------------------------
add_action( 'woocommerce_before_cart', 'desby_print_mrp_coupon_notice_from_session', 5 );
add_action( 'woocommerce_before_checkout_form', 'desby_print_mrp_coupon_notice_from_session', 5 );

function desby_print_mrp_coupon_notice_from_session() {
    if ( ! WC()->session ) {
        return;
    }

    $msg = WC()->session->get( 'desby_mrp_coupon_notice' );
    if ( $msg ) {
        wc_print_notice( $msg, 'notice' );
        WC()->session->__unset( 'desby_mrp_coupon_notice' );
    }
}
