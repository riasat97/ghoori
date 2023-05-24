
// $(function(){
// 	$('#masonry-container').masonry({
// 		itemSelector : '.item-masonry',
// 		columnWidth : 240
// 	});
// });



// var $container = $('#masonry-container');

// $container.imagesLoaded(function(){
// 	$container.masonry({
// 		itemSelector : '.item-masonry',
// 		columnWidth : 240
// 	});
// });





// $(function(){
// 	$('.grid').masonry({
// 		itemSelector : '.grid-item',
// 	});
// });



// var $container = $('.grid');

// $container.imagesLoaded(function(){
// 	$container.masonry({
// 		itemSelector : '.grid-item',
// 	});
// });



/*---------------------
PRICE FILTER
--------------------- */
$(function() {
    $( "#slider-range" ).slider({
      range: true,
      min: 0,
      max: 5000,
      values: [ 0, 5000 ],
      slide: function( event, ui ) {
        $( "#amount" ).val( "BDT " + ui.values[ 0 ] + " - " + ui.values[ 1 ] );
      }
    });
    $( "#amount" ).val( "BDT" + $( "#slider-range" ).slider( "values", 0 ) + " - " +
      $( "#slider-range" ).slider( "values", 1 ) );
  });