(function(){

    $('.order-precess-done').click(function(e) {
        alert('Are you sure to process the order now?');
        var r = confirm("Order Processed.");
        if (r == true) {
            x = "You pressed OK!";
        } else {
            x = "You pressed Cancel!";
        }
    });
    $('.order-precess-cancel').click(function(e) {
        alert('Are you sure to cancel the order?');
        var r = confirm("Order Cancelled.");
        if (r == true) {
            x = "You pressed OK!";
        } else {
            x = "You pressed Cancel!";
        }
        e.preventDefault();
    });

    $('.product-detail').click(function(e){
        e.preventDefault();
        $('.container-product-info').show();

    });
    $('.product-detail-ok').click(function(e){
        e.preventDefault();
        $('.container-product-info').hide();

    });

})();