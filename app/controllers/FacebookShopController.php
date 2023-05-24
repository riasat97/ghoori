<?php
use Chorki\Facebook\FacebookAdapter;
use Chorki\Facebook\repository\FbShopLogRepository;
use Chorki\shops\Models\ShopRepositoryInterface;
use Chorki\products\Models\ProductRepositoryInterface;

class FacebookShopController extends \BaseController {

    private $fb;
    private $fbShop,$user,$shopRepo,$productRepo,$fbShopLogRepository;


    public function __construct(FacebookShop $fbShop, User $user, FacebookAdapter $fb, ShopRepositoryInterface $shopRepo
        , ProductRepositoryInterface $productRepo ,FbShopLogRepository $fbShopLogRepository){
        $this->fbShop = $fbShop;
        $this->user = $user;
        $this->fb = $fb;
        $this->shopRepo = $shopRepo;
        $this->productRepo = $productRepo;
        $this->fbShopLogRepository = $fbShopLogRepository;
    }

    public function index($slug){
        $shop = $this->shopRepo->getBySlug($slug);
        $shopId= $shop->id;
        if($this->fbShop->shopHasFbShop($shopId)){
            $shopTabData = $this->getFbShopTabData($shopId,$slug);
            if(!$shopTabData){
                return Redirect::route('fbShop.create',[$slug]);
            }
        }else{
            return Redirect::route('fbShop.create',[$slug]);
        }
        $myFbShop=$this->fbShop->where('shop_id', '=', $shopId)->first();
        $pageId= $myFbShop->page_id;
        $appId= $myFbShop->app_id;
        $fbShopUrl= "https://www.facebook.com/$pageId";
        // $fbShopUrl= "https://www.facebook.com/$pageId?sk=app_$appId";
        // $fbShopUrl= "https://www.facebook.com/pages/PinJuice/1633890893553096?sk=app_989829407724668";
        return View::make('fbShop.index')
            ->with('fbShopUrl',$fbShopUrl)
            ->with('shop',$shop)
            ->with('slug',$slug);
    }

    public function create($slug){
        $shop = $this->shopRepo->getBySlug($slug);
        $shopId = $shop->id;

        if($this->fbShop->shopHasFbShop($shopId)){
            $shopTabData = $this->getFbShopTabData($shopId,$slug);
            if($shopTabData){
                return Redirect::route('fbShop.index',[$slug]);
            }
        }

        try{
            //@todo now check if fb is connected or not
            $accounts= $this->fb->apiCall('/me/accounts');
        }catch(Exception $e){
            return Redirect::route('shops.show', [$slug])
                ->with('flash_message', $e->getMessage())
                ->with('flash_type', 'alert-danger');
        }
        $pages=$accounts->data;

        $options= array();
        foreach($pages as $page){
            foreach($page->perms as $permission){
                if($permission === 'EDIT_PROFILE'){
                    $options[$page->id]=$page->name;
                }
            }
        }

        return View::make('fbShop.selectPage')
            ->with('pages',$options)
            ->with('shop',$shop)
            ->with('url',URL::route('fbShop.store',[$slug]));

    }

    public function store($slug){
        $pageId = Input::get('pageId');
        $shop = $this->shopRepo->getBySlug($slug);
        $shopId = $shop->id;
        try{
            $accounts= $this->fb->apiCall('/me/accounts');
        }catch(Exception $e){
            return Redirect::route('fbShop.create',[$slug])
                ->with('flash_message', $e->getMessage())
                ->with('flash_type', 'alert-danger');
        }
        $pages=$accounts->data;
        $accessToken=null;
        foreach($pages as $page){
            if($page->id===$pageId){
                $accessToken = $page->access_token;
            }
        }
        if(!$accessToken){
            return Redirect::route('fbShop.create',[$slug])
                ->withInput()
                ->with('flash_message', '<b>Error!</b> You do not have permission to install app into the selected page.')
                ->with('flash_type', 'alert-danger');
        }

        //dd($accessToken);

        $this->fb->setPageMode($accessToken);
        $appId = Config::get('facebook.appId');
        $parameters= array(
            'id' => $pageId,
            'app_id' => $appId,
            'position' => 1
        );
        try{
            $response= $this->fb->apiCall("/$pageId/tabs", 'POST', $parameters);
        }catch(Exception $e){
            return Redirect::route('fbShop.create',[$slug])
                ->with('flash_message', $e->getMessage())
                ->with('flash_type', 'alert-danger');
        }finally{
            $this->fb->resetMode();
        }

        if($response->success){
            $fbShop = FacebookShop::firstOrNew(array('shop_id' => $shopId));
            $fbShop->page_id = $pageId;
            $fbShop->page_access_token = $accessToken;
            $fbShop->app_id = $appId;
            $parameters = array(
                'position' => 1
            );
            $this->fb->setPageMode($accessToken);
            try{
                // @TODO do this by batch request
                $this->fb->apiCall("/$pageId/tabs/app_$appId", 'POST', $parameters);
            }catch(Exception $e){
                return Redirect::route('fbShop.index',[$slug])
                    ->with('flash_message', $e->getMessage())
                    ->with('flash_type', 'alert-danger');
            }finally{
                $this->fb->resetMode();
            }
            $fbShop->save();
            $this->fbShopLogRepository->postLogFbShop($fbShop);

            return Redirect::route('fbShop.edit',[$slug]);
        }
    }

    public function edit($slug){
        $shop = $this->shopRepo->getBySlug($slug);
        $shopId = $shop->id;
        if($this->fbShop->shopHasFbShop($shopId)){
            $shopTabData = $this->getFbShopTabData($shopId,$slug);
            if(!$shopTabData){
                return Redirect::route('fbShop.index',[$slug]);
            }
        }else{
            return Redirect::route('fbShop.index',[$slug]);
        }

        $name = $shopTabData->name;
        if(isset($shopTabData->custom_name)){
            $name= $shopTabData->custom_name;
        }

        $url= URL::route('fbShop.update',[$slug]);
        return View::make('fbShop.editFbShop')
            ->with('custom_name',$name)
            ->with('shop',$shop)
            ->withUrl($url);
    }

    public function update($slug){
        $shop = $this->shopRepo->getBySlug($slug);
        $shopId = $shop->id;
        if(!$this->fbShop->shopHasFbShop($shopId)){
            return Redirect::route('fbShop.index',[$slug]);
        }else{
            $shopTabData = $this->getFbShopTabData($shopId,$slug);
            if(!$shopTabData){
                return Redirect::route('fbShop.index',[$slug]);
            }
        }

        $myFbShop=$this->fbShop->where('shop_id', '=', $shopId)->first();

        $pageAccessToken = $myFbShop->page_access_token;

        $appId= $myFbShop->app_id;

        $this->fb->setPageMode($pageAccessToken);

        $parameters = array(
            'position' => 2,
            'custom_name' => Input::get('custom_name')
        );

        try{
            $this->fb->apiCall("/me/tabs/app_$appId","POST",$parameters);
        }catch (Exception $e){
            return Redirect::route('fbShop.index',[$slug])
                ->with('flash_message', $e->getMessage())
                ->with('flash_type', 'alert-danger');
        }finally{
            $this->fb->resetMode();
        }

        return Redirect::route('fbShop.index',[$slug]);
    }

    public function myFbShop(){
        if(Input::has('signed_request')){
            $signed_request = Input::get('signed_request');
            $data_signed_request = explode('.',$signed_request); // Get the part of the signed_request we need.
            $jsonData = base64_decode($data_signed_request['1']); // Base64 Decode signed_request making it JSON.
            $objData = json_decode($jsonData,true); // Split the JSON into arrays.
            $pageData = $objData['page'];
            $pageId = $pageData['id'];
            $fbShop = $this->fbShop->getFbShopByPageId($pageId);
            if(!$fbShop){
                return Redirect::route('home');
            }
            $shopId = $fbShop->shop_id;
        }elseif(Input::has('shop_id')){
            $shopId = Input::get('shop_id');
        }else{
            return Redirect::route('home');
        }

        $shop = $this->shopRepo->getById($shopId);
        if(($shop->status==='Published')&&($shop->reviewed)&&($shop->chorkiVerified)){
            $slug = $shop->slug;
            $currentPage = Input::get('page', 1);
            $itemsPerPage = 8;
            $data = $this->productRepo->getPublishedByPage($shopId,$currentPage,$itemsPerPage);
            $totalItems= $this->productRepo->totalItemsForShop($slug);
            $products = Paginator::make($data->items, $totalItems, $itemsPerPage);

            return View::make('fbShop.showFbShop')
                ->with('products',$products)
                ->with('shop',$shop)
                ->with('shopId',$shopId)
                ->with('slug',$slug);
        }else{
            return Redirect::route('home');
        }
    }

    protected function getFbShopTabData($shopId,$redirectSlugIfException){
        $myFbShop = $this->fbShop->where('shop_id', '=', $shopId)->first();
        $pageAccessToken = $myFbShop->page_access_token;
        $appId= $myFbShop->app_id;
        $this->fb->setPageMode($pageAccessToken);
        try{
            $response = $this->fb->apiCall("/me/tabs/app_$appId");
        }catch(Exception $e){
            return Redirect::route('shops.show', [$redirectSlugIfException])
                ->with('flash_message', $e->getMessage())
                ->with('flash_type', 'alert-danger');
        }finally{
            $this->fb->resetMode();
        }
        if(empty($response->data)){
            return false;
        }
        return $response->data[0];
    }
}