<?php

use Chorki\Payment\Traits\PaymentableTrait;

class SponsoredItem extends \Eloquent {
    protected $table = 'sponsored_items';
	protected $guarded = [];

    use PaymentableTrait;

    public function dates(){
        return $this->hasMany('SponsoredItemDate','sponsored_item_id');
    }

    public function product(){
        return $this->belongsTo('Chorki\products\Models\Product','productId');
    }

    public function getCapacityByPosition($position){
        if($position=='large_ad'){
            $capacity = 5;
        }elseif($position == 'small_ad'){
            $capacity = 4;
        }else{
            $capacity = 1;
        }
        return $capacity;
    }

    public function store($title,$subtitle,$shortDescription,$productId,$url,$image,$position,$group,array $dates){
        DB::beginTransaction();
        try{

            $siDt = new SponsoredItemDate();
            $capacity = $this->getCapacityByPosition($position);
            if(!$siDt->datesAreAvailable($position,$group,$dates,$capacity)){
                throw new Exception('Some dates are occupied.',420);
            }
            $boost_charges = Config::get('boost');
            $spItem = new SponsoredItem();
            $freefor = 0;
            $dateCount = count($dates);
            if( $dateCount > $freefor ) {
                switch($position) {
                    case 'large_ad':
                        $spItem->cost = ceil( ($dateCount - $freefor) * $boost_charges['large_ad'] * ( (100+4.5)/100 ) );
                        break;
                    case 'medium_ad':
                        $spItem->cost = ceil( ($dateCount - $freefor) * $boost_charges['medium_ad'] * ( (100+4.5)/100 ) );
                        break;
                    case 'small_ad':
                        $spItem->cost = ceil( ($dateCount - $freefor) * $boost_charges['small_ad'] * ( (100+4.5)/100 ) );
                        break;
                    default:
                        break;
                }
            }
            $spItem->title = $title;
            $spItem->subtitle = $subtitle;
            $spItem->shortDescription = $shortDescription;
            $spItem->productId = $productId;
            $spItem->url = $url;
            $spItem->image = $image;
            $spItem->position = $position;
            $spItem->group = $group;
            $spItem->save();

            $dateData = array('position'=>$position, 'group'=>$group,'date'=>null);
            foreach($dates as $date){
                $dateData['date'] = $date;
                $spItem->dates()->create($dateData);
            }

            $spItem->setPayment($spItem->cost);

            DB::commit();
        }catch (Exception $e){
            DB::rollBack();
            throw $e;
        }
    }
    public function onPaymentPending(){
        $this->paymentStatus = 'Pending';
        $this->save();
    }
    public function onPaymentComplete(){
        $this->paymentStatus = 'Paid';
        $this->save();
    }
}