<?php if(count($thumbs) && !empty($thumbs)): ?>
	<h2>Vídeos Relacionados</h2>
	<ul id="youtube_videos">
		<?php foreach($thumbs as $thumb): ?>
			<li>
				<h2><?php echo $thumb['title']; ?></h2>
				<div class="video-player">
					<a class="video-link" href="<?php echo $thumb['video_url']; ?>" style="background: url(<?php echo $thumb['thumbnail']; ?>); 
																		width: 120px; 
																		height: 90px; 
																		display:block;
																		margin: 0 auto;"> <img class="play" title="<?php echo $thumb['description']; ?>" alt="<?php echo $thumb['title']; ?>" width="40" src="<?php bloginfo('url'); ?>/wp-content/plugins/youtube-insystems/images/play.png" /></a>
					
				</div>
			</li>
		<?php endforeach; ?>
	</ul>
<?php endif; ?>