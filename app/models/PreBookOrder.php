<?php

use Chorki\Payment\Traits\PaymentableTrait;
use Chorki\shops\Models\ShopRepositoryInterface as Shop;

class PreBookOrder extends Eloquent{



    use PaymentableTrait;

    protected $table = 'prebook_orders';
    public $timestamps=true;

    public function user(){
        return $this->belongsTo('\User');
    }
    public function shippingAddress(){
        return $this->belongsTo('Chorki\Shippings\ShippingAddresses\Models\ShippingAddress','user_id');
    }
    public function shippingPackage(){
        return $this->belongsTo('\ShippingPackage','shippingPackage_id');
    }
    public function paymentMethod(){
        return $this->belongsTo('\PaymentMethod','paymentMethod_id');
    }
    public function shippingLocation(){
        return $this->belongsTo('\ShippingLocation','shippingLocation_id');
    }
    public function preorderPackage(){
        return $this->belongsTo('\PreorderPackage','preorderPackage_id');
    }
    public function shop(){
        return $this->belongsTo('Chorki\shops\Models\Shop');
    }

    public function onPaymentComplete(){

       $this->status='New';
       $this->save();
       //dd($this);
       $this->sendSMSToMerchant($msg="You received a new order form your eShop");
       $this->sendSMSToCustomer(input::get('mobile'),input::get('name'),$this);
       $this->sendSMSToAuthority($this);

   }

    protected function sendSMSToMerchant($msg="You received a new order form your eShop")
    {
        $shop = $this->Shop->_getShop();
      
        switch (App::environment()):
            case "local":
                $name = $shop->name;
                $number = $shop->mobile;
                $message = "Dear,".preg_split('/[\s,]+/',$name)[0].".".$msg .$shop->title." -lOCAL";
                $originator = Config::get('constants.sms_originator');
                $this->smsSender->sendSMS($number,$message,$originator);
                break;
            case "production":
                $name = $shop->mobile->name;
                $number = $shop->mobile;
                $message = "Dear,".preg_split('/[\s,]+/',$name)[0].".".$msg .$shop->title." -GHOORI";
                $originator = Config::get('constants.sms_originator');
                $this->smsSender->sendSMS($number,$message,$originator);
                break;
            default:

                break;

        endswitch;

    }

    protected function sendSMSToCustomer($phone,$name,$order)
    {
        $number = $phone;
        $message = "Dear,".preg_split('/[\s,]+/',$name)[0].".Your Order no. ".($order->id+100000)." is now in process. -Ghoori";
        $originator = Config::get('constants.sms_originator');
        $this->smsSender->sendSMS($number,$message,$originator);
    }

    protected function sendSMSToAuthority($order)
    {
        switch (App::environment()):
            case "local":
                // return $url;
                break;
            case "production":
                $this->sendSmsToBosses('01913660111', "Nazmus Saquibe", $order);
                $this->sendSmsToBosses('01778189750', 'Rashed Moslem', $order);
                $this->sendSmsToBosses('01764111104', 'Zahidul Amin', $order);
                break;
            default:
                // return $url;
                break;

        endswitch;

    }

    protected function sendSmsToBosses($number, $name, $order)
    {
        $message = "Dear, $name. eShop named ".$order->shop->title." received a new order".($order->id + 100000)."  -Ghoori";
        $this->smsSend($number,$message);
    }

    protected function sendEmailToCustomer($email,$name,$address,$preorder,$prebookOrder,$view,$msg, $subject = ''){
        $emailAddress = $email;
        $userName =  $name;
        $data = array(
            'emailAddress' => $emailAddress,
            'userName'=>$userName,
            'preorder'=>$preorder,
            'msg'=> $msg,
            'subject' => $subject,
            'link'=>null,
            'prebookorder'=>$prebookOrder,
            'address'=>$address,
        );
        $this->mail($view,$data, $subject);

    }

    public function mail($view,$data){
        Mail::queue($view, $data, function($message) use ($data)
        {
            $message->to( $data['emailAddress'], $data['userName'])->subject($data['subject']);
        });
    }
}