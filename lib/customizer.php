<?php

namespace Roots\Sage\Customizer;

use Roots\Sage\Assets;

/**
 * Add postMessage support
 */
function customize_register($wp_customize) {
  $wp_customize->get_setting('blogname')->transport = 'postMessage';
}
add_action('customize_register', __NAMESPACE__ . '\\customize_register');

/**
 * Customizer JS
 */
function customize_preview_js() {
  wp_enqueue_script('sage/customizer', Assets\asset_path('scripts/customizer.js'), ['customize-preview'], null, true);
}
add_action('customize_preview_init', __NAMESPACE__ . '\\customize_preview_js');

/**
 * @snippet       Remove "successfully added to your cart"
 * @how-to        Watch tutorial @ https://businessbloomer.com/?p=19055
 * @sourcecode    https://businessbloomer.com/?p=494
 * @author        Rodolfo Melogli
 * @testedwith    WooCommerce 3.0.5
 */

add_filter( 'wc_add_to_cart_message_html', '__return_null()' );

/* Repare WooCommerce Gallery lightbox */
function wpc_theme_setup() {
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', __NAMESPACE__ . '\\wpc_theme_setup');

// Produit variables, ne pas afficher tous les prix mais uniquement le plus bas
// Utiliser les variables pour le format des prix WC 2.0
add_filter( 'woocommerce_variable_sale_price_html', __NAMESPACE__ . '\\wc_wc20_variation_price_format', 10, 2 );
add_filter( 'woocommerce_variable_price_html', __NAMESPACE__ . '\\wc_wc20_variation_price_format', 10, 2 );
function wc_wc20_variation_price_format( $price, $product ) {
  $min_price = $product->get_variation_price( 'min', true );
  $max_price = $product->get_variation_price( 'max', true );
  if ($min_price != $max_price){
  $price = sprintf( __( 'A partir de %1$s', 'woocommerce' ), wc_price( $min_price ) );
  return $price;
  } else {
  $price = sprintf( __( '%1$s', 'woocommerce' ), wc_price( $min_price ) );
  return $price;
  }
}
