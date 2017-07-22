<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegisteredBy extends Model
{
    
    protected $table = 'registered_by';

    protected $fillable = [ 'name'];
}
