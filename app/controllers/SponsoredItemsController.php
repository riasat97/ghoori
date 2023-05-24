<?php
use Chorki\shops\Models\ShopRepositoryInterface;
use Chorki\products\Models\ProductRepositoryInterface;

class SponsoredItemsController extends \BaseController {
    protected $sponsoredItemDateModel,$sponsoredItemModel;
    protected $shopRepo,$productRepo;
    public function __construct(SponsoredItemDate $sponsoredItemDateModel, ShopRepositoryInterface $shopRepo,
                                ProductRepositoryInterface $productRepo, SponsoredItem $sponsoredItemModel){
        $this->sponsoredItemDateModel = $sponsoredItemDateModel;
        $this->shopRepo = $shopRepo;
        $this->productRepo = $productRepo;
        $this->sponsoredItemModel=$sponsoredItemModel;
    }

    public function getOccupiedDates(){
        $group = Input::get('group');
        $position = Input::get('position');
        $capacity = $this->getCapacity($position);
        $response = [];
        $response['occupiedDates'] = $this->sponsoredItemDateModel->getOccupiedDates($position,$group,$capacity);
        return Response::json($response);
    }

    public function store($slug,$productId){
        $shop = $this->shopRepo->getBySlug($slug);
        $product = $this->productRepo->getById($productId);
        if(!($shop&&$product)){
            return Response::make('Not Found', 404);
        }
        if($shop->id != $product->shop_id){
            return Response::make('Unauthorized', 401);
        }
        $img_name = $this->getImageName($shop->id,$productId,$product->name);

        try{
            $this->saveImage(Input::get('image'),$img_name);
        }catch (Exception $e){
            $response = array('status'=>'failure','message'=>$e->getMessage());
            return Response::json($response);
        }
        $title = Input::get('title');
        $subtitle = Input::get('subtitle','');
        $group = Input::get('group');
        $shortDescription = Input::get('short-description','');
        $position = Input::get('position');
        $url = URL::route('products.view',[$shop->subDomain,$productId]);
        $dates = explode(';',Input::get('boost_dates'));
        try{
            $this->sponsoredItemModel->store($title,$subtitle,$shortDescription,$productId,$url,$img_name,$position,$group,$dates);
        }catch (Exception $e){
            if($e->getCode()==420){
                $capacity = $this->getCapacity($position);
                $occupied = $this->sponsoredItemDateModel->getOccupiedDates($position,$group,$capacity);
                $response = array('status'=>'failure','message'=>$e->getMessage(),'occupied'=>$occupied);
                return Response::json($response);
            }else{
                $response = array('status'=>'failure','message'=>$e->getMessage());
                return Response::json($response);
            }
        }

        $response = array('status'=>'success');
        return Response::json($response);
    }

    protected function saveImage($img_data,$img_name){
        $data = $this->getUnsanitizeImageData($img_data);
        $uri = substr($data,strpos($data,",")+1);
        $img = Image::make($uri);
        $img->save(public_path('sp_img/'.$img_name));
    }

    protected function getUnsanitizeImageData($img_code){//@todo blame it on frozennode/xssInput
        return 'data:image/jpeg;base64,'.str_replace('[removed]','',$img_code);
    }

    protected function getImageName($shopId,$productId,$productName){
        $limited_name = str_limit($productName,10,'');
        $lower_case_name = strtolower($limited_name);
        $snaked_case_name = str_replace(' ', '_', $lower_case_name);
        $random_str = strtolower(str_random(40));
        $name = $shopId.'_'.$productId.'_'.$snaked_case_name.'_'.$random_str.'.jpg';
        return $name;
    }

    protected function getCapacity($position){
        return $this->sponsoredItemModel->getCapacityByPosition($position);
    }
}