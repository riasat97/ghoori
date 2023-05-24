<div class="jumbotron" style="background-image: url('http://lorempixel.com/1500/500/food/')">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <div class="thumbnail" id="logo" data-toggle="modal" data-target="#imageUploadForm">
                    @if($shop->logo)
                        {{ HTML::image($shop->logo->logo)}}
                    @else
                        <img src="http://lorempixel.com/200/200/food/" alt=""/>
                    @endif
                </div>
            </div>
            <dl id="address" class="col-md-2 col-md-offset-8">
                <dt>Address:</dt>
                <dd>Gulshan 1</dd>
                <dt>Phone:</dt>
                <dd>2441139</dd>

            </dl>
        </div>
    </div>
</div>
