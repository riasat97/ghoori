jQuery(document).ready(function($) {
    //alert(cattreejson);
	// console.log(moveCatUrl);
	$('#category-tree').hide();
	var mainresult = '';
	var is_bouncy_nav_animating = false;
	// var result;
	$.ajax({
		url: cattreejson, 
		dataType: "json", 
		success: function(result) {
	        // $("#div1").html(result);
	        // console.log(result[0]);
	        // console.log(is_bouncy_nav_animating)
	        // return false;
	        mainresult = result;
	        renderHtml(result);

			//open bouncy navigation
			$('.cd-bouncy-nav-trigger').on('click', function() {
				$('.cd-bouncy-nav').data('from','main');
				$('.cd-bouncy-nav').data('prod_id', '');
				// console.log(is_bouncy_nav_animating);
				triggerBouncyNav(true);
			});

			$(document).on('click', 'a.move-cat-menu-nav', function(e) {
				e.preventDefault();
				var prod_id = $(this).data('productid');
				$('.cd-bouncy-nav').data('from','move');
				$('.cd-bouncy-nav').data('prod_id', prod_id);
				// var fromForm = "move";
				// alert($('.cd-bouncy-nav').data('from'));
				triggerBouncyNav(true);
			});
			$('.cd-bouncy-nav-modal').on('click', function(event) {
				if($(event.target).is('.cd-bouncy-nav-modal')) {
					
					
					triggerBouncyNav(false);
					is_bouncy_nav_animating = false;
					renderHtml(result);
				}
			});
			$('.cd-bouncy-nav-modal .cd-close').on('click', function() {
				
				
				triggerBouncyNav(false);
				is_bouncy_nav_animating = false;
				renderHtml(result);
			});
    	}
	});

	
	//close bouncy navigation
	$('.cd-bouncy-nav-modal .cd-close').on('click', function() {
		triggerBouncyNav(false);
	});

	$('.cd-bouncy-nav-modal').on('click', function(event) {
		if($(event.target).is('.cd-bouncy-nav-modal')) {
			triggerBouncyNav(false);
		}
	});

	function triggerBouncyNav($bool) {
		// console.log('main ' + $bool)
		//check if no nav animation is ongoing
		if( !is_bouncy_nav_animating) {
			// console.log('is_bouncy_nav_animating ' + is_bouncy_nav_animating)
			is_bouncy_nav_animating = true;
			//toggle list items animation
			$('#cat_selector').toggleClass('fade-in', $bool).toggleClass('fade-out', !$bool).find('li:last-child')
							.one('webkitAnimationEnd oanimationend msAnimationEnd animationend', function() {

				$('#cat_selector').toggleClass('is-visible', $bool);
				if(!$bool) $('#cat_selector').removeClass('fade-out');
				is_bouncy_nav_animating = false;
			});
			
			//check if CSS animations are supported... 
			if($('.cd-bouncy-nav-trigger').parents('.no-csstransitions').length > 0 ) {
				$('#cat_selector').toggleClass('is-visible', $bool);
				is_bouncy_nav_animating = false;
			}
		}
	}

	function renderHtml(result) {
		$('.cd-bouncy-nav-modal .cd-bouncy-nav').html('');
        $.each(result, function(i, v) {
		    $('.cd-bouncy-nav-modal .cd-bouncy-nav').append('<li><a data-level="'+v.level+'" data-catid="'+v.catid+'" href="#" class="cat-'+v.catid+'-'+v.level+'">'+v.catname+'</a></li>');
		});

		$(document).on('click', '.cd-bouncy-nav li a', function(e) {
			e.preventDefault();
			// console.log($(this).data('level'));
			// console.log($(this).data('catid'));
			// console.log(result);
			var catid = $(this).data('catid');
			
			$.each(result, function(i, v) {
	        	// console.log(v);
	        	if (v.catid == catid) {
	        		if (v.children.length > 0) {
	        			renderHtml(v.children);
	        		} 
	        		else {
	        			// console.log('no');
	        			$(document).off('click', '.cd-bouncy-nav li a');
						renderHtml(mainresult);
						$('#category-tree').show();
						triggerBouncyNav(false);
						is_bouncy_nav_animating = false;

						if ($('.cd-bouncy-nav').data('from') !== 'move') {
							$('.cd-bouncy-nav-trigger').text('Change categories');
						}
						else {
							// console.log('calling to move');

							moveCategoryRequest();


						}
	        		}
	        		// console.log(v.children.length);
	        		return false;
	        	}
	        	else {
	        		//else goes here..
	        	}
			});

			if ($(this).data('level') == '1') { // first level selection
				$('#category-id-field').val(catid);
				$('#catspan').text($(this).text());
				$('#subcategory-id-field').val('');
				$('#subcatspan').text('');
				$('#subsubcategory-id-field').val('');
				$('#subsubcatspan').text('');
			}
			else if ($(this).data('level') == '2') { // second level selection
				$('#subcategory-id-field').val(catid);
				$('#subcatspan').text($(this).text());
				$('#subsubcategory-id-field').val('');
				$('#subsubcatspan').text('');
			}
			else if ($(this).data('level') == '3') { // second level selection
				$('#subsubcategory-id-field').val(catid);
				$('#subsubcatspan').text($(this).text());
			}

		});
		return false;
	}

	function moveCategoryRequest() {
		var _token = $('input[name=_token]').first().val();
		$.ajax({
			method: 'POST',
			url: moveCatUrl,
			data: {
				id: $('.cd-bouncy-nav').data('prod_id'),
				category_id: $('#category-id-field').val(),
				subcategory_id: $('#subcategory-id-field').val(),
				subSubCategory_id: $('#subsubcategory-id-field').val(),
				newCatString: $('#category-tree').html(),
				_token: _token
			},
			success: function (response) {
				$('.dropdown-toggle').attr("aria-expanded",false);
				$('.dropdown-toggle').parent().removeClass('open');
				if (response.success) {
					// console.log(response.data);
					// create the notification
					setTimeout( function() {
						var notification = new NotificationFx({
							wrapper : document.body,
							message : '<p>Product successfully moved to category '+$('#category-tree').html()+'.</p>',
							layout : 'growl',
							effect : 'slide',
							type : 'success', // notice, warning, error or success
							ttl : 2000,
							onClose : function() { return false; },
							onOpen : function() { return false; }
						});
						notification.show();
					}, 1200 );
					
				} 
				else{
					// console.log(response);
				};
			}
		});
	}
});

// a ^= b ^= a ^=b