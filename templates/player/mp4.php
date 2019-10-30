<?php
/**
 * Section template used for mp4 videos
 */

	global $videoUrl;
	global $graphicURL;
	
	echo '<div class="video-mp4">';
		echo '<video poster="' . $graphicURL . '" playsinline controls>';
			echo '<source src="' . $videoUrl . '" type="video/mp4" />';
		echo '</video>';
	echo '</div>';
?>

<script>
	$(document).ready(function(){
		
		// create video player
		const videoPlayer = new Plyr(document.querySelector('.pjs-mm-video .video-mp4 video'), {
			fullscreen: {iosNative:true},
			settings: ['captions', 'quality', 'loop'],
		});
		
		// pause video player
		$('.pjs-mm-video .wrapper .links .show-audio').click(function(){
			if ($('.pjs-mm-video .wrapper .audio').hasClass('open')) {
				videoPlayer.pause();
			} else {
				
			}
		});
		
	});
</script>