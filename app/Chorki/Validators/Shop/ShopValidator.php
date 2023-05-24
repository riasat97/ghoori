<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 3/18/2015
 * Time: 11:32 AM
 */

namespace Chorki\Validators\Shop;


use Chorki\Validators\FormValidator;

class ShopValidator extends FormValidator{
    //@todo add size and regex
    public static $rules=[
        'name' => 'required',
        'title'=>'required',
        'description'=>'required',
        'address'=>'required|max:160',
        'email'=>'required|email',
        'agreeWithTerms' => 'required',
        'subDomain' => array('regex:/^[a-z][a-z0-9-]{3,31}$/' , 'unique:shops,subDomain','unique:reservedsubdomains,subDomain'),
        'mobile'=>array('required','regex:/^([+]?88)?01[15-9]\d{8}$/'),
        'verifywith'=>'required',
        'nationalId' => 'required_without_all:drivingLicense,passport,birthCertificate|numeric|digits_between:13,17',
        'drivingLicense' => 'required_without_all:nationalId,passport,birthCertificate|alpha_num|size:15',
        'passport' => 'required_without_all:nationalId,drivingLicense,birthCertificate|alpha_num',
        'birthCertificate' => 'required_without_all:nationalId,drivingLicense,passport|numeric|digits:17',
        'sameAsAddress'=>'required_without:pickUpAddress',
        'pickUpAddress'=>'required_without:sameAsAddress|max:160'


    ];
}