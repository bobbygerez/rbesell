<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    
    protected $table = 'address';

    protected $fillable = ['address_id', 'address_type', 'country_id', 'region_id', 'province_id', 'municipality_id', 'barangay_id', 'street', 'lat', 'long'];

    public function addressable(){

    	return $this->morphTo();
    }

    public function country(){

    	return $this->hasOne('App\Country', 'id', 'country_id');
    }

    public function province(){

    	return $this->hasOne('App\Province', 'id', 'province_id');
    }

    public function city(){

    	return $this->hasOne('App\City', 'id', 'municipality_id');
    }
}
