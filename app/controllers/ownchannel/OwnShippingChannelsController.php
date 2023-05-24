<?php

use Chorki\Shippings\OwnShippingChannels\Models\OwnShippingChannel as Model;
use Chorki\Shippings\OwnShippingChannels\Models\OwnShippingChannelRepository;
use Chorki\Shippings\OwnShippingChannels\Models\OwnShippingChannelRepositoryInterface;
use Chorki\shops\Models\ShopRepositoryInterface;
use Chorki\Validators\OwnShippingChannel\OwnShippingChannelValidator as OwnShippingChannelValidator;

class OwnShippingChannelsController extends \BaseController {

    private $ownShippingChannel;
    private $shop;

    public function __construct(OwnShippingChannelRepository $ownShippingChannel,ShopRepositoryInterface $shop){

        $this->ownShippingChannel = $ownShippingChannel;
        $this->shop = $shop;
    }
	public function update($slug)
    {
        $input = Input::all();

        $validator = OwnShippingChannelValidator::make($input);

        if ($validator->fails()) {
            $url = $this->getShippingUrl($slug);
            return Redirect::to($url)->withErrors($validator->instance());
        } else {
            $shop = $this->shop->_getShop();
            $shippingLocations=$shop->shippingLocations;

           if (!$shippingLocations->count()) {
                 $this->insertShippingLocationsWithCharges($input,$shop);
            } else {
                if($shippingLocations->count()){
                        foreach($shippingLocations as $shippingLocation){
                            $shop->shippingLocations()->detach($shippingLocation);
                        }
                        $this->insertShippingLocationsWithCharges($input,$shop);
                    }
                }
            }
        $url = $this->getShippingUrl($slug);
        return Redirect::to($url)
            ->with('flash_message', '<b>Well done!</b>')
            ->with('flash_type', 'alert-success');



    }
    public function insertShippingLocationsWithCharges($input,$shop){
        $locationWithCharge=[];
        foreach($input['shippingLocation_id'] as $key=>$locWithCharge){
            $locationWithCharge[$locWithCharge]=['unitCost'=>$input['unitCost'][$key]];
        }

        $shop->shippingLocations()->attach($locationWithCharge);
    }

    private function getShippingUrl($slug)
    {
       return URL::route('settings.edit', $slug) . '#shipping';
    }

}