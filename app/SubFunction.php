<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubFunction extends Model
{
    

    protected $table = 'sub_functions';
    protected $fillable = [

    	'main_function_id', 'name'
    ];

    public function deepSubFunctions(){

    	return $this->hasMany('App\DeepSubFunction', 'sub_function_id', 'id');
    }
}
