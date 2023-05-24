<?php
use Chorki\Shippings\OwnShippingChannels\Models\OwnShippingChannelRepository;
use Chorki\shops\Models\AccountRepository;
use Chorki\shops\Models\ShopRepositoryDb;
use Chorki\shops\Models\ShopRepositoryInterface as Shop;
use Chorki\Validators\FormValidationException;
use Chorki\Validators\Shop\ShippingChannelValidator;
use Chorki\Validators\Shop\SocialNetworkValidator;

class SettingsController extends \BaseController {

    private $networkValidator;
    protected $accountRepository;
    /**
     * @var OwnShippingChannelRepository
     */
    private $ownShippingChannelRepository;
    /**
     * @var ShopRepositoryDb
     */
    private $shopRepositoryDb;

    function __construct(Shop $shop,SocialNetworkValidator $networkValidator,AccountRepository $accountRepository,
                         FacebookShop $fbShop,OwnShippingChannelRepository $ownShippingChannelRepository, ShopRepositoryDb $shopRepositoryDb)
    {
        $this->shop = $shop;
        $this->fbShop = $fbShop;
        $this->networkValidator = $networkValidator;
        $this->accountRepository = $accountRepository;
        $this->ownShippingChannelRepository = $ownShippingChannelRepository;
        $this->shopRepositoryDb = $shopRepositoryDb;
    }

	public function edit($slug)
    {
        $shop = $this->shop->getBySlug($slug);

        $cuponCampaignList = $this->shopRepositoryDb->cuponCampaignList($shop->id);
        $shopId = $shop->id;
        $SponsoredItems = SponsoredItem::whereHas('product',function($q) use ($shopId)
        {
            $q->where('shop_id', '=', $shopId);

        })->with(['product','dates'])->orderBy('id','desc')
        ->get();
        // dd($SponsoredItems->toArray());

        $shippingChannels = ShippingChannel::all();
        $paymentMethods = PaymentMethod::where('active', "=", '1')->get();
        $shippingLocations= ShippingLocation::lists('name','id');
        $shippingLocationsWithCharges= $shop->shippingLocations;
        $shopShippingLocations = array();
        foreach ($shippingLocationsWithCharges as $key => $value) {
            $shopShippingLocations[$key] = $value->name;
        }
        $bkashType=$this->accountRepository->getBkashAccountType();
        $bankName=$this->accountRepository->getBankName();

        $fbShopUrl = '';
        $myFbShop=$this->fbShop->where('shop_id', '=', $shop->id)->first();
        if ($myFbShop) {
                
            $pageId= $myFbShop->page_id;
            $appId= $myFbShop->app_id;
            $fbShopUrl= "https://www.facebook.com/$pageId";
        }

        return View::make('settings.edit', compact('shop','shippingChannels','paymentMethods','shippingLocations',
                          'shippingLocationsWithCharges', 'shopShippingLocations','bkashType','bankName','fbShopUrl', 'SponsoredItems','cuponCampaignList'));

    }

	public function update($slug)
	{
        $shop = $this->shop->getBySlug($slug);
        $input= Input::all();
        $validator= new SocialNetworkValidator();
        if($validator->passes())
        {
            $this->networkValidator->passes();
            $this->shop->saveSocialNetwork($shop,$input);
            $url = URL::route('settings.edit',$shop->getSlug()) . '#social';
            return Redirect::to($url);

        }
        else
        {
            $url = URL::route('settings.edit',$shop->getSlug()) . '#social';
            return Redirect::to($url)->withInput()->withErrors($validator->getErrors());
        }

	}
    public function postShippingChannels($slug){

        $shop = $this->shop->getBySlug($slug);
        $validator = ShippingChannelValidator::make($input = Input::all());
        if ($validator->fails())
        {
            $url = URL::route('settings.edit',$shop->getSlug()) . '#shipping';
            return Redirect::to($url)->withErrors($validator->instance());
        }
        $input= Input::all();
        $this->shop->saveShippingChannels($shop,$input);
        $this->ownShippingChannelRepository->update($shop);
      //  $this->shop->publishShopIfVerificationRulesAreComplete();
        $url = URL::route('settings.edit',$shop->getSlug()) . '#shipping';
        return Redirect::to($url);
    }
    public function postPaymentMethods($slug){
        $shop = $this->shop->getBySlug($slug);
        $validator = Validator::make($input = Input::all(), PaymentMethod::$rules);
        if ($validator->fails())
        {
            $url = URL::route('settings.edit',$shop->getSlug()) . '#payment';
            return Redirect::to($url)->withErrors($validator);
        }
        $this->shop->savePaymentMethods($shop,$input);
        $url = URL::route('settings.edit',$shop->getSlug()) . '#payment';
        return Redirect::to($url);
    }

    public function boostPaymentConfirm($slug) {//@todo not in use from 'Modal Not In Use' in boost.blade in settings partial
        $shop = $this->shop->getBySlug($slug);
        $item = SponsoredItem::find(Input::get('boostid'));
        if (!empty( Input::get('txnid') )) {
            $item->bkash_txnid = Input::get('txnid');
            $item->payment_at = date("Y-m-d H:i:s");
            $item->save();
            // dd(Input::all());
            // dd(Auth::user());
            $url = URL::route('settings.edit',$shop->getSlug()) . '#boost';
            return Redirect::to($url)
            ->with('flash_message', 'bKash Txn id saved. You will be notified within 24 hours.')
            ->with('flash_type', 'alert-success');
        }
        else {
            return Redirect::back()
            ->with('flash_message', 'Invalid bKash Txn id provided.')
            ->with('flash_type', 'alert-danger');
        }
            
    }
    public function postCuponSettings(){
        $input = Input::all();
        $message = '';
        $shopCampaign = DB::table('campaign_shop')->where('shop_id',$input['shopId'])->where('campaign_id',$input['campaignId'])->first();
        if($shopCampaign == null && $input['active']==1){
            DB::table('campaign_shop')->insert(
                array('shop_id' => $input['shopId'], 'campaign_id' => $input['campaignId']));
        }else{
            DB::table('campaign_shop')
                ->where('shop_id',$input['shopId'])
                ->where('campaign_id',$input['campaignId'])
                ->delete();
        }
        if($input['active']){
            $message = 'You have joined in the '.$input['name'].' campaign';
        }else{
            $message = 'You kicked you from the '.$input['name'].' campaign';
        }
        return $message;
    }



}
