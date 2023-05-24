<?php
//use Chorki\products\PostproductListingCommand;

use Chorki\Carts\Models\CartRepositoryInterface;
use Chorki\ProductEvents\ProductEvent;
use Chorki\products\Commands\PostProductListingCommand;
use Chorki\products\Models\ProductRepositoryInterface as Product;
use Chorki\shops\Models\Shop;
use Chorki\shops\Models\ShopRepositoryInterface;
use Chorki\themes\products\ThemeProductRepository;
use Chorki\Traits\CartTrait;
use Chorki\Validators\Product\ProductValidator;
use Illuminate\Support\Facades\DB;

class ProductsController extends \BaseController {
    Use CartTrait;
    protected $product;
    protected $shop;
    protected $productValidator;
    protected $cart;
    protected $attribute;
    protected $themeProductRepository;
    protected $productEvent;


    public function __construct(Product $product, ShopRepositoryInterface $shop,
                                ProductValidator  $productValidator,CartRepositoryInterface $cart,
                                Attribute $attribute,ThemeProductRepository $themeProductRepository,
                                ProductEvent $productEvent)
    {
        $this->product = $product;
        $this->productValidator = $productValidator;
        $this->shop = $shop;
        $this->cart = $cart;
        $this->attribute = $attribute;
        $this->themeProductRepository = $themeProductRepository;
        $this->productEvent = $productEvent;
    }

      private function moveAndRecordImages($images, $shop_id, $product_id){
        $old_directory = public_path('img_tmp');
        $old_thumb_directory = $old_directory.'/thumb';
        $new_directory = public_path().'/public_img/shop_'.$shop_id.'/products';
        $new_thumb_directory = $new_directory.'/thumb';
        if (!folder_exists($new_directory)) {
            mkdir( $new_directory, 0777, true );
        }
        if ( !folder_exists($new_thumb_directory) ) {
            mkdir( $new_thumb_directory, 0777, true );
        }
        foreach($images as $old_file_name){
            $new_file_name = $product_id.'_'.$old_file_name;
            if (rename($old_directory.'/'.$old_file_name , $new_directory.'/'.$new_file_name )
                && rename($old_thumb_directory.'/'.$old_file_name, $new_thumb_directory.'/'.$new_file_name)){
                $productImage = new ProductImage();
                $productImage->imageLink = $new_file_name;
                $productImage->product_id = $product_id;
                $productImage->save();
            }
        }
    }
    /**
     * Store a newly created product in storage.
     *
     * @return Response
     */
    public function post()
    {

        $validator = new ProductValidator();

        if($validator->passes())
        {
            $res=$this->execute(
                new PostProductListingCommand(Input::get('name'),Input::get('description'),Input::get('price'),
                     Input::get('category_id'),Input::get('subcategory_id')
                    ,Input::get('subSubCategory_id'),Input::get('stock'),Input::get('weight'),Input::get('weightunit'),Input::get('shop_id'))
            );
            if(!$res){
                return 'error';
            }
            $productId = $res->id;
            $product=$this->product->getById($productId);
            $shopID = Input::get('shop_id');

            $images = Input::get('images');
            $this->moveAndRecordImages($images,$shopID,$productId);

            $color= Input::get('color');
            $colorImage= Input::file('colorimage');
            $this->postColorImage($color,$colorImage,$productId);

            $size= Input::get('size');
            $this->saveSize($size,$product);

            $type=Input::get('label');
            $value=Input::get('value');
            $this->saveProperties($type,$value,$product);

            $data = $res;
            $shop=$this->shop->getById($shopID);
            $this->productEvent->postProduct($shop,$product);

            return Response::json(['success'=>true,
                'products'=> $data
            ]);
        }

        return Response::json(['success'=> false,'errors'=> $validator->getErrors()->toArray()]);

    }

    public function postColorImage($colors,$images,$productId, $colorid = null){
        $count=count($images);
        $shopID     = $this->shop->_getShop()->id;
        $destination = public_path() . '/public_img/shop_'.$shopID.'/products/colors';
        $thumb_destination = $destination.'/thumb';

        if (!folder_exists($destination)) {
            mkdir( $destination, 0777, true );
        }
        if ( !folder_exists($thumb_destination) ) {
            mkdir( $thumb_destination, 0777, true );
        }

        for($i=0;$i<$count;$i++){
            if(!empty($images[$i])){
                if (is_array($colorid)  && !empty($colorid[$i]) ) {
                    $productAttributeId = $colorid[$i];
                    DB::table('product_attribute')
                            ->where('id', $productAttributeId)
                            ->update(array('value' => $colors[$i])) ;
                }
                else{
                    $productAttributeId = DB::table('product_attribute')->insertGetId(
                                        array('product_id'=>$productId,'value' => $colors[$i], 'attribute_id' => 1)
                                    );
                }

                $filename   = $productId.'_'.$colors[$i].'_'.time() .uniqid(). '.' . $images[$i]->getClientOriginalExtension();
                Image::make( $images[$i]->getRealPath() )
                    ->widen( 800,null )
                    ->save( $destination .'/'. $filename, 70 );

                Image::make( $images[$i]->getRealPath() )
                        ->fit( 200 )
                        ->save( $thumb_destination .'/'. $filename, 60 );
                DB::table('product_attribute')
                        ->where('id', $productAttributeId)
                        ->update(array('image' => $filename)) ;

            }
        }
        for($i=0;$i<$count;$i++){
            if(!empty($colors[$i]) && is_array($colorid)  && !empty($colorid[$i]) && empty($images[$i]) ) {
                $productAttributeId = $colorid[$i];
                DB::table('product_attribute')
                            ->where('id', $productAttributeId)
                            ->update(array('value' => $colors[$i])) ;
            }
        }
    }

    public function saveSize($sizes,$product){
        if (is_array($sizes)) {
            foreach($sizes as $size){
                if(!empty($size)){
                DB::table('product_attribute')->insert(
                    array('product_id'=>$product->id,'value' => $size, 'attribute_id' => 2)
                );
                }
            }
        }

    }
    public function saveProperties($type,$value,$product){
        // $propertylist = array();
        $propertyType=$type;
        $propertyValue=$value;
        if (is_array($propertyType)) {
            foreach ($propertyType as $key => $typename) {
                if( $typename != '' && $propertyValue[$key] != '' ){
                    // $propertylist[$typename] = $propertyValue[$key];
                    Property::create(['type'=>$typename,'value'=>$propertyValue[$key],'product_id'=>$product->id]);

                }
            }
        }



    }
    public function show($slug,$id)
    {   $product = $this->_getProduct($id);
        $product->load('category','subCategory','images');

        

        //  $this->incrementProductHits($product);
        $shop = $product->shop;
        if( empty($shop) || !isEshopVerifiedToAppearInPublic($shop) ) {
            return Response::view('errors.404', array(), 404);
        }
        if( $product->status== 'Unpublished'){
            return Redirect::route('store.shops',$shop->getSlug());
        }

     //   $this->product->viewCount($product);
        
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
        $discountedPrice=$this->product->ProductHasGpCampaign($product);

        if($shop->theme && $shop->theme->name == 'dhumketu'){

//            $relatedProducts = $this->getRelatedProducts();

//            dd($relatedProducts);

            return View::make($shop->theme->path.'.product.product',
                compact('product','cart','attributes','shop','attributeCount','discountedPrice','categories', 'relatedProducts'));
        }




        if($shop->theme && $shop->theme->name == 'chayaneer'){

//            $relatedProducts = $this->getRelatedProducts();

//            dd($relatedProducts);

            return View::make($shop->theme->path.'.home.home',
                compact('product','cart','attributes','shop','attributeCount','discountedPrice','categories', 'relatedProducts'));
        }


        if($shop->theme){

            return View::make($shop->theme->path.'.product.product',
                compact('product','cart','attributes','shop','attributeCount','discountedPrice','categories'));
        }
        $headerSection=View::make('shops.yourshop._partials.header',compact('shop'));
        $ownProduct = false;
        if(Auth::user()&&Auth::user()->shop&&($product->shop->id == Auth::user()->shop->id)){
            $ownProduct = true;
        }

        return View::make('products._partials.show', compact('ownProduct','product','cart','headerSection','attributes','shop','attributeCount','discountedPrice'));
    }
    public function getJson(){
        // return Input::get('id');
        $product = $this->_getProduct(Input::get('id'));
        $shop=$product->shop;
        $shopID = $product->shop_id;
        $product['url'] = url('public_img/shop_'.$shopID.'/products');
        $product['singleurl'] = route('shop.products', array($shop->getSlug(),$product->id) );
        $chorkiVerification=isChorkiVerifiedMessage($shop);
        $appearPublishButton= $this->shop->publishShopIfVerificationRulesAreComplete();
        return Response::json(['product'=>$product,'chorkiVerified'=>$chorkiVerification,
                                'appearPublishButton'=>$appearPublishButton]);
    }
    public function getProductsByCategories(){

        $productquery = DB::table('products')
            ->where('shop_id', Input::get('shop_id'))
            // ->where('stock', '>', 0)
            ->where('products.status', 'like', 'Published')
            // ->whereStatus('Published')
            ->whereNull('products.deleted_at')
            ->select(
                'products.id as product_id',
                'products.name as product_name',
                'products.price',
                'products.shop_id',
                'products.status',
                'images.imageLink as images',
                'shops.slug as shop_slug',
                'shops.subDomain as shop_subdomain'
                );
        if (!empty(Input::get('category_id'))) {
            $productquery->join('categories','products.category_id','=','categories.id')
                     ->where('products.category_id', Input::get('category_id'));

        }
        if (!empty(Input::get('subcategory_id'))) {
            $productquery->leftJoin('subcategories','products.subcategory_id','=','subcategories.id')
                     ->where('products.subcategory_id', Input::get('subcategory_id'));

        }
        if (!empty(Input::get('subsubcategory_id'))) {
            $productquery->leftJoin('subsubcategories','products.subsubcategory_id','=','subsubcategories.id')
                     ->where('products.subsubcategory_id', Input::get('subsubcategory_id'));

        }
        $productquery->join('images','products.id','=','images.product_id');
        $productquery->join('shops','products.shop_id','=','shops.id');
        // $product['url'] = url('public_img/shop_'.$shopID.'/products');
        // $product['singleurl'] = route('shop.products', array($shop->getSlug(),$product->id) );
        $productresults = $productquery->get();
        $lastproduct = '';
        $treeresult = array("status"=>'success');
        foreach ($productresults as $key => $value) {
            if ($lastproduct != $value->product_id) {
                $treeresult['data'][$value->product_id] = array(
                                                            'product_id' =>  $value->product_id,
                                                           'product_name' =>  $value->product_name,
                                                           'price' =>  $value->price,
                                                           'shop_id' =>  $value->shop_id,
                                                           'status' =>  $value->status,
                                                           'images' =>  array($value->images),
                                                           'url' => url('public_img/shop_'.$value->shop_id.'/products'),
                                                           'singleurl' => route('shop.products', array($value->shop_slug,$value->product_id) ),
                                                           'singleurlpublic' => GhooriURI::producturl($value->shop_subdomain, URL::route('products.view',array($value->shop_slug,$value->product_id)), $value->product_id),

                                                        );
                $lastproduct = $value->product_id;
            }
            else {
                $treeresult['data'][$lastproduct]['images'][] = $value->images;
            }
        }

        return $_GET['callback'].'('.json_encode($treeresult).')';
    }
    public function moveCategory(){
        // return array(Input::get('category_id'),Input::get('subcategory_id'),Input::get('subSubCategory_id'));
        $product=$this->product->getById(Input::get('id'));
        $product->category_id = Input::get('category_id');
        $product->subcategory_id = Input::get('subcategory_id');
        $product->subSubCategory_id = Input::get('subSubCategory_id');
        $product->update();
        $this->productEvent->postProduct($shop,$product,true);
        $product = $this->_getProduct(Input::get('id'));
        return Response::json(array('success' => true, 'data' => $product));

        // return ['success' => true, 'data' => Input::get('newCatString')];
    }

    private function _getProduct($id){
        $product = $this->product->getById($id);
        $product->load('shop','images');
        // dd($product);
        return $product;
    }

    public function editProduct($slug,$id)
    {
        $product = $this->product->getById($id);
        $shop = $product->shop;
        $product->load('images');

        $img_directory = public_path('public_img').'/shop_'.$product->shop_id.'/products';
        $thumb_directory = $img_directory.'/thumb';
        $tmp_img_directory = public_path('img_tmp');
        $tmp_thumb_directory = $tmp_img_directory.'/thumb';
        $attributes=$this->attribute->getAttr($id);

        $images = array();
        foreach($product->images as $image){
            $imageLink = $image->imageLink;
            copy($img_directory.'/'.$imageLink,$tmp_img_directory.'/'.$imageLink);
            copy($thumb_directory.'/'.$imageLink,$tmp_thumb_directory.'/'.$imageLink);
            $images[] = $imageLink;
        }
        $product['weight']=$this->getProcessedWeight($product);
        if(Auth::user() && Auth::user()->shop && ($product->shop_id == Auth::user()->shop->id)){
            return View::make('products.edit', compact('product','shop','images', 'attributes', 'edit'));
        }

        App::abort(403, 'Unauthorized action.');

    }

    public function update($id)//in use 12/2015
    {
        $input= Input::all();
        $shop= $this->shop->_getShop();
        $product = $this->product->getById($id);
        $product->load('images');

        $validator = new ProductValidator();

        if($validator->passes()) {

            $oldImages = array();
            foreach($product->images as $image){
                $imageLink = $image->imageLink;
                $oldImages[] = $imageLink;
            }

            $new_images = array_diff(Input::get('images'),$oldImages);
            $deleted_images = array_diff($oldImages,Input::get('images'));//@todo delete these

            foreach($deleted_images as $deletee){
                ProductImage::where('imageLink',$deletee)->delete();
            }
            $this->moveAndRecordImages($new_images,$product->shop_id,$product->id);
            $this->updateRequiredProductFields($product,$input);
            $this->updateProductProperties($product,Input::get('label'),Input::get('value'));
            $this->updateColorImage( Input::get('color'), Input::file('colorimage'), Input::get('colorid'), $product );
            $this->updateSize(Input::get('size'),$product);
            $product->weight=$this->product->processWeight($input['weight'],$input['weightunit']);
            $product->update();
            $this->productEvent->postProduct($shop,$product,true);
            return Redirect::route('shops.show',$shop->getSlug())
                ->with('flash_message', '<b>Well done!</b> Successfully Updated.')
                ->with('flash_type', 'alert-success');
        }
        else{
            return Redirect::back()
                ->withInput()
                ->withErrors($validator->getErrors());
        }

    }

    public function updateColorImage($colors,$images,$colorid,$product){
        /*dd($product->attributes->toArray());*/

        if($product->attributes->count()){
            foreach($product->attributes as $key => $color){
                if($color->type== 'color') {
                   // echo "\n".$color->pivot->id;
                    if($colorid == null){
                        $colorid = array();
                    }
                    if (is_array($colorid)) {
                        if ( in_array($color->pivot->id, $colorid)) {
                                                // echo "\ntrue";
                        }
                        else {
                            // echo "\nfalse";
                            // $img_directory = public_path('public_img').'/shop_'.$product->shop_id.'/products/colors/';
                            // $thumb_directory = $img_directory.'/thumb/';
                            // File::delete($img_directory.$color->pivot->image);
                            // File::delete($thumb_directory .$color->pivot->image);
                            DB::table('product_attribute')->whereid($color->pivot->id)->delete();
                        }
                    }

                }
            }
        }        
        $this->postColorImage($colors,$images,$product->id, $colorid);
    }
    public function destroy($id)//in use 12/2015
    {
        $product= $this->product->getById($id);
       /* $img_directory = public_path('public_img').'/shop_'.$product->shop_id.'/products/';
        $thumb_directory = $img_directory.'/thumb/';
        foreach($product->images as $image){
            File::delete($img_directory.$image->imageLink);
            File::delete($thumb_directory .$image->imageLink);
        }*/
        $this->product->delete($id);
        $product->status= 'Unpublished';
        $product->save();
        $shop = $this->shop->_getShop();
        $this->productEvent->postProduct($shop,$product);
        $this->unPublishShopIfThereIsNoProduct($shop);

        return Redirect::route('shops.show',$shop->getSlug());
    }

    public function postProductImage(){
        //@todo does not require delete later
        dd('Bam!!'); // if there is no problem after 3/2016 safely delete it - arafat
        $shopID     = Session::get('shop_id');

        $image      = Input::file('file');
        $filename   = time() .uniqid(). '.' . $image->getClientOriginalExtension();

        $destination = public_path() . '/public_img/shop_'.$shopID.'/products/temp';
        if (!folder_exists($destination)) {
            mkdir( $destination, 0777, true );
        }
        $productImage = new ProductImage();
        $productImage->imageLink =  $filename;
        $productImage->tempKey = Input::get('ch_pd_key');
        Image::make( $image->getRealPath() )
            ->widen( 800,null )
            ->save( $destination .'/'. $filename, 70 );
        $productImage->save();

        if( $productImage ) {
            $response = array(
                'status' => 'success',
                'productImage' => $productImage
            );
            return Response::json( $response );
        }
    }


    public function getEdit($productId){
        $product = $this->product->getById($productId);
        if($product){

            $response = array(
                'status' => 'success',
                'product' => $product
            );

            return Response::json( $response );

        }
    }

    public function postEdit(){

        $productId = Input::get('product_id');
        $product = $this->product->getById($productId);
        $product->name = Input::get('name');
        $product->description = Input::get('description');
        $product->price = Input::get('price');

        if($product->update()){

            $response = array(
                'status' => 'success',
                'msg' => 'Product Inserted Successfully',
                'product' => Input::all()
            );

            return Response::json( $response );

        } else {
            $response = array(
                'status' => 'success',
                'msg' => 'Product Update Fail',
                'product' => Input::all()
            );
            return Response::json( $response );
        }

    }

    public function changeProductStatus(){

        $product = $this->product->getById( Input::get('productId'));

        if($product->status == 'Unpublished')
        {
            $product->status = 'Published';
            $product->update();
            $response = array(
                'status' => 'success',
                'msg' => 'Published',
                'product' => $product->id
            );
            $this->productEvent->postProduct($product->shop,$product);
            return Response::json( $response );
        }
        else{
            $product->status = 'Unpublished';
            $product->update();
            $response = array(
                'status' => 'fail',
                'msg' => 'UnPublished',
                'product' => $product->id
            );
            $this->productEvent->postProduct($product->shop,$product);
            return Response::json( $response );

        }

    }

    public function getRelatedProducts(){
        $data = $this->product->getRelatedProducts(Input::all());
        return Input::get('callback').'('.json_encode($data).')';
        
    }

    private function updateRequiredProductFields($product,$input)
    {
        $product->name= $input['name'];
        $product->description = $input['description'];
        $product->price = $input['price'];
        $product->stock= $input['stock'];
        $product->weightunit = $input['weightunit'];
        $product->shop_id= $input['shop_id'];
    }
    private function updateProductProperties($product, $type ,$value)
    {
        if($product->properties->count()){
            foreach($product->properties as $property){
                $property->delete();
            }
        }
        $this->saveProperties($type,$value,$product);
    }
    private function updateSize($sizes,$product){

        foreach($product->attributes as $size){
            if($size->type == 'size'){
                $size->pivot->delete();
            }
        }
        if(!empty($sizes)){
            $this->saveSize($sizes,$product);
        }

    }

    private function unPublishShopIfThereIsNoProduct($shop)
    {
       $numberOfProduct= $this->product->totalItemsForShop($shop->getSlug());
        if($numberOfProduct ==0){
        $this->shop->unPublishShopIfVerificationRulesAreNotComplete();
        }
    }

    private function getProcessedWeight($product)
    {
     if($product->weightunit == 'kg'){
         return $weight= $product->weight/1000;
     }
     else{
         return $product->weight;
     }
    }

    private function incrementProductHits($product)
    {
        $product->hits +=1;
        $product->save();
    }


}

