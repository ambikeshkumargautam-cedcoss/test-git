<?php
/**
 * ====================================
 * Register Custom Post type Book
 * ====================================
 *
 * @package poca
 */

/**
 * Register a custom post type called "podcast".
 *
 * @see get_post_type_labels() for label keys.
 */
/**
 * Register a custom post type called "book".
 *
 * @see get_post_type_labels() for label keys.
 */
function wpdocs_codex_book_init() {
	$labels = array(
		'name'                  => _x( 'book', 'Post type general name', 'textdomain' ),
		'singular_name'         => _x( 'book', 'Post type singular name', 'textdomain' ),
		'menu_name'             => _x( 'book', 'Admin Menu text', 'textdomain' ),
		'name_admin_bar'        => _x( 'book', 'Add New on Toolbar', 'textdomain' ),
		'add_new'               => __( 'Add New book', 'textdomain' ),
		'add_new_item'          => __( 'Add New Book', 'textdomain' ),
		'new_item'              => __( 'New Book', 'textdomain' ),
		'edit_item'             => __( 'Edit Book', 'textdomain' ),
		'view_item'             => __( 'View Book', 'textdomain' ),
		'all_items'             => __( 'All book', 'textdomain' ),
		'search_items'          => __( 'Search book', 'textdomain' ),
		'parent_item_colon'     => __( 'Parent book:', 'textdomain' ),
		'not_found'             => __( 'No book found.', 'textdomain' ),
		'not_found_in_trash'    => __( 'No book found in Trash.', 'textdomain' ),
		'featured_image'        => _x( 'Book Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain' ),
		'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
		'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
		'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
		'archives'              => _x( 'Book archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain' ),
		'insert_into_item'      => _x( 'Insert into book', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain' ),
		'uploaded_to_this_item' => _x( 'Uploaded to this book', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain' ),
		'filter_items_list'     => _x( 'Filter book list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain' ),
		'items_list_navigation' => _x( 'book list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain' ),
		'items_list'            => _x( 'book list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true, // make it hierarchical (like categories).
		'publicly_queryable' => true, // whether queries can be performed on the front end for the post type as part of parse_request().
		'show_ui'            => true, // Whether to generate and allow a UI for managing this post type in the admin.
		'show_in_menu'       => true, // Where to show the post type in the admin menu.
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'book' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'menu_icon'          => 'dashicons-text-page',
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
	);

	register_post_type( 'book', $args );
}

add_action( 'init', 'wpdocs_codex_book_init' );
// ========================================= Register Custom texonomy With Name [Author] ============================================================
/**
 * This function register_taxonomy in the cutom post[Book] .
 *
 * @return void
 */
function book_author_taxonomy() {
	$labels = array(
		'name'              => _x( 'Author ', 'taxonomy general name' ),
		'singular_name'     => _x( 'Author ', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Author' ),
		'all_items'         => __( 'All Author' ),
		'parent_item'       => __( 'Parent Author' ),
		'parent_item_colon' => __( 'Parent Author:' ),
		'edit_item'         => __( 'Edit Author' ),
		'update_item'       => __( 'Update Author' ),
		'add_new_item'      => __( 'Add Author' ),
		'new_item_name'     => __( 'New Author ' ),
		'menu_name'         => __( 'Author' ),
	);
	$args   = array(
		'hierarchical'      => true, // make it hierarchical (like categories).
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array(
			'slug' => 'book-author',
		),
	);
	// 1. First Parameter of register_taxonomy is "slug" of the taxonomy which will show in the browser URL.
	// 2. Second @param is custom post name where it will show in the sub-menu of the custom posts.
	// 3. Third is Arguments.
	register_taxonomy( 'book-author', array( 'book' ), $args );
}
add_action( 'init', 'book_author_taxonomy' );
