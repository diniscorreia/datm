<?php
/**
 * The Template for displaying all single press releases.
 */
?>

<?php get_header(); ?>

					<?php if (have_posts()) : while ( have_posts() ) : the_post(); ?>
          <section class="major singular">
          	
          	<h1 class="group-primary-title"><strong>Press / Release</strong></h1>
            
            <article class="item" id="post-<?php the_ID(); ?>">
              <header>
              	<hgroup>
          				<h1 class="item-primary-title"><?php the_title(); ?></h1>
                	<h2 class="item-secondary-title"><time pubdate datetime="<?php the_time('Y-m-d') ?>"><?php the_time('M dS, Y') ?></time></h2>
          			</hgroup>
          		</header>
      				<div class="item-prose">
      				  <?php the_content(); ?>
      				</div>
        		</article>
          
          </section>
					<?php endwhile; endif; ?>
					<?php wp_reset_query(); ?>
					
<?php get_footer(); ?>