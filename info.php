<?php
/**
 * Template Name: Info
 */
?>

<?php get_header(); ?>

					<?php if (have_posts()) : while ( have_posts() ) : the_post(); ?>
          <section class="major group">
          
            <h1 class="group-primary-title visuallyhidden"><strong>Page</strong></h1>
            
	          <article class="item" id="post-<?php the_ID(); ?>">
	          	<h1 class="item-primary-title"><?php the_title(); ?></h1>
	    				<div class="item-prose">
	    				  <?php the_content(); ?>
	    				</div>
	      		</article>
          
          </section>
					<?php endwhile; endif; ?>
					<?php wp_reset_query(); ?>
					
<?php get_footer(); ?>