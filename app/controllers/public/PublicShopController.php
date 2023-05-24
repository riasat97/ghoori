<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 4/5/2015
 * Time: 5:09 PM
 */
use Carbon\Carbon;
use Chorki\Carts\Models\CartRepositoryInterface;
use Chorki\shops\Models\ShopRepositoryInterface as Shop;
use Chorki\products\Models\ProductRepositoryInterface as Product;
use Chorki\themes\products\ThemeProductRepository;
use Chorki\Traits\CartTrait;
use Chorki\WinterIsHereRepository;

class PublicShopController extends \BaseController{
    use CartTrait;
    protected $shops,$products;
    protected $cart;
    private $generalStatus;
    protected $sponsoredItemModel;
    protected $sponsoredItemDateModel;
    protected $winterIsHereRepository;
    protected $themeProductRepository;

    function __construct(Shop $shops,
                         CartRepositoryInterface $cart,
                         Product $products,
                         GeneralStatus $generalStatus,
                         SponsoredItem $sponsoredItemModel,
                         SponsoredItemDate $sponsoredItemDateModel,
                         WinterIsHereRepository $winterIsHereRepository,
                         ThemeProductRepository $themeProductRepository
    )

    {
        $this->sponsoredItemModel= $sponsoredItemModel;
        $this->sponsoredItemDateModel= $sponsoredItemDateModel;
        $this->shops = $shops;
        $this->cart = $cart;
        $this->products= $products;
        $this->generalStatus = $generalStatus;
        $this->winterIsHereRepository = $winterIsHereRepository;
        $this->themeProductRepository = $themeProductRepository;
    }


    public function getTotalPublishedShopByDate($start,$end){

        return  $reviewed = DB::table('generalstatuses')
            ->where('action','=','Published')
            ->whereBetween('created_at', array($start, $end))
            ->distinct('generalstatuses.shop_id')
            ->count('generalstatuses.shop_id');
    }
    public function getTotalReviewedShopByDate($start,$end){

        return  $reviewed = DB::table('generalstatuses')
            ->where('action','=','Reviewed')
            ->whereBetween('created_at', array($start, $end))
            ->distinct('generalstatuses.shop_id')
            ->count('generalstatuses.shop_id');
    }
    public function getTotalBlockedShopByDate($start,$end){

        return  $reviewed = DB::table('generalstatuses')
            ->where('action','=','Blocked')
            ->whereBetween('created_at', array($start, $end))
            ->distinct('generalstatuses.shop_id')
            ->count('generalstatuses.shop_id');
    }
    public function getTotalRegisteredShopByDate($start,$end){

        return  DB::table('shops')
            ->whereBetween('created_at', array($start, $end))
            ->get();
        // ->count('shops.id');
    }
    public function getTotalRegisteredShop(){

        return  $users = DB::table('users')
            ->count('users.id');
    }
    public function getTotalLiveShop(){
        return  DB::table('shops')
            ->where('status','Published')
            ->where('chorkiVerified',1)
            ->count('shops.id');
    }
    public function getTotalOrderByDate($start,$end){
        return DB::table('orders')
            ->whereBetween('created_at', array($start, $end))
            ->count('orders.id');
    }
    public function getTotalAcceptedOrderByDate($start,$end){
        return DB::table('orders')
            ->where('status','Proceed')
            ->whereBetween('created_at', array($start, $end))
            ->count('orders.id');
    }
    public function getTotalRejectedOrderByDate($start,$end){
        return DB::table('orders')
            ->where('status','Reject')
            ->whereBetween('created_at', array($start, $end))
            ->count('orders.id');
    }
    public function getStartAndEndDate(){
        $start=Input::get('start');
        $end = Input::get('end');
        if(!empty($start) && !empty($end)){
            $start=$start.' '.'00:00:00';
            $end = $end.' '.'23:59:59';
            return ['start'=>$start,'end'=>$end];
        }
        if(!empty($start) && empty($end)){
            $start=$end.' '.'00:00:00';
            $end = $end.' '.'23:59:59';
            return ['start'=>$start,'end'=>$end];
        }
        if(empty($start) && !empty($end)){
            $start=$start.' '.'00:00:00';
            $end = $start.' '.'23:59:59';
            return ['start'=>$start,'end'=>$end];
        }
        else{
            $start = Carbon::now()->toDateString().' '.'00:00:00' ;
            $end =  Carbon::now()->toDateTimeString();
            return ['start'=>$start,'end'=>$end];
        }
    }

    public function getIndex(){

        $shops = $this->shops->getAll();
        $newestShops=$this->shops->getAllNewestShops();
        $featuredShops=$this->shops->getFeaturedShops();
        $newestProducts=$this->products->getAllNewestProducts();
        $highestViewedProducts=$this->products->getHighestViewedProducts();
        $highestSoldProducts=$this->products->getHighestSoldProducts();
        $featuredProducts=$this->products->getFeaturedProducts();
        //  dd($highestSoldProducts->toArray());
        // dd($featuredProducts);
        /* $search=new Search();
         if(Auth::user())
         {
             $search->who = Auth::user()->name;
             $search->views =  Auth::user()->search->views + 1;
         }
         else{
             $search->who =  $this->getIdFromCookie();
             $search->views =  0 + 1;
         }*/

        $range=array();
        $range[0] = 0;
        $productBuffer = array();
        $currentShop = null;
        $count=0;
        foreach ($featuredProducts as $key => $featuredProduct) {
            if($currentShop == $featuredProduct->shopId) {
                $count+=1;
                /* if($count>2){
                    // unset($featuredProducts[$key]);
                }*/
            }
            else {
                if($key > 0 ) {
                    $range[1] = $key-1;
                    $rand1 = rand($range[0], $range[1]);
                    $productBuffer[] = $featuredProducts[$rand1];

                    if($range[0] != $range[1]) {
                        if($range[1] == $range[0]+1) {
                            if($rand1 == $range[0]) $rand2 = $range[1];
                            else $rand2 = $range[0];
                        }
                        else {
                            $rand2 = rand($range[0], $range[1]);
                            while ( $rand1 == $rand2  ) {
                                $rand2 = rand($range[0], $range[1]);
                            }

                        }

                        $productBuffer[] = $featuredProducts[$rand2];
                    }
                }
                $currentShop = $featuredProduct->shopId;
                $count=1;
                $range[0] = $key;
            }

        }
        $featuredProducts = $productBuffer;


        $cartCount = $this->cart->cartCount();
        $cartContents = $this->cart->cartContent();
        $cartTotal = $this->cart->cartTotal();
        $cart = View::make('_partials.cart',compact('cartCount','cartContents','cartTotal'));
        return View::make('shops.index',compact('shops','cart', 'featuredShops','newestShops','newestProducts','featuredProducts','highestViewedProducts','highestSoldProducts'));
        // return View::make('shops.index2',compact('cart', 'featuredShops','newestShops'));
    }

    public function getIndex2(){
        $hotDeals = $this->winterIsHereRepository->getRandomDiscountedProductsForWinterCampaign();

        $extremeDeal = $this->winterIsHereRepository->getRandomDiscountedProductForWinterCampaign();

        $newestShops=$this->shops->getAllNewestShops();
        $featuredShops=$this->shops->getFeaturedShops();

        $forhertoday = $this->sponsoredItemModel->with(['dates'=>function($q){
            $q->where('date', '=', Carbon::today() )->whereNull('deleted_at');
        }])->with('product')->where('reviewStatus', '=', 'accepted')->where('group', '=', 'for_her' )->whereHas('product',function($q)
        {
            $q->where('status', '=', 'Published')->whereHas('shop', function($qs) {
                $qs->where('status', '=', 'Published');
            });

        })->get();
        // $forherpromoted
        // dd($forhertoday);
        $forhermain = array();
        foreach ($forhertoday as $key => $item) {
            // var_dump($item->position);
            $forhermain[$item->position][] = $item;
        }
        // var_dump(count($forhermain['large_ad']));
        if (empty( $forhermain['large_ad'] ) ||  count($forhermain['large_ad']) < 5) {
            if(empty($forhermain['large_ad'])) {
                $adcount = 0;
            } else {
                $adcount = count($forhermain['large_ad']);
            }
            $promotedads = PromotedItem::where('group', '=', 'for_her' )->where('isActive', '=', '1' )->where('position', '=', 'large_ad' )->take( 5 - $adcount )->get();
            // var_dump($promotedads);
            foreach ($promotedads as $key => $item) {
                // var_dump($item->position);
                $forhermain[$item->position][] = $item;
            }
        }
        if ( empty( $forhermain['medium_ad'] ) || count($forhermain['medium_ad']) < 1) {
            if(empty($forhermain['medium_ad'])) {
                $adcount = 0;
            } else {
                $adcount = count($forhermain['medium_ad']);
            }
            $promotedads = PromotedItem::where('group', '=', 'for_her' )->where('isActive', '=', '1' )->where('position', '=', 'medium_ad' )->take( 1 )->get();
            // var_dump($promotedads);
            foreach ($promotedads as $key => $item) {
                // var_dump($item->position);
                $forhermain[$item->position][] = $item;
            }
        }
        if ( empty( $forhermain['small_ad'] ) ||  count($forhermain['small_ad']) < 4) {
            if(empty($forhermain['small_ad'])) {
                $adcount = 0;
            } else {
                $adcount = count($forhermain['small_ad']);
            }
            $promotedads = PromotedItem::where('group', '=', 'for_her' )->where('isActive', '=', '1' )->where('position', '=', 'small_ad' )->take( 4 - $adcount )->get();
            // var_dump($promotedads);
            foreach ($promotedads as $key => $item) {
                // var_dump($item->position);
                $forhermain[$item->position][] = $item;
            }
        }

        // dd($forhermain);
        $cartCount = $this->cart->cartCount();
        $cartContents = $this->cart->cartContent();
        $cartTotal = $this->cart->cartTotal();
        $cart = View::make('_partials.cart',compact('cartCount','cartContents','cartTotal'));
        // return View::make('shops.index',compact('shops','cart', 'featuredShops','newestShops','newestProducts','featuredProducts','highestViewedProducts','highestSoldProducts'));
        return View::make('shops.index3',compact('cart','hotDeals','extremeDeal', 'featuredShops','newestShops','forhermain'));
    }

    public function getAllShops(){

        $shops = $this->shops->getAll();
        $shops->load('logo');
        $ownShopId = null;
        if(Auth::user()&&Auth::user()->shop){
            $ownShopId = Auth::user()->shop->id;
        }
        /* $search=new Search();
         if(Auth::user())
         {
             $search->who = Auth::user()->name;
             $search->views =  Auth::user()->search->views + 1;
         }
         else{
             $search->who =  $this->getIdFromCookie();
             $search->views =  0 + 1;
         }*/

        $cartCount = $this->cart->cartCount();
        $cartContents = $this->cart->cartContent();
        $cartTotal = $this->cart->cartTotal();
        $cart = View::make('_partials.cart',compact('cartCount','cartContents','cartTotal'));
        return View::make('shops.allshops',compact('ownShopId','shops','cart'));
    }

    public function getShop($slug){
        $shop = $this->shops->getBySlug($slug);

//        $this->shops->viewCount($shop);

        if(!$shop){
            return Response::view('errors.404', array(), 404);
            //todo 404 view/ shop don't exist is due
        }
        $myShop = $this->shops->isMyShop($slug);
        if($myShop){
            return Redirect::route('shops.show',$slug);
        }
        if ( !isEshopVerifiedToAppearInPublic($shop) ) {
            //todo This will be a Locked shop image view 
            return Redirect::route('home');
        }
      //  $this->shops->viewCount($shop);
        $products=$this->getShopProducts($shop);

        $cart= $this->getCart();

        /* ************ Load Dhumketu Theme with products under dhumkeu theme Shop************************** */
        if($shop->theme && $shop->theme->name == 'dhumketu'){

            $products=$this->getDhumketuShopProducts($shop);

            return View::make($shop->theme->path.'.home.home',
                compact('shop','categories','cart','headerSection','products', 'productsWithCat', 'latestProducts', 'popularProducts'));
        }



        /* ************ Load Chayaneer Theme Shop************************** */
        if($shop->theme && $shop->theme->name == 'chayaneer'){

            $products=$this->getChayaneerShopProducts($shop);

            $ownProduct = false;
            if(Auth::user()&&Auth::user()->shop&&($products->shop->id == Auth::user()->shop->id)){
                $ownProduct = true;
            }
            return View::make($shop->theme->path.'.home.home',
                compact('shop','categories','cart','headerSection','products', 'ownProduct', 'productsWithCat', 'latestProducts', 'popularProducts'));
        }








        if($shop->theme){
            $products=$this->themeProductRepository->getShopProducts($shop);
//            dd($products);
            return View::make($shop->theme->path.'.home.home',
                compact('shop','categories','cart','products','latestProducts','popularProducts'));
        }
        $products=$this->getShopProducts($shop);

        if(!empty($shop->banner->path))
            $shop->bannerfull = asset('public_img/shop_'.$shop->id.'/banners/'.$shop->banner->path);
        else
            $shop->bannerfull = asset('img/shopbanner-default.jpg');
        $headerSection=View::make('shops.yourshop._partials.header',compact('shop'));

        return View::make('shops.yourshop.show',compact('shop','categories','cart','headerSection','products'));
    }



    public function getShopProducts($shop){
        $currentPage = Input::get('page', 1);
        $itemsPerPage = 3;
        $productLimit=$this->products->getProductLimitAccordingToShopPackage($shop);
        $data = $this->products->getPublishedByPage($shop->id,$currentPage, $itemsPerPage,$productLimit);
        $totalItems= $this->products->totalPublishedItemsForShop($shop->slug,$productLimit);
        return $products = Paginator::make($data->items, $totalItems, $itemsPerPage);
    }





    /* ************get products under dhumkeu theme Shop************************** */
    public function getDhumketuShopProducts($shop){
        $currentPage = Input::get('page', 1);
        $itemsPerPage = 20;
        $data = $this->products->getPublishedByPage($shop->id,$currentPage, $itemsPerPage);
        $totalItems= $this->products->totalPublishedItemsForShop($shop->slug);
        return $products = Paginator::make($data->items, $totalItems, $itemsPerPage);
    }


    /* ************get products under Chayaneer theme Shop************************** */
    public function getChayaneerShopProducts($shop){
        $currentPage = Input::get('page', 1);
        $itemsPerPage = 20;
        $data = $this->products->getPublishedByPage($shop->id,$currentPage, $itemsPerPage);
        $totalItems= $this->products->totalPublishedItemsForShop($shop->slug);
        return $products = Paginator::make($data->items, $totalItems, $itemsPerPage);
    }








    public function showAbout($slug){
        $shop = $this->shops->getBySlug($slug);


        if($shop->theme && $shop->theme->name == 'dhumketu') {
            $header = View::make($shop->theme->path.'._partials.theme-header', compact('shop'));
            return View::make($shop->theme->path.'._partials.about', compact('shop', 'header'));
        }

        $headerSection=View::make('shops.yourshop._partials.header',compact('shop'));
        return View::make('shops.yourshop.pages.show.about',compact('shop','headerSection'));
    }


    public function showPrivacy($slug){
        /*$shop = $this->shop->getBySlugWithModelAndType($slug,'shopContent');*/
        $shop = $this->shops->getBySlug($slug);

        if($shop->theme && $shop->theme->name == 'dhumketu') {
            $header = View::make($shop->theme->path.'._partials.theme-header', compact('shop'));
            return View::make($shop->theme->path.'._partials.privacy', compact('shop', 'header'));
        }

        $headerSection=View::make('shops.yourshop._partials.header',compact('shop'));
        $shop->load('shopPrivacy');
        return View::make('shops.yourshop.pages.show.privacy',compact('shop','headerSection'));
    }


    public function showTerm($slug){
        $shop = $this->shops->getBySlug($slug);

        if($shop->theme && $shop->theme->name == 'dhumketu') {
            $header = View::make($shop->theme->path.'._partials.theme-header', compact('shop'));
            return View::make($shop->theme->path.'._partials.term', compact('shop', 'header'));
        }

        $headerSection=View::make('shops.yourshop._partials.header',compact('shop'));
        $shop->load('shopTerm');
        return View::make('shops.yourshop.pages.show.term',compact('shop','headerSection'));
    }


    private function person(){

        if (!empty(Auth::user()->name)){
            return Auth::user()->name;
        } else
        {
            return  $this->getIdFromCookie();

        }
    }
    public function getIdFromCookie() {

        $unknownUserId = Cookie::get('unknownUserId');
        if (!$unknownUserId) {
            $newId = uniqid();
            //$cookie = Cookie::forever('unknownUser',$newId);
            Cookie::queue('unknownUserId',$newId,2628000);
            return $newId;
        }
        return $unknownUserId;
    }


}