<nav class="navbar yamm navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{URL::route('home')}}">Home</a>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="dropdown yamm-fw" role="tabpanel">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Categories <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <row>
                                <div class="col-md-3">
                                    <ul class="nav nav-default nav-stacked" role="tablist">
                                        {{-- @foreach($shop->categories as $category)

                                             <li><a href="javascript:" data-id="{{$category->id}}" data-name="{{$category->name}}" class="clickablelink">{{$category->name}}</a></li>
                                         @endforeach--}}
                                    </ul>
                                </div>
                                <div class="col-md-9">
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="fashion">
                                            <row>
                                                <div class="col-md-4">
                                                    <ul class="nav nav-default nav-stacked" role="tablist">
                                                        <li role="presentation" class="active"><a href="#men" role="tab" data-toggle="tab">Men</a></li>
                                                        <li role="presentation"><a href="#ladies" role="tab" data-toggle="tab">Ladies</a></li>
                                                        <li role="presentation"><a href="#children" role="tab" data-toggle="tab">Children</a></li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="tab-content">
                                                        <div role="tabpanel" class="tab-pane active" id="men">
                                                            men
                                                        </div>
                                                        <div role="tabpanel" class="tab-pane" id="ladies">
                                                            ladies
                                                        </div>
                                                        <div role="tabpanel" class="tab-pane" id="food">
                                                            children
                                                        </div>
                                                    </div>
                                                </div>
                                            </row>
                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="electronics">
                                            electronics
                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="food">
                                            food
                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="others">
                                            others
                                        </div>
                                    </div>
                                </div>
                            </row>
                        </li>
                    </ul>
                </li>
            </ul>
            <form class="navbar-form navbar-right" role="search">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div><!--/.nav-collapse -->
    </div><!--/.container-fluid -->
</nav>