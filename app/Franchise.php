<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Franchise extends Model
{
    protected $table = 'franchise';
    protected $fillable = [

    	'created_by', 'merchant_id', 'trade_id'
    ];

    public function trade(){

    	return $this->hasOne('App\Trade', 'id', 'trade_id');
    }
}
