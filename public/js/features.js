$(document).ready(function(){
	$('body').scrollspy({
	    target: '.bs-docs-sidebar',
	    offset: 50
	});
	var offset = $("#sidebar").offset();
	if (offset) {
		$("#sidebar").affix({
		    offset: {
		      top: offset.top-90
		    }
		});
	};
	$('.bs-docs-sidebar #sidebar a').click(function(){
	    $('html, body').animate({
	        scrollTop: $( $(this).attr('href') ).offset().top
	    }, 500);
	    return false;
	});
});