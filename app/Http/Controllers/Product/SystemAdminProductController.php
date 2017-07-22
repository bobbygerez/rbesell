<?php

namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repo\Product\ProductInterface;
use Illuminate\Pagination\LengthAwarePaginator;


class SystemAdminProductController extends Controller
{
    
    protected $product;

    public function __construct(ProductInterface $product){

        $this->product = $product;

    }

    public function index(){

    	$request = app()->make('request');
        $products = $this->product->with(['brand', 'productable'])->get();
    	$paginate = new LengthAwarePaginator($products->forPage($request->page, $request->per_page), $products->count(), $request->per_page, $request->page);

    	return response()->json([

    			'products' => $paginate

    		]);
    }

    public function show($id){

        $request = app()->make('request');
        $products = $this->product->with(['discounts.discountable', 'brand', 'productable', 'productableUsers', 'productableMerchants', 'productableBranches'])->get();

        $paginate = new LengthAwarePaginator($products->forPage($request->page, $request->per_page), $products->count(), $request->per_page, $request->page);

        return response()->json([

                'products' => $paginate

            ]);
    }

    public function edit($id){

        $request = app()->make('request');

        $product = $this->product->whereNoDecode('id', $id)
                        ->with([
                            'discounts.discountable',
                            'discounts.user.personalData',
                            'user.personalData',
                            'brand', 
                            'productableUsers', 
                            'productableMerchants', 
                            'productableBranches'
                        ])
                        ->first();


        return response()->json([

                'product' => $product

            ]);
    }

    public function productSearch(){

         $request = app()->make('request');

        $products = $this->product
                        ->whereOperator('name', 'LIKE', '%'.$request->q.'%')
                        ->take(10)
                        ->get();

        return response()->json([
                'products' => $products
            ]);
    }
}
