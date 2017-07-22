<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactData extends Model
{
    
    protected $table = 'contact_data';
    protected $fillable = [

    	'mobile_no', 'tel_no', 'messenger_acct'
    ];
}
