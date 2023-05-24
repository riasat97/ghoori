<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 10/29/2015
 * Time: 4:55 PM
 */

namespace Chorki\shops\Models;


use Chorki\Validators\Shop\AccountValidator;
use Chorki\Validators\Shop\BkashValidator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class AccountRepository extends ShopRepositoryDb{


  public function store(){
      $validator = AccountValidator::make(Input::all());
      $url = $this->getAccountUrl();
      $shop=$this->getShop();
      if ($validator->fails()) {
          return Redirect::to($url)->withErrors($validator->instance())->withInput();
      }
      $id=$this->getBankId($shop);
      $bank=$this->bank->findOrNew($id);
      $bank->name=Input::get('name');
      $bank->accountNO=Input::get('accountNo');
      $bank->bank=Input::get('bank');
      $bank->branch=Input::get('branch');
      $shop->bank()->save($bank);
      return Redirect::to($url)
          ->with('flash_message', '<b>Well done!</b>')
          ->with('flash_type', 'alert-success');
  }
  public function postBkash(){
      $validator = BkashValidator::make(Input::all());
      $url = $this->getAccountUrl();
      $shop=$this->getShop();
      if ($validator->fails()) {
          return Redirect::to($url)->withErrors($validator->instance())->withInput();
      }

      $id=$this->getBkashId($shop);
      $bkash=$this->bkash->findOrNew($id);
      $bkash->name=Input::get('name');
      $bkash->mobile=Input::get('mobile');
      $bkash->type=Input::get('type');
      $shop->bkash()->save($bkash);
      return Redirect::to($url)
          ->with('flash_message', '<b>Well done!</b>')
          ->with('flash_type', 'alert-success');
  }
  public function getBkashAccountType(){
      return ['1'=>'Personal','2'=>'Agent'];
  }
    private function getAccountUrl()
    {
        $slug=$this->getShop()->slug;
        return URL::route('settings.edit', $slug) . '#bank';
    }
    public function getShop(){
        return $this->_getShop();
    }

    private function getBkashId($shop)
    {
        return $shop->bkash?$shop->bkash->id:null;
    }
    private function getBankId($shop)
    {
        return $shop->bank?$shop->bank->id:null;
    }
    public function getBankName(){
        return ['0'=> "AB Bank Limited", '1'=>"Agrani Bank Limited", '2'=>"Al-Arafah Islami Bank Limited",'3'=>"Bangladesh Commerce Bank Limited",'4'=> "Bangladesh Development Bank Limited", '5'=>"Bangladesh Krishi Bank", '6'=>" Bank Al-Falah Limited", '7'=>" Bank Asia Limited", '8'=>" BASIC Bank Limited", '9'=>" BRAC Bank Limited",'10'=>" Commercial Bank of Ceylon Limited", '11'=>" Dhaka Bank Limited", '12'=>" Dutch-Bangla Bank Limited", '13'=>" Eastern Bank Limited", '14'=> " EXIM Bank Limited", '15'=>" First Security Islami Bank Limited", '16'=>" Habib Bank Ltd.", '17'=>" ICB Islamic Bank Ltd.", '18'=>" IFIC Bank Limited", '19'=>" Islami Bank Bangladesh Ltd", '20'=>" Jamuna Bank Ltd", '21'=>" Janata Bank Limited", '22'=>" Meghna Bank Limited", '23'=>" Mercantile Bank Limited", '24'=>" Midland Bank Limited", '25'=>" Mutual Trust Bank Limited", '26'=>" National Bank Limited", '27'=>" National Bank of Pakistan", '28'=>" National Credit & Commerce Bank Ltd", '29'=>" NRB Commercial Bank Limited", '30'=>" NRB Bank", '31'=>" NRB Global", '32'=>" One Bank Limited", '33'=>" Premier Bank Limited", '34'=>" Prime Bank Ltd", '35'=>" Pubali Bank Limited", '36'=>" Rajshahi Krishi Unnayan Bank", '37'=>" Rupali Bank Limited", '38'=>" Shahjalal Bank Limited", '39'=>" Social Islami Bank Ltd.", '40'=>" Sonali Bank Limited", '41'=>" South Bangla Agriculture & Commerce Bank Limited", '42'=>" Southeast Bank Limited" ,'43'=>" Standard Bank Limited", '44'=>" Standard Chartered Bank", '45'=>" State Bank of India", '46'=>" The City Bank Ltd.", '47'=>" The Hong Kong and Shanghai Banking Corporation. Ltd.", '48'=>" Trust Bank Limited" ,'49'=>" Union Bank Limited", '50'=>" United Commercial Bank Limited", '51'=>" Uttara Bank Limited", '52'=>" Woori Bank" ];
    }

}