<?php

use Illuminate\Database\Eloquent\Model;

class Package extends \Eloquent {
    protected $table= 'packages';

    public function getPublicPackages(){
        return $this->where('type','public')->get();
    }

    public function features(){
        return $this->belongsToMany('Feature','package_feature')->withTimestamps();
    }

    public function newPivot(Model $parent, array $attributes, $table, $exists){
        if ($parent instanceof Feature) {
            return new PackageFeaturePivot($parent, $attributes, $table, $exists);
        }
        return parent::newPivot($parent, $attributes, $table, $exists);
    }

    /**
     * Use it for both creating and updating feature and key-value pair
     * @param $shortName
     * @param array $keyValues
     */
    public function setFeature($shortName, $keyValues=null){
        $feature = Feature::firstOrCreate(['shortName'=>$shortName]);
        $fid = $feature->id;
        $this->features()->sync([$fid],false);
        $pivot = $this->features->find($fid)->pivot;
        foreach($keyValues as $key => $value){
            $pivot->setKeyValue($key,$value);
        }
    }

    public function getFeatureValue($featureShortName, $key){
        $feature = $this->features()->where('shortName',$featureShortName)->first();
        if(is_null($feature)){
            return null;
        }
        $pivot = $feature->pivot;
        return $pivot->getValue($key);
    }

    public function hasFeature($featureShortName){
        $feature = $this->features()->where('shortName',$featureShortName)->first();
        return !is_null($feature);
    }
}