<?php

class Subcription extends \Eloquent {

    protected $table = 'subscription';

	protected $fillable = ['name','email','mobile'];
}