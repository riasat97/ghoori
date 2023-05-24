<?php

use Illuminate\Database\Eloquent\Model;

class Feature extends \Eloquent {
    protected $table = 'features';
	protected $fillable = ['shortName','longName','description'];

    public function packages(){
        return $this->belongsToMany('Package','package_feature')->withTimestamps();
    }

    public function newPivot(Model $parent, array $attributes, $table, $exists){
        if ($parent instanceof Package) {
            return new PackageFeaturePivot($parent, $attributes, $table, $exists);
        }
        return parent::newPivot($parent, $attributes, $table, $exists);
    }
}