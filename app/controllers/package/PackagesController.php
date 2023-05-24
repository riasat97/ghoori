<?php

use Chorki\Carts\Models\CartRepositoryInterface;
use Chorki\Facebook\FacebookAdapter;
use Chorki\GeneralStatusRepository;
use Chorki\ShippingSDK\ECourier;
use Chorki\shops\Models\AccountRepository;
use Chorki\SMS\SMSSender;

class PackagesController extends \ShopsController {


    protected $packageRequest;
    private $revenue;

    function __construct(\Chorki\packages\PackageRequestRepository $packageRequest,
                         \Chorki\Orders\Models\RevenueRepository $revenue,
                         \Chorki\shops\Models\ShopRepositoryInterface $shop, FacebookAdapter $fb, SMSSender $smsSender
                          ,CartRepositoryInterface $cart,\Chorki\products\Models\ProductRepositoryInterface $product,
                         Attribute $attribute,
                         ECourier $ecourier,
                         Package $packageRepo,
                         GeneralStatusRepository $generalStatus,AccountRepository $accountRepository, \Chorki\ProductEvents\ProductEvent $productEvent){

        parent::__construct($shop,$fb,$smsSender,$cart,$product,$attribute,$ecourier,$packageRepo,$generalStatus,$accountRepository, $productEvent);
        $this->packageRequest= $packageRequest;
        $this->revenue = $revenue;
    }

	public function index($slug)
	{
        $slugShop = $this->shops->getBySlug($slug);

        if(!$slugShop){
            //@todo redirect to 404
        }
        $userShop = $this->shops->_getShop();
        if((!$userShop)||($slugShop->id === $userShop->id)){
            $shop=$slugShop;
            return View::make('shops.myshop.packages',compact('shop'));
        }
	}

	public function edit($id)
	{
        $packageRequest=$this->packageRequest->store($id);

        $migrationDate=$this->revenue->getPackageMigrationDate();
        $migrationDate=$this->revenue->getCarbonInstance($migrationDate);
        $date=$migrationDate['start']->addHours(6)->toFormattedDateString();

        $shop=$this->shops->_getShop();
        return Redirect::route('package.index',[$shop->slug])
            ->with('flash_message', "<b>Well done!</b>Your package will be migrated on $date .")
            ->with('flash_type', 'alert-success');

	}




}