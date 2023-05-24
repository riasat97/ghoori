<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 11/2/2015
 * Time: 6:27 PM
 */

namespace Chorki\Orders\Models;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;

class InvoiceRepository extends RevenueRepository{

    public function index(){
        $date=$this->getStartAndEndDate();
        $selectedShops=$this->getSelectedShopsToSentInvoice($date);
       return $this->sentEmailWithInvoiceForEachShop($date,$selectedShops);
    }
    public function getInvoiceData($date,$shopId){
        $shop=$this->shop->getById($shopId);
        $shop=$this->shop->loadShop($shop);

        $revenues=$this->getRevenues($date,$shopId); //merchant payable/total transition fee/tax/Ghoori revenue||
        $totalSales = $this->getTotalSales($revenues);
        $totalOwnShippingCharge=$this->getOwnChannelOrderCharges($date,$shopId,false);
        $totalMerChantRevenue= $this->getTotalMerChantRevenue($revenues[0]->totalSales,
            $totalOwnShippingCharge->totalOwnChannelCharge);
        $paymentReceivedFromOwnChannel=$this->getOwnChannelOrderCharges($date,$shopId,true);
        $totalPaymentReceivedFromOwnChannel= $this->getTotalPaymentReceivedFromOwnChannel(
            $paymentReceivedFromOwnChannel->totalPaymentReceived
            , $totalOwnShippingCharge->totalOwnChannelCharge);
        $totalPaymentReceivedFromGhoori = $this->getTotalPaymentReceivedFromGhoori($date,$shopId);
        $totalRevenueReceived= $this->getTotalRevenueReceived($totalPaymentReceivedFromOwnChannel,
            $totalPaymentReceivedFromGhoori);
        $netSales = $this->getNetSales($totalMerChantRevenue,$totalRevenueReceived);

        $totalGhooriCommission=$this->getTotalGhooriCommission($revenues);
        $totalSubscriptionFee=$this->getTotalSubscriptionFee($date,$shopId);
        $ownChannelFee=$this->getOwnChannelFee($date,$shopId);
        $facebookShopFee=$this->getFacebookShopFee($date,$shopId);

        $totalServiceCost=$this->getTotalServiceCost($totalSubscriptionFee,$ownChannelFee,$facebookShopFee);

        $dueRevenue = $this->getDueRevenue($date,$shopId);

        $previousDue=$dueRevenue['due'];
        $totalPayable= $this->getTotalPayableToGhoori($totalServiceCost['unPaid'],
            $totalGhooriCommission['unPaid'],$previousDue);
        $total = $this->getTotal($netSales,$totalPayable);

        $date=$this->getCarbonInstance($date);
        $today=Carbon::now()->addHours(6)->toFormattedDateString();
        $dueDate=Carbon::now()->addDays(15)->addHours(6)->toFormattedDateString();
        $data=['totalRevenue'=>$totalMerChantRevenue,'revenueReceived'=>$totalRevenueReceived,
               'receivableAmount'=>$netSales,
              'totalTransactionCharge'=>$totalGhooriCommission,'totalServiceCost'=>$totalServiceCost,
              'previousDue'=>$previousDue,
              'payableAmount'=>$totalPayable, 'total'=>$total,'date'=>$date,'dueDate'=>$dueDate,'today'=>$today];
        $data['shop']=$shop;
        $data['invoiceId']= $this->getGenInvoiceId($date,$shopId);
        return $data;
      /*  $pdf=PDF::loadView('invoice.dummy', $data);
        $pdf->setOption('image-quality', 100)->setOption('disable-smart-shrinking', true);
        return $pdf->stream();*/


    }

    protected function getStartAndEndDate(){
        $now=Carbon::now();
        $day=$now->day;

        if($day == 1){
            $root=$this->getADateOfTheLastMonthByDay(16);
            $end=$now->subMonth()->lastOfMonth()->endOfDay()->subHours(6)->toDateTimeString();

            return $this->getReturn($root,$end);
        }
        elseif($day == 16){
            $root=$now->firstOfMonth()->startOfDay()->subHours(6)->toDateTimeString();

            $end= $this->getEnd(null,null,'15');
            return $this->getReturn($root,$end);
        }
    }

    protected function sentEmailWithInvoiceForEachShop($date,$selectedShops)
    {

        foreach($selectedShops as $key=>$shopId){
            $data= $this->getInvoiceData($date,$shopId);
            $this->sentInvoiceMail($data);

        }
        return ' invoice mail sent successfully to all shops';
    }
    public function sentMailWithInvoice($shopId){
        $date=$this->getRootAndEndDate();
        $invoiceData=$this->getInvoiceData($date,$shopId);
        $this->sentInvoiceMail($invoiceData);
        return true;
    }
    public function getDownLoadInvoice($shopId)
    {
        $date=$this->getRootAndEndDate();
        $invoiceData=$this->getInvoiceData($date,$shopId);
        $pdf=PDF::loadView('invoice.invoice', $invoiceData);
        return $pdf->stream();
    }

    public function getInvoiceLink($shopId,$route)
    {
        $dateRange=$this->getRootAndEndDate();
        $date= explode('-',$dateRange['end'],-1);

        if(Input::has('type')){

            $queryString=$this->getQueryString($date,$shopId,Input::get('type'));

            return $link =URL::route($route,$queryString);
        }else{

            return $link=URL::route($route,[$shopId]);
        }
    }
    public function getGenInvoiceId($date,$shopId){
        $dateWithOutDay=substr($this->getCarbonParseObject($date['end'])->toDateString(),0,7);
        $dateFormat=str_replace('-',"",$dateWithOutDay);
        $cycle=substr($this->getCycleByDate($date['end']),-1);
        return $invoiceId= $shopId.$dateFormat.'C'.$cycle;
    }

    private function sentInvoiceMail($data)
    {
        Mail::alwaysFrom(Config::get('mailaddress.0.address'), Config::get('mailaddress.0.name'));

        Mail::queue('emails.revenue.invoice', $data, function($message) use($data)
        {

            $pdf=PDF::loadView('invoice.invoice', $data);
            $message->to($data['shop']->email)->subject('Invoice');

            $message->attachData($pdf->output(), "invoice.pdf");
        });
    }

}