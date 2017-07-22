<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    
    protected $table = 'policies';
    protected $fillable = ['name'];

    public function users(){

    	 return $this->morphedByMany('App\User', 'policeable')->withPivot('policy_id', 'policeable_type', 'user_id');
    }

    public function roles(){

    	return $this->morphedByMany('App\Role', 'policeables');
    }
}
