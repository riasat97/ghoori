<?php
use Illuminate\Support\Facades\Cache;

if (!function_exists('folder_exists')) {
	function folder_exists($folder) {
	    // Get canonicalized absolute pathname
	    $path = realpath($folder);

	    // If it exist, check if it's a directory
	    return ($path !== false AND is_dir($path)) ? $path : false;
	}


}
if (!function_exists('isPublished')) {
	function isPublished($shop) {
		if ($shop->status == "Published") {
			return true;
		}
		else {
			return false;
		}

	}
}
if (!function_exists('isChorkiVerifiedMessage')) {
    function isChorkiVerifiedMessage($shop){
    if($shop->chorkiVerified == 0 &&$shop->isVerified == 1 &&$shop->emailVerified == 1
        && $shop->logo && $shop->banner
        && $shop->products->count()){
        return true;
    }
    else{
        return false;
    }

    }
}
if (!function_exists('isChorkiVerified')) {
    function isChorkiVerified($shop){
        if($shop->chorkiVerified == 1){
            return true;
        }
        else{
            return false;
        }

    }
}

if (!function_exists('isEmailVerified')) {
    function isEmailVerified($shop){
        if($shop->emailVerified == 1){
            return true;
        }
        else{
            return false;
        }

    }
}
if (!function_exists('isEshopVerifiedToAppearInPublic')) {
    function isEshopVerifiedToAppearInPublic($shop){
        if( !empty($shop) && $shop->chorkiVerified == 1 &&
             $shop->status == "Published"
            ){
            return true;
        }
        else{
            return false;
        }

    }
}
if (!function_exists('isEshopVerifiedToShowShopStatusBtn')) {
    function isEshopVerifiedToShowShopStatusBtn($shop){
        if  ($shop->isVerified == 1 &&$shop->emailVerified == 1
            && $shop->logo && $shop->banner
            && $shop->products->count()  ){
            return true;
        }
        else{
            return false;
        }

    }
}
if (!function_exists('addhttp')) {
    function addhttp($url) {
        if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
            $url = "http://" . $url;
        }
        return $url;
    }
}

if (!function_exists('fix_url_https')) {
    function fix_url_https($url) {
        return (substr($url, 0, 7) == 'http://' || substr($url, 0, 8) == 'https://')
            ? $url 
            : 'https://'.$url;
    }
}

if(!class_exists('Gravatar')){
    class Gravatar
    {
        /**
        * Function to generate the Gravatar image tag.
        *
        * @param $email_address
        * @param null $firstname
        * @param null $surname
        * @param string $size
        *
        * @return string
        */
        public static function image( $email_address , $size = '50', $firstname = null , $surname = null )
        {
            if ( $firstname && $surname ){
                $alt_text = $firstname . ' ' . $surname;
            } else {
                $alt_text = 'Gravatar for ' . $email_address;
            }
            return '<img src="'.self::imageURL($email_address , $size, $firstname, $surname).'" alt="'.$alt_text.'"/>';
        }


        public static function imageURL( $email_address = null , $size = '50', $firstname = null , $surname = null )
        {
            if($email_address == null) {
                return asset('img/user.png');
            }
            $hash = md5( strtolower( trim( $email_address ) ) );
            $url = 'https://www.gravatar.com/avatar/'.$hash.'?s=' . $size.'&d='.urldecode('https://myspace.com/common/images/user.png');

            return $url;
        }
    }
}
if (!function_exists('shopHasGpCampaign')) {

    function shopHasGpCampaign($shopId)
    {
        $shop = \Chorki\shops\Models\Shop::find($shopId);
        $shopHasGpCampaign = $shop->campaigns()->where('campaigns.id',1)->first();
        if ($shopHasGpCampaign && $shopHasGpCampaign->active) {

            return true;
        } else {
            return false;
        }
    }
}
if (!function_exists('productHasGpCampaign')) {
    function productHasGpCampaign($productId)
    {
        $product = \Chorki\products\Models\Product::find($productId);
        $productHasCampaign = $product->campaigns()->where('campaigns.id',1)->first();
        if ($productHasCampaign && $productHasCampaign->active) {
            $discount = $product->price * 10 / 100;
            return $discountedPrice = round($product->price - $discount);
        } else {
            return false;
        }
    }
}
if (!function_exists('AcceptedOrderRejectionStatusToRejectParcel')) {

    function AcceptedEcourierStatusToRejectParcelByCustomer()
    {
        return ['S0'=>'Order Submitted','S1'=>'Awaiting to pickup','S8'=>'API request processing',
        'S10'=>'Request processing'];
    }
}
if (!function_exists('lastDayOfTheMonth')) {
    function lastDayOfTheMonth($year=null,$month=null,$day=null) {
        return Carbon\Carbon::createFromDate($year,$month,$day)->daysInMonth;
    }
}
if (!function_exists('isSamePackage')) {
    function isSamePackage($shop,$id) {
        if ($shop->package_id == $id) {
            return true;
        }
        else {
            return false;
        }
    }
}
if (!function_exists('ownChannel')) {
    function ownChannel() {
       return ['0'=>0,'1'=>99];
    }
}

if (!function_exists('facebookShopFee')) {
    function facebookShopFee() {
        return ['0'=>0,'1'=>99];
    }
}

if (!function_exists('cardFee')) {
    function cardFee() {
        return ['0'=>0];
    }
}

if (!function_exists('isFShopInstalled')) {
    function isFShopInstalled( $shopId ) {
       return FacebookShop::shopHasFbShop($shopId);
    }
}
if (!function_exists('doCurrentUserHasFB')) {
    function doCurrentUserHasFB( ) {
        $user = Auth::user();
       return !is_null($user->fbId);
    }
}

if(!function_exists('cacheQuery')) {

     function cacheQuery($key,$query,$timeout = 15)
    {
        if(Cache::has($key))
         {
        return Cache::get($key);
         }

        Cache::put($key, $query,$timeout);
        return $query;
       /* return Cache::remember($key, $timeout, function () use ($query) {
            return $query;
        });*/
    }
}





    