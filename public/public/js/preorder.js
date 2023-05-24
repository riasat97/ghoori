
$(document).ready(function(){
function createCategoryMenu(result) {
	$('.ch-category-cat_1>ul.dropdown-menu').html('');
	$.each(result, function(i, v) {
		console.log(Object.keys(v.children).length)
		$('.ch-category-cat_1>ul.dropdown-menu').append('<li role="presentation"><a role="menuitem" tabindex="-1" data-level="'+v.level+'" data-catid="'+v.catid+'" href="#" class="">'+v.catname+'</a></li>');
	});
}

function createSubCategoryMenu(catID, result) {
	$('li.ch-category-subcat_1> a.dropdown-toggle').text('Select Sub-category...');
	$('.ch-category-subcat_1>ul.dropdown-menu').html('');
	console.log('createSubCategoryMenu');
	$.each(result, function(i, v) {
		// console.log(catID+' | '+v.catid);
		if (catID == v.catid) {
			console.log(catID+' | '+v.catid+" - "+Object.keys(v.children).length);
			if (Object.keys(v.children).length > 0) {
				console.log('add ch-category-subsubcat_1');
				$.each(v.children, function(i, v) {
					$('.ch-category-subcat_1>ul.dropdown-menu').append('<li role="presentation"><a role="menuitem" tabindex="-1" data-level="'+v.level+'" data-parentcat="'+catID+'" data-catid="'+v.catid+'" href="#" class="">'+v.catname+'</a></li>');
				});
						$('.ch-category-subcat_1').removeClass('ch-hide');
						$('.ch-category-subcat_1').addClass('animated fadeInLeft').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
							$('.ch-category-subcat_1').removeClass('animated fadeInLeft');
							$('.ch-category-cat_1, .ch-category-subcat_1').removeClass('ch-hide');

						});
						$('.ch-category-cat_1, .ch-category-subcat_1').removeClass('ch-hide');
			}
			else{
				console.log('remove ch-category-subsubcat_1');

				$('.ch-category-subcat_1, .ch-category-subsubcat_1').addClass('animated fadeOutLeft').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
					console.log('remove classes');
					$('.ch-category-subcat_1').removeClass('animated fadeOutLeft');
					$('.ch-category-subsubcat_1').removeClass('animated fadeOutLeft');
					
					$('.ch-category-subcat_1, .ch-category-subsubcat_1').addClass('ch-hide');
				});
				if ($('.ch-category-subsubcat_1').hasClass('animated')) {
							$('.ch-category-subsubcat_1').removeClass('animated fadeInLeft fadeOutLeft');
							console.log('.ch-category-subsubcat_1 has ani')
							
						};

			};
			return false;
			
		};
		// $('.ch-category-subcat>ul.dropdown-menu').append('<li role="presentation"><a role="menuitem" tabindex="-1" data-level="'+v.level+'" data-catid="'+v.catid+'" href="#" class="">'+v.catname+'</a></li>');
	});

}

function createSubSubCategoryMenu(subCatID, parentCat, result) {
	$('li.ch-category-subsubcat_1> a.dropdown-toggle').text('Select Sub-category...');
	$('.ch-category-subsubcat_1>ul.dropdown-menu').html('');
	$.each(result, function(i, v) {
		// console.log(catID+' | '+v.catid);
		if (parentCat == v.catid) {
			console.log(parentCat+' | '+v.catid);
			
			$.each(v.children, function(i, v) {
				if (subCatID == v.catid) {
					if (Object.keys(v.children).length > 0) {
						$.each(v.children, function(i, v) {
							$('.ch-category-subsubcat_1>ul.dropdown-menu').append('<li role="presentation"><a role="menuitem" tabindex="-1" data-level="'+v.level+'" data-parentcat="'+subCatID+'" data-catid="'+v.catid+'" href="#" class="">'+v.catname+'</a></li>');
						});
						$('.ch-category-subsubcat_1').removeClass('ch-hide');
						$('.ch-category-subsubcat_1').addClass('animated fadeInLeft').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
							$('.ch-category-subsubcat_1').removeClass('animated fadeInLeft fadeOutLeft');
							$('.ch-category-cat_1, .ch-category-subcat_1, .ch-category-subsubcat_1').removeClass('ch-hide');

						});
						$('.ch-category-cat_1, .ch-category-subcat_1, .ch-category-subsubcat_1').removeClass('ch-hide');
					}
					else{
						console.log('3rd level none');

						$('.ch-category-subsubcat_1').toggleClass('animated fadeOutLeft').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
							$('.ch-category-subsubcat_1').removeClass('animated fadeInLeft fadeOutLeft');
							$('.ch-category-subsubcat_1').addClass('ch-hide');
							if ($('.ch-category-subsubcat_1').hasClass('animated')) {
								// $('.ch-category-subsubcat').removeClass('animated fadeInLeft fadeOutLeft');
								console.log('.ch-category-subsubcat_1 has ani')
							
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
});