<?php

namespace App\Http\Controllers\Own;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Controller\ResourceController;
use App\Repo\Own\OwnInterface;
use App\Repo\Branch\BranchInterface;
use App\Repo\Merchant\MerchantInterface;
use App\Repo\Brand\BrandInterface;
use Illuminate\Pagination\LengthAwarePaginator;


class SystemAdminOwnController extends Controller
{
    
    protected $own;
    protected $branch;
    protected $merchant;
    protected $brand;

    public function __construct(OwnInterface $own, BranchInterface $branch, MerchantInterface $merchant, BrandInterface $brand){

        $this->own = $own;
        $this->branch = $branch;
        $this->merchant = $merchant;
        $this->brand = $brand;

    }

    public function edit($id){

        $request = app()->make('request');

    	$own = $this->own->whereNoDecode('id', $id)
    		->with(['ownable', 'user', 'discounts', 'quantities', 'brand'])
    		->first();
    	 

        $merchant = '';
        $brands = $this->brand->whereNoDecode('brandable_id', $own->brand_id)->get();
    	if ($own->ownable_type == 'App\Branch'){

    		$merchantId = $this->branch->findNoDecode($own->ownable_id)
    					->first()
    					->merchant_id;
    		$merchant = $this->merchant->whereNoDecode('id', $merchantId)
    					->with(['branches'])
    					->first();

    	}
        else {

            $merchant = $this->merchant->whereNoDecode('id', $own->ownable_id)
                        ->with(['branches'])
                        ->first();
        }

        $discounts = $own->discounts;

        $discounts = new LengthAwarePaginator($discounts->forPage($request->page, $request->per_page), $discounts->count(), $request->per_page, $request->page);

    	return response()->json([

    			'own' => $own,
    			'merchant' => $merchant,
    			'brands' => $brands,
                'discounts' => $discounts
    		]);
    }


}
