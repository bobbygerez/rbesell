<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    
    protected $table = 'trade';
    protected $fillable = [

    	'created_by', 'name', 'desc'

    ];

    public function franchise(){

    	return $this->hasMany('App\Franchise', 'trade_id', 'id');
    }
}
