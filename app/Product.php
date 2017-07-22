<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\ProductDataViewer;
use Carbon\Carbon;

class Product extends Model
{
    
    use ProductDataViewer;

    protected $fillable = [

    	'productable_id', 'productable_type', 'user_id', 'unit_id', 'brand_id', 'model_number', 'name',  'desc', 'discount', 'discount2'
    ];


    /************* GETTERS *****************/
    
    public function getDiscountAttribute($value){

        return $value . '%';
    }

    public function getNameAttribute($value){

        $lower = strtolower($value);

        return ucwords($lower);
    }

    public function getCreatedAtAttribute($value){


        return Carbon::parse($value)->toDayDateTimeString();
    }

    /************* END GETTERS *****************/





    /************* OBJECT RELATIONAL MAPPING ***************/
    public function photos(){

    	return $this->morphMany('App\Photo', 'imageable');
    }

    public function user(){

        return $this->hasOne('App\User', 'id', 'user_id');
    }
    
    public function brand(){

        return $this->hasOne('App\Brand', 'id', 'brand_id');
    }


    public function merchantSubcategory(){

    	return $this->hasOne('App\MerchantSubcategory', 'id', 'merchant_subcategory_id');
    }

    public function mainCategory(){

    	return $this->belongsToMany('App\MainCategory', 'maincategory_product', 'maincategory_id', 'product_id');
    }

    public function unit(){

        return $this->hasOne('App\Unit', 'id', 'unit_id');
    }

    public function branches(){

        return $this->belongsToMany('App\Branch', 'branch_product', 'product_id', 'branch_id');
    }

    

    public function getPriceAttribute($value){

        return number_format($value, 2, '.', ',');
    }

    public function users()
    {
        return $this->morphedByMany('App\User', 'productable');
    }

    public function discounts(){

        return $this->hasMany('App\Discount', 'product_id', 'id');
    }

    public function merchants()
    {
        return $this->morphedByMany('App\Merchant', 'productable');
    } 

     
     public function productable(){

        return $this->belongsToMany('App\Productable', 'product_productable', 'product_id', 'productable_id');
     }
    // public function productable(){

    //     return $this->morphTo();
    // }
    //  public function productableUsers()
    // {
    //     return $this->morphedByMany('App\User', 'productable')->withPivot(['user_id', 'price', 'discount_id', 'quantity_id', 'price'])->withTimestamps();
    // } 

    //  public function productableMerchants()
    // {
    //     return $this->morphedByMany('App\Merchant', 'productable')->withPivot(['user_id', 'price', 'discount_id', 'quantity_id', 'price'])->withTimestamps();
    // } 

    // public function productableBranches()
    // {
    //     return $this->morphedByMany('App\Branch', 'productable')->withPivot(['user_id', 'price', 'discount_id', 'quantity_id', 'price'])->withTimestamps();
    // } 


    /************* END OBJECT RELATIONAL MAPPING ***************/
}
