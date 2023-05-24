// ===============
// Slider function
// ===============
function slider(){

	//Main slider
	$('#flexcarousel').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: false,
    slideshow: false,
    itemWidth: 188,
    //itemMargin: 5 ,
    asNavFor: '#flexslider'
  });
   
  $('#flexslider').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: false,
    slideshow: true,
	slideshowSpeed: 5000,
	animationSpeed: 600,
    sync: "#flexcarousel"
  });
  
  // Thumbnail
  $('#flexcarousel-product').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: false,
    slideshow: false,
    itemWidth: 115,
    asNavFor: "#flexslider-product"
  });
  
  $('#flexslider-product').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: false,
    slideshow: false,
    sync: "#flexcarousel-product",
    smoothHeight: true,
    start: function(){
    	var img = $("#flexslider-product .flex-active-slide .zoom").elevateZoom({
            zoomType: "inner",
            // cursor: "crosshair",
            zoomWindowFadeIn: 500,
            zoomWindowFadeOut: 750
        });
    },
	before: function(){
		$('.zoomContainer').remove();
		if (typeof img !== 'undefined') {
		    img.removeData('elevateZoom');
			img.removeData('zoomImage');
		}
		
	},
	after: function(){
		console.log('ok')
		img = $("#flexslider-product .flex-active-slide .zoom").elevateZoom({
            zoomType: "inner",
            // cursor: "crosshair",
            zoomWindowFadeIn: 500,
            zoomWindowFadeOut: 750
        });
	}, 
  });

  // Brands
  $('#flexcarousel-brands').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: true,
    slideshow: false,
    itemWidth: 180
  });
  $('.product-list-thumb-flexslider').flexslider({
    animation: "slide",
    slideshow: false
  });
}

// ===================
// Navigation function
// ===================

function navWidth(){
	var nav = $('.horizontal-nav ul li').not('.horizontal-nav ul li li'), 
	size = $('.horizontal-nav ul li').not('.horizontal-nav ul li li').size(),
	percent = 100/size;
	nav.css('width', percent+'%').parent().show();
}

$('.horizontal-nav ul li').mouseenter(function(){
	$('ul', this).stop().slideDown('fast');
}).mouseleave(function(){
	$('ul', this).stop().slideUp(150);
});

// if ($.browser.msie) {
// 	//Back off
// } else {
// 	selectnav('nav', {
// 		label: 'Menu'
// 	});	
// };

// ======================
// Thumbnail Hover Effect
// ======================

function thumbHover(){

	if ($('html').hasClass('csstransforms3d')) {	
		
		$('.thumb').removeClass('scroll').addClass('flip');		
		$('.thumb.flip').hover(
			function () {
				$(this).find('.thumb-wrapper').addClass('flipIt');
			},
			function () {
				$(this).find('.thumb-wrapper').removeClass('flipIt');			
			}
		);
		
	} else {

		$('.thumb').hover(
			function () {
				$(this).find('.thumb-detail').stop().animate({bottom:0}, 500, 'easeOutCubic');
			},
			function () {
				$(this).find('.thumb-detail').stop().animate({bottom: ($(this).height() * -1) }, 500, 'easeOutCubic');			
			}
		);

	}
}



// ============
// Initial load
// ============

$(function(){

	// Cart bubble
	$('.counter a').on('click', function(){
		$('.cartbubble').slideToggle();
	});
	$('#closeit').on('click',function(e){
		e.preventDefault;
		$('.cartbubble').slideUp();
	});
	
	// Tab function
	$('#myTab a, #myTab button').click(function (e) {
		e.preventDefault();
		$(this).tab('show');
	});
	
	// Fancybox function
	// $('#flexslider-product .slides a').fancybox();

	// Toggle function
	$('.product h6.subhead').on('click', function(){
		$('.query').slideToggle();
	});

    // $(".collapse").collapse();
	
	slider();
	navWidth();
	thumbHover();

	// var index = $('.slides li').index($('.slides li:last'));
	$(document).on('change', ".selectcolorpicker",function(){
		var toId = $(this).val();
		// console.log("ID "+toId);
		// console.log(  );
		var index = $(".slide_"+toId+":eq(-1)").index();
		$('#flexslider-product').data("flexslider").flexAnimate(index - 1);
		// console.log("index "+index);
		// console.log("count "+$('#flexslider-product .slides li').length);
		

		var carindex = $(".carouselslide_"+toId+":eq(-1)").index();
		// console.log("> "+$(".carouselslide_"+toId).index());
		
		$('#flexcarousel-product').data("flexslider").flexAnimate(carindex - 1);
		// console.log("carindex "+carindex);
		// console.log("count "+$('#flexcarousel-product .slides li').length);
	});

	$(document).on('click','.print-order', function(e) {
		e.preventDefault();
		

		var printContents = document.getElementById('order-details-container').innerHTML;
		var originalContents = document.body.innerHTML;

		document.body.innerHTML = printContents;

		window.print();

		document.body.innerHTML = originalContents;
	});

    $('.createShopButton').click(function(e){
        e.preventDefault();
        var orig_url = $('.emailloginbutton').data('orig-url');
        var param = $.param({
        	'redirectUrl' : $(this).attr('href')
        });
        $('.emailloginbutton').attr('href', orig_url+'?'+param);
    });
});