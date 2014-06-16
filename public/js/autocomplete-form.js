$(document).ready(function() {


	$('#perishable').change(function() {
		var expiry = $('#expiry');

		if($('#perishable').prop('checked') == false) {
			expiry.attr('disabled', 'disabled');
			expiry.removeAttr('enabled', 'enabled');
		} else {
			expiry.removeAttr('disabled', 'disabled');
			expiry.attr('enabled', 'enabled');
		}

	});
});