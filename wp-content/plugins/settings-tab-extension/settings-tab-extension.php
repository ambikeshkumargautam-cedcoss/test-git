<?php
/**
 * This plugin create some input field in the woocommerce
 *
 * This will create input fields in the woocommerce->product->edit[product]-> product-Data->General settings
 * in the woocommerce.
 *
 * @link              https://github.com/ambikeshkumargautam-cedcoss
 * @since             1.0.0
 * @package           settings-tab-extension
 *
 * @wordpress-plugin
 * Plugin Name:       settings-tab-extension
 * Plugin URI:        https://github.com/ambikeshkumargautam-cedcoss/woo-marketplace-integration
 * Description:       To add custom settings input field in woocommerce.
 * Version:           1.0.0
 * Author:            Ambikesh kumar Gautam
 * Author URI:        https://github.com/ambikeshkumargautam-cedcoss
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       settings-tab-extension
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'SETTINGS-TAB-EXTENSION', '1.0.0' );
/**
 * Check if WooCommerce is active
 */
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	/**
	 * ***************************************************************
	 * To creat custom fields in product_edit->general-> custom fields
	 * ***************************************************************
	 *
	 * @return void
	 */
	function woocommerce_product_custom_unique_key_fields() {
			global $woocommerce, $post;
			echo '<div class=" product_custom_field ">';
			// This function has the logic of creating custom field.
			// This function includes input text field to inter unique key.
			// Custom Product Text Field.
			woocommerce_wp_text_input(
				array(
					'id'          => '_custom_product_unique_key_field',
					'label'       => __( 'Unique Key', 'woocommerce' ),
					'placeholder' => 'Unique Key Text Field',
					'desc_tip'    => 'true',
				)
			);

			echo '</div>';
	}
	// The code for displaying WooCommerce Product Custom Fields.
	add_action( 'woocommerce_product_options_general_product_data', 'woocommerce_product_custom_unique_key_fields' );
	/**
	 * **************************************************
	 * To save the custom field values into the Database.
	 * **************************************************
	 *
	 * @param string $post_id current post id.
	 * @return void
	 */
	function woocommerce_product_custom_unique_key_fields_save( $post_id ) {
		// Custom Product unique key field.
		$woocommerce_custom_product_unique_key_field = $_POST['_custom_product_unique_key_field'];
		if ( ! empty( $woocommerce_custom_product_unique_key_field ) ) {
			update_post_meta( $post_id, '_custom_product_unique_key_field', esc_attr( $woocommerce_custom_product_unique_key_field ) );
		}
	}
	// Following code Saves  WooCommerce Product unique text field value in  wp_postmeta table.
	add_action( 'woocommerce_process_product_meta', 'woocommerce_product_custom_unique_key_fields_save' );
	/**
	 * ***********************************************************
	 * Add unique input value with SKU on the product detail page|
	 * ***********************************************************
	 *
	 * @param string $sku sku of the product.
	 * @param string $product sfd.
	 * @return string
	 */
	function add_unique_input_value_to_sku( $sku, $product ) {
		if ( is_single() ) {
			$parts = explode( '.', $sku );

			// Only first two parts.
			$parts = array_slice( $parts, 0, 2 );

			// Display the value of custom product text field.
			$value = get_post_meta( get_the_ID(), '_custom_product_unique_key_field', true );
			// OR all parts except last (remove above)
			// array_pop( $parts );.
			$sku = implode( '.', $parts ) . $value;
		}

		return $sku;
	}
	add_filter( 'woocommerce_get_sku', 'add_unique_input_value_to_sku', 10, 2 );
	/**
	 * *************************************************************************************************************************************************************************
	 * .....................CREATING CUSTOM ADDITIONAL TAB IN THE PRODUCT DETAIL PAGE IN DESCRIPTION SECTION
	 * Check if product has attributes, dimensions or weight to override the call_user_func() expects parameter 1 to be a valid callback error when changing the additional tab
	 * *************************************************************************************************************************************************************************
	 */
	add_filter( 'woocommerce_product_tabs', 'woo_rename_tabs', 98 );
	/**
	 * Adding addition information tab on the product detail page.
	 *
	 * @param [type] $tabs .
	 * @return string
	 */
	function woo_rename_tabs( $tabs ) {

		global $product;

		if ( $product->has_attributes() || $product->has_dimensions() || $product->has_weight() ) { // Check if product has attributes, dimensions or weight.
			$tabs['additional_information']['title'] = __( 'Additional Product data' );// Rename the additional information tab.
		}

		return $tabs;
	}
	/**
	 * *************************************************************************
	 * To add one more custom output field in additional details of the product
	 * on the single detail page of the product detailpage->additional
	 * information->unique key[field].
	 * *************************************************************************
	 *
	 * @param string $product_attributes attributes of product.
	 * @return string
	 */
	function yourprefix_woocommerce_display_product_attributes( $product_attributes ) {
		$product_attributes['uniquekey'] = array(
			'label' => __( 'Unique key', 'text-domain' ),
			'value' => get_post_meta( get_the_ID(), '_custom_product_unique_key_field', true ),
		);
		return $product_attributes;
	}
		add_filter( 'woocommerce_display_product_attributes', 'yourprefix_woocommerce_display_product_attributes', 10, 2 );

	/**
	 * ----------------------TASK TWO ---------------
	 * 1) This field should be shown on cart page along with the product that is been added to cart
	 * - Customer Order View Page should also show this value along side product
	 * - Products on Order Edit page on admin panel should also show this value.
	 */
	/**
	 * Display custom item data in the cart
	 */

	/**
	 * Creating output in the product field
	 *
	 * @param [type] $item_data .
	 * @param [type] $cart_item_data .
	 * @return string
	 */
	function plugin_republic_get_item_data( $item_data, $cart_item_data ) {
				$value   = get_post_meta( get_the_ID(), '_custom_product_unique_key_field', true );
			$item_data[] = array(
				'key'   => __( 'Unique key', 'text-domain' ),
				'value' => 'this',
			);
			return $item_data;
	}
	add_filter( 'woocommerce_get_item_data', 'plugin_republic_get_item_data', 10, 2 );
	/**
	 * Adding thank you text on thank you page.
	 */
	add_filter( 'woocommerce_thankyou_order_received_text', 'woo_change_order_received_text', 10, 2 );
	/**
	 * Appear custom new text on the thank you text.
	 *
	 * @param string $str already available text.
	 * @param string $order .
	 * @return string
	 */
	function woo_change_order_received_text( $str, $order ) {
		$new_str = $str . ' We have emailed the purchase receipt to you.';
		return $new_str;
	}
}
