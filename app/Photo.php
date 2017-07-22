<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    

    protected $fillable = [

    	'path', 'imageable_id', 'imageable_type', 'name', 'desc', 'size'
    	
    ];

    public function imageable(){

    	return $this->morphTo();
    }

    public function scopeIsPrimary($query){

    	$result  = $query->where('is_primary', 1)->first();

    	if( $result ){

    		return $result->path;
    	}
    }
}
