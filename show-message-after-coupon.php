// Show custom notice when a coupon is applied
add_action( 'woocommerce_applied_coupon', 'show_mrp_coupon_notice', 10, 1 );

function show_mrp_coupon_notice( $coupon_code ) {
    // Change message text as you like
    wc_add_notice( __( 'This coupon is applied on the MRP only.', 'woocommerce' ), 'notice' );
}


// 👉 If you only want this message for specific coupons (e.g., not all), you can tweak it like this:

add_action( 'woocommerce_applied_coupon', 'show_mrp_coupon_notice_specific', 10, 1 );

function show_mrp_coupon_notice_specific( $coupon_code ) {
    $target_coupons = array( 'mrpdiscount', 'regularonly' ); // add your coupon codes here
    if ( in_array( strtolower( $coupon_code ), $target_coupons ) ) {
        wc_add_notice( __( 'This coupon is applied on the MRP only.', 'woocommerce' ), 'notice' );
    }
}
