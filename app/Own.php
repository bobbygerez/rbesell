<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Own extends Model
{
    
    protected $table = 'own';

    protected $fillable = [

    	'user_id', 'productable_id', 'productable_type', 'discount_id', 'price', 'quantity_id'

    ];


    /******************* GETTERS ***********************/
    public function getPriceAttribute($value){

        return number_format($value, 2, '.', ',');
    }
    public function getCreatedAtAttribute($value){

         return Carbon::parse($value)->toDayDateTimeString();
    }
    /******************* END GETTERS ******************/



    /****************** OBJECT RELATIONAL MAPPING ***************/
    public function products(){

    	return $this->belongsToMany('App\Product', 'own_product', 'own_id', 'product_id')->withTimestamps();
    }

    public function user(){

    	return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function discounts(){

    	return $this->hasMany('App\Discount', 'own_id', 'id');
    }

    public function quantities(){

    	return $this->hasMany('App\Quantity', 'own_id', 'id');
    }

    public function ownable(){

    	return $this->morphTo();
    }

    public function brand(){

        return $this->hasOne('App\Brand', 'id', 'brand_id');
    }
    /***************** END OBJECT RELATIONAL MAPPING ***************/
}
