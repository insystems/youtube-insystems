<small>Ex.: http://www.youtube.com/watch?v=0LbQlX5VFuM</small>
<input 	type="text" 
		id="<?php  echo $vars['id']; ?>" 
		name="<?php echo $vars['name']; ?>" 
		value="<?php echo $vars['value']; ?>" 
		style="<?php echo $vars['style']; ?>"
/>

<div id="video-preview">
	<h2></h2>
	<div class="video"></div>
	<div class="description"></div>
</div>
<script type="text/javascript" src="<?php bloginfo('url'); ?>/wp-content/plugins/youtube-insystems/templates/js/jquery.js"></script>
<script type="text/javascript" src="<?php bloginfo('url'); ?>/wp-content/plugins/youtube-insystems/templates/js/animacao.js"></script>