<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonalData extends Model
{
    
    protected $table = 'personal_data';
    protected $fillable = [

    	'gender_id', 'firstname', 'lastname', 'middlename', 'mothers_maiden_name',
    	'nationality', 'birthdate', 'birthplace', 'marital_status', 'spouse_name'

    ];

    public function user(){

    	return $this->hasOne('App\User', 'id', 'personal_data_id');
    }

    public function likeName($value){

    	return $query->orWhere('firstname', 'LIKE', '%'.$value.'%');
    }
}
