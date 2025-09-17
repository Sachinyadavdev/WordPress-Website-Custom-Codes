// Force coupons to use regular price instead of sale price
add_filter( 'woocommerce_product_get_price', 'force_coupon_on_regular_price', 20, 2 );
add_filter( 'woocommerce_product_variation_get_price', 'force_coupon_on_regular_price', 20, 2 );

function force_coupon_on_regular_price( $price, $product ) {
    // Only adjust when coupon is applied
    if ( WC()->cart && ! empty( WC()->cart->applied_coupons ) ) {
        $regular_price = $product->get_regular_price();
        if ( $regular_price && $regular_price > 0 ) {
            return $regular_price;
        }
    }
    return $price;
}
