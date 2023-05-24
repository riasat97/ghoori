<?php



class Division extends Eloquent  {


    //public $timestamps = false;     //added to enable insertion, MOHSIN
    //protected $fillable = ['', 'password'];

   /* protected $table = 'divisions';*/
    protected $rules=[];
    protected $fillable=['name'];

    public function shops() {
        return $this->hasMany('Shop');
    }

    public function districts() {
        return $this->hasMany('District');
    }

}
