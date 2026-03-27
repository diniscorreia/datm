<?php
/**
 * Template Name: Shows
 */
?>

<?php get_header(); ?>

					<?php $todaysDate = date('Y/m/d H:i:s'); ?>
          <?php query_posts('showposts=100&post_type=datm_shows&meta_key=datm_show_start_date&meta_compare=>=&meta_value='.$todaysDate.'&orderby=meta_value&order=ASC'); if (have_posts()) : ?>            
          <!-- upcoming-shows -->
          <section id="upcoming-shows" class="group major">
          
            <h1 class="group-primary-title"><strong>Upcoming Shows</strong></h1>
            
            <ol class="item-list">
              <?php while (have_posts()) : the_post(); ?>
              <?php get_template_part('post-layout', 'datm_shows') ?>
              <?php endwhile; ?>
            </ol>
            
          </section>
          <!-- /upcoming-shows -->
          <?php endif; wp_reset_query(); ?>
          
          <?php query_posts('showposts=100&post_type=datm_shows&meta_key=datm_show_start_date&meta_compare=<=&meta_value='.$todaysDate.'&orderby=meta_value&order=DSC'); if (have_posts()) : ?>            
          <!-- past-shows -->
          <section id="past-shows" class="group major">
          
            <h1 class="group-primary-title"><strong>Past Shows</strong></h1>
            
            <ol class="item-list">
              <?php while (have_posts()) : the_post(); ?>
              <?php get_template_part('post-layout', 'datm_shows') ?>
              <?php endwhile; ?>
            </ol>
            
          </section>
          <!-- /past-shows -->
          <?php endif; wp_reset_query(); ?>
          
<?php get_footer(); ?>