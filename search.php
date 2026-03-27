<?php
/**
 * The Template for displaying search results.
 */
?>

<?php get_header(); ?>
<?php if ( have_posts() ) : ?>

			<?php get_template_part( 'loop', 'search' ); ?>
			
<?php else : ?>

		<h2><?php _e( 'Nothing Found', 'starkers' ); ?></h2>
		<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'starkers' ); ?></p>

<?php endif; ?>

<?php get_footer(); ?>