<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/ambikeshkumargautam-cedcoss
 * @since             1.0.0
 * @package           Book
 *
 * @wordpress-plugin
 * Plugin Name:       Book
 * Plugin URI:        https://github.com/ambikeshkumargautam-cedcoss/woo-marketplace-integration
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Ambikesh kumar Gautam
 * Author URI:        https://github.com/ambikeshkumargautam-cedcoss
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       book
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
define( 'BOOK_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-book-activator.php
 */
function activate_book() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-book-activator.php';
	Book_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-book-deactivator.php
 */
function deactivate_book() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-book-deactivator.php';
	Book_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_book' );
register_deactivation_hook( __FILE__, 'deactivate_book' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-book.php';
/**
 * Including custom post type Book
 */
require plugin_dir_path( __FILE__ ) . 'includes/custom-post-book.php';
/**
 * **************************************
 * To creat custom meta box.
 * **************************************
 *
 * @return void
 */
function book_custom_post_add_custom_box() {
	$screens = array( 'post', 'book' );

	foreach ( $screens as $screen ) {
		add_meta_box(
			'wporg_box_id',           // Unique ID.
			'Add you content on the single page',  // Box title.
			'edit_custom_post_book_custom_box_html',  // Content callback, must be of type callable.
			$screen,                   // Post type.
			'advanced'
		);
	}
}
add_action( 'add_meta_boxes', 'book_custom_post_add_custom_box' );
/**
 * Appear html in the custom post type .
 *
 * @param string $object for create html description fields.
 * @return void
 */
function edit_custom_post_book_custom_box_html( $object ) {
	wp_nonce_field( basename( __FILE__ ), 'meta-box-nonce' );
	?>
	<div>
		<label for="meta-box-text">Enter title for append</label>
		<input name="meta-box-text" type="text" value="<?php echo get_post_meta( get_the_ID(), 'meta-box-text', true ); ?>">	</div>
		<br>
		<label for="meta-box-text-description">Enter you Descriptoin </label>
		<input name="meta-box-text-description" type="text" value="<?php echo get_post_meta( get_the_ID(), 'meta-box-text-description', true ); ?>">
	</div>
	<div>
	<?php
}
/**
 * *****************************************
 * Storing metabox values in the tables
 *
 * @return void
 * ******************************************
 */
function save_custom_meta_box( $post_id, $post, $update ) {

	$meta_box_text_value             = '';
	$meta_box_text_description_value = '';

	if ( isset( $_POST['meta-box-text'] ) ) {
		$meta_box_text_value = $_POST['meta-box-text'];
	}
	update_post_meta( $post_id, 'meta-box-text', $meta_box_text_value );

	if( isset( $_POST['meta-box-text-description'] ) ) {

		$meta_box_text_description_value = $_POST['meta-box-text-description'];
	}
	update_post_meta( $post_id, 'meta-box-text-description', $meta_box_text_description_value );
}
add_action( 'save_post', 'save_custom_meta_box', 10, 3 );
/**
 * ********************************************************
 * Apppend descriptoin on single post custom post type book.
 * ********************************************************
 *
 * @param string $content description.
 * @return string
 */
function my_added_page_content( $content ) {
	if ( is_single() ) {
		$content = $content . get_post_meta( get_the_ID(), 'meta-box-text-description', true );
	}
	return $content;
}
add_filter( 'the_content', 'my_added_page_content' );

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_book() {

	$plugin = new Book();
	$plugin->run();

}
run_book();
