<?php
/**
 * The Sidebar
 */
?>

          <aside id="primary-sidebar">
            
            <?php if(is_front_page() || is_page('music') || is_page('shows')) : ?>
            <?php
							$page = get_page_by_title('Info');
						  $the_excerpt = $page->post_excerpt;
						  $page_data = get_page( $page );
						  $title = $page_data->post_title;
						?>
            <section id="the-band" class="group minor">
            
              <h1 class="group-primary-title"><strong>The Band</strong> <a href="<?php echo home_url( '/' ) ?>info/" title="Read More" class="global-more-bttn">More</a></h1>
              
              <div class="item-prose">
              	<p><?php echo $page->post_excerpt; ?></p>
              </div>
              
            </section>
            <?php endif; ?>
            
            <?php if(!is_front_page() & !is_home() & !is_page('music') & !is_page('shows') & !is_page('press') & 'datm_press' != get_post_type() & !is_404() & !is_tag()) : ?>
            <!-- share-page-options -->
            <section id="share-page-options" class="group minor">
               
              <h1 class="group-primary-title"><strong>Share this Page</strong></h1>
              
              <ul>
              	<li class="share-facebook">
              		<div class="fb-like" data-href="<?php echo urlencode(get_permalink()); ?>" data-send="false" data-layout="box_count" data-width="50" data-show-faces="false" data-font="lucida grande"></div>
              	</li>
              	<li class="share-twitter">
              		<a href="https://twitter.com/share" class="twitter-share-button" data-via="duskatthemansion" data-count="vertical">Tweet</a>
									<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
								</li>
								<li class="share-gplus">
									<div class="g-plusone" data-size="tall"></div>
									<script type="text/javascript">
									  (function() {
									    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
									    po.src = 'https://apis.google.com/js/plusone.js';
									    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
									  })();
									</script>
								</li>
								<li class="share-stumbleupon">
									<su:badge layout="5"></su:badge>
									<script type="text/javascript"> 
									 (function() { 
									     var li = document.createElement('script'); li.type = 'text/javascript'; li.async = true; 
									     li.src = window.location.protocol + '//platform.stumbleupon.com/1/widgets.js'; 
									     var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(li, s); 
										})(); 
									</script>
								</li>
              </ul>
              
            </section>
            <!-- /share-page-options -->
            <?php endif; ?>
            
            <?php if(is_home() || is_singular('post') || is_tag()) : ?>
            <!-- topics-cloud -->
            <section id="topics-cloud" class="group minor">
            	<?php if ( function_exists('wp_tag_cloud') ) : ?>
								<h1 class="group-primary-title"><strong>Blog Topics</strong></h1>
								<?php wp_tag_cloud('smallest=10&largest=20&format=list'); ?>
							<?php endif; ?>
            </section>
            <?php endif; ?>
            <!-- /topics-cloud -->
						
						<?php if(!is_page('shows') & !is_404() & !is_page('press') & 'datm_press' != get_post_type() & 'datm_shows' != get_post_type()) : ?>
            <?php $todaysDate = date('Y/m/d').' '.date('H:i:s'); ?>
            <?php query_posts('showposts=4&post_type=datm_shows&meta_key=datm_show_start_date&meta_compare=>=&meta_value='.$todaysDate.'&orderby=meta_value&order=ASC'); if (have_posts()) : ?>            
            <!-- upcoming-shows -->
            <section id="upcoming-shows" class="group minor">
            
              <h1 class="group-primary-title"><strong>Upcoming Shows</strong> <a href="<?php echo home_url( '/' ) ?>shows/" title="All Shows" class="global-more-bttn">All</a></h1>
              
              <ol class="item-list">
                <?php while (have_posts()) : the_post(); ?>
                <?php get_template_part('post-layout', 'datm_shows') ?>
                <?php endwhile; ?>
              </ol>
              
            </section>
            <!-- /upcoming-shows -->
            <?php endif; wp_reset_query(); ?>
            <?php endif; ?>
            
            <?php if(!is_page('press') & 'datm_press' != get_post_type()) : ?>
            <!-- latest-tweets -->
            <section id="latest-tweets" class="group minor" data-username="fallingdusk" data-count="3">
              
              <h1 class="group-primary-title"><strong>Latest Tweets</strong> <a href="http://twitter.com/fallingdusk" title="Dusk at the Mansion on Twitter" class="global-more-bttn">All</a></h1>
              <div class="item-list-wrapper"></div>
              
            </section>
            <!-- /latest-tweets -->
            <?php endif; ?>
            
            <?php if('datm_press' == get_post_type() && is_single() ) : ?>
            <!-- press-info -->
            <section id="press-band" class="group minor">
              
              <?php if(is_object_in_term( get_the_ID(), 'language', 'pt' )) : ?> 
              <h1 class="group-primary-title"><strong>Sobre a Banda</strong></h1>
              
              <article class="item">
							<?php if (function_exists('iinclude_page')) iinclude_page(230,'displayTitle=true&titleBefore=<h1 class="item-primary-title">&titleAfter=</h1><div class="item-prose">'); echo "</div>" ?>
	      			</article>
	      			
	      			<? else : ?>
              <h1 class="group-primary-title"><strong>The Band</strong></h1>
	      			
	      			<article class="item">
							<?php if (function_exists('iinclude_page')) iinclude_page(201,'displayTitle=true&titleBefore=<h1 class="item-primary-title">&titleAfter=</h1><div class="item-prose">'); echo "</div>" ?>
	      			</article>
              
              <?php endif; ?>
              
            </section>
            <!-- /press-info -->
            <?php endif; ?>
            
          </aside>