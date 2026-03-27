<?php
/**
 * Starkers functions and definitions
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */

/** Tell WordPress to run starkers_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'starkers_setup' );

if ( ! function_exists( 'starkers_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * @since Starkers HTML5 3.0
 */
function starkers_setup() {

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'starkers', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'starkers' ),
		'follow' => __( 'Follow Navigation', 'starkers' ),
	) );
}
endif;

/**
 * Makes some changes to the <title> tag, by filtering the output of wp_title().
 *
 * @since Starkers HTML5 3.0
 *
 */
function starkers_filter_wp_title( $title, $separator ) {
	// Don't affect wp_title() calls in feeds.
	if ( is_feed() )
		return $title;

	// The $paged global variable contains the page number of a listing of posts.
	// The $page global variable contains the page number of a single post that is paged.
	// We'll display whichever one applies, if we're not looking at the first page.
	global $paged, $page;

	if ( is_search() ) {
		// If we're a search, let's start over:
		$title = sprintf( __( 'Search results for %s', 'starkers' ), '"' . get_search_query() . '"' );
		// Add a page number if we're on page 2 or more:
		if ( $paged >= 2 )
			$title .= " $separator " . sprintf( __( 'Page %s', 'starkers' ), $paged );
		// Add the site name to the end:
		$title .= " $separator " . get_bloginfo( 'name', 'display' );
		// We're done. Let's send the new title back to wp_title():
		return $title;
	}
	
	if ( is_tag() ) {
		// If we're a tag archive, let's start over:
		$title = sprintf( __( 'Blog Topic: %s', 'starkers' ), single_tag_title( '', false ) );
		// Add the site name to the end:
		$title .= " $separator " . get_bloginfo( 'name', 'display' );
		// We're done. Let's send the new title back to wp_title():
		return $title;
	}
	
	// Otherwise, let's start by adding the site name to the end:
	$title .= get_bloginfo( 'name', 'display' );

	// If we have a site description and we're on the front page, add the description:
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_front_page() ) )
		$title .= " $separator " . $site_description;
		
	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $separator " . sprintf( __( 'Page %s', 'starkers' ), max( $paged, $page ) );

	// Return the new title to wp_title():
	return $title;
}
add_filter( 'wp_title', 'starkers_filter_wp_title', 10, 2 );

/**
 * Set our wp_nav_menu() fallback, starkers_menu().
 *
 * @since Starkers HTML5 3.0
 */
function starkers_menu() {
	echo '<nav><ul><li><a href="'.get_bloginfo('url').'">Home</a></li>';
	wp_list_pages('title_li=');
	echo '</ul></nav>';
}

/**
 * Remove inline styles printed when the gallery shortcode is used.
 *
 * @since Starkers HTML5 3.0
 */
function starkers_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
add_filter( 'gallery_style', 'starkers_remove_gallery_css' );

if ( ! function_exists( 'starkers_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * @since Starkers HTML5 3.0
 */
function starkers_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li class="item-wrapper">
    <article <?php comment_class('item'); ?> id="comment-<?php comment_ID() ?>">
			<header>
		    <h1 class="primary-title"><?php printf( __( 'Comment by %s', 'starkers' ), sprintf( '%s', get_comment_author_link() ) ); ?></h1>
		    <?php if ( $comment->comment_approved == '0' ) : ?>
        <?php _e( 'Your comment is awaiting moderation.', 'starkers' ); ?>
        <br />
        <?php endif; ?>
        <p class="thumb"><?php echo get_avatar( $comment, 80 ); ?></p>
		    <p class="date">Published on <time pubdate datetime="<?php echo get_comment_date('Y-m-d')."T".get_comment_time('H:i'); ?>"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><?php echo get_comment_date('M dS, Y')." at ".get_comment_time('H:i'); ?></a></time><?php edit_comment_link( __( '(Edit)', 'starkers' ), ' ' ); ?></p>
			</header>
		  <div class="prose">
		    <?php comment_text(); ?>
		  </div>
		  <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</article>
  </li>
	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="item-wrapper">
    <article <?php comment_class('item'); ?> id="comment-<?php comment_ID() ?>">
      <header>
        <h1 class="primary-title">Pingback from <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'starkers'), ' ' ); ?></h1>
        <p class="thumb"><img src="<?php bloginfo('template_url'); ?>/assets/images/layout/pingback-avatar-80.png" alt="Pingback Avatar" width="80" height="80" /></p>
		    <p class="date">Published on <time pubdate datetime="<?php echo get_comment_date('Y-m-d')."T".get_comment_time('H:i'); ?>"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><?php echo get_comment_date('M dS, Y')." at ".get_comment_time('H:i'); ?></a></time><?php edit_comment_link( __( '(Edit)', 'starkers' ), ' ' ); ?></p>
      </header>
      <div class="prose">
		    <?php comment_text(); ?>
      </div>
    </article>
  </li>
	<?php
			break;
	endswitch;
}
endif;

/**
 * Closes comments and pingbacks with </article> instead of </li>.
 *
 * @since Starkers HTML5 3.0
 */
function starkers_comment_close() {
	echo '  </article>';
	echo '</li>';
}

/**
 * Adjusts the comment_form() input types for HTML5.
 *
 * @since Starkers HTML5 3.0
 */
function starkers_fields($fields) {
$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );
$fields =  array(
	'author' => '<p><label for="author">' . __( 'Name' ) . '</label> ' . ( $req ? '*' : '' ) .
	'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
	'email'  => '<p><label for="email">' . __( 'Email' ) . '</label> ' . ( $req ? '*' : '' ) .
	'<input id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
	'url'    => '<p><label for="url">' . __( 'Website' ) . '</label>' .
	'<input id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
);
return $fields;
}
add_filter('comment_form_default_fields','starkers_fields');

/**
 * Register widgetized areas.
 *
 * @since Starkers HTML5 3.0
 */
function starkers_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'starkers' ),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', 'starkers' ),
		'before_widget' => '<li>',
		'after_widget' => '</li>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );

	// Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
	register_sidebar( array(
		'name' => __( 'Secondary Widget Area', 'starkers' ),
		'id' => 'secondary-widget-area',
		'description' => __( 'The secondary widget area', 'starkers' ),
		'before_widget' => '<li>',
		'after_widget' => '</li>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );

	// Area 3, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'First Footer Widget Area', 'starkers' ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'The first footer widget area', 'starkers' ),
		'before_widget' => '<li>',
		'after_widget' => '</li>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );

	// Area 4, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Second Footer Widget Area', 'starkers' ),
		'id' => 'second-footer-widget-area',
		'description' => __( 'The second footer widget area', 'starkers' ),
		'before_widget' => '<li>',
		'after_widget' => '</li>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );

	// Area 5, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Third Footer Widget Area', 'starkers' ),
		'id' => 'third-footer-widget-area',
		'description' => __( 'The third footer widget area', 'starkers' ),
		'before_widget' => '<li>',
		'after_widget' => '</li>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );

	// Area 6, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Fourth Footer Widget Area', 'starkers' ),
		'id' => 'fourth-footer-widget-area',
		'description' => __( 'The fourth footer widget area', 'starkers' ),
		'before_widget' => '<li>',
		'after_widget' => '</li>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );
}
/** Register sidebars by running starkers_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'starkers_widgets_init' );

/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * @since Starkers HTML5 3.0
 */
function starkers_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'starkers_remove_recent_comments_style' );

if ( ! function_exists( 'starkers_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post—date/time and author.
 *
 * @since Starkers HTML5 3.0
 */
function starkers_posted_on() {
	printf( __( 'Posted on %2$s by %3$s', 'starkers' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time datetime="%3$s" pubdate>%4$s</time></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date('Y-m-d'),
			get_the_date()
		),
		sprintf( '<a href="%1$s" title="%2$s">%3$s</a>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'starkers' ), get_the_author() ),
			get_the_author()
		)
	);
}
endif;

if ( ! function_exists( 'starkers_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 * @since Starkers HTML5 3.0
 */
function starkers_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'starkers' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'starkers' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'starkers' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;

/**
 * Sets the_post_thumbnail sizes.
 */
if (function_exists('add_theme_support')) :
  add_theme_support('post-thumbnails');
  set_post_thumbnail_size( 200, 200, true);
endif;


/**
 * Sets up custom taxonomies.
 */
//hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_lang_taxonomies', 0 );

function create_lang_taxonomies() 
{
// Add new taxonomy, NOT hierarchical (like tags)
$labels = array(
  'name' => _x( 'Language', 'taxonomy general name' ),
  'singular_name' => _x( 'Language', 'taxonomy singular name' ),
  'search_items' =>  __( 'Search Languages' ),
  'popular_items' => __( 'Popular Languages' ),
  'all_items' => __( 'All Languages' ),
  'parent_item' => null,
  'parent_item_colon' => null,
  'edit_item' => __( 'Edit Language' ), 
  'update_item' => __( 'Update Language' ),
  'add_new_item' => __( 'Add New Language' ),
  'new_item_name' => __( 'New Language Name' ),
  'separate_items_with_commas' => __( 'Separate languages with commas' ),
  'add_or_remove_items' => __( 'Add or remove languages' ),
  'choose_from_most_used' => __( 'Choose from the most used languages' ),
  'menu_name' => __( 'Languages' ),
); 

register_taxonomy('language',array( 'datm_press', 'page' ),array(
  'hierarchical' => false,
  'labels' => $labels,
  'show_ui' => true,
  'update_count_callback' => '_update_post_term_count',
  'query_var' => true,
  'rewrite' => array( 'slug' => 'language', 'with_front' => false ),
));
}

/**
 * Sets up custom post types.
 */
add_action( 'init', 'create_post_types' );

function create_post_types() {
	register_post_type( 'datm_music',
		array(
            'labels' => array(
				'name' => __( 'Music' ),
				'singular_name' => __( 'Music' ),
            	'add_new_item' => __( 'Add New Music' ),
            	'edit' => __( 'Edit' ),
            	'edit_item' => __( 'Edit Music' ),
            	'new_item' => __( 'New Music' ),
            	'view' => __( 'View Music' ),
            	'view_item' => __( 'View Music' ),
            	'search_items' => __( 'Search Music' ),
            	'not_found' => __( 'No music found' ),
            	'not_found_in_trash' => __( 'No music found in Trash' ),
            	'parent' => __( 'Parent Music' )
			),
        	'public' => true,
        	'rewrite' => array( 'slug' => 'music', 'with_front' => false ),
        	'show_ui' => true,
        	'menu_position' => 5,
        	'capability_type' => 'post',
        	'hierarchical' => false,
        	'query_var' => true,
        	'supports' => array('title', 'editor', 'excerpt', 'revisions', 'author', 'thumbnail', 'comments'),
			'taxonomies' => array( 'post_tag'), 
		)
	);
	register_post_type( 'datm_shows',
		array(
            'labels' => array(
				'name' => __( 'Shows' ),
				'singular_name' => __( 'Show' ),
            	'add_new_item' => __( 'Add New Show' ),
            	'edit' => __( 'Edit' ),
            	'edit_item' => __( 'Edit Show' ),
            	'new_item' => __( 'New Show' ),
            	'view' => __( 'View Show' ),
            	'view_item' => __( 'View Show' ),
            	'search_items' => __( 'Search Show' ),
            	'not_found' => __( 'No shows found' ),
            	'not_found_in_trash' => __( 'No shows found in Trash' ),
            	'parent' => __( 'Parent Show' )
			),
        	'public' => true,
        	'rewrite' => array( 'slug' => 'shows', 'with_front' => false ),
        	'show_ui' => true,
        	'menu_position' => 6,
        	'capability_type' => 'post',
        	'hierarchical' => false,
        	'query_var' => true,
        	'supports' => array('title', 'editor', 'excerpt', 'revisions', 'author', 'thumbnail', 'comments'),
			'taxonomies' => array( 'post_tag'),
		)
	);
	register_post_type( 'datm_press',
		array(
        'labels' => array(
				'name' => __( 'Press' ),
				'singular_name' => __( 'Press' ),
            	'add_new_item' => __( 'Add New Press' ),
            	'all_items' => __( 'All Press' ),
            	'edit' => __( 'Edit' ),
            	'edit_item' => __( 'Edit Press' ),
            	'new_item' => __( 'New Press' ),
            	'view' => __( 'View Press' ),
            	'view_item' => __( 'View Press' ),
            	'search_items' => __( 'Search Press' ),
            	'not_found' => __( 'No press found' ),
            	'not_found_in_trash' => __( 'No press found in Trash' ),
            	'parent' => __( 'Parent Press' )
			),
        	'public' => true,
        	'rewrite' => array( 'slug' => 'press', 'with_front' => false ),
        	'show_ui' => true,
        	'menu_position' => 6,
        	'capability_type' => 'post',
        	'hierarchical' => false,
        	'query_var' => true,
        	'supports' => array('title', 'editor', 'excerpt', 'revisions', 'author', 'thumbnail', 'comments'),
					'taxonomies' => array( 'language' ) 
		)
	);
}

// Add shows columns
add_filter( 'manage_edit-datm_shows_columns', 'edit_shows_columns' ) ;

function edit_shows_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'Event' ),
		'event-date' => __( 'Date' ),
		'author' => __( 'Author' ),
		'tags' => __( 'Tags' ),
		'comments' => '<span><span class="vers"><img alt="Comments" src="http://duskatthemansion.com/wordpress/wp-admin/images/comment-grey-bubble.png"></span></span>',
		'date' => _( 'Date' )
	);

	return $columns;
}

add_action( 'manage_datm_shows_posts_custom_column', 'manage_shows_columns', 10, 2 );

function manage_shows_columns( $column, $post_id ) {
	global $post;

	switch( $column ) {

		/* If displaying the 'duration' column. */
		case 'event-date' :

			/* Get the post meta. */
			$event_date = get_post_meta( $post_id, 'datm_show_start_date', true );

			/* If no duration is found, output a default message. */
			if ( empty( $event_date ) )
				echo __( 'Unknown' );

			/* If there is a duration, append 'minutes' to the text string. */
			else
				printf( __( '%s' ), $event_date );

			break;
			
		/* Just break out of the switch statement for everything else. */
		default :
			break;
	}
}

add_filter( 'manage_edit-datm_shows_sortable_columns', 'shows_sortable_columns' );

function shows_sortable_columns( $columns ) {

	$columns['event-date'] = 'event-date';

	return $columns;
}

/* Only run our customization on the 'edit.php' page in the admin. */
add_action( 'load-edit.php', 'edit_shows_load' );

function edit_shows_load() {
	add_filter( 'request', 'sort_shows' );
}

/* Sorts the movies. */
function sort_shows( $vars ) {

	/* Check if we're viewing the 'movie' post type. */
	if ( isset( $vars['post_type'] ) && 'datm_show' == $vars['post_type'] ) {

		/* Check if 'orderby' is set to 'duration'. */
		if ( isset( $vars['orderby'] ) && 'event-date' == $vars['orderby'] ) {

			/* Merge the query vars with our custom variables. */
			$vars = array_merge(
				$vars,
				array(
					'meta_key' => 'datm_show_start_date',
					'orderby' => 'meta_value_num'
				)
			);
		}
	}

	return $vars;
}

function set_event_post_type_admin_order($wp_query) {
  if (is_admin()) {

    $post_type = $wp_query->query['post_type'];

    if ( $post_type == 'datm_shows') {
    	$wp_query->set('meta_key', 'datm_show_start_date');
      	$wp_query->set('orderby', 'meta_value_num');
      	$wp_query->set('order', 'DESC');
    }

  }
}

add_filter ( 'pre_get_posts', 'set_event_post_type_admin_order' );


function remove_metaboxes() {
 remove_meta_box( 'postcustom' , 'post' , 'normal' ); //removes custom fields for page
/*
 remove_meta_box( 'commentstatusdiv' , 'page' , 'normal' ); //removes comments status for page
 remove_meta_box( 'commentsdiv' , 'page' , 'normal' ); //removes comments for page
 remove_meta_box( 'authordiv' , 'page' , 'normal' ); //removes author for page
*/
}
add_action( 'admin_menu' , 'remove_metaboxes' );



/**
 * Create meta boxes for editing pages in WordPress
 * Compatible with custom post types in WordPress 3.0
 *
 * Support input types: text, textarea, checkbox, radio box, select, file, image
 *
 * @author: Rilwis
 * @url: http://www.deluxeblogtips.com/2010/04/how-to-create-meta-box-wordpress-post.html
 * @version: 2.4.1
 *
 * Changelog:
 * - 2.4.1: fix bug of not receiving value for select box
 * - 2.4: (image upload features are credit to Kai http://twitter.com/ungestaltbar)
 *   + change image upload using meta fields to using default WP gallery
 *   + add delete button for images, using ajax
 *   + allow to upload multiple images
 *   + add validation for meta fields
 * - 2.3: add wysiwyg editor type, improve check for upload fields, change context and priority attributes to optional
 * - 2.2: add enctype to post form (fix upload bug), thanks to http://www.hashbangcode.com/blog/add-enctype-wordpress-post-and-page-forms-471.html
 * - 2.1: add file upload, image upload support
 * - 2.0: oop code, support multiple post types, multiple meta boxes
 * - 1.0: procedural code
 */

/*
Usage: for more information, please visit: http://www.deluxeblogtips.com/2010/04/how-to-create-meta-box-wordpress-post.html
*/

// Register meta boxes

$prefix = 'datm_';

$meta_boxes = array();

// Downloads meta box
$meta_boxes[] = array(
	'id' => 'music-metabox',
	'title' => 'Options',
	'pages' => array('datm_music'), // multiple post types, accept custom post types
	'context' => 'normal', // normal, advanced, side (optional)
	'priority' => 'high', // high, low (optional)
	'fields' => array(
		array(
			'name' => 'Release date',
			'id' => $prefix . 'release_date',
			'type' => 'text'
			//'validate_func' => 'check_date_format' // validate function, created below, inside RW_Meta_Box_Validate class
		),
		array(
			'name' => 'Record label',
			'id' => $prefix . 'record_label',
			'type' => 'text'
		)
	)
);

// Events meta box 
$meta_boxes[] = array(
	'id' => 'events-metabox',
	'title' => 'Options',
	'pages' => array('datm_shows'), // custom post types, since WordPress 3.0
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => 'Start date/time',
			'id' => $prefix . 'show_start_date',
			'type' => 'text',
			//'validate_func' => 'check_date_format' // validate function, created below, inside RW_Meta_Box_Validate class
		),
		array(
			'name' => 'End date/time',
			'id' => $prefix . 'show_end_date',
			'type' => 'text',
			//'validate_func' => 'check_date_format' // validate function, created below, inside RW_Meta_Box_Validate class
		),
		array(
			'name' => 'Venue',
			'id' => $prefix . 'show_venue',
			'type' => 'text', // text box
		),
		array(
			'name' => 'Address',
			'id' => $prefix . 'show_address',
			'type' => 'text', // text box
		),
		array(
			'name' => 'Postal Code',
			'id' => $prefix . 'show_postalcode',
			'type' => 'text', // text box
		),
		array(
			'name' => 'City',
			'id' => $prefix . 'show_city',
			'type' => 'text', // text box
		),
		array(
			'name' => 'Country',
			'id' => $prefix . 'show_country',
			'type' => 'text', // text box
		),
		array(
			'name' => 'Price',
			'id' => $prefix . 'event_price',
			'type' => 'text', // text box
		),
		array(
			'name' => 'Event URL',
			'id' => $prefix . 'event_url',
			'type' => 'text', // text box
		),
		array(
			'name' => 'Tickets Info',
			'id' => $prefix . 'tickets_info',
			'type' => 'text', // text box
		)
	)
);

// Events meta box 
$meta_boxes[] = array(
	'id' => 'posts-metabox',
	'title' => 'Extras',
	'pages' => array('post'), // custom post types, since WordPress 3.0
	'context' => 'side',
	'priority' => 'low',
	'fields' => array(
		array(
			'name' => 'Promote to front page',
			'id' => $prefix . 'featured',
			'type' => 'checkbox'
		)
	)
);

foreach ($meta_boxes as $meta_box) {
	$my_box = new RW_Meta_Box($meta_box);
}

// Validate value of meta fields

// Define ALL validation methods inside this class
// and use the names of these methods in the definition of meta boxes (key 'validate_func' of each field)

class RW_Meta_Box_Validate {
	function check_text($text) {
		if ($text != 'hello') {
			return false;
		}
		return true;
	}
	function check_url($text) {
		if ($text!='' && filter_var($text, FILTER_VALIDATE_URL) == false) {
			return false;
		}
		return true;
	}	
	function check_date_format($date) {
        //match the format of the date
        if (preg_match("/^([0-9]{2})\/([0-9]{2})\/([0-9]{4})$/", $date, $parts)) {
            //check weather the date is valid of not
            if(checkdate($parts[2],$parts[1],$parts[3])) {
              return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    function check_time_format($text) {
        //match the format of the date
        if (preg_match("/^([01][0-9]|2[0-3]):[0-5][0-9]$/", $text)) {
            return true;
        } else {
            return false;
        }
    }
}

/**
 * AJAX delete images on the fly. This script is a slightly altered version of a function used by the Plugin "Verve Meta Boxes"
 * http://wordpress.org/extend/plugins/verve-meta-boxes/
 *
 */
add_action('wp_ajax_unlink_file', 'unlink_file_callback');
function unlink_file_callback() {
	global $wpdb;
	if ($_POST['data']) {
		$data = explode('-', $_POST['data']);
		$att_id = $data[0];
		$post_id = $data[1];
		wp_delete_attachment($att_id);
	}
}

/**
 * Create meta boxes
 */
class RW_Meta_Box {

	protected $_meta_box;

	// create meta box based on given data
	function __construct($meta_box) {
		if (!is_admin()) return;

		$this->_meta_box = $meta_box;

		// fix upload bug: http://www.hashbangcode.com/blog/add-enctype-wordpress-post-and-page-forms-471.html
		$upload = false;
		foreach ($meta_box['fields'] as $field) {
			if ($field['type'] == 'file' || $field['type'] == 'image') {
				$upload = true;
				break;
			}
		}
		$current_page = substr(strrchr($_SERVER['PHP_SELF'], '/'), 1, -4);
		if ($upload && ($current_page == 'page' || $current_page == 'page-new' || $current_page == 'post' || $current_page == 'post-new')) {
			add_action('admin_head', array(&$this, 'add_post_enctype'));
			add_action('admin_head', array(&$this, 'add_unlink_script'));
			add_action('admin_head', array(&$this, 'add_clone_script'));
		}

		add_action('admin_menu', array(&$this, 'add'));

		add_action('save_post', array(&$this, 'save'));
	}

	function add_post_enctype() {
		echo '
		<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery("#post").attr("enctype", "multipart/form-data");
			jQuery("#post").attr("encoding", "multipart/form-data");
		});
		</script>';
	}

	function add_unlink_script(){
		echo '
		<script type="text/javascript">
		jQuery(document).ready(function($){
			$("a.deletefile").click(function () {
				var parent = jQuery(this).parent(),
					data = jQuery(this).attr("rel"),
					_wpnonce = $("input[name=\'_wpnonce\']").val();

				$.post(
					ajaxurl,
					{action: \'unlink_file\', _wpnonce: _wpnonce, data: data},
					function(response){
						//$("#info").html(response).fadeOut(3000);
						//alert(data.post);
					},
					"json"
				);
				parent.fadeOut("slow");
				return false;
			});
		});
		</script>';
	}

	function add_clone_script() {
		echo '
		<script type="text/javascript">
		jQuery(document).ready(function() {
			jQuery(".add").click(function() {
				jQuery("#newimages p:first-child").clone().insertAfter("#newimages p:last").show();
				return false;
			});
			jQuery(".remove").click(function() {
				jQuery(this).parent().remove();
			});
		});
		</script>';
	}


	/// Add meta box for multiple post types
	function add() {
		$this->_meta_box['context'] = empty($this->_meta_box['context']) ? 'normal' : $this->_meta_box['context'];
		$this->_meta_box['priority'] = empty($this->_meta_box['priority']) ? 'high' : $this->_meta_box['priority'];
		foreach ($this->_meta_box['pages'] as $page) {
			add_meta_box($this->_meta_box['id'], $this->_meta_box['title'], array(&$this, 'show'), $page, $this->_meta_box['context'], $this->_meta_box['priority']);
		}
	}

	// Callback function to show fields in meta box
	function show() {
		global $post;

		// Use nonce for verification
		echo '<input type="hidden" name="wp_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

		echo '<table class="form-table">';

		foreach ($this->_meta_box['fields'] as $field) {
			// get current post meta data
			$meta = get_post_meta($post->ID, $field['id'], true);

			echo '<tr>',
					'<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
					'<td>';
			switch ($field['type']) {
				case 'text':
					echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" />',
						'<br />', $field['desc'];
					break;
				case 'textreadonly':
					echo '<input readonly type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" />',
						'<br />', $field['desc'];
					break;
				case 'textarea':
					echo '<textarea name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="15" style="width:97%">', $meta ? $meta : $field['std'], '</textarea>',
						'<br />', $field['desc'];
					break;
				case 'select':
					echo '<select name="', $field['id'], '" id="', $field['id'], '">';
					foreach ($field['options'] as $option) {
						echo '<option value="', $option['value'], '"', $meta == $option['value'] ? ' selected="selected"' : '', '>', $option['name'], '</option>';
					}
					echo '</select>';
					break;
				case 'radio':
					foreach ($field['options'] as $option) {
						echo '<input type="radio" name="', $field['id'], '" value="', $option['value'], '"', $meta == $option['value'] ? ' checked="checked"' : '', ' />', $option['name'];
					}
					break;
				case 'checkbox':
					echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />';
					break;
				case 'file':
					echo $meta ? "$meta<br />" : '', '<input type="file" name="', $field['id'], '" id="', $field['id'], '" />',
						'<br />', $field['desc'];
					break;
				case 'wysiwyg':
					echo '<textarea name="', $field['id'], '" id="', $field['id'], '" class="theEditor" cols="60" rows="4" style="width:97%">', $meta ? $meta : $field['std'], '</textarea>',
						'<br />', $field['desc'];
					break;
				case 'image':
					?>
					<h2>Images attached to this post</h2>
					<div id="uploaded">
						<?php
						$args = array(
							'post_type' => 'attachment',
							'post_parent' => $post->ID,
							'numberposts' => -1,
							'post_status' => NULL
						);
						$attachs = get_posts($args);
						if (!empty($attachs)) {
							foreach ($attachs as $att) {
							?>
								<div class="single-att" style="margin: 0 10px 10px 0; float: left;">
									<?php echo wp_get_attachment_image($att->ID, 'thumbnail'); ?>
									<br />
									<a class="deletefile" href="#" rel="<?php echo $att->ID ?>-<?php echo $post_id ?> "title="Delete this file">Delete Image</a>
								</div>
							<?php
							}
						} else {
							echo 'No Images uploaded yet';
						}
						?>
					</div>

					<h2>Upload new Images</h2>
                    <div id="newimages">
						<p><input type="file" name="<?php echo $field['id'] ?>[]" id="" /></p>
						<a class="add" href="#">Add More Images</a>
					</div>
					<?php
					break;
			}
			echo 	'<td>',
				'</tr>';
		}

		echo '</table>';
	}

	// Save data from meta box
	function save($post_id) {
		// verify nonce
		if (!wp_verify_nonce($_POST['wp_meta_box_nonce'], basename(__FILE__))) {
			return $post_id;
		}

		// check autosave
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post_id;
		}

		// check permissions
		if ('page' == $_POST['post_type']) {
			if (!current_user_can('edit_page', $post_id)) {
				return $post_id;
			}
		} elseif (!current_user_can('edit_post', $post_id)) {
			return $post_id;
		}

		foreach ($this->_meta_box['fields'] as $field) {
			$name = $field['id'];

			$old = get_post_meta($post_id, $name, true);
			$new = $_POST[$field['id']];

			/*
			// changed to using WP gallery
			if ($field['type'] == 'file' || $field['type'] == 'image') {
				$file = wp_handle_upload($_FILES[$name], array('test_form' => false));
				$new = $file['url'];
			}
			*/

			if ($field['type'] == 'file' || $field['type'] == 'image') {
				if (!empty($_FILES[$name])) {
					$this->fix_file_array($_FILES[$name]);
					foreach ($_FILES[$name] as $position => $fileitem) {
						$file = wp_handle_upload($fileitem, array('test_form' => false));
						$filename = $file['url'];
						if (!empty($filename)) {
							$wp_filetype = wp_check_filetype(basename($filename), null);
							$attachment = array(
								'post_mime_type' => $wp_filetype['type'],
								'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
								'post_status' => 'inherit'
							);
							$attach_id = wp_insert_attachment($attachment, $filename, $post_id);
							// you must first include the image.php file
							// for the function wp_generate_attachment_metadata() to work
							require_once(ABSPATH . 'wp-admin/includes/image.php');
							$attach_data = wp_generate_attachment_metadata($attach_id, $filename);
							wp_update_attachment_metadata($attach_id, $attach_data);
						}
					}
				}
			}

			if ($field['type'] == 'wysiwyg') {
				$new = wpautop($new);
			}

			if ($field['type'] == 'textarea') {
				$new = htmlspecialchars($new);
			}

			// validate meta value
			if (isset($field['validate_func'])) {
				$ok = call_user_func(array('RW_Meta_Box_Validate', $field['validate_func']), $new);
				if ($ok === false) { // pass away when meta value is invalid
					continue;
				}
			}

			if ($new && $new != $old) {
				update_post_meta($post_id, $name, $new);
			} elseif ('' == $new && $old && $field['type'] != 'file' && $field['type'] != 'image') {
				delete_post_meta($post_id, $name, $old);
			}
		}
	}

	/**
	 * Fixes the odd indexing of multiple file uploads from the format:
	 *
	 * $_FILES['field']['key']['index']
	 *
	 * To the more standard and appropriate:
	 *
	 * $_FILES['field']['index']['key']
	 *
	 * @param array $files
	 * @author Corey Ballou
	 * @link http://www.jqueryin.com
	 */
	function fix_file_array(&$files) {
		$names = array(
			'name' => 1,
			'type' => 1,
			'tmp_name' => 1,
			'error' => 1,
			'size' => 1
		);

		foreach ($files as $key => $part) {
			// only deal with valid keys and multiple files
			$key = (string) $key;
			if (isset($names[$key]) && is_array($part)) {
				foreach ($part as $position => $value) {
					$files[$position][$key] = $value;
				}
				// remove old key reference
				unset($files[$key]);
			}
		}
	}
}

/**
 * Adds more columns to custom post type edit screens.
 *
 */
/*
add_action("manage_posts_custom_column",  "portfolio_custom_columns");
add_filter("manage_edit-datm_shows_columns", "portfolio_edit_columns");
 
function portfolio_edit_columns($columns){
  $columns = array(
    "cb" => "<input type=\"checkbox\" />",
    "title" => "Event",
    "description" => "Description",
    "st_date" => "Start Date",
    "tags" => "Tags"
  );
 
  return $columns;
}
function portfolio_custom_columns($column){
  global $post;
 
  switch ($column) {
    case "description":
      the_excerpt();
      break;
    case "st_date":
      $custom = get_post_custom();
      echo $custom["datm_event_start_date"][0];
      break;
    case "tags":
      echo get_the_term_list($post->ID, 'post_tags', '', ', ','');
      break;
  }
} */

/**
 * Load custom field JavaScript validation.
 *
 */

function jquery_ui_js() {
  global $post;

  if($post->post_type == 'datm_music' || $post->post_type == 'datm_shows') {
    wp_enqueue_script('jquery-ui-slider',  WP_CONTENT_URL . '/themes/datm/assets/js/libs/jquery.slider.min.js', array('jquery','jquery-ui-core','jquery-ui-widget','jquery-ui-mouse'));
    wp_enqueue_script('jquery-ui-datepicker',  WP_CONTENT_URL . '/themes/datm/assets/js/libs/jquery.datepicker.min.js', array('jquery','jquery-ui-core','jquery-ui-widget'));
    wp_enqueue_script('jquery-ui-timepicker',  WP_CONTENT_URL . '/themes/datm/assets/js/libs/jquery.datepicker.addon.js', array('jquery','jquery-ui-core','jquery-ui-datepicker','jquery-ui-slider'));
    wp_enqueue_script('my-datepicker-js', WP_CONTENT_URL . '/themes/datm/assets/js/admin.js', array('jquery','jquery-ui-core','jquery-ui-datepicker','jquery-ui-widget'));
  }
}

function jquery_ui_css() {
  global $post;
  
  if($post->post_type == 'datm_music' || $post->post_type == 'datm_shows') {
    wp_enqueue_style('jquery-ui', WP_CONTENT_URL . '/themes/datm/assets/css/jquery-smoothness/jquery-ui.css');
  }
}

add_action('admin_print_scripts', 'jquery_ui_js');
add_action('admin_print_styles', 'jquery_ui_css');

/**
 * Hide admin menus.
 *
 */
function remove_menus () {
global $menu;
	$restricted = array(__('Links'));
	end ($menu);
	while (prev($menu)){
		$value = explode(' ',$menu[key($menu)][0]);
		if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);}
	}
}
//add_action('admin_menu', 'remove_menus');


/**
 * Hacky fix for current_page fuck up with custom post type and automatic menus.
 *
 */
function remove_parent($var) {
	// check for current page values, return false if they exist.
	if ($var == 'current_page_parent' || $var == 'current-menu-item' || $var == 'current-page-ancestor') { return false; }

	return true;
}

function tg_add_class_to_menu($classes) {
	// datm_shows is my custom post type
	if (is_singular('datm_shows')) {
		// we're viewing a custom post type, so remove the 'current-page' from all menu items.
		$classes = array_filter($classes, "remove_parent");

		// add the current page class to a specific menu item.
		if (in_array('menu-item-17', $classes)) $classes[] = 'current_page_parent';
	}
	if (is_singular('datm_music')) {
		// we're viewing a custom post type, so remove the 'current-page' from all menu items.
		$classes = array_filter($classes, "remove_parent");

		// add the current page class to a specific menu item.
		if (in_array('menu-item-18', $classes)) $classes[] = 'current_page_parent';
	}
	if (is_singular('datm_press')) {
		// we're viewing a custom post type, so remove the 'current-page' from all menu items.
		$classes = array_filter($classes, "remove_parent");
	}
  if (is_search()) {
		$classes = array_filter($classes, "remove_parent");
	}
	if (is_404()) {
		$classes = array_filter($classes, "remove_parent");
	}
	return $classes;
}

if (!is_admin()) { add_filter('nav_menu_css_class', 'tg_add_class_to_menu'); }

// Fix tag and categories
add_filter('pre_get_posts', 'query_post_type');
function query_post_type($query) {
  if ( is_category() || is_tag() && empty( $query->query_vars['suppress_filters'] ) || is_feed() ) {
    $post_type = get_query_var('post_type');
	if($post_type)
	    $post_type = $post_type;
	else
	    $post_type = array('post','datm_music','datm_shows');
    $query->set('post_type',$post_type);
	return $query;
    }
}

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 620;
	
add_shortcode('wp_caption', 'fixed_img_caption_shortcode');
add_shortcode('caption', 'fixed_img_caption_shortcode');
function fixed_img_caption_shortcode($attr, $content = null) {
	// Allow plugins/themes to override the default caption template.
	$output = apply_filters('img_caption_shortcode', '', $attr, $content);
	if ( $output != '' ) return $output;
	extract(shortcode_atts(array(
		'id'=> '',
		'align'	=> 'alignnone',
		'width'	=> '',
		'caption' => ''), $attr));
	if ( 1 > (int) $width || empty($caption) )
	return $content;
	if ( $id ) $id = 'id="' . esc_attr($id) . '" ';
	return '<div ' . $id . 'class="wp-caption ' . esc_attr($align)
	. '">'
	. do_shortcode( $content ) . '<p class="wp-caption-text">'
	. $caption . '</p></div>';
}


function remove_more_jump_link($link) { 
	$offset = strpos($link, '#more-');
	if ($offset) {
		$end = strpos($link, '"',$offset);
		}
	if ($end) {
		$link = substr_replace($link, '', $offset, $end-$offset);
		}
	return $link;
}
add_filter('the_content_more_link', 'remove_more_jump_link');


add_filter('the_password_form', 'custom_the_password_form');

function custom_the_password_form() {
  $label = "pwbox-390";
  $output = '<p>' . __("This content is password protected. To view it please enter your password below:") . '</p> <form action="' . get_bloginfo('wpurl') . '/wp-login.php?action=postpass" method="post" class="pass-form">
	<p><label for="' . $label . '">' . __("Password") . '</label> <input name="post_password" id="' . $label . '" type="password" size="20" /> <input type="submit" name="Submit" value="' . esc_attr__("Submit") . '"></p>
	</form>
	';
  return $output;
}

/*
<form action="http://duskatthemansion.com/wordpress/wp-login.php?action=postpass" method="post">
<p>This post is password protected. To view it please enter your password below:</p>
<p><label for="pwbox-390">Password: <input name="post_password" id="pwbox-390" type="password" size="20"></label> <input type="submit" name="Submit" value="Submit"></p>
<p></p></form>
*/


/*
function filter_post_type_link($link, $post)
{
    if ($post->post_type != 'datm_press')
        return $link;

    if ($cats = get_the_terms($post->ID, 'language'))
        $link = str_replace('%language%', array_pop($cats)->slug, $link);
    return $link;
}
add_filter('post_type_link', 'filter_post_type_link', 10, 2);
*/

add_action( 'generate_rewrite_rules', 'fix_literature_category_pagination' );
function fix_literature_category_pagination( $wp_rewrite ) {
    unset($wp_rewrite->rules['press/([^/]+)/page/?([0-9]{1,})/?$']);
    $wp_rewrite->rules = array(
        'press/?$' => $wp_rewrite->index . '?post_type=datm_press',
        'press/page/?([0-9]{1,})/?$' => $wp_rewrite->index . '?post_type=datm_press&paged=' . $wp_rewrite->preg_index( 1 ),
        'press/([^/]+)/page/?([0-9]{1,})/?$' => $wp_rewrite->index . '?language=' . $wp_rewrite->preg_index( 1 ) . '&paged=' . $wp_rewrite->preg_index( 2 ),
    ) + $wp_rewrite->rules;
}

/*
add_action( 'wp', 'post_pw_sess_expire' );
    function post_pw_sess_expire() {
    if ( isset( $_COOKIE['wp-postpass_' . COOKIEHASH] ) )
    // Setting a time of 0 in setcookie() forces the cookie to expire with the session
    setcookie('wp-postpass_' . COOKIEHASH, '', 86400, COOKIEPATH);
}
*/

/*
// Filter to hide protected posts
function exclude_protected($where) {
	return $where .= " AND wp_posts.post_password = '' ";
}

// Decide where to display them
function exclude_protected_action($query) {
	if( !is_single() && !is_page() && !is_admin() ) {
		add_filter( 'posts_where', 'exclude_protected' );
	}
}

// Action to queue the filter at the right time
add_action('pre_get_posts', 'exclude_protected_action');
*/

function the_title_trim($title) {
	$title = attribute_escape($title);
	$findthese = array(
		'#Protected:#',
		'#Private:#'
	);
	$replacewith = array(
		'', // What to replace "Protected:" with
		'' // What to replace "Private:" with
	);
	$title = preg_replace($findthese, $replacewith, $title);
	return $title;
}
add_filter('the_title', 'the_title_trim');

//Support for excerpts in Pages
add_post_type_support( 'page', 'excerpt' );



/**
 * Sets OpenGraphs tags.
 */
// add OGP namespace per ogp.me schema
function wpfbogp_namespace($output) {
	return $output.' xmlns:og="http://ogp.me/ns#"';
}
add_filter('language_attributes','wpfbogp_namespace');

// function to call first uploaded image in functions file. borrowed from i forgot :/ sorry.
function wpfbogp_first_image() {
  global $post, $posts;
  $wpfbogp_first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  $wpfbogp_first_img = $matches [1] [0];
  if(empty($wpfbogp_first_img)){ // return false if nothing there, makes life easier
    return false;
  }
  return $wpfbogp_first_img;
}

// build ogp meta
function wpfbogp_build_head() {
	global $post;
	$options = array("wpfbogp_fallback_img" => get_bloginfo('template_url')."/assets/images/aux/facebook-thumb.png");
	// check to see if you've filled out one of the required fields and announce if not

		// do fb verification fields
		//echo "\t<meta property='fb:app_id' content='263434066253' />\n";

		
		// do url stuff
		if (is_home() || is_front_page() ) {
			echo "\t<meta property='og:url' content='".get_bloginfo('url')."' />\n";
		}else{
			echo "\t<meta property='og:url' content='http://".$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']."' />\n";
		}
		
		// do title stuff
		if (is_home() || is_front_page() ) {
			echo "\t<meta property='og:title' content='".get_bloginfo('name')."' />\n";
		}elseif (is_singular('gtb_bits') ){
			echo "\t<meta property='og:title' content='Free Bit: ".get_the_title()."' />\n";
		}else{
			echo "\t<meta property='og:title' content='".get_the_title()." | ".get_bloginfo('name')."' />\n";
		}
		
		// do additional randoms
		echo "\t<meta property='og:site_name' content='".get_bloginfo('name')."' />\n";
		
		// do descriptions
		if (is_singular('post')) {
			if (has_excerpt($post->ID)) {
				echo "\t<meta property='og:description' content='".esc_attr(strip_tags(get_the_excerpt($post->ID)))."' />\n";
			}else{
				echo "\t<meta property='og:description' content='".esc_attr(str_replace("\r\n",' ',substr(strip_tags(strip_shortcodes($post->post_content)), 0, 160)))."' />\n";
			}
		}else{
			echo "\t<meta property='og:description' content='".get_bloginfo('description')."' />\n";
		}
		
		// do ogp type
		if (is_singular(array('post', 'datm_shows', 'datm_music'))) {
			echo "\t<meta property='og:type' content='article' />\n";
		}else{
			echo "\t<meta property='og:type' content='website' />\n";
		}
		
		// do image tricks
		if (is_home()) {
			if (isset($options['wpfbogp_fallback_img']) && $options['wpfbogp_fallback_img'] != '') {
				echo "\t<meta property='og:image' content='".$options['wpfbogp_fallback_img']."' />\n";
			}else{
				echo "\t<!-- There is not an image here as you haven't set a default image in the plugin settings! -->\n"; 
			}
		} else {
							
		  $pattern = get_shortcode_regex();
      
      if (   preg_match_all( '/'. $pattern .'/s', $post->post_content, $matches )
	        && array_key_exists( 2, $matches )
	        && in_array( 'flickr', $matches[2] ) )
	    {
	        //print_r($matches[5][0]);
	    }
			
			if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail($post->ID))) {
				$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail' );
				//echo "\t<meta property='og:image' content='".esc_attr($thumbnail_src[0])."' />\n";
				$image_id = get_post_thumbnail_id();
				$image_url = wp_get_attachment_url($image_id);
				echo "\t<meta property='og:image' content='".$image_url."' />\n";
			}elseif (( wpfbogp_first_image() !== false ) && (is_singular())) {
				echo "\t<meta property='og:image' content='".wpfbogp_first_image()."' />\n";
			}else{
				if (isset($options['wpfbogp_fallback_img']) && $options['wpfbogp_fallback_img'] != '') {
					echo "\t<meta property='og:image' content='".$options['wpfbogp_fallback_img']."' />\n";
				}else{
					echo "\t<!-- There is not an image here as you haven't set a default image in the plugin settings! -->\n"; 
				}
			}
		}
		// do locale
		echo "\t<meta property='og:locale' content='".esc_attr( get_locale() )."' />\n";
		
		// do facebook IDs of page administrators
		echo "\t<meta property='fb:admins' content='ricardomestre' />\n";


} // end function


add_action('wp_head','wpfbogp_build_head',50);

// twentyten and twentyeleven add crap to the excerpt so lets check for that and remove
add_action('after_setup_theme','wpfbogp_fix_excerpts_exist');
function wpfbogp_fix_excerpts_exist() {
	remove_filter('get_the_excerpt','twentyten_custom_excerpt_more');
	remove_filter('get_the_excerpt','twentyeleven_custom_excerpt_more');
}


/**
 * SoundCloud embed shortcode — replacement for the abandoned soundcloud-is-gold plugin.
 *
 * Usage: [soundcloud id='TRACK_ID']
 *        [soundcloud id='SET_ID' format='set']
 *
 * The 'id' attribute is the numeric SoundCloud track or playlist ID.
 * The 'format' attribute defaults to 'tracks'; use 'set' for playlists.
 */
function datm_soundcloud_shortcode( $atts ) {
	$atts = shortcode_atts( array(
		'id'     => '',
		'format' => 'tracks',
		'width'  => '100%',
	), $atts );

	if ( empty( $atts['id'] ) ) return '';

	$type   = ( $atts['format'] === 'set' ) ? 'playlists' : 'tracks';
	$height = ( $atts['format'] === 'set' ) ? 450 : 166;
	$url    = 'https://w.soundcloud.com/player/?url=' . rawurlencode( 'https://api.soundcloud.com/' . $type . '/' . $atts['id'] ) . '&auto_play=false&show_artwork=true&visual=false';

	return '<iframe width="' . esc_attr( $atts['width'] ) . '" height="' . $height . '" scrolling="no" frameborder="no" allow="autoplay" src="' . esc_url( $url ) . '"></iframe>';
}
add_shortcode( 'soundcloud', 'datm_soundcloud_shortcode' );


/**
 * Flickr shortcodes — replacement for the abandoned Flickr Gallery plugin.
 *
 * [flickr]https://www.flickr.com/photos/user/PHOTO_ID/[/flickr]
 *   Embeds a single Flickr photo via oEmbed (no API key required).
 *
 * [flickr-gallery mode="photoset" photoset="PHOTOSET_ID"]
 *   Embeds a Flickr photoset via oEmbed, falling back to Flickr's
 *   slideshow player. The 'user' attribute defaults to 'duskatthemansion'.
 */
function datm_flickr_shortcode( $atts, $content = '' ) {
	$content = trim( $content );
	if ( empty( $content ) ) return '';

	$embed = wp_oembed_get( $content );
	if ( $embed ) return '<div class="flickr-embed">' . $embed . '</div>';

	return '<p><a href="' . esc_url( $content ) . '" target="_blank" rel="noopener">View photo on Flickr</a></p>';
}
add_shortcode( 'flickr', 'datm_flickr_shortcode' );

function datm_flickr_gallery_shortcode( $atts ) {
	$atts = shortcode_atts( array(
		'mode'     => 'photoset',
		'photoset' => '',
		'user'     => 'duskatthemansion',
	), $atts );

	if ( empty( $atts['photoset'] ) ) return '';

	$album_url = 'https://www.flickr.com/photos/' . $atts['user'] . '/sets/' . $atts['photoset'] . '/';
	$embed = wp_oembed_get( $album_url );
	if ( $embed ) return '<div class="flickr-gallery-embed">' . $embed . '</div>';

	// Fallback: Flickr's embeddable slideshow player
	$player_url = $album_url . 'player/';
	return '<div class="flickr-gallery-embed"><iframe src="' . esc_url( $player_url ) . '" width="100%" height="500" frameborder="0" allowfullscreen></iframe></div>';
}
add_shortcode( 'flickr-gallery', 'datm_flickr_gallery_shortcode' );

?>