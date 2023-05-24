<?php

class PhotographyServicePackage extends \Eloquent {
    protected $table = 'photography_service_packages';
	protected $fillable = ['name','price','photos'];
}