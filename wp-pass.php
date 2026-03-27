<?php

/** Make sure that the WordPress bootstrap has run before continuing. */
require( dirname(__FILE__) . '/../../../wp-load.php');

if ( get_magic_quotes_gpc() )
	$_POST['post_password'] = stripslashes($_POST['post_password']);

// Expires when the browser shuts down
setcookie('wp-postpass_' . COOKIEHASH, $_POST['post_password'], 0, COOKIEPATH);

wp_safe_redirect(wp_get_referer());

?>