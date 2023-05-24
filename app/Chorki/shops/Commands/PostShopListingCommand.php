<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 3/18/2015
 * Time: 11:29 AM
 */

namespace Chorki\shops\Commands;


class PostShopListingCommand {

    public $name, $title,$description,$address,$email,$mobile,$user_id, $subDomain, $package;
    public $nationalId;
    public $drivingLicense;
    public $passport;
    public $birthCertificate;
    public $pickUpAddress;

    function __construct($name, $title, $description, $address, $email, $package,
                         $mobile, $user_id,$subDomain ,$nationalId,$drivingLicense,$passport,$birthCertificate,$pickUpAddress)
    {
        $this->name = $name;
        $this->title = $title;
        $this->description = $description;
        $this->address = $address;
        $this->email = $email;
        $this->mobile = $mobile;
        $this->user_id = $user_id;
        $this->subDomain = $subDomain;
        $this->nationalId = $nationalId;
        $this->drivingLicense = $drivingLicense;
        $this->passport = $passport;
        $this->birthCertificate = $birthCertificate;
        $this->pickUpAddress = $pickUpAddress;
        $this->package = $package;
    }
}