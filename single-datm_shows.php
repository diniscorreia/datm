<?php
/**
 * The Template for displaying all single shows.
 */
?>

<?php get_header(); ?>

					<?php
					$now = time();
					$showStartDate = get_post_meta($post->ID,'datm_show_start_date',true);
					$showStartDate = strtotime($showStartDate);
					$showEndDate = get_post_meta($post->ID,'datm_show_end_date',true);
					$showEndDate = strtotime($showEndDate);
					$venue = get_post_meta($post->ID,'datm_show_venue',true);
					$address = get_post_meta($post->ID,'datm_show_address',true);
					$postalcode = get_post_meta($post->ID,'datm_show_postalcode',true);
					$city = get_post_meta($post->ID,'datm_show_city',true);
					$country = get_post_meta($post->ID,'datm_show_country',true);
					$tickets = get_post_meta($post->ID,'datm_tickets_info',true);
					$info = get_post_meta($post->ID,'datm_event_url',true);
					$price = get_post_meta($post->ID,'datm_event_price',true);
					$geo = urlencode("$address, $city, $country");
					?>
					
					<?php if (have_posts()) : while ( have_posts() ) : the_post(); ?>
          <section class="major singular">
          
          	<header>
          		<h1 class="group-primary-title"><strong>Shows / <?php if($showStartDate < $now) : ?>Past<?php else : ?>Upcoming<?php endif; ?></strong> <a href="<?php echo home_url( '/' ) ?>shows/" title="All Shows" class="global-more-bttn">All</a></h1>
          	</header>
          	
            <article class="show item" id="post-<?php the_ID(); ?>">
            	<header>
            		<hgroup>
									<h1 class="item-primary-title"><?php the_title(); ?></h1>
									<h2 class="item-secondary-title"><time datetime="<?php echo date('Y-m-d\TH:i', $showStartDate).'-'.date('Y-m-d\TH:i', $showEndDate); ?>"><span class="month"><?php echo date('M', $showStartDate); ?></span> <span class="day"><?php echo date('d', $showStartDate); ?></span></time></h2>
									<h3 class="item-tertiary-title"><?php echo "$city, $country"; ?></h3>
								</hgroup>
  							<dl class="item-details">
  								<?php if($showStartDate) : ?>
  								<dt class="item-detail-title">When</dt>
  								<dd class="item-detail-desc"><time datetime="<?php echo date('Y-m-d\TH:i', $showStartDate).'-'.date('Y-m-d\TH:i', $showEndDate); ?>"><?php echo date('l, dS M Y \a\t g:ia', $showStartDate); ?></time></dd>
  								<?php endif; ?>
  								<?php if($venue & $address & $postalcode & $city & $country) : ?>
  								<dt class="item-detail-title">Where</dt>
  								<dd class="item-detail-desc">
  									<?php echo '<strong class="venue">'.$venue.'</strong>'; ?>
  									<?php echo '<span class="address">'.$address.'</span>'; ?>
  									<?php echo '<span class="postalcode">'.$postalcode.' '.$city.', '.$country.'</span>'; ?>
  									<small class="map"><a href="http://maps.google.com/maps?q=<?php echo $geo; ?>" title="Google Maps">Map ›</a></small>
  								</dd>
  								<?php endif; ?>
  								<?php if($price) : ?>
  								<dt class="item-detail-title">Price</dt>
  								<dd class="item-detail-desc"><?php echo $price; ?></dd>
  								<?php endif; ?>
  								<?php if($info) : ?>
  								<dt class="item-detail-title">More</dt>
  								<dd class="item-detail-desc"><a href="<?php echo $info; ?>" title="More Information"><?php echo $info; ?></a></dd>
  								<?php endif; ?>
  							</dl>
            	</header>
      				<div class="item-prose">
      				  <?php the_content(); ?>
      				</div>
        		</article>
        		
        		<aside class="item-comments">
      				<h1 class="group-primary-title"><strong>Comments</strong></h1>
      				<?php echo do_shortcode('[fbcomments width="580" count="off" num="4" title=""]'); ?>
          	</aside>
        		
        		<footer>
	        		<nav id="inner-nav-wrapper" role="navigation">
		      			<ul id="inner-nav">
		      				<?php previous_post_link_plus( array(
			        			'order_by' => 'custom',
		                'order_2nd' => 'post_title',
		                'meta_key' => 'datm_show_start_date',
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
		                'meta_key' => 'datm_show_start_date',
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