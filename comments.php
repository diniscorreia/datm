<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.  The actual display of comments is
 * handled by a callback to starkers_comment which is
 * located in the functions.php file.
 */
?>

<div id="comments">

  <?php if ( post_password_required() ) : ?>
  <p><?php _e( 'This post is password protected. Enter the password to view any comments.', 'starkers' ); ?></p>
  <?php
    return;
  	endif;
  ?>
  
  <?php if ( have_comments() ) : ?>
  <section id="comments-entries" class="group">
    <header>
      <h1 id="comments-title" class="group-title"><?php printf( _n( 'One Response to %2$s', '%1$s Responses to %2$s', get_comments_number(), 'starkers' ), number_format_i18n( get_comments_number() ), '<strong>' . get_the_title() . '</strong>' ); ?></h1>
    </header>
    <ol class="item-list">
  	<?php
  		wp_list_comments( array( 'style' => 'div', 'callback' => 'starkers_comment', 'end-callback' => 'starkers_comment_close' ) );
  	?>
  	</ol>
  </section>
  
  <?php else : // or, if we don't have comments:
  
  	if (!comments_open()) :
  ?>
  <section id="comments-entries" class="group">
  	<p><?php _e( 'Comments are closed.', 'starkers' ); ?></p>
  </section>
  <?php endif; // end ! comments_open() ?>
  
  <?php endif; // end have_comments() ?>
  
  <section id="comments-reply" class="group">
    <header>
      <h1 id="comments-reply-title" class="group-title">Reply to <strong><?php echo get_the_title() ?></strong></h1>
    </header>
    <div class="item">
      <?php comment_form(array('title_reply'=>'')); ?>
    </div>
  </section>

</div>