<?php
/**
 * Page template used for the video podcast RSS feed
 */

	// variables
	$postType = 'pjs_media';
	$podcastType = get_query_var('podcast-type');
	$image = get_field('pjs_podcast_image', 'option');
	$title = utf8_encode(htmlspecialchars(get_field('pjs_podcast_title', 'option')));
	$subTitle = utf8_encode(htmlspecialchars(get_field('pjs_podcast_sub_title', 'option')));
	$desc = utf8_encode(htmlspecialchars(get_field('pjs_podcast_description', 'option')));
	$name = get_field('pjs_podcast_owner_name', 'option');
	$email = get_field('pjs_podcast_owner_email', 'option');
	$keywords = utf8_encode(htmlspecialchars(get_field('pjs_podcast_keywords', 'option')));
	$category = utf8_encode(htmlspecialchars(get_field('pjs_podcast_category', 'option')));
	$subCategory = utf8_encode(htmlspecialchars(get_field('pjs_podcast_sub_category', 'option')));
	
	$link = get_the_permalink();
	$author = get_bloginfo('name');
	$copyright = date('Y') . ' ' . get_bloginfo('name');
	
	$enablePodcast = get_field('pjs_podcast_enable', 'option');
	
	if ($enablePodcast) {
		
		// rss feed setup
		header('Content-type: text/xml');
		echo '<?xml version="1.0" encoding="UTF-8"?>';
		echo '<rss xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" version="2.0">';
			echo '<channel>';
				echo '<title>' . $title . '</title>';
				echo '<link>' . $link . '</link>';
				echo '<language>en-us</language>';
				if ($subTitle) {
					echo '<itunes:subtitle>' . $subTitle . '</itunes:subtitle>';
				}
				echo '<itunes:author>' . $author . '</itunes:author>';
				echo '<itunes:summary>' . $desc . '</itunes:summary>';
				echo '<description>' . $desc . '</description>';
				echo '<itunes:owner>';
					echo '<itunes:name>' . $name . '</itunes:name>';
					echo '<itunes:email>' . $email . '</itunes:email>';
				echo '</itunes:owner>';
				echo '<itunes:explicit>no</itunes:explicit>';
				echo '<itunes:image href="' . $image['url'] . '"></itunes:image>';
				echo '<itunes:category text="' . $category . '">';
					if ($subCategory) {
						echo '<itunes:category text="' . $subCategory . '"></itunes:category>';
					}
				echo '</itunes:category>';
				if ($keywords) {
					echo '<itunes:keywords>' . $keywords . '</itunes:keywords>';
				}
				echo '<copyright>' . $copyright . '</copyright>';
				
				// RSS feed items
				$seriesArgs = array(
					'post_type' => $postType,
					'posts_per_page' => -1,
					'orderby' => 'date',
					'order' => 'DESC',
				);
				$seriesQuery = new WP_Query($seriesArgs);
				
				if ($seriesQuery->have_posts()) {
					while ($seriesQuery->have_posts()) { $seriesQuery->the_post();
					
						$title = utf8_encode(htmlspecialchars(get_the_title()));
						$videoUrl = get_field('video_url');
						$audioUrl = get_field('audio_url');
						$link = get_the_permalink();
						$date = get_field('date');
						$desc = utf8_encode(htmlspecialchars(get_field('description')));
						
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
						
						if ($podcastType == 'video') {
							if ($videoUrl) {
								
								echo '<item>';
									echo '<title>' . $title . '</title>';
									echo '<itunes:summary>' . $desc . '</itunes:summary>';
									echo '<description>' . $desc . '</description>';
									echo '<link>' . $link . '</link>';
									echo '<enclosure url="' . $videoUrl . '" type="video/quicktime" />';
									echo '<pubDate>' . $date . '</pubDate>';
									echo '<itunes:author>' . $speakers . '</itunes:author>';
									echo '<itunes:explicit>no</itunes:explicit>';
									echo '<itunes:keywords></itunes:keywords>';
									echo '<guid>' . $link . '</guid>';
								echo '</item>';
								
							}
						} else {
							if ($audioUrl) {
								
								echo '<item>';
									echo '<title>' . $title . '</title>';
									echo '<itunes:summary>' . $desc . '</itunes:summary>';
									echo '<description>' . $desc . '</description>';
									echo '<link>' . $link . '</link>';
									echo '<enclosure url="' . $audioUrl . '" type="audio/mpeg" />';
									echo '<pubDate>' . $date . '</pubDate>';
									echo '<itunes:author>' . $speakers . '</itunes:author>';
									echo '<itunes:explicit>no</itunes:explicit>';
									echo '<itunes:keywords></itunes:keywords>';
									echo '<guid>' . $link . '</guid>';
								echo '</item>';
								
							}
						}
					
					}
				}
				
			echo '</channel>';
		echo '</rss>';
		
	} else {
		// silence is golden
	}