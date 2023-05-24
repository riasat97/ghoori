$(document).ready(function () {
	var imgTop = $('.poabaroback2').css('top');
    var imgLeft = $('.poabaroback2').css('left');
    var wrapperoffset = $('.poabaro-wrap').offset();
	$('.poabaro-wrap').mousemove(function(e){
        /* Work out mouse position */
        
        var xPos = e.pageX - wrapperoffset.left;
        var yPos = e.pageY - wrapperoffset.top;

        /* Get per­cent­age positions */
        var mouseXPercent = Math.round(xPos / $(this).width() * 100);
        var mouseYPercent = Math.round(yPos / $(this).height() * 100);

        // console.log('('+mouseXPercent+','+mouseYPercent+')');
        // console.log('('+mouseXPercent+','+mouseYPercent+')');

        
        var new1Top	= parseFloat(imgTop) - ( (mouseYPercent - 50) / 4 );
        var new1Left	= parseFloat(imgLeft) - ( (mouseXPercent - 50) / 4 );
        var new2Top	= parseFloat(imgTop) - ( (mouseYPercent - 50) / 2 );
        var new2Left	= parseFloat(imgLeft) - ( (mouseXPercent - 50) / 2 );
        // console.log('('+newTop+','+newLeft+')');
        $('.poabaroback1').animate({left: new1Left, top: new1Top},{duration: 10, queue: false, easing: 'linear'});
        $('.poabaroback2').animate({left: new2Left, top: new2Top},{duration: 10, queue: false, easing: 'linear'});
    });
 	
 	$(window).on('resize', function(){
	     $('.poabaroback2').css({top: imgTop, left: "50%" });
	     imgTop = $('.poabaroback2').css('top');
    	imgLeft = $('.poabaroback2').css('left');
	});

})