<?php

class Permission extends \Eloquent {
    protected $table = 'permissions';
	protected $fillable = ['name'];

    public function roles()
    {
        return $this->belongsToMany('Role');
    }
}