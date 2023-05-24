<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductEventLogger extends Model{

    // Add your validation rules here
    public static $rules = [];

    protected $guarded = [''];

    protected $table = 'producteventloggers';

}