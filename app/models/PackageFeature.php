<?php

class PackageFeature extends \Eloquent {
    protected $table = 'package_feature';

    public static function getInstance($package_id, $feature_id){
        return self::where('package_id',$package_id)->where('feature_id',$feature_id)->first();
    }

    public function package(){
        return $this->belongsTo('Package');
    }

    public function feature(){
        return $this->belongsTo('Feature');
    }

    public function key_values(){
        return $this->hasMany('PackageFeatureKeyValue','package_feature_id');
    }
}