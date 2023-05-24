<!-- @todo Not in use 12/2015 -->
<div class="title-container">
    <div class="row">
       {{-- <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
            <h1 class="shop-title">Shop Title: {{$shop->title}}</h1>
        </div>--}}
        <div class="row">
            <header class="col-sm-12 prime">
                <!-- <p><a href="index.html">Home</a> &#9656; <a href="product.html">User Name</a> &#9656; Shop Name</p> -->
                <h3 class="shop-title">{{$shop->title}} </h3>
                <a class="title-button edit-title" href=""><i class="icon-pencil"></i> Edit</a> <a class="title-button shop-status"  data-id="{{$shop->id}}"href="">{{$statusRev[$shop->status]}}</a>
            </header>
        </div>
    </div>

</div>
<br><br>

<div id="title-edit" class="col-md-offset-8 edit-title-form" style="display:none;">
    {{ Form::open(array('route' => 'updateShopTitle','id'=>'edittitle')) }}
    <div>
        <h4>Change Title</h4>
        <div>
            {{ Form::label('shop-title', 'Title:') }}
            {{ Form::text('title') }}
            {{ $errors->first('title', '<p class="error">:message</p>') }}
        </div>
        <div>

            {{ Form::hidden('shop_id',Session::get('shop_id')) }}
        </div>

        <div>
            {{ Form::submit('Save',array('id'=>'titlesave')) }}
        </div>
    </div>
    {{ Form::close() }}
</div>


<script>
    $('.edit-title').click(function(e) {
        e.preventDefault();
        $('.title-container').hide();
        $("#title-edit").show();

    });

    $("#titlesave").click(function(e) {
        e.preventDefault();
        var data = $("#edittitle").serialize();
        console.log(data);
        $.ajax({
            url: "updateShopTitle",
            data: data,
            type: "POST",

            success: function(msg) {
                if (msg !== 'Error') {
                    updateTitleBox(msg);
                }
            },
            error: function(){

            }
        });
    });

    function updateTitleBox(msg){
        $("#title-edit").hide();
        $('.title-container').show();
        $('.shop-title').text(msg.title);
    }


</script>