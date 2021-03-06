<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
   
   protected $table = 'branches';
   protected $fillable = [
   		'created_by', 'branch_name', 'email', 'branch_id_no',
   		'status', 'registration_no', 'date_registered', 'phone_no', 'mobile_no', 'contact_person'
   ];

   public function merchant(){

   		return $this->hasOne('App\Merchant', 'id', 'merchant_id');
   }

   public function users(){

         return $this->belongsToMany('App\User', 'branch_user', 'branch_id', 'user_id');
   }

   public function photos(){

        return $this->morphMany('App\Photo', 'imageable', 'imageable_type', 'imageable_id');
    }
   public function address(){

        return $this->morphOne('App\Address', 'addressable', 'address_type', 'address_id');
    }

    public function products(){

        return $this->morphToMany('App\Product', 'productable', 'productable_type', 'productable_id');
    }

    public function own(){

      return $this->morphOne('App\Own', 'ownable', 'ownable_type', 'ownable_id');
    }

    public function quantity(){

      return $this->morphMany('App\Quantity', 'quantitable', 'quantitable_type', 'quantitable_id');
    }

 
}
