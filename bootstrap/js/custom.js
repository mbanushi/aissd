jQuery(document).ready(function($) {
	// Search Box Animation
	$('.search-wrapper .search-field').focus(function () {
		$(this).animate({
			width: 125,
		},
		{
			duration: 'normal',
			queue: false,
		});
		$('.search-wrapper, .search-wrapper .search-field, .search-wrapper .glyphicon').animate({
			color: '#000',
			backgroundColor: '#fff',
		},
		{
			duration: 'fast',
			queue: false,
		});
	});
	$('.search-wrapper .search-field').blur(function () {
		$(this).animate({
			width: 90,
		},
		{
			duration: 'normal',
			queue: false,
		});
		$('.search-wrapper, .search-wrapper .search-field, .search-wrapper .glyphicon').animate({
			color: '#fff',
			backgroundColor: '#000',
		},
		{
			duration: 'fast',
			queue: false,
		});
	});
	
	$('.search-wrapper').click(function() {
		$('.search-wrapper .search-field').focus();
	});
	
});