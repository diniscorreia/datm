<?php
/**
 * The Header.
 */
?>
<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!-- Consider adding a manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="description" content="<?php bloginfo( 'description' ); ?>" />
    <meta name="keywords" content="music,band,trio,electro,electronic,eletronica,synth-pop,dark,melancholic,energetic,cello,drums,keyboard,laptop,Lisboa,Lisbon,Portugal,David Costa,Leihla Pinho,Ricardo Mestre" />
    <meta name="author" content="Dusk at the Mansion" />
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <link rel="shortcut icon" href="<?php bloginfo( 'template_url' ); ?>/assets/images/aux/favicon.ico" />
    <link rel="apple-touch-icon" href="<?php bloginfo( 'template_url' ); ?>/assets/images/aux/apple-touch-icon-57x57.png"> 
    <link rel="apple-touch-icon" sizes="72x72" href="<?php bloginfo( 'template_url' ); ?>/assets/images/aux/apple-touch-icon-72x72.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="<?php bloginfo( 'template_url' ); ?>/assets/images/aux/apple-touch-icon-114x114.png" />
<!--     <link rel="image_src" href="<?php bloginfo( 'template_url' ); ?>/assets/images/aux/facebook-thumb.png" /> -->
    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />  
    <?php wp_head(); ?>
    <script src="<?php bloginfo( 'template_url' ); ?>/assets/js/libs/modernizr.custom.20537.js"></script>
  </head>

  <body <?php body_class(); ?>>
  	
  	<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
		</script>
    
    <!-- page -->
    <div id="page">
        
      <!-- brand -->
      <header id="brand" role="banner">
      
    		<h1 class="brand-name"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home" class="ir"><?php bloginfo( 'name' ); ?></a></h1>
    		<?php wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'primary-nav-wrapper', 'menu_id' => 'primary-nav', 'fallback_cb' => 'starkers_menu', 'theme_location' => 'primary' ) ); ?>

      </header>
      <!-- /brand -->
    
      <!-- main -->
      <div id="main" class="clearfix">
      
      	<!-- content -->
        <div id="content">
          