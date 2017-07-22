<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccessRight extends Model
{
    
    protected $table = 'access_rights';

    public function roles(){

    	return $this->belongsToMany('App\Role', 'access_right_role', 'role_id', 'access_right_id');
    }

    public function getNameAttribute($value){

    	return ucwords($value);
    }
}
