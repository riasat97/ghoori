<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';
    protected $fillable = ['fbId','name','email','gender','mobile'];
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

    public function shop(){
        return $this->hasOne('Chorki\shops\Models\Shop');
    }
    public function codes(){
        return $this->hasManyThrough('VerificationCode','Chorki\shops\Models\Shop','user_id','shop_id');
    }

    public static function userHasShop($userId){
        //@todo fix it after unverified shop but has been solved
        $user= self::find($userId);
        return $user->shop? true: false;
    }
    public function orders(){
        return $this->hasMany('Chorki\Orders\Models\Order');
    }
    public function shippingAddresses(){
        return $this->hasMany('Chorki\Shippings\ShippingAddresses\ShippingAddress');
    }

    public function shops(){
        return $this->belongsToMany('Chorki\shops\Models\Shop')->withTimestamps()->withPivot('role_id');
    }
    public function search(){
        return $this->hasOne('Search');
    }
    public function assignShopRole($shopId, $role){
        $roleObject = Role::where('name',$role)->first();
        $roleId = $roleObject->id;
        if($this->shops->contains($shopId)){
            $this->shops()->updateExistingPivot($shopId,['role_id'=>$roleId]);
        }else{
            $this->shops()->attach($shopId,['role_id'=>$roleId]);
        }
    }

    public function removeShopRole($shopId){
        $this->shops()->detach($shopId);
    }

    public function shopRole($shopId){
        $user_shop = $this->shops->find($shopId);
        if(!$user_shop){
            return null;
        }
        $roleId = $user_shop->pivot->role_id;
        $role = Role::find($roleId)->with('permissions')->first();
        return $role->name;
    }

    public function hasShopRole($shopId,$role){
        $shopRole = $this->shopRole($shopId);
        return $shopRole === $role;
    }

    public function hasShopPermission($shopId,$permission){
        $user_shop = $this->shops->find($shopId);
        if(!$user_shop){
            return null;
        }
        $permission = Permission::where('name',$permission)->first();
        if(!$permission){
            return false;
        }
        $permissionId = $permission->id;

        $roleId = $user_shop->pivot->role_id;
        $exist = Role::find($roleId)->with('permissions')->first()->permissions->contains($permissionId);

        return $exist;
    }
}
