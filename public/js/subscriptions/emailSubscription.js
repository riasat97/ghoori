(function(){

    $('.email-subscription').click(function(e){

    });

    $('.email-subscription-button').click(function(e){
        e.preventDefault();
        var data = $(".email-subscription-form").serialize();
        //alert(data);

        $.ajax({
            url: "get-started/subscribe",
            data: data,
            type: "POST",

            success: function(response) {
                //alert(response.subscriber.email);
                if (response !== 'Error') {
                    subscribeByEmail(response);
                    //alert(response);
                }
            },
            error: function(){

            }
        });
    });

    function subscribeByEmail(response){
        $('.email-print').text(response.subscriber.email);

    }

    $('.subscription-confirmation').click(function(e){
        e.preventDefault();
        $('#subscription-pop-up').modal('hide')
        var data = $(".confirmation-form").serialize();

        $.ajax({
            url: "get-started/subscribed",
            data: data,
            type: "POST",

            success: function(response) {
                //alert(response.subscriber.name);
                if (response !== 'Error') {
                    getNameMobile(response);
                    //alert(response);
                }
            },
            error: function(){

            }
        });
    });

    function getNameMobile(response){
        $('.name-print').text(response.subscriber.name);
        $('.mobile-print').text(response.subscriber.mobile);
    }

})();