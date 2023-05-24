<?php



class Preorder extends Eloquent{

    protected $table = 'preorders';
    public $timestamps=true;
    protected $primaryKey = 'preorder_id';

    public function packages(){

        return $this->hasMany('\PreorderPackage','preorder_key','preorder_key');
    }
    public function images(){

        return $this->hasMany('\PreorderImage','preorder_key','preorder_key');
    }
}