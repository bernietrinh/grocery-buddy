$(document).ready(function() {
	
	$('.toggle').next().children().children().hide();

	$('.toggle').click(function() {
		if ($(this).hasClass('down')) {
			$(this).removeClass('down');
			$(this).addClass('up');
			$(this).html('Cancel');
		} else {
			$(this).removeClass('up');
			$(this).addClass('down');
			$(this).html('Add');
		}
		
		$(this).next().children().children().slideToggle(400, 'linear');
	});

});