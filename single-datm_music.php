<?php
/**
 * The Template for displaying all single music releases.
 */
?>

<?php get_header(); ?>

					<?php
					$musicReleaseDate = get_post_meta($post->ID,'datm_release_date',true);
					$musicReleaseDate = strtotime($musicReleaseDate);
					$musicRecordLabel = get_post_meta($post->ID,'datm_record_label',true);
					?>
					
					<?php if (have_posts()) : while ( have_posts() ) : the_post(); ?>
          <section class="major singular">
          	
          	<header>
          		<h1 class="group-primary-title"><strong>Music / Release</strong> <a href="<?php echo home_url( '/' ) ?>music/" title="All Music" class="global-more-bttn">All</a></h1>
          	</header>
            
            <article class="music item" id="post-<?php the_ID(); ?>">
            	<header>
            		<hgroup>
            			<h1 class="item-primary-title"><?php the_title(); ?></h1>
      				  	<?php if($musicReleaseDate || $musicRecordLabel) : ?>
    							<h2 class="item-secondary-title">Release: <?php if($musicReleaseDate) : ?><time datetime="<?php echo date('Y-m-d', $musicReleaseDate); ?>"><?php echo date('M dS, Y', $musicReleaseDate); ?></time><?php endif; ?><?php if($musicRecordLabel) : ?> / <?php echo $musicRecordLabel; ?><?php endif; ?></h2>
    							<?php endif; ?>
    						</hgroup>
            	</header>
      				<div class="item-prose">
      				  <?php the_content(); ?>
      				</div>
        		</article>
        		
        		<?php /*
        		Facebook Comments removed — fbcomments shortcode no longer works.
        		<aside class="item-comments">
      				<h1 class="group-primary-title"><strong>Comments</strong></h1>
      				<?php echo do_shortcode('[fbcomments width="580" count="off" num="4" title=""]'); ?>
          	</aside>
          	*/ ?>
        		
        		<footer>
	        		<nav id="inner-nav-wrapper" role="navigation">
		      			<ul id="inner-nav">
		      				<?php previous_post_link_plus( array(
			        			'order_by' => 'custom',
		                'order_2nd' => 'post_title',
		                'meta_key' => 'datm_release_date',
		                'post_type' => '',
		                'loop' => false,
		                'end_post' => false,
		                'thumb' => false,
		                'max_length' => 0,
		                'format' => '%link',
		                'link' => 'Previous',
		                'date_format' => '',
		                'tooltip' => '%title',
		                'in_same_cat' => false,
		                'in_same_tax' => false,
		                'in_same_format' => false,
		                'in_same_author' => false,
		                'in_same_meta' => false,
		                'ex_cats' => '',
		                'ex_cats_method' => 'weak',
		                'in_cats' => '',
		                'ex_posts' => '',
		                'in_posts' => '',
		                'before' => '<li class="prev">',
		                'after' => '</li>',
		                'num_results' => 1,
		                'return' => ''
		                ) ); ?>
		        			<?php next_post_link_plus( array(
			        			'order_by' => 'custom',
		                'order_2nd' => 'post_title',
		                'meta_key' => 'datm_release_date',
		                'post_type' => '',
		                'loop' => false,
		                'end_post' => false,
		                'thumb' => false,
		                'max_length' => 0,
		                'format' => '%link',
		                'link' => 'Next',
		                'date_format' => '',
		                'tooltip' => '%title',
		                'in_same_cat' => false,
		                'in_same_tax' => false,
		                'in_same_format' => false,
		                'in_same_author' => false,
		                'in_same_meta' => false,
		                'ex_cats' => '',
		                'ex_cats_method' => 'weak',
		                'in_cats' => '',
		                'ex_posts' => '',
		                'in_posts' => '',
		                'before' => '<li class="next">',
		                'after' => '</li>',
		                'num_results' => 1,
		                'return' => ''
		                ) ); ?>
		            </ul>
		          </nav>
        		</footer>
          
          </section>
					<?php endwhile; endif; ?>
					<?php wp_reset_query(); ?>
					
<?php get_footer(); ?>