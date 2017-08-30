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

/** WOOCOMMERCE CUSTOMIZATION **/
//remove_action( 'woocommerce_after_single_product_summary', __NAMESPACE__ . '\\woocommerce_output_product_data_tabs', 10 );

//* http://gasolicious.com/remove-tabs-keep-product-description-woocommerce/
//  Location: add to functions.php
//  Output: adds full description to below price

function woocommerce_template_product_description() {
  woocommerce_get_template( 'single-product/tabs/description.php' );
}
add_action( 'woocommerce_single_product_summary', __NAMESPACE__ . '\\woocommerce_template_product_description', 90 );

// REMOVE ADD TO CART BUTTON ON SHOP PAGE
add_action( 'woocommerce_after_shop_loop_item', __NAMESPACE__ . '\\remove_add_to_cart_buttons', 1 );

function remove_add_to_cart_buttons() {
  if( is_product_category() || is_shop()) {
    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
  }
}

// Change number or products per row to 3
add_filter('loop_shop_columns',  __NAMESPACE__ . '\\loop_columns');
if (!function_exists('loop_columns')) {
	function loop_columns() {
		return 3; // 3 products per row
	}
}
// Remove Related Products Output
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );


/**
 * Hook in on activation
 */

/**
 * Define image sizes https://docs.woocommerce.com/document/set-woocommerce-image-dimensions-upon-theme-activation/
 */
 /*
function azalyne_woocommerce_image_dimensions() {
	global $pagenow;

	if ( ! isset( $_GET['activated'] ) || $pagenow != 'themes.php' ) {
		return;
	}

  	$catalog = array(
		'width' 	=> '400',	// px
		'height'	=> '400',	// px
		'crop'		=> 1 		// true
	);

	$single = array(
		'width' 	=> '600',	// px
		'height'	=> '600',	// px
		'crop'		=> 1 		// true
	);

	$thumbnail = array(
		'width' 	=> '120',	// px
		'height'	=> '120',	// px
		'crop'		=> 0 		// false
	);

	// Image sizes
	update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
	update_option( 'shop_single_image_size', $single ); 		// Single product image
	update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
}

add_action( 'after_switch_theme', __NAMESPACE__ . '\\azalyne_woocommerce_image_dimensions', 1 );
*/
