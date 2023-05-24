<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 2/17/2016
 * Time: 2:45 PM
 */

namespace Chorki\Traits\Revenues;


trait ServiceChargeTrait {

    public function getAmountDependsOnJournalExistence($cost,$journal,$index){
        $cost = round($cost,2);
        $paid=$this->getPaidAmount($journal,$index);
        $unPaid=$cost-$paid;
         return ['cost'=>$cost,'unPaid'=>$unPaid,'paid'=>$paid];
    }

    public function getPaidAmount($journal,$index){
        if(!empty($journal)){
            return round($journal->$index,2);
        }
        return 0;

    }

}