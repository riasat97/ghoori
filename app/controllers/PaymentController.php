<?php
/**
 * Created by PhpStorm.
 * User: arafat
 * Date: 1/5/16
 * Time: 4:47 PM
 */

use Chorki\Payment\Models\Payment;
use Chorki\Payment\Models\Transaction;
use Chorki\Payment\Models\BKashTransaction;

class PaymentController extends \BaseController{

    private $paymentModel;
    private $transactionModel;
    private $bkashTransactionModel;

    public function __construct(Payment $paymentModel, Transaction $transactionModel, BKashTransaction $bkashTransactionModel){
        $this->paymentModel = $paymentModel;
        $this->transactionModel = $transactionModel;
        $this->bkashTransactionModel = $bkashTransactionModel;
    }

    public function redirectToPaymentURL($transaction_method,$payment_token){
        $payment = $this->paymentModel->whereToken($payment_token)->first();
        if(!$payment){
            return View::make('errors.404');
        }
        switch($payment->status){
            case 'canceled':
            case 'expired':
            case 'completed':
                return Redirect::back(); //@todo redirect with error message
        }

        switch($transaction_method){
            case 'bkash' :
                if($payment->status == 'created'){
                    $payment->status = 'requested';
                    $payment->save();
                }
                return Redirect::to($this->getBkashTrxIdInputURL($payment));
            default:
                return View::make('errors.404',[],404);
        }
    }

    private function getBkashTrxIdInputURL(Payment $payment){
        $transaction = $this->transactionModel->newInstance(['transaction_method'=>'bkash']);
        $bkashTransaction = $this->bkashTransactionModel->create([]);
        $transaction->transactionable()->associate($bkashTransaction);
        $transaction->save();
        $payment->transactions()->save($transaction);
        return URL::route('bkash-input',[$transaction->token]);
    }

    /**
     * payment method will post their success, failure or cancel status here
     * @param string $transaction_method
     * @param string $transaction_token
     * @param mixed $status
     */
    public function paymentResponse($transaction_method,$transaction_token,$status=null){

    }

    public function bKashTransactionIdInput($transaction_token){
        $transaction = $this->transactionModel->whereToken($transaction_token)->first();
        if((!$transaction)||($transaction->transaction_method!='bkash')){
            return View::make('errors.404');
        }
        switch($transaction->status){
            case 'created':
                $transaction->status = 'requested';
                $transaction->save();
            case 'requested':
                return View::make('payment.bkash');//@todo pass the post url from here
            default:
                return View::make('errors.404');
        }
    }

    public function bKashTransactionProcess($transaction_token){
        $transaction = $this->transactionModel->whereToken($transaction_token)->first();
        if((!$transaction)||($transaction->transaction_method!='bkash')){
            return View::make('errors.404');
        }
        if($transaction->status == 'requested'){
            $trx_id = Input::get('trx_id');//@todo check for duplicate entry here
            $data = [
                'bkash_trx_id'=>$trx_id,
                'transaction_id'=>$transaction->id
            ];
            DB::beginTransaction();
            try{
                Queue::push('Chorki\Payment\Handlers\BkashPaymentHandler',$data,'transaction/bkash');
                $transaction->status = 'pending_verification';
                $transaction->save();
                DB::commit();
            }catch (Exception $e){
                DB::rollback();
                throw $e;
            }
            return Redirect::route('payment-ack','payment');//@todo make sure the payment id is right
        }else{
            return View::make('errors.404');
        }
    }

    public function showAcknowledgement($payment_token){
        //@todo make sure to process the payment token
        $message_title = "Thank You | Ghoori";
        $message_header = "Thank You! You are awesome.";
        $message_body = "Your payment request has been placed. We will review and get back to you with confirmation.
                        If you face any problem using our service let us know.<br>
                        Call us at 09612000888 or email us at info@ghoori.com.bd";
        return View::make('payment.acknowledgement',compact('message_title','message_header','message_body'));
    }
}