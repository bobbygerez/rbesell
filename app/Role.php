<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Role extends Model
{
    

    protected $fillable = ['name', 'description'];

    public function users(){

    	return $this->belongsToMany('App\User', 'role_user', 'role_id', 'user_id');
    }

    public function accessRights(){

    	return $this->belongsToMany('App\AccessRight', 'access_right_role', 'role_id', 'access_right_id');
    }

    public function scopeHasRole($query, $roleNames){

    	$roles = Auth::User()->roles;
    	$roles = $roles->map(function($item){

    		return $item->name;
    	});


    	foreach ($roleNames as $value) {
            
            if( ! in_array($value, $roles->toArray()) ){

                return 'false';
            }
        }

        return 'true';
        
    }
}
