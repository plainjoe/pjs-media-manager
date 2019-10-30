<?php
/**
 * Page template used for the media landing page
 */
 
get_header();
	
	$postType = get_post_type();
	$archiveTitle = get_field('pjs_mm_archive_title', 'option');
	$loadMoreLabel = get_field('pjs_mm_load_more_label', 'option');
	$displaySeries = get_field('pjs_mm_display_series', 'option');
	
	if (!$loadMoreLabel) {
		$loadMoreLabel = 'Load More Media';
	}
	
	// latest media item
	$latestArgs = array(
		'post_type' => $postType,
		'posts_per_page' => 1,
		'orderby' => 'date',
		'order' => 'DESC',
	);
	$latestQuery = new WP_Query($latestArgs);
	
	if ($latestQuery->have_posts()) {
		while ($latestQuery->have_posts()) { $latestQuery->the_post();
		
			$graphic = get_field('graphic', $post->post_parent);
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
			
			if (strpos($videoUrl, 'youtube.com')) {
				$videoType = 'youtube';
			} elseif (strpos($videoUrl, 'youtu.be')) {
				$videoType = 'youtube';
			} elseif (strpos($videoUrl, 'vimeo.com')) {
				$videoType = 'vimeo';
			} else {
				$videoType = 'mp4';
			}
			
			if ($graphic) {
				$graphicURL = $graphic['sizes']['pjs-mm'];
			} elseif ($seriesGraphic) {
				$graphicURL = $seriesGraphic['sizes']['large'];
			} else {
				$graphicURL = '/wp-content/plugins/pjs-media-manager/images/placeholder.jpg';
			}
			
			echo '<section class="pjs-mm-video">';
				echo '<div class="bg" style="background:url(' . $graphicURL . ') no-repeat center / cover;"></div>';
				echo '<div class="wrapper pjs-mm-trans">';
					if ($videoType == 'youtube') {
						include(WP_PLUGIN_DIR . '/pjs-media-manager/templates/player/youtube.php');
					} elseif ($videoType == 'vimeo') {
						include(WP_PLUGIN_DIR . '/pjs-media-manager/templates/player/vimeo.php');
					} elseif ($videoType == 'mp4') {
						include(WP_PLUGIN_DIR . '/pjs-media-manager/templates/player/mp4.php');
					}
					include(WP_PLUGIN_DIR . '/pjs-media-manager/templates/player/audio.php');
					if ($audioUrl || $notesUrl) {
						echo '<div class="links">';
							if ($audioUrl) {
								echo '<a href="javascript:;" class="show-video"><i class="fal fa-play-circle"></i> Video</a>';
								echo '<a href="javascript:;" class="show-audio"><i class="fal fa-microphone-alt"></i> Audio</a>';
							}
							if ($notesUrl) {
								echo '<a href="' . $notesUrl . '" target="_blank"><i class="fal fa-edit"></i> Notes</a>';
							}
						echo '</div>';
					}
					echo '<div class="meta">';
						echo '<h4>' . $series->name . '</h4>';
						echo '<h1>' . $title . '</h1>';
						if ($speakers) {
							echo '<p>' . $date . ' - <b>' . $speakers . '</b></p>';
						} else {
							echo '<p>' . $date . '</p>';
						}
					echo '</div>';
				echo '</div>';
			echo '</section>';
		
		}
	}
	
	// total media count
	$k = 0;
	
	$totalArgs = array(
		'post_type' => $postType,
		'posts_per_page' => -1,
		'orderby' => 'date',
		'order' => 'DESC',
	);
	$totalQuery = new WP_Query($totalArgs);
	
	if ($totalQuery->have_posts()) {
		while ($totalQuery->have_posts()) { $totalQuery->the_post();
			$k++;
		}
	}
	
	echo '<section class="pjs-mm-archive">';
		echo '<div class="wrapper">';
			if ($archiveTitle) {
				echo '<h1>' . $archiveTitle . '</h1>';
			}
			if (!$displaySeries) {
				echo '<div class="filters">';
					echo '<div class="filter">';
						echo '<div class="container">';
							echo '<select filter="keywords">';
								echo '<option value="all">Filter by Keyword</option>';
								
								$keywords = get_terms('pjs-mm-keywords');
								
								foreach ($keywords as $keyword) {
									echo '<option value="' . $keyword->term_id . '">' . $keyword->name . '</option>';
								}
								
							echo '</select>';
						echo '</div>';
					echo '</div>';
					echo '<div class="filter">';
						echo '<div class="container">';
							echo '<select filter="series">';
								echo '<option value="all">Filter by Series</option>';
								
								$series = get_terms('pjs-mm-series');
								
								foreach ($series as $series) {
									echo '<option value="' . $series->term_id . '">' . $series->name . '</option>';
								}
								
							echo '</select>';
						echo '</div>';
					echo '</div>';
					echo '<div class="filter">';
						echo '<div class="container">';
							echo '<select filter="speakers">';
								echo '<option value="all">Filter by Speaker</option>';
								
								$speakers = get_terms('pjs-mm-speakers');
								
								foreach ($speakers as $speaker) {
									echo '<option value="' . $speaker->term_id . '">' . $speaker->name . '</option>';
								}
								
							echo '</select>';					
						echo '</div>';
					echo '</div>';
				echo '</div>';
			}
			echo '<div class="cards" post-type="' . $postType . '" keywords="all" series="all" speakers="all" page="1" total="' . $k . '" offset="0">';
				// cards are added through an AJAX call located in ajax/load-more.js
			echo '</div>';
			echo '<div class="no-results"><p>No results found. Try changing the filters.</p></div>';
			echo '<div class="loader"><img src="' . plugins_url('/pjs-media-manager/images/loader.svg') . '" /></div>';
			echo '<div class="btns center">';
				echo '<a href="javascript:;">' . $loadMoreLabel . '</a>';
			echo '</div>';
		echo '</div>';
	echo '</section>';

get_footer();
