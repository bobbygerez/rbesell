<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MainFunction extends Model
{
    
    protected $table='main_functions';

    protected $fillable = [

    	'name'
    ];

    public function subFunctions(){

    	return $this->hasMany('App\SubFunction', 'main_function_id', 'id');
    }
}
