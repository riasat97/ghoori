<?php
use Chorki\shops\Models\ShopRepositoryInterface;

class ProductPhotographyServiceController extends \BaseController {

    protected $shopRepo;
    protected $photoServicePackageModel;
    protected $photoPackRequestModel;

    public function __construct(ShopRepositoryInterface $shopRepo,
                                PhotographyServicePackage $photoServicePackageModel,
                                PhotographyPackRequest $photoPackRequestModel){
        $this->shopRepo= $shopRepo;
        $this->photoServicePackageModel=$photoServicePackageModel;
        $this->photoPackRequestModel=$photoPackRequestModel;
    }

    public function placeRequestAndRedirectToPayment($slug,$package_id){
        try{
            $shop = $this->shopRepo->getBySlug($slug);
            $package = $this->photoServicePackageModel->findOrFail($package_id);
        }catch (Exception $e){
            return View::make('erros.404');
        }
        $packageRequest = new PhotographyPackRequest;
        $packageRequest->photography_service_package_id = $package_id;
        $packageRequest->shop_id = $shop->id;
        $packageRequest->subtotal = $package->price;
        $packageRequest->vat = ceil($package->price*0.045);
        $packageRequest->total = $packageRequest->vat+$packageRequest->subtotal;
        $packageRequest->save();
        $packageRequest->setPayment($packageRequest->total);
        $bkashUrl = $packageRequest->getPaymentUrl('bkash');
        return Redirect::to($bkashUrl);
    }

}