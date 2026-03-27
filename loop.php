<?php
/**
 * The loop that displays posts.
 */
?>        
          <?php if (have_posts()) : ?>
          <!-- col -->
          <ol class="triad minor" id="journal-list">
          
            <?php while (have_posts()) : the_post(); ?>
            <?php get_template_part('post-layout', get_post_type( $post ) ); ?>
            <?php endwhile; ?>
                          
          </ol>
          <!--/ col -->
          <?php endif; ?>
          <?php wp_reset_query(); ?>
          
          <?php if (  $wp_query->max_num_pages > 1 ) : ?>
          	<nav>
          		<?php next_posts_link( __( '&larr; Older posts', 'starkers' ) ); ?>
          		<?php previous_posts_link( __( 'Newer posts &rarr;', 'starkers' ) ); ?>
          	</nav>
          <?php endif; ?>