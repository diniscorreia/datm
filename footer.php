<?php
/**
 * The Footer.
 */
?>
      	</div>
      	<!-- /content -->
      	
      	<?php get_sidebar(); ?>
      	
      </div>
      <!-- /main -->
      
      <!-- colophon -->
    	<footer id="colophon">
        
    		<nav id="colophon-nav-wrapper">
    			<?php wp_nav_menu( array( 'container' => '', 'menu_id' => 'follow-nav', 'fallback_cb' => 'starkers_menu', 'theme_location' => 'follow' ) ); ?>
    			<div class="fb-like" data-href="http://facebook.com/duskatthemansion" data-send="false" data-layout="button_count" data-width="100" data-show-faces="false"></div>
				</nav>
    		<p class="credits"><strong><a href="<?php echo home_url( '/' ) ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></strong> Copyright © <?php echo date('Y'); ?></p>
    		
    	</footer>
    	<!-- /colophon -->
  
      <!-- Grab Google CDN's jQuery. fall back to local if necessary -->
      <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.js"></script>
      <script>!window.jQuery && document.write(unescape('%3Cscript src="<?php bloginfo( 'template_url' ); ?>/assets/js/libs/jquery-1.7.2.min.js"%3E%3C/script%3E'))</script>
      <script type="text/javascript" src="<?php bloginfo( 'template_url'); ?>/assets/js/libs/jquery.fancybox.js"></script>
      <script type="text/javascript" src="<?php bloginfo( 'template_url'); ?>/assets/js/libs/jquery.animate-colors-min.js"></script>
			<!--[if (gte IE 6)&(lte IE 8)]>
      <script type="text/javascript" src="<?php bloginfo( 'template_url'); ?>/assets/js/libs/selectivizr-min.js"></script>
      <![endif]-->
      <script type="text/javascript" src="<?php bloginfo( 'template_url'); ?>/assets/js/jquery.tweet.js"></script>
      <script type="text/javascript" src="<?php bloginfo( 'template_url'); ?>/assets/js/global.js"></script>
        
      <?php wp_footer(); ?>
    
    </div>
    <!-- /page -->
    
  </body>
  
</html>