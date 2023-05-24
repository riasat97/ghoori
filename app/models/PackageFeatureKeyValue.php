<?php

class PackageFeatureKeyValue extends \Eloquent {

    protected $fillable = ['package_feature_id','key','value'];

    protected $table = 'package_feature_key_values';

    public function package_feature(){
        return $this->belongsTo('PackageFeature','package_feature_id');
    }
}