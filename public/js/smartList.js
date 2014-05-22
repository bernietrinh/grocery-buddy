$(document).ready(function() {
	
	$('.toggle').next().children().children().hide();

	$('.toggle').click(function() {
		if ($(this).hasClass('down')) {
			$(this).removeClass('down').addClass('up').html('Cancel');
		} else {
			$(this).removeClass('up').addClass('down').html('Add');
		}
		
		$(this).next().children().children().slideToggle(400, 'linear');
	})

	$('.more_info').next().hide();
	$('.more_info').click(function() {
		$(this).next().slideToggle(400, 'linear');
	})

});


