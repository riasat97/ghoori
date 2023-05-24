<?php
use Carbon\Carbon;
use Chorki\Orders\Models\InvoiceRepository;
use Chorki\Orders\Models\OrderRepositoryInterface;
use Chorki\Orders\Models\ReportRepository;
use Chorki\Orders\Models\RevenueRepository;
use Chorki\products\Models\ProductRepositoryInterface;
use Chorki\shops\Models\ShopRepositoryInterface as Shop;
use Chorki\shops\Models\Shop as ShopModel;
use Chorki\shops\Models\ShopRepositoryInterface;

class RevenuesController extends BaseRevenueController {
    protected $shop,$product;
    protected $order;
    protected $range= 15;
    protected  $year,$month;
    protected $revenue;
    protected $orderDb;
    protected $invoiceRepository;
    protected $reportRepository;

    public function __construct(ShopRepositoryInterface $shop,OrderRepositoryInterface $order,
                                \Chorki\Orders\Models\Order $orderDb,
                                ProductRepositoryInterface $product,RevenueRepository $revenue,
                                InvoiceRepository $invoiceRepository,ReportRepository $reportRepository
    )
    {
        $this->shop = $shop;
        $this->product = $product;
        $this->order = $order;
        $this->revenue = $revenue;
        $this->orderDb = $orderDb;
        $this->invoiceRepository = $invoiceRepository;
        $this->reportRepository = $reportRepository;
    }

	public function index($slug)
	{
        $shop=$this->shop->_getShop();
        $date=$this->getDate();


        $totalReceivable= $this->getTotalReceivable($date);//ecourier-cash||ecourier-card
        $totalReceivableByOwnChannelUsingCard = $this->getTotalReceivableByOwnChannelWhileUsingCard($date);//own-card

        $revenues=$this->getRevenues($date); //merchant payable/total transition fee/tax/Ghoori revenue||
        $totalSales = $this->revenue->getTotalSales($revenues);
        $totalOwnShippingCharge=$this->getOwnChannelOrderCharges($date,null,false);
        $totalMerChantRevenue= $this->getTotalMerChantRevenue($revenues[0]->totalSales,
        $totalOwnShippingCharge->totalOwnChannelCharge);

        $paymentReceivedFromOwnChannel=$this->getOwnChannelOrderCharges($date,null,true);
        $totalPaymentReceivedFromOwnChannel= $this->getTotalPaymentReceivedFromOwnChannel(
           $paymentReceivedFromOwnChannel->totalPaymentReceived
         , $totalOwnShippingCharge->totalOwnChannelCharge);
        $totalPaymentReceivedFromGhoori = $this->getTotalPaymentReceivedFromGhoori($date);
        $totalRevenueReceived= $this->getTotalRevenueReceived($totalPaymentReceivedFromOwnChannel,
        $totalPaymentReceivedFromGhoori);
        $netSales = $this->revenue->getNetSales($totalMerChantRevenue,$totalRevenueReceived);


        $lifeTimeRevenueDate=$this->getLifeTimeRevenueDate();
        $lifeTimeRevenue=$this->getLifeTimeRevenue($lifeTimeRevenueDate);
     //   $lifeTimeTotalReceivable=$this->getLifeTimeTotalReceivable($lifeTimeRevenueDate);

        $totalGhooriCommission=$this->revenue->getTotalGhooriCommission($revenues);
        $journal = $this->revenue->getJournal($date);
        $totalSubscriptionFee=$this->getTotalSubscriptionFee($date);
        $ownChannelFee=$this->getOwnChannelFee($date);
        $facebookShopFee=$this->getFacebookShopFee($date);
        $cardFee = $this->getCardFee($date);
        $totalServiceCost=$this->getTotalServiceCost($totalSubscriptionFee,$ownChannelFee,$facebookShopFee);
        $dueRevenue = $this->revenue->getDueRevenue($date);
        $previousDue=$dueRevenue['due'];
        $dueBillCycleList = $dueRevenue['dueBillCycles'];
        $totalPayable= $this->getTotalPayableToGhoori($totalServiceCost['unPaid'],
        $totalGhooriCommission['unPaid'],$previousDue);
        $total = $this->revenue->getTotal($netSales,$totalPayable);
      /*  $grandTotal= $this->getGrandTotal($revenues,$grandReceivable,$totalSubscriptionFee,$ownChannelFee,
                     $facebookShopFee,$cardFee);*/
        $date=$this->getCarbonInstance($date);

        $netSalesDetailsLink = $this->revenue->getNetSalesDetailsLink($slug);
        $transactionChargesLink = $this->revenue->getTransactionChargesLink($slug);
        $invoiceDownloadLink = $this->invoiceRepository->getInvoiceLink($shop->id,'downloadInvoice');
       // $lifeTimeRevenueListLink =$this->revenue->getLifeTimeRevenueListLink($slug);
        $year= $this->getYears($shop);

        Input::flash();

        return View::make('revenues.revenue',compact('shop','revenues','grandReceivable','totalReceivable',
               'totalSales','totalOwnShippingCharge','totalMerChantRevenue' ,'totalPaymentReceivedFromOwnChannel',
               'totalGhooriCommission','netSales','journal','totalPaymentReceivedFromGhoori','totalRevenueReceived',
               'lifeTimeRevenue','lifeTimeTotalReceivable','totalSubscriptionFee','facebookShopFee',
               'ownChannelFee','cardFee','totalServiceCost','previousDue','totalPayable','total','grandTotal','date',
               'lifeTimeRevenueDate','year','filteredOrderListLink','lifeTimeRevenueListLink','netSalesDetailsLink',
               'transactionChargesLink','dueBillCycleList','invoiceDownloadLink'));
	}

    public function getNetSalesDetails($slug){
        $shop=$this->shop->_getShop();
        $date=$this->getDate();

        $revenues=$this->getRevenues($date);
        $totalSales = $this->revenue->getTotalSales($revenues);
        $totalOwnShippingCharge=$this->getOwnChannelOrderCharges($date,null,false);
        $totalMerChantRevenue= $this->getTotalMerChantRevenue($revenues[0]->totalSales,
            $totalOwnShippingCharge->totalOwnChannelCharge);

        $paymentReceivedFromOwnChannel=$this->getOwnChannelOrderCharges($date,null,true);
        $totalPaymentReceivedFromOwnChannel= $this->getTotalPaymentReceivedFromOwnChannel(
            $paymentReceivedFromOwnChannel->totalPaymentReceived
            , $totalOwnShippingCharge->totalOwnChannelCharge);

        $totalPaymentReceivedFromGhoori = $this->getTotalPaymentReceivedFromGhoori($date);
        $totalRevenueReceived= $this->getTotalRevenueReceived($totalPaymentReceivedFromOwnChannel,
            $totalPaymentReceivedFromGhoori);
        $netSales = $this->revenue->getNetSales($totalMerChantRevenue,$totalRevenueReceived);


        $netSalesDetails = $this->revenue->getNetSalesDetails($date);
        $merchantPackage = $this->revenue->getMerchantPackage($date,$shop);

        $date=$this->getCarbonInstance($date);
        $year= $this->getYears($shop);
        Input::flash();

        return View::make('revenues.netSales',compact('shop','revenues','totalSales','totalOwnShippingCharge',
            'totalPaymentReceivedFromOwnChannel','totalGhooriCommission','netSales',
            'date','year','netSalesDetails','merchantPackage'));
    }
    public function getTransactionCharges($slug){
        $shop=$this->shop->getBySlug($slug);
        $date=$this->getDate();

        $transactionChargesList=$this->revenue->getTransactionCharges($date,$shop->Id);
        $revenues=$this->getRevenues($date);
        $totalSales = $this->revenue->getTotalSales($revenues);
        $totalTransactionCharge=$this->revenue->getTotalGhooriCommission($revenues);
        $merchantPackage = $this->revenue->getMerchantPackage($date,$shop);

        $date=$this->getCarbonInstance($date);
        $year= $this->getYears($shop);
        Input::flash();

        return View::make('revenues.transactionCharges',compact('shop','date','transactionChargesList',
           'totalSales','totalTransactionCharge','merchantPackage','year'));

    }

    public function  getLifeTimeRevenueList($slug){
        $shop=$this->shop->_getShop();

        $lifeTimeRevenueDate=$this->getLifeTimeRevenueDate();
        $lifeTimeRevenue=$this->getLifeTimeRevenue($lifeTimeRevenueDate);

        $lifeTimeRevenueList= $this->revenue->getLifeTimeRevenueList();
        $lifeTimeFilteredOrderListLink=$this->revenue->getLifeTimeFilteredOrderListLink($slug,$lifeTimeRevenueList);

        $lifeTimeRevenueDate=$this->getCarbonInstance($lifeTimeRevenueDate);

        return View::make('revenues.lifeTimeRevenueList',compact('shop','lifeTimeRevenueDate','lifeTimeRevenueList',
              'lifeTimeRevenue','lifeTimeFilteredOrderListLink'));

    }

    public function getFilteredOrderList($slug){
        $shop=$this->shop->_getShop();

        $date=$this->getDate();

        $revenues=$this->getRevenues($date);
        $totalReceivable= $this->getTotalReceivable($date);
        $totalReceivableByOwnChannelUsingCard = $this->getTotalReceivableByOwnChannelWhileUsingCard($date);
        $grandReceivable= $totalReceivable+$totalReceivableByOwnChannelUsingCard;

        $totalSubscriptionFee=$this->getTotalSubscriptionFee($date);
        $ownChannelFee=$this->getOwnChannelFee($date);
        $facebookShopFee=$this->getFacebookShopFee($date);
        $cardFee = $this->getCardFee($date);
        $totalServiceCost=$this->getTotalServiceCost($totalSubscriptionFee, $ownChannelFee, $facebookShopFee, $cardFee);
        $grandTotal= $this->getGrandTotal($revenues,$grandReceivable,$totalSubscriptionFee,
            $ownChannelFee,$facebookShopFee,$cardFee);

        $filteredOrderList = $this->revenue->getFilteredOrderList($date);
        $date=$this->getCarbonInstance($date);

        $year= $this->getYears($shop);
        Input::flash();

        return View::make('revenues.filteredOrderList',compact('shop','revenues','grandReceivable',
            'facebookShopFee','totalSubscriptionFee','ownChannelFee','cardFee','totalServiceCost','grandTotal',
            'date','year','filteredOrderList'));
    }

}