$(document).ready(function(){

    
    var link=$('.box ul li a');
    link.next('p, div').hide();
    link.click(function(){       
        if($(this).next('p:visible, div:visible').length==0){
        $(this).parent('li').children('a').css('font-weight','bold');
        $(this).parent('li').children('a').children('span').removeClass('glyphicon-triangle-right').addClass('glyphicon-triangle-bottom');
        $(this).next('p, div').slideDown();
        }
        else{
            $(this).parent('li').children('a').css('font-weight','normal');
            $(this).parent('li').children('a').children('span').removeClass('glyphicon-triangle-bottom').addClass('glyphicon-triangle-right');
            $(this).next('p, div').slideUp();
        }
        
    });




    var type = window.location.hash.substr(1);
    $('.details_shop').hide();
    // alert(type);
    if (type === '') {
            
        $('.icon_section').show();
    }
    else {
        // alert(type);
        $('#'+type).fadeIn();
        $(".breadcrumb-child").html('<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>  '+$('#'+type+">h2").text())
    }

    $(window).bind('hashchange', function () { //detect hash change
        var hash = window.location.hash.slice(1); //hash to string (= "myanchor")

        $('.details_shop').hide();

        $('#'+hash).fadeIn();
        $(".breadcrumb-child").html('<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>  '+$('#'+hash+">h2").text())
    });

    // var link=$('.box ul li a');
    // link.next('div').hide();
    // link.click(function(){       
    //     if($(this).next('div:visible').length==0){
    //     $(this).parent('li').children('a').css('font-weight','bold');
    //     $(this).parent('li').children('a').children('span').removeClass('glyphicon-triangle-right').addClass('glyphicon-triangle-bottom');
    //     $(this).next('div').slideDown();
    //     }
    //     else{
    //         $(this).parent('li').children('a').css('font-weight','normal');
    //         $(this).parent('li').children('a').children('span').removeClass('glyphicon-triangle-bottom').addClass('glyphicon-triangle-right');
    //         $(this).next('div').slideUp();
    //     }
        
    // });
});

