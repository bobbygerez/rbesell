<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    
    protected $table = 'cities';

    public function state(){

    	return $this->hasOne('App\State', 'id', 'birthplace_city_id');
    }

}
