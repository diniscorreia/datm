<?php
/**
 * Template Name: 404
 */
?>

<?php get_header(); ?>

          <section class="major singular">
          
          	<h1 class="group-primary-title"><strong>404 Error</strong></h1>
            
	          <article class="item" id="post-<?php the_ID(); ?>">
							<?php if (function_exists('iinclude_page')) iinclude_page(43,'displayTitle=true&titleBefore=<h1 class="item-primary-title">&titleAfter=</h1><div class="item-prose">'); echo "</div>" ?>
	      		</article>
          
          </section>

<?php get_footer(); ?>