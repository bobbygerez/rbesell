<?php

namespace App;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class Quantity extends Model
{
    
    protected $table = 'quantities';

    protected $fillable = [

    	'product_id', 'qty', 'quantitable_id', 'quantitable_type'

    ];

    public function getCreatedAtAttribute($value){

    	return Carbon::parse($value)->toDayDateTimeString();

    }

    public function getUpdatedAtAttribute($value){

        return Carbon::parse($value)->toDayDateTimeString();
    }

     public function products(){
      
         return $this->morphToMany('App\Product', 'quantitable')->withPivot(['user_id', 'price'])->withTimestamps();
    }

    public function quantitable(){

        return $this->morphTo();
    }


}
