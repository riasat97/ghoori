<?php
/**
 * Created by PhpStorm.
 * User: arafat
 * Date: 1/17/16
 * Time: 3:45 PM
 */

namespace Chorki\Payment\Handlers;

use Chorki\Payment\Models\Transaction;

use GuzzleHttp\Exception\GuzzleException;

use Exception;


class BkashPaymentHandler {
    public function fire($job, $data)
    {
        $trx_id = $data['bkash_trx_id'];
        $transaction = Transaction::find($data['transaction_id']);
        echo "--Processing trx_id = $trx_id --";
        $bks_sdk = app('Chorki\PaymentSDK\BKash');
        try{
            $details = $bks_sdk->getTransactionDetails($trx_id);
            $transactionInfo = (array)$details->transaction;
            $this->fixTransactionInfo($transactionInfo);

            echo '--Transaction Details--';
            var_dump($transactionInfo);

            switch($transactionInfo['trxStatus']){
                case '0000'://success
                    $this->saveTransactionAndDeleteJob($transaction,$transactionInfo,$job,'completed');
                    break;
                case '0100'://payment reversed
                case '0111'://failed
                case '1002'://invalid
                case '1004'://unauthorized access
                    $transactionInfo['trxId'] = $trx_id;
                    $this->saveTransactionAndDeleteJob($transaction,$transactionInfo,$job,'failed');
                    break;
                case '1001'://invalid msisdn
                case '1003'://username password incorrect
                    throw new Exception('BKash SDK Credential Incorrect');
                default:
                    echo "Transaction status = '{$transactionInfo['trxStatus']}' Releasing job.".PHP_EOL;
                    $this->delayTheJob($job);
            }
        }catch (GuzzleException $e){
            echo "GuzzleException: ".$e->getMessage().PHP_EOL;
            $this->delayTheJob($job,$e);
        }catch (Exception $e){
            echo "Exception: ".$e->getMessage().PHP_EOL;
            $this->delayTheJob($job,$e);
            //@todo notify the developers
        }
    }

    protected function saveTransactionAndDeleteJob(Transaction $transaction, array $transactionInfo, $job, $status){

        echo 'Saving Transaction and Deleting Job'.PHP_EOL;
        $bkashTransaction = $transaction->transactionable;
        $bkashTransaction->update($transactionInfo);
        $transaction->status = $status;
        $transaction->amount = (double) $transactionInfo['amount'];
        $transaction->save();//payment will be updated automatically
        $job->delete();
    }

    protected function delayTheJob($job, Exception $e = null){
        if(!is_null($e)){
            echo $e->getMessage().PHP_EOL;
        }
        $attempts = $job->attempts();
        echo "Attempts = $attempts".PHP_EOL;
        if($attempts<=5){
            $delay = $attempts*$attempts*60;
        }else{
            $delay = 3600;
        }
        echo "Delay = $delay Seconds".PHP_EOL;
        $job->release($delay);
    }

    protected function fixTransactionInfo(&$transactionInfo){
        if(isset($transactionInfo['trx_status'])){
            echo '--cleaning: trxStatus came through trx_status'.PHP_EOL;
            $transactionInfo['trxStatus']=$transactionInfo['trx_status'];
        }
        if(isset($transactionInfo['trx_id'])){
            echo '--cleaning: trxId came through trx_id'.PHP_EOL;
            $transactionInfo['trxId']=$transactionInfo['trx_id'];
        }
        if(isset($transactionInfo['datetime'])){
            echo '--cleaning: trxTimestamp came through datetime'.PHP_EOL;
            $transactionInfo['trxTimestamp']=$transactionInfo['datetime'];
        }
    }
}