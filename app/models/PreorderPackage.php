<?php



use Illuminate\Database\Eloquent\SoftDeletingTrait;

class PreorderPackage extends Eloquent{
	protected $dates = ['deleted_at'];
    protected $table = 'preorder_packages';
    public $timestamps=true;
    protected $primaryKey = 'preorder_package_id';
    protected $guarded=[];

    public function preorder() {

        return $this->belongsTo('Preorder','preorder_key');
    }

}