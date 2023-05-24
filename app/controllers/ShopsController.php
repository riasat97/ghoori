<?php

use Chorki\Carts\Models\CartRepositoryInterface;
use Chorki\GeneralStatusRepository;
use Chorki\ProductEvents\ProductEvent;
use Chorki\ShippingSDK\ECourier;
use Chorki\shops\Commands\PostShopListingCommand;
use Chorki\shops\Models\AccountRepository;
use Chorki\shops\Models\ShopRepositoryInterface as Shop;
use Chorki\products\Models\ProductRepositoryInterface;
use Chorki\Validators\Shop\AddressValidator;
use Chorki\Validators\Shop\ShopValidator;
use Chorki\Facebook\FacebookAdapter;
use Illuminate\Support\Facades\Auth;
use Chorki\SMS\SMSSender;

class ShopsController extends \BaseController {

    protected $shops, $smsSender,$cart,$product,$packageRepo;
    protected $attribute;
    protected $ecourier;
    protected $generalStatus;
    private $accountRepository;
    protected $productEvent;

    function __construct(Shop $shops, FacebookAdapter $fb, SMSSender $smsSender,
                         CartRepositoryInterface $cart,ProductRepositoryInterface $product,
                         Attribute $attribute, ECourier $ecourier, Package $packageRepo,
                         GeneralStatusRepository $generalStatus,AccountRepository $accountRepository,
                         ProductEvent $productEvent)
    {
        $this->packageRepo = $packageRepo;
        $this->shops = $shops;
        $this->fb = $fb;
        $this->smsSender = $smsSender;
        $this->cart = $cart;
        $this->productRepo = $product;
        $this->attribute = $attribute;
        $this->ecourier = $ecourier;
        $this->generalStatus = $generalStatus;
        $this->accountRepository = $accountRepository;
        $this->productEvent = $productEvent;
    }

	public function create()
	{
        if(Auth::user()&&($shop=Auth::user()->shop)){
            return Redirect::route('package.index', $shop->getSlug());
        }else{
            $packages = $this->packageRepo->getPublicPackages()->keyBy('id')->lists('name','id');
            $formData = array(
                'email' => Auth::user()->email,
                'name' => Auth::user()->name,
                'package' => Input::get('pid',1)
            );
            $prefillData = array();
            if (Session::has('shopCreateData')) {
                $prefillData = Session::get('shopCreateData');
                Session::forget('shopCreateData');
            }
            elseif (Input::has('email') || Input::has('mobile') || Input::has('title') ||  Input::has('name')) {
                $prefillData = Input::only('email','mobile','title', 'name');
            }
            $formData = array_merge($formData , array_filter($prefillData));
            return View::make('shops.create')->with('formData',$formData)->withPackages($packages);
        }
	}

	public function store()
	{
        $validator = new ShopValidator();
        if($validator->passes())
        {
            $this->execute(PostShopListingCommand::class);
            $shop=$this->shops->_getShop();
            Session::put('shop_id',$shop->id);
            Session::put('shop',$shop);
            return Redirect::route('shops.show',$shop->getSlug());
        }

        return Redirect::route('shops.create')
            ->withInput()
            ->withErrors($validator->getErrors());
	}
    public function view($slug){//@todo does not work delete 3 months after november 2013
        $slugShop = $this->shops->getBySlug($slug);
        if(!$slugShop){
            return Response::view('errors.404', array(), 404);
        }
        $userShop = $this->shops->_getShop();
        if((!$userShop)||($slugShop->id === $userShop->id)){
            $this->sendSMSIfChorkiVerified($slugShop);
            $shop=$slugShop;
            $categories = Category::lists('name', 'id');
            return View::make('shops.myshop._layouts.main',compact('shop','categories'));
        }

        App::abort(403, 'Unauthorized action.');
    }

	public function show($slug){ // Shop dash view
        $slugShop = $this->shops->getBySlug($slug);
        if(!$slugShop){
            return Response::view('errors.404', array(), 404);
        }
        $boost_charges = Config::get('boost');
        $userShop = $this->shops->_getShop();
        if((!$userShop)||($slugShop->id === $userShop->id)){
            $this->sendSMSIfChorkiVerified($slugShop);
            $shop=$slugShop;
            $products=$this->productRepo->getShopProducts($shop);
            $productOverFlow=$this->productRepo->areProductsOverFlown($shop);
            $categories = Category::lists('name', 'id');
            return View::make('shops.myshop.show',
                  compact('shop','categories','products','boost_charges','productOverFlow'));
        }

        App::abort(403, 'Unauthorized action.');
	}

    private function sendSMSIfChorkiVerified($shop)
    {
        if($shop->chorkiVerified == 1 && $shop->reviewed == 0  ){
            $name = Auth::user()->name;
            $number = Auth::user()->shop->mobile;
            $message = "Dear, ".$name." Your eShop is now verified by Ghoori and publicly visible for customers.";
            $originator = Config::get('constants.sms_originator');
            if(App::environment() == 'production'){
            $this->smsSender->sendSMS($number,$message,$originator);
            }
            $this->updateReviewStatus($shop);
           // $this->shops->postEcourierRegistration($shop);
            return $shop;
        }

    }
    private function updateReviewStatus($shop)
    {
        $shop->reviewed = 1;
        $shop->save();
        return $shop;
    }
    public function getProducts($slug,$id)
    {
        $product = $this->productRepo->getById($id);
        $shop = $this->shops->_getShop();
        $attributes=$this->attribute->getAttr($id);
        $attributeCount = array('color'=> 0, 'size'=>0);
        foreach ($attributes as $key => $value) {
            if ($value->type == 'color') {
                $attributeCount['color']++;
            }
            if ($value->type == 'size') {
                $attributeCount['size']++;
            }
        }
        $discountedPrice=$this->productRepo->ProductHasGpCampaign($product);
        return View::make('products.show', compact('product','shop','attributes', 'attributeCount','discountedPrice'));
    }


    public function postUploadLogo(){
        $shop = $this->shops->_getShop();
        $shopID = $shop->id;
        $validator = new \Chorki\Validators\Logo\LogoValidator(InputOld::all());
        if($validator->passes()){
        $image    = Input::file('logo');
        // $filename    = time() . '.' . $image->getClientOriginalExtension().'.jpg';
        $filename    = time() . '.jpg';
        $destination = public_path() . '/public_img/shop_'.$shopID.'/logos';

        if (!folder_exists($destination)) {
            mkdir( $destination, 0777, true );

        }

        $logo=$shop->logo;
        if($logo){
            $logo->logo = $filename;
            $shop->logo()->save($logo);
        }else{
            $logo = new Logo();
            $logo->logo = $filename;
            $shop->logo()->save($logo);
        }
        $fitimage = Image::make($image->getRealPath())
            ->fit(152, 152);
        Image::canvas(152,152, '#ffffff')->insert($fitimage)
            ->encode('jpg', 75)
            ->save($destination .'/'. $filename);
        
        $this->shops->publishShopIfVerificationRulesAreComplete();
        return Redirect::route('shops.show',$shop->getSlug());
        } else { return
            Redirect::route('shops.show',$shop->getSlug())
            ->withInput()
            ->withErrors($validator->getErrors());
        }

    }
    public function postUploadBanner(){
        $shop = $this->shops->_getShop();
        $shopID = $shop->id;
        $validator = new \Chorki\Validators\Banner\BannerValidator(InputOld::all());
        if($validator->passes()){
        $image    = Input::file('path');
        // $filename    = time() . '.' . $image->getClientOriginalExtension().'.jpg';
        $filename    = time() . '.jpg';

        $destination = public_path() . '/public_img/shop_'.$shopID.'/banners';
        if (!folder_exists($destination)) {
            mkdir( $destination, 0777, true );
        }

        $banner=$shop->banner;
        if($banner){
            $banner->path = $filename;
            $shop->banner()->save($banner);
        } else {
            $banner = new Banner();
            $banner->path = $filename;
            $shop->banner()->save($banner);
        }
        $fitimage = Image::make($image->getRealPath())
            ->fit(851, 315);
        Image::canvas(851,315, '#ffffff')->insert($fitimage)
            ->encode('jpg', 75)
            ->save($destination .'/'. $filename);
        $this->shops->publishShopIfVerificationRulesAreComplete();
        return Redirect::route('shops.show',$shop->getSlug());
        }
        else{
       return Redirect::route('shops.show',$shop->getSlug())
            ->withInput()
            ->withErrors($validator->getErrors());
        }

    }

    public function getMobileVerificationCodeView(){
        $user=User::find(Auth::user()->id);
         $shopId=$user->shop->id;
         Session::put('shop_id',$shopId);
         $shop=$user->shop;
         Session::put('shop',$shop);

        return View::make('verificationCode.mobileCode');

    }

     public function postMobileVerificationCode(){

         $shop = $this->shops->_getShop();
         $shopId = $shop->id;
         Session::put('shop_id',$shopId);
         Session::put('shop',$shop);
         $code=$shop->code;
         $dbCode= $shop->code->code;

         $userCode=Input::get('code');
         if($dbCode == $userCode)
         {
            $shop->isVerified=1;
            $shop->save();
            $this->shops->publishShopIfVerificationRulesAreComplete();
            $url = URL::route('settings.edit',$shop->getSlug()) . '#verify';
             return Redirect::to($url);

         }
         else
         {
             $attemptNo= $code->attempt;
             if($attemptNo<2) {
                 $countAttempt = $attemptNo + 1;
                 $code->attempt=$countAttempt;
                 $update=$shop->code()->save($code);
                 $attempt= $update->attempt;
                 $url = URL::route('settings.edit',$shop->getSlug()) . '#verify';
                 return Redirect::to($url)->with('attempt', $attempt);

             }
             else{

                 $url = URL::route('settings.edit',$shop->getSlug()) . '#verify';
                 return Redirect::to($url)->with('message', 'Call center number: 09612000888. Contact there to verify');
             }
         }
     }

    Private function _getShop(){
        dd('Bam!!');//@todo not in use delete after 4/2015
        if(Auth::user()&&Auth::user()->shop){
            $shopId = Auth::user()->shop->id;
            $shop = $this->shops->getById($shopId);
            return $shop;
        }
        return null;
    }

    public function editAddress(){
        $shop = $this->shops->_getShop();
        if($shop){

            $response = array(
                'status' => 'success',
                'shop' => $shop
            );

            return Response::json( $response );

        }
    }

    public function updateAddress()
    {
        $shop = $this->shops->_getShop();
        $validator = new AddressValidator();
        if($validator->passes()){
            $shop->address = Input::get('address');
            $shop->website = Input::get('website');
                $disappearUnpublishButtonIfEmailChanged=$this->checkEmailUpdated($shop,Input::get('email'));
            $disappearUnpublishButtonIfMobileChanged=$this->checkMobileUpdated($this->shops->_getShop(),Input::get('mobile'),Input::get('email'));
            if( $shop->update()) {
                $response = array('success'=>true,'shop'=> $this->shops->_getShop(), 'emailVerified' => $shop->emailVerified, 'mobileVerified' => $shop->isVerified,
                'appearUnpublishButtonIfEmailChanged'=>$disappearUnpublishButtonIfEmailChanged,'appearUnpublishButtonIfMobileChanged'=>$disappearUnpublishButtonIfMobileChanged);
                return Response::json($response);
            }
            else
                return "Error";
        }
        return Response::json(['success'=> false,'errors'=> $validator->getErrors()->toArray()]);

    }
    private function checkMobileUpdated($shop,$mobile,$email)
    {
        if($shop->mobile == $mobile){
            $shop->mobile =$mobile;
            $shop->update();
            return false;
        }

        else{
            $shop->mobile =$mobile;
            $shop->isVerified=0;
            $shop->update();
            $code=$shop->code;
            $code->resendCount=0;
            $code->attempt=0;
            $code->code=rand(1000,9000);
            $code->save();
            $this->shops->unPublishShopIfVerificationRulesAreNotComplete();
            $this->shops->SMSMobileVerificationCodeToUser();
            return true;

        }
    }

    private function checkEmailUpdated($shop,$email)
    {
        if($shop->email == $email){
            $shop->email =$email;
            $shop->update();
            return false;
        }
        else{
            $shop->email =$email;
            $shop->emailVerified=0;
            $shop->emailVerificationCode=$this->shops->generateVerificationCode('emailVerificationCode');
            $shop->update();
            $this->shops->unPublishShopIfVerificationRulesAreNotComplete();
            $this->shops->MailVerificationLinkToUser();
            return true;
        }
    }
    public function shopStatus(){

        $shop = $this->shops->_getShop();
        $chorkiVerification=isChorkiVerifiedMessage($shop);
        if($shop->status == 'Unpublished')
        {
            $shop->status = 'Published';
            $shop->update();
            $this->generalStatus->logGeneralStatus($shop);
            $this->productEvent->postProductsDependsOnShopStatus($shop);
            $response = array(
                'status' => 'success',
                'msg' => 'Published',
                'shop' => $shop->id,
                'chorkiVerified'=>$chorkiVerification
            );
            return Response::json( $response );
        }
        else{
            $shop->status = 'Unpublished';
            $shop->update();
            $this->generalStatus->logGeneralStatus($shop);
            $this->productEvent->postProductsDependsOnShopStatus($shop);
            $response = array(
                'status' => 'fail',
                'msg' => 'UnPublished',
                'shop' => $shop->id,
                'chorkiVerified'=>$chorkiVerification
            );
            return Response::json( $response );

        }

    }
  /*  private function logGeneralStatus($shop)
    {
        $this->generalStatus->action=$shop->status;
        $this->generalStatus->user_id= Auth::user()->id;
        $shop->generalStatuses()->save($this->generalStatus);

    }*/
    public function resendMobileVerificationCodeToUser(){
        $sent=$this->shops->SMSMobileVerificationCodeToUser();
        $shop=$this->shops->_getShop();
        $url = URL::route('settings.edit',$shop->getSlug()) . '#verify';
        if($sent)
        return Redirect::to($url)->with('message', 'Mobile verification code  resend Successful..Check inbox');
        else
        return Redirect::to($url);


    }
    public function resendMailVerificationLinkToUser(){
        $shop=$this->shops->_getShop();
        $this->shops->MailVerificationLinkToUser();
        $url = URL::route('settings.edit',$shop->getSlug()) . '#verify';
        return Redirect::to($url)->with('message', 'Email verification code  mail resend Successful..Check inbox');
    }

    public function updateTagLine($slug)
    {
        $shop = $this->shops->_getShop();
        $shop->tagline = Input::get('value');
        if( $shop->update() ) {
            $response = array('success'=>true,'data'=>['id'=> $shop->id, 'tagline'=> $shop->tagline]);
            return Response::json($response);
        }
        else
            return Response::json(['success'=>false]);
        
    }



}//EOC
