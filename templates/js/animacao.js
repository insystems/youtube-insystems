$(document).ready(function() {
	if($('input#video-youtube').val() != "" && $('input#video-youtube').val() != " " && $('input#video-youtube').val() != "   ") {
		var _q = $('input#video-youtube').val();
		var _url = "https://gdata.youtube.com/feeds/api/videos?q=" + _q + "&v=2&alt=jsonc&max-results=1";
		
		jsonIntegraComYouTube(_url);
	}
	
	$('input#video-youtube').blur(function() {
		var _q = $(this).val();
		var _url = "https://gdata.youtube.com/feeds/api/videos?q=" + _q + "&v=2&alt=jsonc&max-results=1";
		
		jsonIntegraComYouTube(_url);
	});
	
	function jsonIntegraComYouTube(url) {
		var _iframe = '';
		$.ajax({
			url: url,
			dataType: 'json',
			success: function(response) {
				$.each(response.data.items, function(k, v) {
					_iframe = montaIframeYouTube(v.content['5']);
					$('#video-preview h2').text(v.title);
					$('#video-preview .video').html(_iframe);
					$('#video-preview .description').text(v.description);
				});
			}
		});
	}
	
	function montaIframeYouTube(url) {
		var _html = '<iframe src="' + url + '" width="600" height="400"></iframe>';
		return _html;
	}
});