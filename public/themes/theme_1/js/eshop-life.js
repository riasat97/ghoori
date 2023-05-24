$(".dropdown-menu li a").on('click', function () {
        console.log("Selected Option:"+$(this).text());
        $('ul>li:eq(3)').attr('selected', true);
});



/*---------------------
 6. category-saide-bar-togle
--------------------- */
  // $(".morecate").on('click', function(){
  //     $(".lesscate").css("display","block");
  //     $(this).hide();
  //     $('.extra-cat').slideDown();
  // });
  // $(".lesscate").on('click', function(){
  //     $(".morecate").css("display","block");
  //     $(this).slideUp();
  //     $('.extra-cat').slideUp();
  // });

  // $(".catemenu-toggler").on('click', function(){
  //     $(".category-saidebar").toggle();
  // });

$(".morecate").on('click', function(){
      $(".lesscate").css("display","block");
      $(this).hide();
      // $('.extra-cat').slideDown(300);
  });
  $(".lesscate").on('click', function(){
      $(".morecate").css("display","block");
      $(this).hide();
      // $('.extra-cat').slideUp(300);
  });




/*---------------------
 16. owl-carousel
--------------------- */
  $(".post-slider").owlCarousel({
  
    autoPlay: false, //Set AutoPlay to 3 seconds
    navigation : true,
    navigationText : ["<i class='fa fa-caret-left'></i>","<i class='fa fa-caret-right'></i>"],
    pagination :true,
    items : 1,
    itemsDesktop : [1199,1],
    itemsDesktopSmall : [979,1],
    itemsMobile : [767,1],
 
  });





/*---------------------
 3. scrollUp
--------------------- */  
  $("a[href='#scrollUp']").click(function() {
    $("html, body").animate({ scrollTop: 0 }, "slow");
    return false;
  });
