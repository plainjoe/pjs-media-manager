<?php
	$path = $_SERVER['DOCUMENT_ROOT'];
	
	include_once $path . '/wp-config.php';
	include_once $path . '/wp-load.php';
	include_once $path . '/wp-includes/wp-db.php';

	global $wpdb;
	global $wp_query;
	
	$postType = $_POST['post_type'];
	$keywords = $_POST['keywords'];
	$series = $_POST['series'];
	$speakers = $_POST['speakers'];
	$page = $_POST['page'];
	$offset = $_POST['offset'];
	
	$results = array();
	$results['page'] = $page + 1;
	
	$viewMediaLabel = get_field('pjs_mm_view_media_label', 'option');
	$displaySeries = get_field('pjs_mm_display_series', 'option');
	
	if (!$viewMediaLabel) {
		$viewMediaLabel = 'View Media';
	}
	
	if ($displaySeries) {
		
		// series query
		$k = 0;
		
		$allSeries = get_terms('pjs-mm-series',
			array(
				'orderby'  => 'meta_value',
				'order'    => 'DESC',
				'meta_key' => 'series_start_date',
				'number'   => 6,
				'offset'   => $offset,
			)
		);
		
		foreach($allSeries as $series) {
			$seriesGraphic = get_field('series_graphic', 'pjs-mm-series_' . $series->term_id);
			$graphicURL = $seriesGraphic['sizes']['pjs-mm'];
			
			$itemsArgs = array(
				'post_type' => $postType,
				'posts_per_page' => -1,
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
			
			$itemsQuery = new WP_Query($itemsArgs);
			$totalItems = count($itemsQuery->posts);
			$m = 1;
			
			if ($itemsQuery->have_posts()) {
				while ($itemsQuery->have_posts()) { $itemsQuery->the_post();
					if ($m == 1) {
						$link = get_the_permalink();
						$startDate = new DateTime(get_the_date());
						$startDate = $startDate->format('F j, Y');
					}
					if ($m == $totalItems) {
						$endDate = new DateTime(get_the_date());
						$endDate = $endDate->format('F j, Y');
					}
					
					$m++;
				}
			}
			
			$results['cards'][$k] .= '<div class="card hidden pjs-mm-trans">';
				$results['cards'][$k] .= '<div class="container">';
					$results['cards'][$k] .= '<a href="' . $link . '">';
						$results['cards'][$k] .= '<div class="image" style="background:url(' . $graphicURL . ') no-repeat center / cover;">';
							$results['cards'][$k] .= '<div class="tint pjs-mm-trans"></div>';
						$results['cards'][$k] .= '</div>';
					$results['cards'][$k] .= '</a>';
					$results['cards'][$k] .= '<div class="details">';
						$results['cards'][$k] .= '<h3><a href="' . $link . '">' . $series->name . '</a></h3>';
						if ($startDate != $endDate) {
							$results['cards'][$k] .= '<p>' . $startDate . ' - ' . $endDate . '</p>';
						} else {
							$results['cards'][$k] .= '<p>' . $startDate . '</p>';
						}
						$results['cards'][$k] .= '<div class="btns center">';
							$results['cards'][$k] .= '<a href="' . $link . '">View Series</a>';
						$results['cards'][$k] .= '</div>';
					$results['cards'][$k] .= '</div>';
				$results['cards'][$k] .= '</div>';
			$results['cards'][$k] .= '</div>';
			
			$k++;
		}
		
		// total query
		$totalSeries = get_terms('pjs-mm-series',
			array(
				'orderby'  => 'meta_value',
				'order'    => 'DESC',
				'meta_key' => 'series_start_date',
			)
		);
		
		$results['total'] = count($totalSeries);
		$results['offset'] = $offset + $k;
		
	} else {
		
		$taxQuery = '';
		$metaQuery = '';
	
		if ($keywords != 'all' || $series != 'all' || $speakers != 'all') {
			$taxQuery = array('relation' => 'AND');
			$metaQuery = array('relation' => 'AND');
			
			if ($keywords != 'all') {
				array_push($taxQuery, array(
					'taxonomy' => 'pjs-mm-keywords',
					'field'    => 'term_id',
					'terms'    => $keywords,
					'operator' => 'IN',
				));
			}
			
			if ($series != 'all') {
				array_push($metaQuery, array(
					'key'     => 'series',
					'value'   => $series,
					'compare' => 'IN',
				));
			}
			
			if ($speakers != 'all') {
				array_push($taxQuery, array(
					'taxonomy' => 'pjs-mm-speakers',
					'field'    => 'term_id',
					'terms'    => $speakers,
					'operator' => 'IN',
				));
			}
		}
		
		// media query
		$k = 0;
		
		$itemsArgs = array(
			'post_type' => $postType,
			'posts_per_page' => 6,
			'orderby' => 'date',
			'order' => 'DESC',
			'paged' => $page,
			'tax_query' => $taxQuery,
			'meta_query' => $metaQuery,
		);
		$itemsQuery = new WP_Query($itemsArgs);
		
		if ($itemsQuery->have_posts()) {
			while ($itemsQuery->have_posts()) { $itemsQuery->the_post();
				$graphic = get_field('graphic');
				$series = get_field('series');
				$seriesGraphic = get_field('series_graphic', 'pjs-mm-series_' . $series->term_id);
				$link = get_the_permalink();
				$title = get_the_title();
				$date = new DateTime(get_the_date());
				$date = $date->format('F j, Y');
				
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
				
				if ($graphic) {
					$graphicURL = $graphic['sizes']['pjs-mm'];
				} elseif ($seriesGraphic) {
					$graphicURL = $seriesGraphic['sizes']['pjs-mm'];
				} else {
					$graphicURL = '/wp-content/plugins/pjs-media-manager/images/placeholder.jpg';
				}
				
				$results['cards'][$k] .= '<div class="card hidden pjs-mm-trans">';
					$results['cards'][$k] .= '<div class="container">';
						$results['cards'][$k] .= '<a href="' . $link . '">';
							$results['cards'][$k] .= '<div class="image" style="background:url(' . $graphicURL . ') no-repeat center / cover;">';
								$results['cards'][$k] .= '<div class="tint pjs-mm-trans"></div>';
							$results['cards'][$k] .= '</div>';
						$results['cards'][$k] .= '</a>';
						$results['cards'][$k] .= '<div class="details">';
							$results['cards'][$k] .= '<h3><a href="' . $link . '">' . $title . '</a></h3>';
							if ($speakers) {
								$results['cards'][$k] .= '<p><b>' . $date . '</b><br>' . $speakers . '</p>';
							} else {
								$results['cards'][$k] .= '<p>' . $date . '</p>';
							}
							$results['cards'][$k] .= '<div class="btns center">';
								$results['cards'][$k] .= '<a href="' . $link . '">' . $viewMediaLabel . '</a>';
							$results['cards'][$k] .= '</div>';
						$results['cards'][$k] .= '</div>';
					$results['cards'][$k] .= '</div>';
				$results['cards'][$k] .= '</div>';
				
				$k++;
			}
		}
		
		// total query
		$j = 0;
		
		$totalArgs = array(
			'post_type' => $postType,
			'posts_per_page' => -1,
			'orderby' => 'date',
			'order' => 'DESC',
			'paged' => $page,
			'tax_query' => $taxQuery,
			'meta_query' => $metaQuery,
		);
		$totalQuery = new WP_Query($totalArgs);
		
		if ($totalQuery->have_posts()) {
			while ($totalQuery->have_posts()) { $totalQuery->the_post();
				$j++;
			}
		}
		
		$results['total'] = $j;
		
	}
	
	echo json_encode($results);