<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MerchantSubcategory extends Model
{
    

    protected $table = 'merchant_subcategories';

    protected $fillable = [

    	'merchant_category_id', 'name', 'desc'
    ];

    public function products(){

    	return $this->hasMany('App\Product', 'merchant_subcategory_id', 'id');
    }

    public function merchantCategory(){

    	return $this->hasOne('App\MerchantCategory', 'id', 'merchant_category_id');
    }

    public function getNameAttribute($value){

        return str_slug($value);
    }

     public function discount(){

        return $this->morphMany('App\Discount', 'categorable', 'categorable_type', 'categorable_id');
    }
}
