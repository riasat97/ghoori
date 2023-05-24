<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 1/21/2016
 * Time: 3:26 PM
 */

namespace Chorki\Traits\ProductEvents;


trait ProductEventTrait {

    protected function getPublishedProducts($shop){
        return  $shop->with(['products'=>function($q){
            $q->where('status','Published');
        }])->find($shop->id);
    }
    protected function postProductEvent($object, $event)
    {
        $object->event=$event;
        $object->status='New';
        $object->save();
    }
    protected function getProductEventLoggerObject($product){
        return
       $this->productEventLogger->firstOrNew([
            'product_id'=>$product->id
        ]);
    }

}