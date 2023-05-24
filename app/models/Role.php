<?php

class Role extends \Eloquent {
    protected $table = 'roles';
	protected $fillable = ['name'];

    public function permissions()
    {
        return $this->belongsToMany('Permission');
    }
}