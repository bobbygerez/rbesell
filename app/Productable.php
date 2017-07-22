<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productable extends Model
{
    
    protected $table = 'productables';

    protected $fillable = [

    	'user_id', 'productable_id', 'productable_type', 'discount_id', 'price', 'quantity_id'

    ];

    public function products(){

    	return $this->belongsToMany('App\Product', 'product_productable', 'productable_id', 'product_id')->withTimestamps();
    }
}
