$(function(){
	decide_navsize();
	window.onscroll=function(){
		
		decide_navsize();
	}; 
	$('.inside_play_button').magnificPopup({
	  type: 'iframe',
	  iframe: {
		  markup: '<div class="mfp-iframe-scaler">'+
		            '<div class="mfp-close"></div>'+
		            '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>'+
		          '</div>', // HTML markup of popup, `mfp-close` will be replaced by the close button

		  patterns: {
		    youtube: {
		      index: 'youtube.com/', // String that detects type of video (in this case YouTube). Simply via url.indexOf(index).

		      id: 'v=', // String that splits URL in a two parts, second part should be %id%
		      // Or null - full URL will be returned
		      // Or a function that should return %id%, for example:
		      // id: function(url) { return 'parsed id'; }

		      src: '//www.youtube.com/embed/%id%?autoplay=1' // URL that will be set as a source for iframe.
		    }

		    // you may add here more sources

		  },

		  srcAction: 'iframe_src', // Templating object key. First part defines CSS selector, second attribute. "iframe_src" means: find "iframe" and set attribute "src".
		}
	  // other options
	});
	$('.flexslider').flexslider({
	    animation: "slide",
	    animationLoop: true,
	    itemWidth: 40,
	    itemMargin: 80,
	    minItems: 2,
	    maxItems: 4,
	    controlNav: false
	  });
});

function decide_navsize() {
	if ($(window).scrollTop() > 52) {
			// console.log('morethan52');
			$('.navbar-ghoori-main').addClass('navbar-fixed-top navbar_ghoori_lite');
		}
		else {
			// console.log('lessthan52');
			$('.navbar-ghoori-main').removeClass('navbar-fixed-top navbar_ghoori_lite');
		}
}