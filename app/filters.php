
<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	// Our own method to defend XSS attacks globally.
    Common::globalXssClean();

});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::guest('login')->withMessage("Please login to access.");
		}
	}
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
//	if (Session::token() != Input::get('_token'))
//	{
//		throw new Illuminate\Session\TokenMismatchException;
//	}
    if (Request::ajax())
    {
        // if (Session::token() !== Request::header('csrftoken'))
        if (Session::token() !== Input::get('_token'))
        {
            // Change this to return something your JavaScript can read...
            throw new Illuminate\Session\TokenMismatchException;
        }
    }
    elseif (Session::token() !== Input::get('_token'))
    {
        throw new Illuminate\Session\TokenMismatchException;
    }
});

Route::filter('mycsrf', function($route, $request) {
    $route = $route->getName();


    switch($route){
        case 'easypayway.shopper':
            return;
        case 'fbShop.myShop':
            return;
    }

/*    if ($route == 'fbShop.myShop')
        return;*/

    Route::callRouteFilter('csrf', [], $route, $request);
});

Route::filter('owner',function($route){

    if(!Auth::user()){
        if (Request::ajax())
        {
            return Response::make('Unauthorized', 401);
        }
        else {
            return View::make('errors.401')->withMessage("Please login with correct credentials to access this page.");
        }
    }

    $noAuthority = false;
    $noResource = false;
    if(!Auth::user()->shop){
        $noAuthority = true;
    }else{ //@todo check resource unavailability first
        $userShopId = Auth::user()->shop->id;
        $shopRepo = App::make('Chorki\shops\Models\ShopRepositoryInterface');
        $slug = $route->getParameter('slug');
        $subDomain = $route->getParameter('subdomain');
        if($slug){
            $shop = $shopRepo->getBySlug($slug);
            if($shop){
                if($shop->id!==$userShopId){
                    $noAuthority = true;
                }
            }else{
                $noResource = true;
            }
        }
        if($subDomain){
            $shop = $shopRepo->getBySubDomain($subDomain);
            if($shop){
                if($shop->id!==$userShopId){
                    $noAuthority = true;
                }
            }else{
                $noResource = true;
            }
        }
    }

    if($noAuthority){
        if (Request::ajax())
        {
            return Response::make('Unauthorized', 401);
        }
        else
        {
            return View::make('errors.401')->withMessage("You do not have permission to access this page.");
        }
    }

    if($noResource){
        if (Request::ajax())
        {
            return Response::make('Not Found', 404);
        }
        else
        {
            return View::make('errors.404');
        }
    }
});

Route::filter('bodleJao',function($route){
    $subDomain = $route->getParameter('subdomain');
    if($subDomain){
        $route->setParameter('slug','BodleJaoBodleDao');
        $shop = App::make('Chorki\shops\Models\ShopRepositoryInterface');
        $slug = $shop->getSlugFromSubDomain($subDomain);
        $route->setParameter('subdomain',$slug);
    }
});
Route::filter('verify-shop', function($route)
{
    $shopRepo = App::make('Chorki\shops\Models\ShopRepositoryInterface');
    $slug = $route->getParameter('slug');
    $shop = $shopRepo->getBySlug($slug);
    if(!$shop){
        return Response::view('errors.404', array(), 404);
    }
    $myShop=$shopRepo->isMyShop($slug);
    if($myShop){
        return Redirect::route('shops.show',$slug);
    }
    if ( !isEshopVerifiedToAppearInPublic($shop) ) {
        return Redirect::route('home');
    }

});

Route::filter('has_package_feat', function($route, $request, $value){
    $shopRepo = App::make('Chorki\shops\Models\ShopRepositoryInterface');
    $slug = $route->getParameter('slug');
    $subDomain = $route->getParameter('subdomain');

    if($slug){
        $shop = $shopRepo->getBySlug($slug);
    }else if($subDomain){
        $shop = $shopRepo->getBySubDomain($subDomain);
    }else{
        return;
    }
    $package = $shop->package;

    $features = explode('|',$value);

    foreach($features as $feature){
        if($package->hasFeature($feature)){
            return;
        }
    }

    return Redirect::route('shops.show',[$slug]);//@todo add error flash message
});