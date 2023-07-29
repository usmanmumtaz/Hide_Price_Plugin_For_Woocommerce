<?php
/**
 * Plugin Name: Hide Price
 */

add_filter('woocommerce_get_price_html','members_only_price');
function members_only_price($price) {
    if(is_user_logged_in()){
        return $price;
    }    
    else {
        remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
        remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
        return 'Only <a href="' .get_permalink(woocommerce_get_page_id('myaccount')). '">Registered Users</a> are able to view pricing.';
    }    
}