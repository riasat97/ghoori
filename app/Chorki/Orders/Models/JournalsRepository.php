<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 2/7/2016
 * Time: 12:20 PM
 */

namespace Chorki\Orders\Models;


use Carbon\Carbon;
use Chorki\Repositories\BaseRevenueRepository;
use Chorki\shops\Models\ShopRepositoryInterface;

class JournalsRepository extends BaseRevenueRepository{

    protected $model,$range = 15,$month,$year,$cycle;

    function __construct(\Journal $model,ShopRepositoryInterface $shopRepositoryInterface)
    {
        $this->model = $model;
        $this->shop = $shopRepositoryInterface ;

    }

    public function getJournalAccordingToCycle($shopId=null){

        return
        $this->model
        ->where('month',$this->month)
        ->where('year',$this->year)
        ->where('cycle',$this->cycle)
        ->where('shop_id',$this->getShopId($shopId))
        ->first();
    }
    public function setTimeCycle(array $date){
       // dd($date);
        $this->month = $date['month'];
        $this->year = $date['year'];
        $this->cycle = $date['cycle'];

    }
    public function getCycle()
    {
         if($this->cycle)
             return $this->cycle;
        else{
            $now=$this->getCarbonNow()->toDateString();
            $range=$this->getEnd(null,null,$this->range);
            if( $now <= $range ){
                return 'cycle1';
            }elseif($now > $range){
                return 'cycle2';
            }
        }
    }

    public function getMonth()
    {
         if($this->month){
             return $this->month;
         }
         else{
           return  $this->getCarbonNow()->month;
         }
    }

    public function getYear()
    {
        if($this->year)
        return $this->year;
        else
        return $this->getCarbonNow()->year;
    }
    public function index(){
     dd($this->month);

    }
    public function getCarbonNow(){
        return Carbon::now()->subHours(6);
    }
}