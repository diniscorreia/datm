<?php
/**
 * The template for displaying Tag Archive pages.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */

get_header(); ?>
          	
            <?php if (have_posts()) : ?>
            <!-- topic-archive -->
            <section id="topic-archive" class="group major">
              
              <h1 class="group-primary-title"><strong>Blog / Topic / <?php printf( __( '%s', 'starkers' ), '' . single_tag_title( '', false ) . '' ); ?></strong> <a href="<?php echo home_url( '/' ) ?>blog/" title="All Posts" class="global-more-bttn">All</a></h1>

							<ol class="item-list">
              	<?php global $more; ?>
                <?php while (have_posts()) : the_post(); ?>
                <?php $more = 0; ?>
                <?php get_template_part('post-layout', 'post' ); ?>
                <?php endwhile; ?>
              </ol>

            </section>
            <!-- /topic-archive -->
            <?php endif; wp_reset_query(); ?>

<?php get_footer(); ?>