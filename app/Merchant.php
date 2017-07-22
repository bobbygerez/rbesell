<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    
    protected $table = "merchants";

    protected $fillable = [

    	'created_by', 'merchant_id', 'phone_no', 'mobile_no', 'contact_person', 'status', 'name', 'website', 'email', 'registered_by_id', 'ownership_type_id', 'registration_no', 'date_registered', 'for_franchise', 'trade_id', 'franchise_id'
    	
    ];

    /****************GETTERS*************/
     public function getNameAttribute($value){

        $lower = strtolower($value);

        return ucwords($lower);
    }

    /*************END GETTERS**************/




    /************OBJECT RELATIONAL MAPPING***********/

    
    public function users(){

    	return $this->belongsToMany('App\User', 'merchant_user', 'merchant_id', 'user_id');
    }

    public function branches(){

    	return $this->belongsToMany('App\Merchant', 'branch_merchant', 'merchant_id', 'branch_id');
    }

    public function address(){

        return $this->morphOne('App\Address', 'addressable', 'address_type', 'address_id');
    }

    public function trade(){

        return $this->hasOne('App\Trade', 'id', 'trade_id');
    }

    public function franchisee(){

        return $this->hasOne('App\Franchise', 'id', 'franchise_id');
    }

    public function photos(){

        return $this->morphMany('App\Photo', 'imageable', 'imageable_type', 'imageable_id');
    }

    public function products(){
      
         return $this->morphToMany('App\Product', 'productable')->withPivot(['user_id', 'price'])->withTimestamps();
    } 

    /************ END OBJECT RELATIONAL MAPPING***********/
}
