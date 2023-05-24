<?php



class PreorderImage extends Eloquent{

    protected $table = 'preorder_images';
    public $timestamps=true;
    protected $primaryKey = 'preorder_image_id';
    protected $guarded=[];

    public function preorder() {

        return $this->belongsTo('Preorder','preorder_key');
    }
}