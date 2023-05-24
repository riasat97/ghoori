@section('shop_title')
    <div id="animatedModalTitle">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                    <div class="close-animatedModalTitle">
                        <a href="" class="btn btn-danger btn-lg"> <i class="fa fa-times fa-x"></i> Close</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-content container-fluid">
            <div class="row">
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-lg-offset-2">

                    {{ Form::open(array('route' => 'updateShopTitle','class'=>'cd-form floating-labels','id'=>'edit-title')) }}

                    <fieldset>
                        <legend>Change Title</legend>

                        <div class="icon field">
                            <label class="cd-label" for="cd-shop">Shop Title</label>
                            {{ Form::text('title','',array('id'=>'cd-textarea','class'=>'message shop-title')) }}
                        </div>

                        <div>
                            {{ Form::submit('Ok',array('id'=>'title-saved','class'=>'close-animatedModalTitle')) }}
                        </div>
                    </fieldset>
                    {{ Form::close() }}

                </div>
            </div>
        </div>
    </div>

    <script>

        $(document).on('click','#add-new-title',function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ URL::route('editShopTitle') }}",
                type: "GET",

                success: function(msg) {
                    if (msg !== 'Error') {
                        console.log(msg);
                        editTitle(msg);
                    }
                },
                error: function(){

                }
            });
        });
        function editTitle(msg){
            var shop = msg.shop;
            $('.shop-title').val(shop.title);

        }


        $(document).on("click","#title-saved",function(e) {
            e.preventDefault();
            var data = $("#edit-title").serialize();
            var submitUrl = $("#edit-title").attr('action');
            console.log(data);
            $.ajax({
                url: submitUrl,
                data: data,
                type: "POST",

                success: function(msg) {
                    if (msg !== 'Error') {
                        updateTitleBox(msg);
                    }
                    setTimeout( function() {
                        var notification = new NotificationFx({

                            // element to which the notification will be appended
                            // defaults to the document.body
                            wrapper : document.body,

                            // the message
                            message : '<p>Shop title changed to "'+msg.title+'".</p>',

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
                },
                error: function(){

                }
            });
        });

        function updateTitleBox(msg){
            $('.shop-name-span').text(msg.title);
        }

    </script>
@show


