<?php
/**
 * Template Name: Press
 */
?>

<?php get_header(); ?>
					
          <?php query_posts('post_type=datm_press'); if (have_posts()) : ?>
					<!-- index-press -->
          <section id="index-press" class="group major">
						
						<h1 class="group-primary-title"><strong>Press</strong></h1>
              
            <ol class="item-list">
            	<?php while (have_posts()) : the_post(); ?>
							<?php get_template_part( 'post-layout', 'datm_press' ); ?>
							<?php endwhile; ?>
						</ol>
						
					</section>
          <!-- /index-press -->
          <?php endif; wp_reset_query(); ?>
          
<?php get_footer(); ?>