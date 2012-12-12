jQuery(function ($) {
	$('a.video-link').click(function (e) {
		$.modal('<iframe src="' + $(this).attr('href') + '&autoplay=1" height="400" width="600" style="border:0">', {
			closeHTML:"",
			overlayClose:true,
			minHeight:416,
			minWidth: 616
		});
		return false;
	});
});