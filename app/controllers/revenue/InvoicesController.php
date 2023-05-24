<?php

use Illuminate\Support\Facades\App;

class InvoicesController extends \RevenuesController {

    public function getGenerateInvoice(){

        return $this->invoiceRepository->index();
    }


    public function getDownLoadInvoice($shopId){

        return $this->invoiceRepository->getDownLoadInvoice($shopId);

    }
    public function sentMailWithInvoice($shopId){
         $shop=$this->shop->getById($shopId);
         $this->invoiceRepository->sentMailWithInvoice($shopId);
         return Redirect::route('revenue.index',$shop->slug)->with('message', 'Successfully sent.');

    }


}