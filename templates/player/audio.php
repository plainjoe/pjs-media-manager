<?php
/**
 * Section template used for mp3 audios
 */

	global $audioUrl;
	global $graphicURL;
	
	if ($audioUrl) {
		echo '<div class="audio">';
			echo '<div class="image" style="background:url(' . $graphicURL . ') no-repeat center / cover;"></div>';
			echo '<audio controls>';
				echo '<source src="' . $audioUrl . '" type="audio/mp3" />';
			echo '</video>';
		echo '</div>';
	}
?>

<script>
	$(document).ready(function(){
		
		// create audio player
		const audioPlayer = new Plyr(document.querySelector('.pjs-mm-video .audio audio'));
		
		// pause audio player
		$('.pjs-mm-video .wrapper .links .show-video').click(function(){
			if ($('.pjs-mm-video .wrapper .audio').hasClass('open')) {
				
			} else {
				audioPlayer.pause();
			}
		});
		
	});
</script>