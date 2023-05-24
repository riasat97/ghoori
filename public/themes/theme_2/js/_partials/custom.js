/*---------------------
PRICE FILTER
--------------------- */
// $(function() {
//     $( "#slider-range" ).slider({
//       range: true,
//       min: 0,
//       max: 5000,
//       values: [ 0, 5000 ],
//       slide: function( event, ui ) {
//         $( "#amount" ).val( "BDT " + ui.values[ 0 ] + " - " + ui.values[ 1 ] );
//       }
//     });
//     $( "#amount" ).val( "BDT" + $( "#slider-range" ).slider( "values", 0 ) + " - " +
//       $( "#slider-range" ).slider( "values", 1 ) );
//   });



// Price Filter test

$(function() {
  $("#ex2").slider({
    range: true,
    min: 10,
    max: 50000,
    values: [10, 50000],
    
  });

});


// $(function() {
//     $( "#ex2" ).slider({
//       range: true,
//       min: 0,
//       max: 5000,
//       values: [ 0, 5000 ],
//       slide: function( event, ui ) {
//         $( ".starting" ).val( "BDT " + ui.values[ 0 ] + " - " + ui.values[ 1 ] );
//       }
//     });
//     $( ".ending" ).val( "BDT" + $( "#slider-range" ).slider( "values", 0 ) + " - " +
//       $( ".price-input-field" ).slider( "values", 1 ) );
//   });