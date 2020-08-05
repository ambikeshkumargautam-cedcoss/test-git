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
<h4>book.php</h4>
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
	?>
	<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
<?
			the_post_thumbnail();
			the_content();
			the_author();
	}
}

?>

</main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>
