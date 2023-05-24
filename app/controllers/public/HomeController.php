<?php

use Carbon\Carbon;
use Chorki\Carts\Models\CartRepositoryInterface;
use Chorki\shops\Models\ShopRepositoryInterface as Shop;
use Chorki\products\Models\ProductRepositoryInterface as Product;
use Chorki\WinterIsHereRepository;

class HomeController extends \BaseController {
    protected $cart;
    protected $sponsoredItemModel;
    protected $sponsoredItemDateModel;
    private $catMap;
    private $catMapWithName;

    protected $winterIsHereRepository;

    function __construct(CartRepositoryInterface $cart, SponsoredItem $sponsoredItemModel, SponsoredItemDate $sponsoredItemDateModel, WinterIsHereRepository $winterIsHereRepository)
    {

        $this->cart = $cart;
        $this->sponsoredItemModel= $sponsoredItemModel;
        $this->sponsoredItemDateModel= $sponsoredItemDateModel;
        $this->winterIsHereRepository = $winterIsHereRepository;

        $this->catMap = array(
            'for_her'   => array(
                            'salwar kamiz'  => array('salwar+kamiz','salwar+kameez' ),
                            'saree'         => array('saree','sharee' ),
                            'cosmetics'     => array('cosmetics','cream','shampoo', 'lipstick' ),
                            'purse'         => array('purse','bag' ),
                            'ornaments'     => array('jewelary','ornaments','ring','ear+ring' ),
                            'kurti'         => array('kurti' ),
                            'sandal'      => array('sandal' ),
                            'sunglass'      => array('sunglass' ),
                            'innerwear'      => array('lingerie','bra', 'panty','nighty' ),
                        ),
            'for_him'   => array(
                            'pants'         => array('pants'   ),
                            'tshirt'        => array('tshirt', 't+shirt'  ),
                            'shirt'         => array('shirt'   ),
                            'watch'         => array('watch'   ),
                            'shoe'          => array('shoe'    ),
                            'perfume'       => array('perfume' ),
                            'shorts'        => array('shorts'  ),
                            'panjabi'       => array('panjabi' ),
                            'sunglass'      => array('sunglass','sunglasses'),
                            'accessories'   => array('belt','wallet','moneybag','tie'),
                            'innerwear'      => array('underwear','boxer' ),

                            ),
            'for_kids'  => array(
                            'books'         => array('books', 'kid+books'),
                            'boy cloth'     => array('boy+shirt', 'kid+shirt'),
                            'girl cloth'    => array('girl+dress', 'kid+dress')  ,
                            'toy'           => array('toy'),
                            'baby care'     => array('baby+care')  ,   
                            'baby shoe'     => array('kid+shoe')  ,   
                ),
            'gadgets'  => array(
                            'smartphone'       => array('smartphone'  , 'mobile'),
                            'tab'               => array('tab'  , 'tablet'),
                            'smartwatch'        => array('smartwatch'),
                            'headphone'         => array('headphone', 'earbud'),
                            'mobile case/cover' => array('mobile+case', 'mobile+cover'),
                            'powerbank'         => array('powerbank'   , 'power+bank'),
                            'accessories'       => array('accessories'   , 'selfie', 'battery'),  
                ),
            'home_and_decor'  => array(
                            'kitchen and dining ' => array('kitchen','dining ' ),
                            'home appliance '   => array('home+appliance','fridge'    ),
                            'furniture'         => array('furniture','sofa', 'chair', 'table' ),
                            'tools and kits '     => array('tools','kits' ),
                            'toilet '           => array('toilet', 'air+freshner', 'soap', 'shampoo'   ),
                            'stationaries '     => array('stationaries','pen','pencil' ),
                ),

        );
        
        $this->catMapWithName = array(
            'Fashion'   => array(
                            'Mens Wear'  => array(
                                'category_name' => array('Clothing'),
                                'subcategory_name' => array('Mens Wear'),
                                'subsubcategory_name' => array('Blazer & Jackets', 'Jeans and Pants', 'Male Hoodies', 'Male Undergarment', 'Polo', 'Shirt', 'Shorts', 'Suits', 'Sweaters', 'T shirts', 'Panjabi'),
                            ),
                            'Womens Wear'  => array(
                                'category_name' => array('Clothing'),
                                'subcategory_name' => array('Womens Wear'),
                                'subsubcategory_name' => array('Hoodies','Jacket','Kurtis', 'Lahenga', 'Nightwear', 'Pants And Tights', 'Sarees', 'Shrugs', 'Sweater', 'T shirts tops', 'Undergarments', 'Unstitched Fabrics', 'Women\'s Dresses'),
                            ),

                            'Jewellery'  => array(
                                'category_name' => array('Jewellery'),
                                'subcategory_name' => array('Bangels and Bracelets', 'Earring', 'Jwellery Set', 'Necklace', 'Rings'),
                            ),
                            'Mens Footwear'  => array(
                                'category_name' => array('Footwear'),
                                'subcategory_name' => array('Mens'),
                                'subcategory_name' => array('Boots','Loafer', 'Men\'s formal shoes','Slippers & sandals', 'Sneaker & casual', 'Sports shoes')
                            ),                            
                            'Womens Footwear'  => array(
                                'category_name' => array('Footwear'),
                                'subcategory_name' => array('Womens'),
                                'subcategory_name' => array('Boots','Flats & sandals','Heels', 'Sneaker', 'Traditional wear')
                            ),
                            'Mens Watches'  => array(
                                'category_name' => array('Watches'),
                                'subcategory_name' => array('Male'),
                                'subcategory_name' => array('Designer Watches','Regular Watch','Smartwatch')
                            ),                            
                            'Womens Watches'  => array(
                                'category_name' => array('Watches'),
                                'subcategory_name' => array('Female'),
                                'subcategory_name' => array('Designer Watches','Regular Watch','Smartwatch')
                            ),
                            'Mens Glasses'  => array(
                                'category_name' => array('Watches'),
                                'subcategory_name' => array('For Men'),
                            ),                            
                            'Womens Glasses'  => array(
                                'category_name' => array('Watches'),
                                'subcategory_name' => array('For Women'),
                            ),

                            
                        ),
            'health_n_beauty'   => array(
                          
                    'Cosmetics'  => array(
                        'category_name' => array('Health and beauty'),
                        'subcategory_name' => array('Cosmetics'),
                        'subsubcategory_name' => array('Eyes', 'Face makeup', 'Lips', 'Nails'),
                    ),      
                    'Hair Care'  => array(
                        'category_name' => array('Health and beauty'),
                        'subcategory_name' => array('Hair Care'),
                        'subsubcategory_name' => array('Hair dryer & straightener', 'Other hair care products & Accessories', 'Shampoo & Conditioner', 'Shaver & Trimmer'),
                    ),
                    'Medicine Health Care'  => array(
                        'category_name' => array('Health and beauty'),
                        'subcategory_name' => array('Medicine & Health Care'),
                        'subsubcategory_name' => array('Fitness', 'Medicine'),
                    ), 
                    'Perfumes'  => array(
                        'category_name' => array('Health and beauty'),
                        'subcategory_name' => array('Perfumes'),
                        'subsubcategory_name' => array('Deodorant', 'Men\'s Perfume','Women\'s perfumes'),
                    ),

                    'Skin care'  => array(
                        'category_name' => array('Health and beauty'),
                        'subcategory_name' => array('Skin care'),
                        'subsubcategory_name' => array('Bath and body care','Facial care'),
                    ),
                ),
            'Electronics' => array(
                'Computer Accessories' => array(
                    'category_name' => array('Computers'),
                    'subcategory_name' => array('Computer Accessories'),
                    'subsubcategory_name' => array('Cables','CD and DVD','Mouse and keyboard','Other Computer Accesories','Software','Speaker and Headset','Storage device','Webcams'),
                    ),
                'Desktop PCs' => array(
                    'category_name' => array('Computers'),
                    'subcategory_name' => array('Desktop PCs'),
                    'subsubcategory_name' => array('All in one desktop','Desktop CPUs','Graphics card','Monitors','Motherboard','Processor','Servers'),
                    ),

                'Laptops' => array(
                    'category_name' => array('Computers'),
                    'subcategory_name' => array('Laptops'),
                    'subsubcategory_name' => array('Laptop bags and accesories','Mac Books','Net Books','Note books','Ultrabooks'),
                    ),
                'Printer and Scanner' => array(
                    'category_name' => array('Computers'),
                    'subcategory_name' => array('Printer & Scanner'),
                    'subsubcategory_name' => array('Printer','Scanner','Tools and accesories'),
                    ),

                'Audio' => array(
                    'category_name' => array('Electronics'),
                    'subcategory_name' => array('Audio'),
                    'subsubcategory_name' => array('HD Multimedia Speakers','Headphones','Mp3 Mp4 Player','Portable Speakers'),
                    ),
                'Camera' => array(
                    'category_name' => array('Electronics'),
                    'subcategory_name' => array('Camera'),
                    'subsubcategory_name' => array('Camera Accessories','Digital Camera','Professional DSLR Camera','Surveillance','Video Camera'),
                    ),
                'Gaming' => array(
                    'category_name' => array('Electronics'),
                    'subcategory_name' => array('Gaming'),
                    'subsubcategory_name' => array('Console','Gaming Accessories','Nintendo Games','Pc games','Playstation games','Video Games','Xbox games'),
                    ),
                'Other Electronics' => array(
                    'category_name' => array('Electronics'),
                    'subcategory_name' => array('Other Electronics'),
                    ),
                'Power Banks' => array(
                    'category_name' => array('Electronics'),
                    'subcategory_name' => array('Power Banks'),
                    ),
                'Tv & Video' => array(
                    'category_name' => array('Electronics'),
                    'subcategory_name' => array('Tv & Video'),
                    'subsubcategory_name' => array('3D TVs','CD DVD Player','LCD TV','LED TV','Portable media devices','Projectors','TV','Tv accessories'),
                    ),
                'Mobile Accessories' => array(
                    'category_name' => array('Mobiles & Tablets'),
                    'subcategory_name' => array('Cases','Charger,BAtteries etc'),
                    ),
                'Mobile' => array(
                    'category_name' => array('Mobiles & Tablets'),
                    'subcategory_name' => array('Mobile'),
                    ),
                'Tabs' => array(
                    'category_name' => array('Mobiles & Tablets'),
                    'subcategory_name' => array('Tabs'),
                    ),
                ),
            'home-n-living'  => array(
                    'Furniture'  => array(
                        'category_name' => array('Home & Living'),
                        'subcategory_name' => array('Furniture' ),
                        'subcategory_name' => array('Bedroom furniture', 'Dining room furniture', 'Livingroom Furniture', 'Offfice furniture', 'Outdoor furniture' ),
                    ),
                    'Gardening'  => array(
                        'category_name' => array('Home & Living'),
                        'subcategory_name' => array('Gardening' ),
                    ),
                    'Home Appliances'  => array(
                        'category_name' => array('Home & Living'),
                        'subcategory_name' => array('Home Appliances' ),
                        'subcategory_name' => array('Air Conditioner', 'Electric Fan','Heater',  'Insect killer',   'Irons',   'Loghting and Generator',  'Telephones',  'Tools',   'Vaccum cleaner',  'Washing Machine')
                   ),
                    'Home decor'  => array(
                        'category_name' => array('Home & Living'),
                        'subcategory_name' => array('Home decor' ),
                        'subcategory_name' => array('Bathroom accessories',    'Carpet rugs mats',    'Clock',   'Curtains',    'Decoration pieces',   'Painting & Poster',   'Pillow and bedsheet')
                   ), 
                    'Kitchen Dining'  => array(
                        'category_name' => array('Home & Living'),
                        'subcategory_name' => array('Kitchen & Dining' ),
                        'subcategory_name' => array('Blender & Mixer', 'Coffee machine & Accessories',    'Crockery',    'Cutlery ','Electric kettle', 'Kitchen accessories', 'Microwave oven',  'Refrigerator and freezers',   'Water Dispencer',)
                   ),


                ),
            'for_kids'  => array(
                    'Baby accesories'  => array(
                        'category_name' => array('Toys, Kids & Babies'),
                        'subcategory_name' => array('Baby accesories'),
                    ), 
                    'Baby food'  => array(
                        'category_name' => array('Toys, Kids & Babies'),
                        'subcategory_name' => array('Baby food'),
                    ), 
                    'Baby products'  => array(
                        'category_name' => array('Toys, Kids & Babies'),
                        'subcategory_name' => array('Baby products'),
                    ),
                    'Pregnancy and maternity'  => array(
                        'category_name' => array('Toys, Kids & Babies'),
                        'subcategory_name' => array('Pregnancy and maternity'),
                    ),
                    'Board games and Puzzels'  => array(
                        'category_name' => array('Toys, Kids & Babies'),
                        'subcategory_name' => array('Board games and Puzzels'),
                    ),
                    'Dolls and stuffed toys'  => array(
                        'category_name' => array('Toys, Kids & Babies'),
                        'subcategory_name' => array('Dolls and stuffed toys'),
                    ),

                    'Gifts'  => array(
                        'category_name' => array('Toys, Kids & Babies'),
                        'subcategory_name' => array('Gifts'),
                    ),
                    'Other toys'  => array(
                        'category_name' => array('Toys, Kids & Babies'),
                        'subcategory_name' => array('Other toys'),
                    ),
                ),

            'Others'  => array(
                    'Books Media'  => array(
                        'category_name' => array('Books & Media'),
                        'subcategory_name' => array('Books', 'Magazines', 'Movies and DVD', 'Music', 'Stationary', 'Comic' ),
                    ),
                    'Food and Beverage'  => array(
                        'category_name' => array('Food and Beverage'),
                    ),
                    'Service'  => array(
                        'category_name' => array('Service'),
                        'subcategory_name' => array('Catering Service', 'Event Management', 'Consultency', 'Food & Restaurant', 'Travelling', 'Photography', 'Training & Developement'),
                    ),
                    'Everything else'  => array(
                        'category_name' => array('Other Catagories'),
                        'subcategory_name' => array('Appliance', 'Building Materials', 'Collectibles', 'Everything else', 'Musical Instruments', 'Office & School', 'Art'),
                    ),
                            
                ),

        );

    }

	public function getHomeGroup(){
		
		$todaysad = $this->sponsoredItemModel->with('dates')->whereHas('dates',function($q){
            $q->where('date', '=', Carbon::today() )->whereNull('deleted_at');
          })->with('product')->where('reviewStatus', '=', 'accepted')->where('group', '=', Input::get('group') )->whereHas('product',function($q)
        {
            $q->where('status', '=', 'Published')->whereHas('shop', function($qs) {
                $qs->where('status', '=', 'Published');
            });

        })->get();
        // $forherpromoted
        // dd($todaysad);
        $todaysmain = array();
        foreach ($todaysad as $key => $item) {
            // var_dump($item->position);
            $todaysmain[$item->position][] = $item;
        }

        if (empty( $todaysmain['large_ad'] ) || count($todaysmain['large_ad']) < 5) {
        	if(empty($todaysmain['large_ad'])) {
        		$adcount = 0;
        	} else {
        		$adcount = count($todaysmain['large_ad']);
        	}
        	$promotedads = PromotedItem::where('group', '=', Input::get('group') )->where('isActive', '=', '1' )->where('position', '=', 'large_ad' )->take( 5 - $adcount )->get();

        	foreach ($promotedads as $key => $item) {
	            // var_dump($item->position);
	            $todaysmain[$item->position][] = $item;
	        }
        }
        if (empty( $todaysmain['medium_ad'] ) || count($todaysmain['medium_ad']) < 1) {
        	if(empty($todaysmain['medium_ad'])) {
        		$adcount = 0;
        	} else {
        		$adcount = count($todaysmain['medium_ad']);
        	}
        	$promotedads = PromotedItem::where('group', '=', Input::get('group') )->where('isActive', '=', '1' )->where('position', '=', 'medium_ad' )->take( 1 )->get();

        	foreach ($promotedads as $key => $item) {
	            // var_dump($item->position);
	            $todaysmain[$item->position][] = $item;
	        }
        }
        if ( empty( $todaysmain['small_ad'] ) || count($todaysmain['small_ad']) < 4) {
        	if(empty($todaysmain['small_ad'])) {
        		$adcount = 0;
        	} else {
        		$adcount = count($todaysmain['small_ad']);
        	}
        	$promotedads = PromotedItem::where('group', '=', Input::get('group') )->where('isActive', '=', '1' )->where('position', '=', 'small_ad' )->take( 4 - $adcount )->get();

        	foreach ($promotedads as $key => $item) {
	            // var_dump($item->position);
	            $todaysmain[$item->position][] = $item;
	        }
        }
        if( count($todaysmain) > 0 )
        	return json_encode(array('success'=>true,'data'=>$todaysmain));
        else return json_encode(array('success'=>false));
        die();
	}
	
    public function  getProducts() {
        
        $group = Input::get('group', 'for_her');
        $cat = Input::get('cat', 'salwar kamiz');
        $page = Input::get('page', 1);
        $query = $this->getQueryParams($group,$cat);
        $results = $this->getResults($query, $page);

        $paged_query = array_except(Input::query(), Paginator::getPageName());

        $resultWithPagination = Paginator::make($results->response->docs, $results->response->numFound, 12);
        $resultWithPagination->appends($paged_query);
        // dd($group);
        // $params['group']  = $group;
        // dd($forhermain);
        $cartCount = $this->cart->cartCount();
        $cartContents = $this->cart->cartContent();
        $cartTotal = $this->cart->cartTotal();
        $cart = View::make('_partials.cart',compact('cartCount','cartContents','cartTotal'));
        // return View::make('shops.index',compact('shops','cart', 'featuredShops','newestShops','newestProducts','featuredProducts','highestViewedProducts','highestSoldProducts'));
        return View::make('shops.products',compact('cart'))
           ->withFound($results->response->numFound)
               ->withResults($results->response->docs)
               ->withPage($resultWithPagination)
               ->withCat($cat)
               ->withGroup($group);
    }

    public function  getMoreProducts() {

        if (!empty(Input::get('url'))) {
            $datastr = Input::get('url');
            $datastr[0] = '';
            $datastr =      trim($datastr);
            $output_array = array();
            parse_str($datastr, $output_array);
            $group = $output_array['group'];
            $cat = $output_array['cat'];
        }
        else {
            $group = 'for_her';
            $cat = 'salwar kamiz';
        }
        // return json_encode($output_array);
        
        $page = Input::get('page', 1);

        $query = $this->getQueryParams($group,$cat);
        $results = $this->getResults($query, $page);

        $paged_query = array_except(Input::query(), Paginator::getPageName());

        // $resultWithPagination = Paginator::make($results->response->docs, $results->response->numFound, 12);
        // $resultWithPagination->appends($paged_query);

        $simpleResult = array();
        foreach($results->response->docs as $key => $item) {
            $simpleResult[$key]['url'] = $item->url[0];
            $simpleResult[$key]['image'] = $item->image[0];
            $simpleResult[$key]['title'] = $item->title[0];
            $simpleResult[$key]['price'] = $item->price[0];
            $simpleResult[$key]['shopTitle'] = $item->shopTitle[0];
        }
                                             
        return json_encode(array('numFound'=>count($simpleResult),'page' =>$page, 'result'=> $simpleResult));
    }

    private function getResults($keyword, $page) {
        $json = file_get_contents($this->getTheUrl($keyword,$page));
        $obj = json_decode($json);
        return $obj;
    }

    private function getTheUrl($query, $page=1) {
       $start = ($page - 1) * 12;
       $url = 'http://103.239.252.141:8983/solr/chorkiSearch/chorki_all_term?q='.$query
       .'&start='.$start.'&rows=12';
       // dd($url);
       return $url;
   }
// http://103.239.252.141:8983/solr/chorkiSearch/select?q=discountpercentage%3A*&start=0&rows=24&wt=json&indent=true
   private function queryuglify($query) {
       return urlencode($query);
   }

   private function getQueryParams($group, $keyword) {
        // dd();
    if (!empty($this->catMap[$group][$keyword])) {
        return implode('+', $this->catMap[$group][$keyword]);
    }
    else {
        return $this->queryuglify($keyword);
    }
    
   }

   public function getDealsPage()
   {
        $deals = $this->getSomeDeals('obj');
        
        return View::make('shops.deals')
               ->withResults($deals);
   }
   public function getDFDealsPage()
   {
        $deals = $this->getSomeDeals('obj');
        
        return View::make('shops.dfdeals')
               ->withResults($deals);
   }
   public function getSomeDeals($ret = 'json')
   {
    // dd($ret);
       $hotDeals = $this->winterIsHereRepository->getDiscountedProductsForWinterCampaignWithPaginate();
       // dd($hotDeals->toArray());
       if ($ret == 'json') {
           return json_encode($hotDeals->toArray());
       }
       else
            return $hotDeals;
   }
   public function getPoaBaroPage()
   {
        $group = Input::get('group', null);
        $cat = Input::get('cat', null);
        $page = Input::get('page', 1);
        $discount = Input::get('discount', null);
        

        $results = $this->getMorePoaBaro('obj');

        $paged_query = array_except(Input::query(), Paginator::getPageName());

        $resultWithPagination = Paginator::make($results->response->docs, $results->response->numFound, 12);
        $resultWithPagination->appends($paged_query);
        // dd($group);
        // $params['group']  = $group;
        // dd($forhermain);

        // return View::make('shops.index',compact('shops','cart', 'featuredShops','newestShops','newestProducts','featuredProducts','highestViewedProducts','highestSoldProducts'));
        return View::make('shops.poabaro')
           ->withFound($results->response->numFound)
               ->withResults($results->response->docs)
               ->withPage($resultWithPagination)
               ->withCat($cat)
               ->withDiscount($discount)
               ->withGroup($group);

   }
   public function savePoaBaroReg()
   {
        if ( Input::get('fullname') && Input::get('email') ) {
            $campaignReg = new CampaignReg;

            $campaignReg->name = trim( Input::get('fullname') ) ;
            $campaignReg->email = trim( Input::get('email') );
            $campaignReg->phone = trim( Input::get('phone') );
            $campaignReg->campaignname = 'poabaro';

            $campaignReg->save();

            return Redirect::route('poabaropage')
            ->with('auth_flash_message', 'রেজিস্ট্রেশনের জন্য ধন্যবাদ')
            ->with('flash_type', 'alert-success');
        }
        else {
            return Redirect::back()->withInput()->with('auth_flash_message', 'দুঃখিত, আবার চেষ্টা করুন।')
                ->with('flash_type', 'alert-danger');
        }
        
        // return View::make('shops.poabaro');

        
   }

    public function getMorePoaBaro($ret = 'json'){
        $param_array = array();
        if (!empty(Input::get('url'))) {
            $datastr = Input::get('url');
            $datastr[0] = '';
            $datastr =      trim($datastr);            
            parse_str($datastr, $param_array);
            
            // return json_encode($param_array);
        }
        elseif (!empty(Input::get('group')) || !empty(Input::get('cat')) || !empty(Input::get('discount')) ) {
            $group = Input::get('group', null);
            $cat = Input::get('cat', null);
            $discount = Input::get('discount', null);
            $param_array = compact('group', 'cat', 'discount');
            // dd($param_array);
        }
        
        $page = Input::get('page', 1);
        $data = $this->getDiscountedProducts($param_array, $page);
        if ($ret == 'json') {
            return json_encode($data->response);
        }
        else {
            return $data;
        }
    }

    private function getDiscountedProducts($param_array, $page) {
        $json = file_get_contents($this->getTheDiscountUrl($param_array,$page));
        $obj = json_decode($json);
        return $obj;
    }

    private function getTheDiscountUrl($param_array, $page=1) {
       $start = ($page - 1) * 24;
       $query = $this->buildDiscountQuery($param_array);
       $url = 'http://103.239.252.141:8983/solr/chorkiSearch/chorki?q='.$query.'&start='.$start.'&rows=24&wt=json&indent=true';
       
       // dd($url);
       return $url;
    }

    private function buildDiscountQuery($param_array = []) {
        // var_dump($param_array);
        $qString = '';
        // $qString = 'campaign_active:0 AND ';

        if (!empty($param_array['discount'])) {
            $qString .= 'discountpercentage:'.$param_array['discount'];
        }
        else $qString .= 'discountpercentage:*';

        if (!empty($param_array['group']) && !empty($param_array['cat'])) {
            // var_dump($this->catMapWithName[$param_array['group']][$param_array['cat']]);
            try {
                foreach ($this->catMapWithName[$param_array['group']][$param_array['cat']] as $catlevel => $catarray) {

                    if(is_array($catarray)) {
                        $qString .= ' AND (';
                            // var_dump($catarray);
                        foreach ($catarray as $catindex => $catsingle) {
                            $qString .= $catlevel.':"'.$catsingle.'"';
                            // var_dump([count($catarray) - 1, $catindex]);
                            if (count($catarray) - 1 != $catindex) {
                                $qString .= ' OR ';
                            }
                            
                        }
                        $qString .= ')';
                    }
                    
                }
            } catch (Exception $e) {
                // dd($e);
            }
            
        }


        // dd($qString);

        return urlencode($qString);
    }
// 
    public function getHome() {
        return View::make('home.index');
    }



}