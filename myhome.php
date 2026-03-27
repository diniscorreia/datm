<?php
/**
 * Template Name: Home
 */
?>
<?php get_header(); ?>

            <?php query_posts('meta_key=datm_featured&meta_value=on'); if (have_posts()) : ?>
            <!-- featured-posts -->
            <section id="featured-posts" class="group major">
              
              <h1 class="group-primary-title"><strong>Featured Blog Posts</strong> <a href="<?php echo home_url( '/' ) ?>blog/" title="All Posts" class="global-more-bttn">All</a></h1>
              
              <ol class="item-list">
              	<?php global $more; ?>
                <?php while (have_posts()) : the_post(); ?>
                <?php $more = 0; ?>
                <?php get_template_part('post-layout', 'post' ); ?>
                <?php endwhile; ?>
              </ol>

            </section>
            <!-- /featured-posts -->
            <?php endif; wp_reset_query(); ?>
            
            <?php if (  $wp_query->max_num_pages > 1 ) : ?>
          	<nav>
          		<?php next_posts_link( __( '&larr; Older posts', 'starkers' ) ); ?>
          		<?php previous_posts_link( __( 'Newer posts &rarr;', 'starkers' ) ); ?>
          	</nav>
          	<?php endif; ?>

<?php get_footer(); ?>