$(document).ready(function(){

	// $('.welcome-modal').modal('show');
	// Category filter
	// if( 'undefined' !== cattreejson)
	$(window).bind('scroll', function () {
	    if ($(window).scrollTop() > 50) {
	        $('.navbar-ghoori-main').removeClass('navbar-fat').find('.gh-input-group-search').removeClass('input-group-lg').addClass('input-group-md');
	    } else {
	        $('.navbar-ghoori-main').addClass('navbar-fat').find('.gh-input-group-search').removeClass('input-group-md').addClass('input-group-lg');
	    }
	});

	if (typeof shopcattreejson !== 'undefined')
	{	
		console.log(shopcattreejson);
		$.ajax({
				url: shopcattreejson,
				dataType: "jsonp",
				success: function(result){
					mainresult = result;
					console.log('shopcattreejson res');
					// console.log(result);
					createCategoryMenu(result);
					// Category Filter in shop list
					$('.smartbread').on('click', '.ch-category-toggle', function(e){
						e.preventDefault();
						
						if ($(this).hasClass('focused')) {
							createCategoryMenu(result);
							$('.ch-category-cat, .ch-category-search').removeClass('ch-hide');
							
							$('.ch-category-cat, .ch-category-search').addClass('animated fadeInLeft').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
								$('.ch-category-cat, .ch-category-search').removeClass('animated fadeInLeft');
								$('.ch-category-cat, .ch-category-search').removeClass('ch-hide');
	
							});
							$('.ch-category-cat, .ch-category-search').removeClass('ch-hide');
							$(this).toggleClass('focused');
						}
						else {
							// createCategoryMenu(result);
							// console.log('hide');
							$('.ch-category-selectors').addClass('animated fadeOutLeft').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
								$('.ch-category-selectors').removeClass('animated fadeOutLeft');

								$('.ch-category-search').addClass('animated fadeInRight').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
									$('.ch-category-search').removeClass('animated fadeInRight');
								});
								$('.ch-category-selectors').addClass('ch-hide');
	
							});

							
							$(this).toggleClass('focused');
							$('#categoryidField,#subCategoryidField, #subSubCategoryidField').val('');
							
						}
							
					});
					$(document).on('click','li.ch-category-cat>ul.dropdown-menu>li>a', function(e){
						
						e.preventDefault();
						$('.ch-category-cat').removeClass('ch-hide');
						$('.ch-category-subsubcat').addClass('ch-hide');
						// console.log('li.ch-category-cat>ul.dropdown-menu>li>a');
						// console.log($(this).text());
						// console.log($(this).data());
						var catName = $(this).text();
						var catData = $(this).data();
						$('li.ch-category-cat> a.dropdown-toggle').text(catName);
						createSubCategoryMenu(catData.catid, result);
						$('li.ch-category-cat>ul.dropdown-menu>li').removeClass('selected');
						$(this).parent().addClass("selected");
						$('#categoryidField').val(catData.catid);
						$('#subCategoryidField, #subSubCategoryidField').val('');
						// console.log($('#categoryidField').val());
	
					});
					$(document).on('click','li.ch-category-subcat>ul.dropdown-menu>li>a', function(e){
						
						e.preventDefault();
						$('.ch-category-cat, .ch-category-subcat').removeClass('ch-hide');
						$('.ch-category-subsubcat').addClass('ch-hide');
						// console.log('li.ch-category-subcat>ul.dropdown-menu>li>a');
						// console.log($(this).text());
						// console.log($(this).data());
						var catName = $(this).text();
						var catData = $(this).data();
						$('li.ch-category-subcat> a.dropdown-toggle').text(catName);
						createSubSubCategoryMenu(catData.catid, catData.parentcat, result);
						$('li.ch-category-subcat>ul.dropdown-menu>li').removeClass('selected');
						$(this).parent().addClass("selected");
						$('#subCategoryidField').val(catData.catid);
						$('#subSubCategoryidField').val('');
					});
					$(document).on('click','li.ch-category-subsubcat>ul.dropdown-menu>li>a', function(e){
						e.preventDefault();
						$('.ch-category-cat, .ch-category-subcat, .ch-category-subsubcat').removeClass('ch-hide');
						var catName = $(this).text();
						var catData = $(this).data();
						$('li.ch-category-subsubcat> a.dropdown-toggle').text(catName);
						$('li.ch-category-subsubcat>ul.dropdown-menu>li').removeClass('selected');
						$(this).parent().addClass("selected");
						$('#subSubCategoryidField').val(catData.catid);
					});
				}
			});
		$('.loadProductsByCategory').on('click', function(e) {
			var actor = $(this).data(actor);
			console.log(getProductsByCategories);
			e.preventDefault();
			var shopID 			= $('#shopidField').val();
			var categoryID 			= $('#categoryidField').val();
			var subCategoryID 		= $('#subCategoryidField').val();
			var subSubCategoryID 	= $('#subSubCategoryidField').val();
			$('.productloading').removeClass('hidden');
			$.ajax({
				url: getProductsByCategories,
				data: { 'shop_id': shopID, 'category_id': categoryID, 'subcategory_id': subCategoryID, 'subsubcategory_id': subSubCategoryID },
				dataType: "jsonp",
				success: function(result) {
					var appendedProduct='';
					if('myshop'=== actor && result.data != undefined)
						jQuery.each(result.data, function(key, data) {
							
						  	appendedProduct += '<li class="product product-'+data.product_id+'">'
					            +'<a class="flexslider product-list-thumb-flexslider" href="javascript:">'
					                +'<ul class="slides">';
					                for (var i = 0; i < data.images.length; i++) {
					            
					                    appendedProduct += '<li><img src="'+data.url+'/'+data.images[i]+'" alt="Preview image"></li>'
					                };   
					                
					                appendedProduct += '</ul></a>'
					                +'<div class="row cd-item-info">'
					                    +'<b class="col-xs-8"><a href="'+data.singleurl+'">'+ data.product_name +'</a></b>'

					                    +'<em class="col-xs-4 cd-price"><span class="pricewithcomma">'+ data.price+'</span> BDT</em>'
					                +'</div>'
					                
					                +'<div class="btn-group options" role="group">'
					                    +'<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">'
					                        +'<span class="caret"></span>'
					                    +'</button>'
					                    +'<ul class="dropdown-menu" role="menu">'
					                        +'<li class="disabled"><a href="#">Edit Product</a></li>'
					                        +'<li><a class="product-status product-status-change-'+data.id+'" href="javascript;" data-id="'+data.id+'">Unpublish</a>'
					                        +'<li class="disabled"><a href="#" class="disabled">Delete Product</a></li>'
					                        +'<li><a class="move-cat-menu-nav" data-productid="'+data.id+'" href="#">Move Category</a></li>'
					                    +'</ul>'
					                +'</div>'
					            +'</li>';
						});
					else if(result.data != undefined) {
						jQuery.each(result.data, function(key, data) {
							
						  	appendedProduct += '<li class="product product-'+data.product_id+'">'
					            +'<a class="flexslider product-list-thumb-flexslider" href="javascript:">'
					                +'<ul class="slides">';
					                for (var i = 0; i < data.images.length; i++) {
					            
					                    appendedProduct += '<li><img src="'+data.url+'/'+data.images[i]+'" alt="Preview image"></li>'
					                };   
					                
					                appendedProduct += '</ul></a>'
					                +'<div class="row cd-item-info">'
					                    +'<b class="col-xs-8"><a href="'+data.singleurlpublic+'">'+ data.product_name +'</a></b>'

					                    +'<em class="col-xs-4 cd-price"><span class="pricewithcomma">'+ data.price+'</span> BDT</em>'
					                +'</div>'
					                +'<div class="buy-now-row">'
					                        +'<a href="'+data.singleurlpublic+'" class="btn btn-info btn-lg btn-buy">Buy Now</a>'
					                    
					                 +'</div>'

					            +'</li>';
			
						});
					}
					$('.pagination').hide();
				        $('.cd-gallery').html(appendedProduct);
				        renderPriceWithCommas();
				        setTimeout(function () { $('.product-list-thumb-flexslider').flexslider({
				            animation: "slide",
				            slideshow: false
				        }); }, 500);
					// console.log(result);
					$('.productloading').addClass('hidden');
				}
			});
		});
	}
	else {
		$('.smartbread').hide();
	}


		//open navigation clicking the menu icon
	$('.cd-nav-trigger').on('click', function(event){
		event.preventDefault();
		toggleNav(true);
	});
	//close the navigation
	$('.cd-close-nav, .cd-overlay').on('click', function(event){
		event.preventDefault();
		toggleNav(false);
	});
	//select a new section
	$('.cd-nav li').on('click', function(event){
		event.preventDefault();
		var target = $(this),
			//detect which section user has chosen
			sectionTarget = target.data('menu');
		if( !target.hasClass('cd-selected') ) {
			//if user has selected a section different from the one alredy visible
			//update the navigation -> assign the .cd-selected class to the selected item
			target.addClass('cd-selected').siblings('.cd-selected').removeClass('cd-selected');
			//load the new section
			loadNewContent(sectionTarget);
		} else {
			// otherwise close navigation
			toggleNav(false);
		}
	});

	function toggleNav(bool) {
		$('.cd-nav-container, .cd-overlay').toggleClass('is-visible', bool);
		$('main').toggleClass('scale-down', bool);
	}

	function loadNewContent(newSection) {
		//create a new section element and insert it into the DOM
		var section = $('<section class="cd-section '+newSection+'"></section>').appendTo($('main'));
		//load the new content from the proper html file
		section.load(newSection+'.html .cd-section > *', function(event){
			//add the .cd-selected to the new section element -> it will cover the old one
			section.addClass('cd-selected').on('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
				//close navigation
				toggleNav(false);
			});
			section.prev('.cd-selected').removeClass('cd-selected');
		});

		$('main').on('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
			//once the navigation is closed, remove the old section from the DOM
			section.prev('.cd-section').remove();
		});

		if( $('.no-csstransitions').length > 0 ) {
			//if browser doesn't support transitions - don't wait but close navigation and remove old item
			toggleNav(false);
			section.prev('.cd-section').remove();
		}
	}


});


$(document).ready( function() { 
	$('.loader-wrap').fadeOut();

    $('.upload').on('change', function () {
    	console.log(this.value);
	    $(".uploadFile").val(this.value);
	    console.log($(".uploadFile").val());
	    console.log(this.value);
	});

	var url      = window.location.href;
	// console.log(url);
	// $('.fauxMenu a').removeClass('current');
	var result = url.match(/get-started/g);
	if(result) {
		$('#secondnav ul li').removeClass('active');
		$('#secondnav #get-started-link').addClass('active');
		
	};
	var result = url.match(/shops/g);
	if(result) {
		$('#secondnav ul li').removeClass('active');
		$('#secondnav #shops-link').addClass('active');
	};
	var result = url.match(/price/g);
	if(result) {
		$('#secondnav ul li').removeClass('active');
		$('#secondnav #pricing-link').addClass('active');
	};
	var result = url.match(/fshop/g);
	if(result) {
		$('#secondnav ul li').removeClass('active');
		$('#secondnav #fshop-link').addClass('active');
	};
	var result = url.match(/photography/g);
	if(result) {
		$('#secondnav ul li').removeClass('active');
		$('#secondnav #photography-link').addClass('active');
	};
	var result = url.match(/faq/g);
	if(result) {
		$('#secondnav ul li').removeClass('active');
		$('#secondnav #faq-link').addClass('active');
	};

	if ( url.match(/about_shop/g) || url.match(/about-shop/g) ) {
		$('.shop-nav > li').removeClass('current');
		$('.shop-nav > #about-tab').addClass('current');
	};
	if ( url.match(/privacy_policy/g) || url.match(/privacy-policy/g) ) {
		$('.shop-nav > li').removeClass('current');
		$('.shop-nav > #privacy-tab').addClass('current');
	};
	if ( url.match(/terms_and_conditions/g) || url.match(/terms-and-conditions/g) ) {
		$('.shop-nav > li').removeClass('current');
		$('.shop-nav > #term-tab').addClass('current');
	};
	if ( url.match(/settings/g) ) {
		$('.shop-nav > li').removeClass('current');
		$('.shop-nav > #settings-tab').addClass('current');
	};
	if ( url.match(/preorder/g) ) {
		$('.shop-nav > li').removeClass('current');
		$('.shop-nav > #preorder-tab').addClass('current');
	};
	if( url.match(/orders/g) || url.match(/preorders/g) ) {

		$('.shop-nav li').removeClass('current');
		$('.shop-nav #order-dropdown').addClass('current');
	};
	

	



 });


function createCategoryMenu(result) {
	$('.ch-category-cat>ul.dropdown-menu').html('');
	$.each(result, function(i, v) {
		console.log(Object.keys(v.children).length)
		$('.ch-category-cat>ul.dropdown-menu').append('<li role="presentation"><a role="menuitem" tabindex="-1" data-level="'+v.level+'" data-catid="'+v.catid+'" href="#" class="">'+v.catname+'</a></li>');
	});
}

function createSubCategoryMenu(catID, result) {
	$('li.ch-category-subcat> a.dropdown-toggle').text('Select Sub-category...');
	$('.ch-category-subcat>ul.dropdown-menu').html('');
	console.log('createSubCategoryMenu');
	$.each(result, function(i, v) {
		// console.log(catID+' | '+v.catid);
		if (catID == v.catid) {
			console.log(catID+' | '+v.catid+" - "+Object.keys(v.children).length);
			if (Object.keys(v.children).length > 0) {
				console.log('add ch-category-subsubcat');
				$.each(v.children, function(i, v) {
					$('.ch-category-subcat>ul.dropdown-menu').append('<li role="presentation"><a role="menuitem" tabindex="-1" data-level="'+v.level+'" data-parentcat="'+catID+'" data-catid="'+v.catid+'" href="#" class="">'+v.catname+'</a></li>');
				});
						$('.ch-category-subcat').removeClass('ch-hide');
						$('.ch-category-subcat').addClass('animated fadeInLeft').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
							$('.ch-category-subcat').removeClass('animated fadeInLeft');
							$('.ch-category-cat, .ch-category-subcat').removeClass('ch-hide');

						});
						$('.ch-category-cat, .ch-category-subcat').removeClass('ch-hide');
			}
			else{
				console.log('remove ch-category-subsubcat');

				$('.ch-category-subcat, .ch-category-subsubcat').addClass('animated fadeOutLeft').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
					console.log('remove classes');
					$('.ch-category-subcat').removeClass('animated fadeOutLeft');
					$('.ch-category-subsubcat').removeClass('animated fadeOutLeft');
					
					$('.ch-category-subcat, .ch-category-subsubcat').addClass('ch-hide');
				});
				if ($('.ch-category-subsubcat').hasClass('animated')) {
							$('.ch-category-subsubcat').removeClass('animated fadeInLeft fadeOutLeft');
							console.log('.ch-category-subsubcat has ani')
							
						};

			};
			return false;
			
		};
		// $('.ch-category-subcat>ul.dropdown-menu').append('<li role="presentation"><a role="menuitem" tabindex="-1" data-level="'+v.level+'" data-catid="'+v.catid+'" href="#" class="">'+v.catname+'</a></li>');
	});

}

function createSubSubCategoryMenu(subCatID, parentCat, result) {
	$('li.ch-category-subsubcat> a.dropdown-toggle').text('Select Sub-category...');
	$('.ch-category-subsubcat>ul.dropdown-menu').html('');
	$.each(result, function(i, v) {
		// console.log(catID+' | '+v.catid);
		if (parentCat == v.catid) {
			console.log(parentCat+' | '+v.catid);
			
			$.each(v.children, function(i, v) {
				if (subCatID == v.catid) {
					if (Object.keys(v.children).length > 0) {
						$.each(v.children, function(i, v) {
							$('.ch-category-subsubcat>ul.dropdown-menu').append('<li role="presentation"><a role="menuitem" tabindex="-1" data-level="'+v.level+'" data-parentcat="'+subCatID+'" data-catid="'+v.catid+'" href="#" class="">'+v.catname+'</a></li>');
						});
						$('.ch-category-subsubcat').removeClass('ch-hide');
						$('.ch-category-subsubcat').addClass('animated fadeInLeft').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
							$('.ch-category-subsubcat').removeClass('animated fadeInLeft fadeOutLeft');
							$('.ch-category-cat, .ch-category-subcat, .ch-category-subsubcat').removeClass('ch-hide');

						});
						$('.ch-category-cat, .ch-category-subcat, .ch-category-subsubcat').removeClass('ch-hide');
					}
					else{
						console.log('3rd level none');

						$('.ch-category-subsubcat').toggleClass('animated fadeOutLeft').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
							$('.ch-category-subsubcat').removeClass('animated fadeInLeft fadeOutLeft');
							$('.ch-category-subsubcat').addClass('ch-hide');
							if ($('.ch-category-subsubcat').hasClass('animated')) {
								// $('.ch-category-subsubcat').removeClass('animated fadeInLeft fadeOutLeft');
								console.log('.ch-category-subsubcat has ani')
							
							};
						});
						

						

					}
					return false;
				}
			});
						

			
			
		};
		// $('.ch-category-subsubcat>ul.dropdown-menu').append('<li role="presentation"><a role="menuitem" tabindex="-1" data-level="'+v.level+'" data-parentcat="'+catID+'" data-catid="'+v.catid+'" href="#" class="">'+v.catname+'</a></li>');
	});

}

function hideToLeft(classes) {

}
function showFromLeft(classes) {
	
}



$(document).ready(function() {

	$('.guidetoaction').find('.guide-circle-done').parent().removeAttr('href');
	$('.guidetoverify').on('click', function(e){
        $('.nav-tabs a[href=#verify]').tab('show') ; 
        // Change hash for page-reload

	});
	$('.guidetoaddshipping').on('click', function(e){
        $('.nav-tabs a[href=#shipping]').tab('show') ; 
        // Change hash for page-reload

	});
	$('.guidetologo').on('click', function(e){
		e.preventDefault();
		$("html, body").animate({
            scrollTop: 0
        }, 600);
        $('.add-new-logo').addClass('hover');
        setTimeout(function() {
        	$(".add-new-logo").addClass('animated shake').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
									$('.add-new-logo').removeClass('animated shake').removeClass('hover');
								});
        }, 600);
	});
	$('.guidetobanner').on('click', function(e){
		e.preventDefault();
		$("html, body").animate({
            scrollTop: 0
        }, 600);
        $('.add-new-banner').addClass('hover');
        setTimeout(function() {
        	$(".add-new-banner").addClass('animated shake').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
									$('.add-new-banner').removeClass('animated shake').removeClass('hover');
								});
        }, 600);
	});
	$('.guidetoaddproduct').on('click', function(e){
		e.preventDefault();
		if($(this).find('.guide-circle-done').length == 0) {
			$("html, body").animate({
	            scrollTop: 0
	        }, 600);
	        setTimeout(function() {
	        	$("#add-new-product").addClass('animated shake').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
										$('#add-new-product').removeClass('animated shake');
									});
	        }, 600);
		};
			
	});
	$('.guidetopublish').on('click', function(e){
		e.preventDefault();
		if($(this).find('.guide-circle-done').length == 0) {
			$("html, body").animate({
	            scrollTop: 0
	        }, 600);
	        setTimeout(function() {
	        	$(".shop-status").addClass('animated shake').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
										$('.shop-status').removeClass('animated shake');
									});
	        }, 600);
	    }
	});

});

$(function () {
  $('[data-toggle="tooltip"]').tooltip();
  $('[data-toggle="popover"]').popover();

	$('body').on('click', function (e) {
	    $('[data-toggle="popover"]').each(function () {
	        //the 'is' for buttons that trigger popups
	        //the 'has' for icons within a button that triggers a popup
	        if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
	            $(this).popover('hide');
	        }
	    });
	});
	
  $('.shopsearch-trigger').click(function (e) {
  	e.preventDefault();
  	$(this).hide();
  	$('.shopsearch').addClass('shopsearch-fullsize').focus();
  })

	$(".loginpage-loginbutton").removeAttr('disabled');

	$(document).on('click', '.add-discount-menu', function(){
		$('#discountModal input[name=product_id]').val($(this).data('productid'));
		$('#discountModal .productnamespan').text($(this).data('productname'));
        var selected = $(this).data('campaign-id');
        $('input:radio[name=discount]').filter('[value="'+selected+'"]').attr('checked', true);
	})



	$('#add-campaign-all-products').on('click',function() {
		if (window.confirm("This will add 10% discount to all of your products only for GP users. Do you want to continue?")) { 
		    return true;
		}
		else return false;
	}) 

	$('.slide-in-modal-close, .slide-in-modal-show').click(function(e){
		e.preventDefault();
		$('.slide_in_modal').toggleClass('open');
		$('.whats-new').hide();
		$("html, body").animate({
            scrollTop: 0
        }, 600);
        // console.log( $('.slide_in_modal').height() );
        // return false;
	})

});

$(function(){
	var darkCover = '<div class="winteriscoming"></div>';
	$('body').append(darkCover);
	// console.log(darkCover);
	$('body').on('click','.winteriscoming', function () {
		$('.checkout').removeClass('checkout--active');
                $('.winteriscoming').fadeOut();
	})
})
