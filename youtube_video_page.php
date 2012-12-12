<?php

add_action( 'widgets_init', function(){
	return register_widget( 'WidgetYouTube' );
});

class WidgetYouTube extends WP_Widget {
	public function __construct() {
		$widget_ops = array(
				'classname' => 'youtube_by_tag',
				'description' => __( 'Seleciona os vídeos do Youtube pela Tag')
		);
		parent::__construct( 'youtubeByTag', 'Youtube by Tags', $widget_ops);
	}
	
	public function widget($args, $instance) {
		global $post;
	
		if(!is_home() && !is_page($post) && is_single($post)) {
			$thumbs = $this->selecionaTags($post);
			include __DIR__ . '/templates/widget_videos.ctp';
		}
	}

	private function selecionaTags(stdClass $post) {
		$thumbs = array();
		$tags = get_the_tags($post->ID);
		if(!empty($tags)) {		
			foreach($tags as $tag) {
				$thumb_url = $this->selecionaVideosPorTag($tag->name); 
				if(!empty($thumb_url)) $thumbs[] = $thumb_url;
			}
		}
		return end($thumbs);
	}
	
	private function selecionaVideosPorTag($tag) {
		$options = array(
					'tag' => $tag,
					'post_type' => 'video',
					'post_status'=>'publish'
				);
		$videos = new WP_Query($options);
		$youtube_api = null; 
		
		foreach($videos->posts as $post) {
			$video_url = get_post_meta($post->ID, 'video-youtube', true);
			if(!empty($video_url)) $youtube_api[] = $this->getYoutubeJsonData($video_url, $post);
		}
		
		return $youtube_api;
	}
	
	public function getYoutubeJsonData($video_url, stdClass $video_post) {
		$result = array();
		$youtube_url = "https://gdata.youtube.com/feeds/api/videos?q={$video_url}&v=2&alt=jsonc&max-results=1";
		
		$api = file_get_contents($youtube_url);
		$_json_decode = json_decode($api, true);

		$result = array(
			'id' => $video_post->ID,
			'title' => $video_post->post_title,
			'description'=> $_json_decode['data']['items'][0]['description'],
			'thumbnail' => $_json_decode['data']['items'][0]['thumbnail']['sqDefault'],
			'video_url' => $_json_decode['data']['items'][0]['content'][5]
		);
		
		return $result;
	}
}

