<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CardNo extends Model
{
    
    protected $table = 'card_nos';
    protected $fillable = [

    	'card_no', 'user_id'

    ];

    public function contactAddress(){

    	return $this->hasMany('App\ContactAddress', 'id', 'contact_data_id');
    }
}
