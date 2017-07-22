<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactAddress extends Model
{
    
    protected $table = 'contact_address';
    protected $fillable = [

    	'contact_data_id', 'country_id', 'province_id', 'city_id', 'brgy_id', 
    	'street_lot_blk', 'longitude', 'latitude'
    ];
}
