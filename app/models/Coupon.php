<?php

class Coupon extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		'name' => 'required',
		'discount'=>'required|numeric|min:1',
		'startDate'=>'required',
		'endDate'=>'required|after:startDate',
		'noOfCupons'=>'required|min:1'
	];

	// Don't forget to fill this array
	protected $fillable = [];

	public function campaign(){
		return $this->belongsTo('Campaign');
	}
}