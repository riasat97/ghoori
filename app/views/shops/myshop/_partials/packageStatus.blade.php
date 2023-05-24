<script>

    $(document).on('click','.package-status',function(e){
        e.preventDefault();
        var packageId = $(this).data('id');
        var data = $(this).text();

        /* var hiddenProductIdField = '<input type="hidden" name="product_id" value="'+productId+'" />';
         $('.product_id_container_productStatus').append(hiddenProductIdField);
         */
        $.ajax({
            url: "{{ URL::route('packages.status') }}",
            data: { packageId :packageId } ,
            type: "GET",
            success: function(packageStatus) {
                console.log(packageStatus)
                changePackageStatus(packageStatus);
                changeText(packageStatus);
            },
            error: function(){

            }
        });
    });

    function changeText(packageStatus){
        $('.packageStatus-'+packageStatus.package).text(packageStatus.msg);
    }
    function changePackageStatus(packageStatus){
        if (packageStatus.msg === 'Published'){
            var packageId = packageStatus.package;
            var data = $('.package-status-change-'+packageId).text("Unpublish");
            var message = "Published!!";
            $('.package-'+packageStatus.package).removeClass('unpublished').addClass('published');
            setTimeout( function() {
                var notification = new NotificationFx({

                    // element to which the notification will be appended
                    // defaults to the document.body
                    wrapper : document.body,

                    // the message
                    message : '<p>Package successfully published.</p>',

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
                    ttl : 3000,

                    // callbacks
                    onClose : function() { return false; },
                    onOpen : function() { return false; }

                });

                // show the notification

                notification.show();

            }, 500 );

            // if (message){
            //     $('.flash').html(message).fadeIn(300).delay(2500).fadeOut(300);
            // }
        }

        else{
            var packageId = packageStatus.package;
            var data =  $('.package-status-change-'+packageId).text("Publish");
            var message = "UnPublished!!";
            $('.package-'+packageStatus.package).addClass('unpublished').removeClass('published');
            setTimeout( function() {
                var notification = new NotificationFx({

                    // element to which the notification will be appended
                    // defaults to the document.body
                    wrapper : document.body,

                    // the message
                    message : '<p>Package successfully unpublished.</p>',

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
                    ttl : 3000,

                    // callbacks
                    onClose : function() { return false; },
                    onOpen : function() { return false; }

                });

                // show the notification

                notification.show();

            }, 500 );

            // if (message){
            //     $('.flash').html(message).fadeIn(300).delay(2500).fadeOut(300);
            // }

        }


    }
</script>