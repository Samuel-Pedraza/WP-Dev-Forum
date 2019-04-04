<?php

// include verb within function naming

// command query split

class RegisterFiles {

	public function __construct(){
		add_action('wp_enqueue_scripts', array($this, 'load_javascript'));
		add_action('wp_enqueue_scripts', array($this, 'load_styles'));
		add_action('wp_enqueue_scripts', array($this, 'unload_styles'));
		add_filter('the_generator', array($this, 'remove_version'));
		$this->unload_emojis();
		$this->unload_excess_links();
	}

	public function load_javascript(){
		wp_deregister_script( 'jquery' );
		wp_deregister_script( 'jquery-migrate.min' );

		wp_register_script( 'jquery', '/wp-includes/js/jquery/jquery.js', array(), false, true );
		wp_register_script( 'jquery-migrate.min', '/wp-includes/js/jquery/jquery-migrate.min.js', array(), false, true );

		wp_enqueue_script( 'jquery', '/wp-includes/js/jquery/jquery.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'jquery-migrate.min', '/wp-includes/js/jquery/jquery-migrate.min.js', array( 'jquery-migrate.min' ), false, true );

		wp_enqueue_script('bootstrapJS', get_template_directory_uri() . '/assets/js/vendor/bootstrap.bundle.min.js', '', '', true);
	}

	public function load_styles(){
		wp_enqueue_style('mainCSS', get_template_directory_uri() . '/style.min.css', '', '', false);
		wp_enqueue_style('fontsCSS', 'https://fonts.googleapis.com/css?family=Poppins|Roboto', '', '', false);
	}

	public function unload_styles(){
		wp_dequeue_style( 'wp-block-library' );
	}

	public function unload_emojis(){
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	}

	public function unload_excess_links(){
		remove_action('wp_head', 'rsd_link'); // remove really simple discovery (RSD) link
		remove_action('wp_head', 'wlwmanifest_link'); // remove wlwmanifest.xml (needed to support windows live writer)
		remove_action('wp_head', 'feed_links', 2); // remove rss feed links (if you don't use rss)
		remove_action('wp_head', 'feed_links_extra', 3); // removes all extra rss feed links
		remove_action('wp_head', 'index_rel_link'); // remove link to index page
		remove_action('wp_head', 'start_post_rel_link', 10, 0); // remove random post link
		remove_action('wp_head', 'parent_post_rel_link', 10, 0); // remove parent post link
		remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // remove the next and previous post links
		remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
		remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 ); // remove shortlink
	}

	public function remove_version(){
		return '';
	}

}

$register = new RegisterFiles;

add_action("admin_post_nopriv_add_new_perspective", "add_new_perspective");
add_action("admin_post_add_new_perspective", "add_new_perspective");

function add_new_perspective(){
	global $post;
	$perspective = $_POST["perspective"];
	$user_id = $_POST["user_id"];
	$post_id = $_POST["post_id"];

	$commentdata = array(
	'comment_post_ID' => $post_id, // to which post the comment will show up
	'comment_content' => $perspective, //fixed value - can be dynamic
	'comment_type' => '', //empty for regular comments, 'pingback' for pingbacks, 'trackback' for trackbacks
	'comment_parent' => 0, //0 if it's not a reply to another comment; if it's a reply, mention the parent comment ID here
	'user_id' => $user_id, //passing current user ID or any predefined as per the demand
	);

	$comment_id = wp_new_comment( $commentdata );

	$location = $_SERVER['HTTP_REFERER'];
	wp_safe_redirect($location);

	exit();

}
