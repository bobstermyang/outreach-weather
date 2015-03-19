
$(document).ready(function() {

	/* Processing the main actions */
	if(navigator.geolocation) {

		navigator.geolocation.getCurrentPosition(process_position, error_position);

	} else { 

		display();
	
	}


	$('a[data-location]').on('click', function(e) {

		search($(this).data('location'));

		e.preventDefault();

	});


	$('#search').on('keypress', function(e) {
		if(e.keyCode == 13 || e.which == 13) {
			
			search($(this).val());

			e.preventDefault();

		}
	});

	/* Change weather temperature type */
	$('#change_degree_type').on('click', function() {

		var cookie_degree_type = $.cookie('degree_type');
		var default_degree_type = $(this).data('default-degree-type');

		if(typeof cookie_degree_type == 'undefined') {
				
			if(default_degree_type == 'C') {
				$.cookie('degree_type', 'F');
			} else {
				$.cookie('degree_type', 'C');
			}

		} else 
		if(cookie_degree_type == 'C') {

			$.cookie('degree_type', 'F');

		} else {

			$.cookie('degree_type', 'C');

		}

		$('#degree_type_value').html($.cookie('degree_type'));

		search($('#location').html());

	});

	/* Enable collapseable menu */
	$(".button-collapse").sideNav();

	/* Dropdown enable */
	$(".dropdown-button").dropdown({ hover: false, constrain_width: false});

	/* Enable tabs */
	$('ul.tabs').tabs();

	/* Enable tooltips */
	$('.tooltipped').tooltip({delay: 50});

	/* Submit disable after 1 click */
	$('[type=submit][name=submit]').on('click', function() {
		$(this).addClass('disabled');
	});

	/* Confirm delete handler */
	$('body').on('click', '[data-confirm]', function(){
		var message = $(this).attr('data-confirm');
		if(confirm(message) == false) return false;
	});

	
});


function process_position(position) {
	
	var data = 'latitude='+position.coords.latitude+'&longitude='+position.coords.longitude;

	display(data);

}

function error_position() {

	display();

}

function display(data) {

	$.post('processing/weather.php', data, function(result){

		setTimeout(function() {
			$('#result').hide().html(result).fadeIn();
			$('#preloader').hide();
		}, 1000);

	});

}

function search(data) {

	
	$('#result').hide();
	$('#preloader').fadeIn();

	var data = 'location='+data;

	display(data);

}


/* Show More */ 
function showMore(start, page, selector, showmore) {
	/* Post and get response */
	$.post(page, "limit="+start, function(data) {
		
		if($.trim(data) == "") {
			/* If no response, fadeOut the button */
			$(showmore).fadeOut('slow');

		} else {
			/* Remove the current show more button */
			$(showmore).remove(); 

			/* Append the result to the div */
			$(data).hide().appendTo(selector).fadeIn('slow');

			/* Refresh the bootstrap tooltip */
			$('.tooltipz').tooltip();
		}
	});
}
