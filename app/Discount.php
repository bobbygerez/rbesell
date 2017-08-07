<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Discount extends Model
{
    
    protected $table = 'discounts';

    protected $fillable = [

    	'name', 'user_id','own_id', 'percent', 'desc', 'categorable_id', 'categorable_type', 'discountable_id', 'discountable_type', 'start', 'end'
    ];

    /*************** GETTERS *******************/
     public function getPercentAttribute($value){

        return $value . '%';
    }

    // public function getStartAttribute($value){


    //     return Carbon::parse($value)->toDayDateTimeString();
    // }

    //  public function getEndAttribute($value){


    //     return Carbon::parse($value)->toDayDateTimeString();
    // }
    /************* END GETTERS *************/




    /************** OBJECT RELATIONAL MAPPING ***************/
    public function discountable(){

    	return $this->morphTo();
    }

    public function user(){

        return $this->hasOne('App\User', 'id', 'created_by');
    }


    /************** END OBJECT RELATIONAL MAPPING ************/
}
