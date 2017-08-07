<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Traits\RoleTrait;

use Auth;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    use RoleTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'contact_data_id', 'personal_data_id', 'member_id', 'account_no', 'email',
       'password', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function cardNos(){

        return $this->hasMany('App\CardNo', 'id', 'user_id');
    }

    public function contactData(){

        return $this->hasOne('App\ContactData', 'id', 'contact_data_id');
    }

    public function personalData(){

        return $this->hasOne('App\PersonalData', 'id', 'personal_data_id');
    }

    public function merchants(){

        return $this->belongsToMany('App\Merchant', 'merchant_user', 'user_id', 'merchant_id');
    }  

    public function branches(){

        return $this->belongsToMany('App\Branch', 'branch_user', 'user_id', 'branch_id');
    }

    public function policies(){

        return $this->morphToMany('App\Policy', 'policeable')->withTimestamps();;
    }

    public function positions(){

        return $this->belongsToMany('App\Position', 'position_user', 'user_id', 'position_id');
    }

    public function products(){

        return $this->morphToMany('App\Product', 'productable', 'productable_type', 'productable_id');
    }

    
}
