<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OwnershipType extends Model
{
    
    protected $table = 'ownership_type';

    protected $fillable = ['name'];
}
