<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Role;
use Carbon\Carbon;
class Position extends Model
{
   
   	protected $table = 'positions';
   	protected $fillable = [

   		'name', 'desc'

   	];

   	public function roles(){

   		return $this->belongsToMany('App\Role', 'position_role', 'position_id', 'role_id');
   	}

   	public function getCreatedAtAttribute($value){

        return Carbon::parse($value)->toDayDateTimeString();
    }
}
