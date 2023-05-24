<?php
/**
 * Created by PhpStorm.
 * User: arafat
 * Date: 10/18/15
 * Time: 4:45 PM
 */

class TestController extends BaseController{
    public function test(){
        $payment = \Chorki\Payment\Models\Payment::find(1);
        $bkp = $payment->bkashPaymentURL();
        dd($bkp);
        $transactionModel = app('Chorki\Payment\Models\Transaction');
        $bkashTransaction = BKashTransaction::create([]);
        $transaction = $transactionModel->newInstance([]);
        $transaction->transactionable()->associate($bkashTransaction);
        $transaction->save();
        dd(DB::getQueryLog());
        //dd($transaction);
        //$transaction->save();
        //$payment->transactions()->save($transaction);
        //dd($payment->transactions->toArray());
        //dd(DB::getQueryLog());
        //$bks = new Chorki\PaymentSDK\BKash();
        //$details = $bks->getTransactionDetails('3193196');
        //dd($details);
        // dd(new DateTime("now"));
        // dd(Hash::make('ASD00700019663'));
        //$p = new \Illuminate\Database\Eloquent\Relations\Pivot(new User,[],'users');
        //$boolean = $p instanceof Eloquent;
        //echo ($boolean);
    }
    public function pdf(){
        return View::make('pdf.design');
    }

    public function testPost(){
        dd(Input::all());
    }

    public function hashmake($string='12345678')
    {
        return Hash::make($string);
    }
}