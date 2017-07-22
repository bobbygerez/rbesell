<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    
    protected $table = 'attachment';

    protected $fillable = ['url', 'attachment_id', 'attachment_type', 'desc', 'desc_id'];
}
