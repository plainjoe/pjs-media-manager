<?php
/**
 * Page template used for media items
 */

get_header();
	
	$slug = get_field('pjs_mm_slug', 'option');
	$relatedTitle = get_field('pjs_mm_related_title', 'option');
	$viewMediaLabel = get_field('pjs_mm_view_media_label', 'option');
	$viewAllLabel = get_field('pjs_mm_view_all_label', 'option');
	
	if (!$slug) {
		$slug = 'media';
	}
	
	if (!$viewMediaLabel) {
		$viewMediaLabel = 'View Media';
	}
	
	if (!$viewAllLabel) {
		$viewAllLabel = 'View All Media';
	}
	
	$postType = get_post_type();
	$graphic = get_field('graphic');
	$title = get_the_title();
	$date = new DateTime(get_the_date());
	$date = $date->format('F j, Y');
	$videoUrl = get_field('video_url');
	$audioUrl = get_field('audio_url');
	$notesUrl = get_field('notes_url');
	$series = get_field('series');
	$seriesGraphic = get_field('series_graphic', 'pjs-mm-series_' . $series->term_id);
	$desc = get_field('description');
	
	$speakers = '';
	$speakersList = wp_get_post_terms($post->ID, 'pjs-mm-speakers');
	$speakersCount = count($speakersList);
	$i = 1;
	
	foreach($speakersList as $speaker) {
		if ($i == $speakersCount) {
			$speakers .= $speaker->name;
		} else {
			$speakers .= $speaker->name . ', ';
		}
		$i++;
	}
	
	$keywords = '';
	$keywordsList = wp_get_post_terms($post->ID, 'pjs-mm-keywords');
	$keywordsCount = count($keywordsList);
	$k = 1;
	
	foreach ($keywordsList as $keyword) {
		if ($k == $keywordsCount) {
			$keywords .= $keyword->name;
		} else {
			$keywords .= $keyword->name . ', ';
		}
		$k++;
	}
	
	if ($graphic) {
		$graphicURL = $graphic['sizes']['pjs-mm'];
	} elseif ($seriesGraphic) {
		$graphicURL = $seriesGraphic['sizes']['large'];
	} else {
		$graphicURL = '/wp-content/plugins/pjs-media-manager/images/placeholder.jpg';
	}
	
	if (strpos($videoUrl, 'youtube.com')) {
		$videoType = 'youtube';
	} elseif (strpos($videoUrl, 'youtu.be')) {
		$videoType = 'youtube';
	} elseif (strpos($videoUrl, 'vimeo.com')) {
		$videoType = 'vimeo';
	} else {
		$videoType = 'mp4';
	}
	
	echo '<section class="pjs-mm-video">';
		echo '<div class="bg" style="background:url(' . $graphicURL . ') no-repeat center / cover;"></div>';
		echo '<div class="wrapper">';
			if ($videoUrl) {
				if ($videoType == 'youtube') {
					include(WP_PLUGIN_DIR . '/pjs-media-manager/templates/player/youtube.php');
				} elseif ($videoType == 'vimeo') {
					include(WP_PLUGIN_DIR . '/pjs-media-manager/templates/player/vimeo.php');
				} elseif ($videoType == 'mp4') {
					include(WP_PLUGIN_DIR . '/pjs-media-manager/templates/player/mp4.php');
				}
			} elseif ($audioUrl) {
				echo '<script>$(document).ready(function(){$(".pjs-mm-video .wrapper .audio").slideDown(300);});</script>';
			}
			if ($audioUrl) {
				include(WP_PLUGIN_DIR . '/pjs-media-manager/templates/player/audio.php');
			}
			if ($audioUrl || $notesUrl) {
				if ($audioUrl && $videoUrl) {
					echo '<div class="links">';
						echo '<a href="javascript:;" class="show-video"><i class="fal fa-play-circle"></i> Video</a>';
						echo '<a href="javascript:;" class="show-audio"><i class="fal fa-microphone-alt"></i> Audio</a>';
						if ($notesUrl) {
							echo '<a href="' . $notesUrl . '" target="_blank"><i class="fal fa-edit"></i> Notes</a>';
						}
					echo '</div>';
				} elseif ($notesUrl) {
					echo '<div class="links">';
						echo '<a href="' . $notesUrl . '" target="_blank"><i class="fal fa-edit"></i> Notes</a>';
					echo '</div>';
				}
			}
			echo '<div class="meta">';
				if ($keywords) {
					echo '<h5>' . $keywords . '</h5>';
				}
				echo '<h4>' . $series->name . '</h4>';
				echo '<h1>' . $title . '</h1>';
				if ($speakers) {
					echo '<p>' . $date . ' - <b>' . $speakers . '</b></p>';
				} else {
					echo '<p>' . $date . '</p>';
				}
				echo '<p>' . $desc . '</p>';
			echo '</div>';
		echo '</div>';
	echo '</section>';

	// related media items
	$relatedArgs = array(
		'post_type' => $postType,
		'posts_per_page' => -1,
		'post__not_in' => array(get_the_ID()),
		'orderby' => 'date',
		'order' => 'DESC',
		'meta_query' => array(
			array(
				'key'     => 'series',
				'value'   => $series->term_id,
				'compare' => 'IN',
			),
		),
	);
	$relatedQuery = new WP_Query($relatedArgs);
	
	echo '<section class="pjs-mm-related">';
		echo '<div class="wrapper">';
			if ($relatedTitle) {
				echo '<h1>' . $relatedTitle . '</h1>';
			}
			echo '<div class="cards">';
			
			if ($relatedQuery->have_posts()) {
				while ($relatedQuery->have_posts()) { $relatedQuery->the_post();
				
					// variables
					$title = get_the_title();
					$graphic = get_field('graphic');
					$link = get_the_permalink();
					$date = new DateTime(get_the_date());
					$date = $date->format('F j, Y');
					$series = get_field('series');
					$seriesGraphic = get_field('series_graphic', 'pjs-mm-series_' . $series->term_id);
					
					$speakers = '';
					$speakersList = wp_get_post_terms($post->ID, 'pjs-mm-speakers');
					$speakersCount = count($speakersList);
					$i = 1;
					
					foreach($speakersList as $speaker):
						if ($i == $speakersCount):
							$speakers .= $speaker->name;
						else:
							$speakers .= $speaker->name . ', ';
						endif;
						$i++;
					endforeach;
					
					if ($graphic) {
						$graphicURL = $graphic['sizes']['pjs-mm'];
					} elseif ($seriesGraphic) {
						$graphicURL = $seriesGraphic['sizes']['large'];
					} else {
						$graphicURL = '/wp-content/plugins/pjs-media-manager/images/placeholder.jpg';
					}
					
					echo '<div class="card">';
						echo '<div class="container">';
							echo '<a href="' . $link . '">';
								echo '<div class="image" style="background:url(' . $graphicURL . ') no-repeat center / cover;">';
									echo '<div class="tint pjs-mm-trans"></div>';
								echo '</div>';
							echo '</a>';
							echo '<div class="details">';
								echo '<h3><a href="' . $link . '">' . $title . '</a></h3>';
								if ($speakers) {
									echo '<p><b>' . $date . '</b><br>' . $speakers . '</p>';
								} else {
									echo '<p>' . $date . '</p>';
								}
								echo '<div class="btns center">';
									echo '<a href="' . $link . '">' . $viewMediaLabel . '</a>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				
				}
			}
			
			echo '</div>';
			echo '<div class="btns center">';
				echo '<a href="' . get_site_url() . '/' . $slug . '/">' . $viewAllLabel . '</a>';
			echo '</div>';
		echo '</div>';
	echo '</section>';

get_footer();