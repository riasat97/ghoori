<script>
$(document).on('click','.shop-status',function(e){
	e.preventDefault();
	var shopId = $(this).data('id');
	console.log(shopId);
	var r = confirm("Are you sure you want to "+$('.shop-status').text()+" your shop?");
	if (r == false) {
		return false;
	}
	$.ajax({
		url: "{{ URL::route('shops.status') }}",
		type: "GET",
		success: function(shopStatus) {
			changeShopStatus(shopStatus);
            chorkiVerificationMessage(shopStatus.chorkiVerified);

		},
		error: function(){

		}
	});
});
function  chorkiVerificationMessage(response){
    if(response.chorkiVerified){
        appendChorkVerificationMessage= ' <div class="alert alert-warning alert-dismissible shop-chorkiVerification-alert " role="alert">'
        +' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
        +'  <div class="chorki-verified">'
        +' <p class="shop-chorkiVerification-unpublish-alert"><strong>Your shop is under review.</strong> It be published within 48 hours.</p>'
        +'</div>'
        +' </div>'
        $('.verify-message').html(appendChorkVerificationMessage);
    }
}
function changeShopStatus(shopStatus){
	if (shopStatus.status === 'success'){
		var shopId = shopStatus.shop;
		var data = $('.shop-status').text("Unpublish");
		$('.shop-status').removeClass('btn-success').addClass('btn-danger');
	    var message = "Published!!";
	    $('.shop-unpublish-alert').addClass('hidden');

	    $('.guidetopublish').find('.guide-circle').addClass('guide-circle-done');

	    setTimeout( function() {
			var notification = new NotificationFx({

				// element to which the notification will be appended
				// defaults to the document.body
				wrapper : document.body,

				// the message
				message : '<p>Shop successfully published.</p>',

				// layout type: growl|attached|bar|other
				layout : 'growl',

				// effects for the specified layout:
				// for growl layout: scale|slide|genie|jelly
				// for attached layout: flip|bouncyflip
				// for other layout: boxspinner|cornerexpand|loadingcircle|thumbslider
				// ...
				effect : 'slide',

				// notice, warning, error, success
				// will add class ns-type-warning, ns-type-error or ns-type-success
				type : 'success', // notice, warning, error or success

				// if the user doesn´t close the notification then we remove it 
				// after the following time
				ttl : 5000,

				// callbacks
				onClose : function() { return false; },
				onOpen : function() { return false; }

			});

			// show the notification

			notification.show();

		}, 500 );
	}

	else{
		

		var shopId = shopStatus.shop;
		var data =  $('.shop-status').text("Publish");
		$('.shop-status').removeClass('btn-danger').addClass('btn-success');
	    var message = "UnPublished!!";
	    $('.shop-unpublish-alert').removeClass('hidden');

	    $('.guidetopublish').find('.guide-circle').removeClass('guide-circle-done');

	    setTimeout( function() {
			var notification = new NotificationFx({

				// element to which the notification will be appended
				// defaults to the document.body
				wrapper : document.body,

				// the message
				message : '<p>Shop successfully unpublished.</p>',

				// layout type: growl|attached|bar|other
				layout : 'growl',

				// effects for the specified layout:
				// for growl layout: scale|slide|genie|jelly
				// for attached layout: flip|bouncyflip
				// for other layout: boxspinner|cornerexpand|loadingcircle|thumbslider
				// ...
				effect : 'slide',

				// notice, warning, error, success
				// will add class ns-type-warning, ns-type-error or ns-type-success
				type : 'success', // notice, warning, error or success

				// if the user doesn´t close the notification then we remove it 
				// after the following time
				ttl : 5000,

				// callbacks
				onClose : function() { return false; },
				onOpen : function() { return false; }

			});

			// show the notification

			notification.show();

		}, 500 );
	}


}
</script>