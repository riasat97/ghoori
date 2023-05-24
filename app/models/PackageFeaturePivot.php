<?php
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Model;

class PackageFeaturePivot extends Pivot {

    protected $table = 'package_feature';

    protected $package_id, $feature_id, $modelInstance , $keyValueCollection, $keyValueChanged;

    public function __construct(Model $parent, $attributes, $table, $exists = false){
        parent::__construct($parent, $attributes, $table, $exists);
        $this->package_id = $attributes['package_id'];
        $this->feature_id = $attributes['feature_id'];
        $this->modelInstance = null;
        $this->keyValueCollection = null;
        $this->keyValueChanged = true;
    }

    public function package(){
        return $this->belongsTo('Package');
    }

    public function feature(){
        return $this->belongsTo('Feature');
    }

    public function getModel(){
        if(is_null($this->modelInstance)){
            $this->modelInstance = PackageFeature::getInstance($this->package_id, $this->feature_id);
        }
        return $this->modelInstance;
    }

    public function key_values(){
        if($this->keyValueChanged){
            $model = $this->getModel();
            $this->keyValueCollection = $model->key_values()->get();
            $this->keyValueChanged = false;
        }
        return $this->keyValueCollection;
    }

    public function setKeyValue($key,$value){
        $model = $this->getModel();
        $keyValue = PackageFeatureKeyValue::firstOrNew(['package_feature_id'=>$model->id,'key'=>$key]);
        $keyValue->value = $value;
        $keyValue->save();
        $this->keyValueChanged = true;
    }

    public function getValue($key){
        $keyValues = $this->key_values();
        $value = null;
        $keyValues->each(function($keyValue) use($key,&$value){
            if($keyValue->key==$key){
                 $value = $keyValue->value;
            }
        });

        return $value;
    }
}