<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 10/21/2015
 * Time: 11:43 AM
 */

abstract class BaseRevenueController extends \BaseController {


    public function getDate(){
        return $this->revenue->getRootAndEndDate();
    }
    public function getRevenues($date){
        return $this->revenue->getRevenues($date);
    }
    protected function getTotalReceivable($date)
    {
        return $this->revenue->getTotalReceivable($date);
    }
    protected function getTotalReceivableByOwnChannelWhileUsingCard($date)
    {
        return $this->revenue->getTotalReceivableByOwnChannelWhileUsingCard($date);

    }
    public function getLifeTimeRevenueDate(){
        return $this->revenue->getLifeTimeRevenueDate();
    }
    public function getLifeTimeRevenue($lifeTimeRevenueDate){
        return $this->revenue->getRevenues($lifeTimeRevenueDate);
    }
    public function getLifeTimeTotalReceivable($lifeTimeRevenueDate){
        return $this->revenue->getTotalReceivable($lifeTimeRevenueDate);
    }
    public function getCarbonInstance($date){
        return $this->revenue->getCarbonInstance($date);
    }

    public function getYears($shop = null)
    {
        $currentYear=$this->revenue->getCurrentYear();
        if ($shop) {
            $createdYear = $shop->created_at->year;
            return array_combine(range($createdYear, $currentYear), range($createdYear, $currentYear));
        }
        else {
            return [$currentYear => $currentYear];
        }
        
    }

    public function getTotalSubscriptionFee($date)
    {
        return $this->revenue->getTotalSubscriptionFee($date);
    }
    public function getOwnChannelFee($date)
    {
        return $this->revenue->getOwnChannelFee($date);
    }
    protected function getFacebookShopFee($date)
    {
        return $this->revenue->getFacebookShopFee($date);

    }
    protected function getCardFee($date)
    {
        return $this->revenue->getCardFee($date);

    }
    protected function getTotalServiceCost($totalSubscriptionFee, $ownChannelFee, $facebookShopFee)
    {
        return $this->revenue->getTotalServiceCost($totalSubscriptionFee, $ownChannelFee, $facebookShopFee);
    }
    protected function getTotalPayableToGhoori($totalServiceCost, $totalGhooriCommission,$previousDue)
    {
        return $this->revenue->getTotalPayableToGhoori($totalServiceCost, $totalGhooriCommission,$previousDue);
    }
    protected function getTotalMerChantRevenue($netSales, $totalOwnChannelOrderCharges)
    {
       return $this->revenue->getTotalMerchantRevenue($netSales,$totalOwnChannelOrderCharges);
    }
    protected function getTotalPaymentReceivedFromOwnChannel($totalPaymentReceived, $totalOwnChannelCharge)
    {
        return $this->revenue->getTotalPaymentReceivedFromOwnChannel($totalPaymentReceived,$totalOwnChannelCharge);

    }
    protected function getTotalPaymentReceivedFromGhoori($date)
    {
      return $this->revenue->getTotalPaymentReceivedFromGhoori($date);
    }
    protected function getTotalRevenueReceived($totalPaymentReceivedFromOwnChannel,
                                               $totalPaymentReceivedFromGhoori){
        return $this->revenue->getTotalRevenueReceived($totalPaymentReceivedFromOwnChannel,
            $totalPaymentReceivedFromGhoori);
    }
    protected function getGrandTotal($revenues, $totalReceivable, $totalSubscriptionFee,
                                     $ownChannelFee,$facebookShopFee,$cardFee)
    {
      return  $this->revenue->getGrandTotal($revenues, $totalReceivable,
              $totalSubscriptionFee, $ownChannelFee,$facebookShopFee,$cardFee);

    }
    protected function getInvoiceDate()
    {
        return $this->invoiceRepository->getStartAndEndDate();
    }
    protected function getOwnChannelOrderCharges($date,$shopId,$cod)
    {
        return $this->revenue->getOwnChannelOrderCharges($date,$shopId,$cod);
    }

}