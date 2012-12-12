<?php
/*
Plugin Name: Youtube Vídeos InSystems
Plugin URI: 
Description: Plugin para integrar vídeos do Youtube com os seus Posts, ele relaciona os vídeos aos posts via Tags.
Version: 1.0
Author: InSystems
Author URI: http://insystems.com.br
*/

add_action('init', 'in_youtubevideos_post_type_init' );
add_action('admin_menu', 'add_video_box');
add_action('save_post', 'video_save_postdata' );
add_action('wp_footer', 'add_css');
add_action('wp_footer', 'add_js');

function in_youtubevideos_post_type_init($paramns) {
	$labels = array(
			'name' => _x('Youtube Vídeos', 'post type general name', 'your_text_domain'),
			'singular_name' => _x('Youtube Vídeo', 'post type singular name', 'your_text_domain'),
			'add_new' => _x('Add New', 'book', 'your_text_domain'),
			'add_new_item' => __('Add New Vídeo', 'your_text_domain'),
			'edit_item' => __('Edit Vídeo', 'your_text_domain'),
			'new_item' => __('New Vídeo', 'your_text_domain'),
			'all_items' => __('All Vídeos', 'your_text_domain'),
			'view_item' => __('View Vídeo', 'your_text_domain'),
			'search_items' => __('Search Vídeo', 'your_text_domain'),
			'not_found' =>  __('No videos found', 'your_text_domain'),
			'not_found_in_trash' => __('No videos found in Trash', 'your_text_domain'),
			'parent_item_colon' => '',
			'menu_name' => __('Vídeos', 'your_text_domain'),
	
	);
	$args = array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'query_var' => true,
			'menu_icon' => get_bloginfo('url') . '/wp-content/plugins/youtube-insystems/images/video_icon.png',
			'rewrite' => array( 'slug' => _x( 'video', 'URL slug', 'your_text_domain' ) ),
			'capability_type' => 'post',
			'has_archive' => true,
			'hierarchical' => false,
			'menu_position' => 5,
			'supports' => array( 'title', 'excerpt'),
			'taxonomies' => array('post_tag')
	);
	register_post_type('video', $args);
}

function add_video_box() {
	add_meta_box(
			'video-youtube', 
			'Url do Vídeo(Youtube)', 
			'video_box', 
			'video' 
	);
}

function video_box() {
	$value = '';
	if(isset($_GET['action']) && $_GET['action'] == 'edit') $value = get_post_meta($_GET['post'], 'video-youtube', true);

	$vars = array(
			'id' => 'video-youtube',
			'name' => 'video-youtube',
			'placeholder' => 'http://www.youtube.com/watch?v=Nba3Tr_GLZU',
			'value' => $value,
			'style' => 'padding: 3px 8px;
						font-size: 1.7em;
						line-height: 100%;
						width: 100%;
						outline: 0;'
		);
	
	include __DIR__ . '/templates/input_text.ctp';
}

function video_save_postdata() {
	if(!empty($_POST) && !empty($_POST['video-youtube'])) {
		save_metadata_youtube($_POST);
	}
}

function save_metadata_youtube(array $data) {
	update_post_meta($data['post_ID'], 'video-youtube',  trim($data['video-youtube']));
} 

function add_css() {
	echo '<link rel="stylesheet" href="' . get_bloginfo('url') . '/wp-content/plugins/youtube-insystems/templates/css/youtube-insystems.css' . '" type="text/css" media="screen" />';
	echo '<link rel="stylesheet" href="' . get_bloginfo('url') . '/wp-content/plugins/youtube-insystems/templates/css/modal-basic.css' . '" type="text/css" media="screen" />';
}

function add_js() {
	echo '<script type="text/javascript" src="' . get_bloginfo('url') . '/wp-content/plugins/youtube-insystems/templates/js/jquery.simplemodal.js' . '"></script>';
	echo '<script type="text/javascript" src="' . get_bloginfo('url') . '/wp-content/plugins/youtube-insystems/templates/js/modal-basic.js' . '"></script>';
}

include 'youtube_video_page.php';