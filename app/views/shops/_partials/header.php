<div class="header-container">

		<header>
	        <nav class="navbar navbar-default navbar-static-top ch_navbar">
	            <div class="container-fluid">
	                <div class="row">
	                    <div id="topbar"></div>
	                </div>
	            </div>
	            <div class="container-fluid">
	                <div class="navbar-header">

	                    <a class="navbar-brand" href="{{URL::route('home')}}">
	                    	<img src="" alt="logo" class="ch_navbar_logo">
	                        <!-- {{ HTML::image('img/logo-fans.png', 'Chorki', array('class' => 'ch_navbar_logo')) }} -->
	                    </a>
	                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
	                        <span class="sr-only">Toggle navigation</span>
	                        <span class="icon-bar"></span>
	                        <span class="icon-bar"></span>
	                        <span class="icon-bar"></span>
	                    </button>
	                </div>
	                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	                    <ul class="nav navbar-nav">
	                        <li><a href="{{URL::route('shops.index')}}">Marketplace <span class="sr-only">(current)</span></a></li>
	                        <li><a href="#">Analytics</a></li>
	                    </ul>
	                    <form class="navbar-form navbar-right ch_chorki_searchform" role="search">
	                        <div class="form-group">
	                            <div class="input-group">
	                              <input type="text" class="form-control" placeholder="Search for...">
	                              <span class="input-group-btn">
	                                <button class="btn btn-primary" type="button"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
	                              </span>
	                            </div>
	                        </div>
	                    </form>

	                </div><!-- /.navbar-collapse -->

	            </div>
	        </nav>
	    </header>
	</div>