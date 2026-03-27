<?php
/**
 * Template Name: Music
 */
?>

<?php get_header(); ?>
          
          <?php $todaysDate = date('Y/m/d'); ?>
          <?php query_posts('post_type=datm_music&meta_key=datm_release_date&meta_compare=<=&meta_value='.$todaysDate.'&orderby=meta_value&order=DSC'); if (have_posts()) : ?>
					<!-- index-music -->
          <section id="index-music" class="group major">
						
						<h1 class="group-primary-title"><strong>Music</strong></h1>
              
            <ol class="item-list">
            	<?php global $more; ?>
           		<?php while (have_posts()) : the_post(); ?>
           		<?php $more = 0; ?>
            	<?php get_template_part('post-layout', 'datm_music' ); ?>
            	<?php endwhile; ?>
						</ol>
						
          </section>
          <!-- /index-music -->
          <?php endif; wp_reset_query(); ?>
          
<?php get_footer(); ?>