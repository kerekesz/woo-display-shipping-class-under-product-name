add_filter( 'woocommerce_cart_item_name', 'shipping_class_in_item_name', 20, 3);
function shipping_class_in_item_name( $item_name, $cart_item, $cart_item_key ) {
    // Only in cart page (remove the line below to allow the display in checkout too)
    if( ! ( is_cart() || is_checkout() ) ) return $item_name;

    $product = $cart_item['data']; // Get the WC_Product object instance
    $shipping_class_id = $product->get_shipping_class_id(); // Shipping class ID
    $shipping_class_term = get_term( $shipping_class_id, 'product_shipping_class' );

    if( empty( $shipping_class_id ) )
        return $item_name; // Return default product title (in case of)

    $label = __( 'Shipping class', 'woocommerce' );

    return $item_name . '<br>
        <p class="item-shipping_class" style="margin:12px 0 0;">
            <strong>' .$label . ': </strong>' . $shipping_class_term->name .' - '. $shipping_class_term->description . '</p>';
}
