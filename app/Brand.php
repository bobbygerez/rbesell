<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    
    protected $table = 'brands';

    protected $fillable = [

    	'name', 'desc'
    ];

    public function brandable(){

    	return $this->morphTo();
    }
}
