$(document).ready(function() {
	
	// filter change
	$('.pjs-mm-archive .wrapper .filters select').change(function() {
		var filterType = $(this).attr('filter');
		var filterValue = $(this).val();
		
		$('.pjs-mm-archive .wrapper .cards').attr(filterType, filterValue);
		$('.pjs-mm-archive .wrapper .cards').attr('page', 1);
		
		clearColumns();
		loadMore();
	});
	
	// load items on button click
	$('.pjs-mm-archive .wrapper > .btns a').click(function() {
		loadMore();
	});
	
	// load initial items
	loadMore();
	
	// loadMore function
	function loadMore() {
		var lmBtn = $('.pjs-mm-archive .wrapper > .btns');
		var loader = $('.pjs-mm-archive .wrapper .loader');
		var noResults = $('.pjs-mm-archive .wrapper .no-results');
		var container = $('.pjs-mm-archive .wrapper .cards');
		var postType = container.attr('post-type');
		var keywords = container.attr('keywords');
		var series = container.attr('series');
		var speakers = container.attr('speakers');
		var page = container.attr('page');
		var offset = container.attr('offset');
		
		lmBtn.slideUp(300);
		noResults.slideUp(300);
		loader.slideDown(300);
		
		$.ajax({
			type: 'POST',
			url: '/wp-content/plugins/pjs-media-manager/ajax/load-more.php',
			data: {post_type:postType, keywords:keywords, series:series, speakers:speakers, page:page, offset:offset}
		}).done(function(results) {
			
			results = $.parseJSON(results);
			
			// console.log(results);
			
			if (results.cards) {
				for (i = 0; i < results.cards.length; i++) {
					container.append(results.cards[i]);
				}
			} else {
				noResults.slideDown(300);
			}
			
			container.attr('page', results.page);
			container.attr('total', results.total);
			container.attr('offset', results.offset);
			loader.slideUp(300);
			
			setTimeout(function() {
				if (results.total > $('.pjs-mm-archive .wrapper .cards .card').length) {
					lmBtn.slideDown(300);
				}
			}, 300);
			
			$('.pjs-mm-archive .wrapper .cards .card').each(function() {
				$(this).removeClass('hidden');
			});
			
		});
	}
	
	// clearColumns function
	function clearColumns() {
		$('.pjs-mm-archive .wrapper .cards .card').each(function() {
			var thisCard = $(this);
			
			thisCard.addClass('hidden');
			
			setTimeout(function() {
				thisCard.remove();
			}, 300);
		});
	}
	
});