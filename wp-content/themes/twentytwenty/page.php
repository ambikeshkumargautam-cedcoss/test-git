<?php
/**
 * The template for displaying single posts and pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
?>

<main id="site-content" role="main">
<?php
/*********************************************************************
 * Fetching  all the Book Custom post type  form the DataBase
 **********************************************************************/
$args = array(
	'post_type'      => 'book',
	'post_status'    => 'publish',
	'posts_per_page' => 10,
	'paged'          => 1,
); // This is conditional statements.

$book_posts = new WP_Query( $args ); // Creating  $book_posts  instance.
if ( $book_posts->have_posts() ) { // Checking we have post or not of provided condition.
	// Single gallery Item.

	while ( $book_posts->have_posts() ) {
		$book_posts->the_post();
		the_post_thumbnail();
		the_author();

			get_template_part( 'template-parts/content', get_post_type() );
	}
	wp_reset_postdata();
} else {
	// if there is no post inside the conditional database then this message wil print .
	esc_html_e( 'No podcast_posts in the diving taxonomy!', 'text-domain' );
}

?>

</main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>
