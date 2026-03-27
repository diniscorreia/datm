<?php
/**
 * The main template file.
*/
?>

<?php get_header(); ?>
					
					<?php query_posts('caller_get_posts=1'); ?>
					<?php if (have_posts()) : ?>
					<!-- index-blog -->
          <section id="index-blog" class="group major">
						
						<h1 class="group-primary-title"><strong>Blog</strong></h1>
              
            <ol class="item-list">
            	<?php while (have_posts()) : the_post(); ?>
							<?php get_template_part( 'post-layout' ); ?>
							<?php endwhile; ?>
						</ol>
						
					</section>
          <!-- /index-blog -->
          <?php endif; wp_reset_query(); ?>
          
<?php get_footer(); ?>