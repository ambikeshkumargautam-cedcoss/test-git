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
<h3> single-book.php </h3>
<main id="site-content" role="main">
<?php
/*************************************************
 * Showing single post of custom post type Book
 *************************************************/
// Checking we have post or not of provided condition.
	if ( have_posts() ) {
	// Single gallery Item.
		while( have_posts() ) {
			the_post();
	?>
			<h3><a href="<?php the_permalink(); ?>"><?php the_title( get_post_meta( get_the_ID(), 'meta-box-text', true ) ); ?></a></h3>
<?
			the_post_thumbnail();
			// the_content();	
			/* Add a paragraph only to Pages. */
			the_content();
			the_author();
		}// end while
	}// end if
?>

</main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>
