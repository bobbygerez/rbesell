<?php

namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repo\Product\ProductInterface;
use App\Repo\MainCategory\MainCategoryInterface;
use App\Repo\MerchantCategory\MerchantCategoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Obfuscate;

class ApiProductController extends Controller
{

    private $collection = [];
    protected $product;
    protected $mainCategory;


    public function __construct(ProductInterface $product, MainCategoryInterface $mainCategory, MerchantCategoryInterface $merchantCategory){

    	$this->product = $product;
        $this->mainCategory = $mainCategory;
        $this->merchantCategory = $merchantCategory;
    }

    public function getData(){

        $request = app()->make('request');

        $addMerchantCat = [];
        if( $request->mainCategoryId != ''){

           $maincategories = $this->mainCategoryId($request->mainCategoryId);

           $this->mainCategories($maincategories);

           $addMerchantCat = $this->merchantCategoryProducts($maincategories->merchantCategory);


        }
        if( $request->checkedMerchantCat != ''){


            $this->collection = [];
            $arrayMerchantId = explode(',', $request->checkedMerchantCat);
            $decodedIds = $this->decodeIds($arrayMerchantId);

            $merchantCategories = $this->merchantCategory->whereIn('id', $decodedIds)->get();
            
            $this->merchantCategories($merchantCategories);
             
        }

        $collection = collect($this->collection);

        $paginate = new LengthAwarePaginator($collection->forPage($request->page, $request->per_page), $collection->count(), $request->per_page, $request->page, ['path'=>url('api/products')]);

        return response()->json([

                'products' => $paginate,
                'merchantCategories' => $addMerchantCat

        ]);

    }


    public function mainCategoryId($mainCategoryId){

        return $this->mainCategory->where('id', $mainCategoryId)
            ->orderBy('created_at', 'asc')
            ->with([
                    'merchantCategory.merchantSubcategory.products.photos', 
                    'merchantCategory.merchantSubcategory.products.prices'
                ])
            ->first();
    }


    public function mainCategories($maincategories){


        foreach ($maincategories->merchantCategory as $merchantCat) {
               
            $this->merchantSub($merchantCat->merchantSubcategory);
               
        }

    }

 

    public function merchantCategories($merchantCategories){

        foreach ($merchantCategories as $merchantCat) {
            
            $this->merchantSub($merchantCat->merchantSubcategory);
        }

    }
    
    public function merchantSub($merchantSubcategory){


        foreach ($merchantSubcategory as $merchantSub) {
            
            $this->products($merchantSub->products);        
                   
        }
    }
    

    public function products($merchantSubProducts){

        $merchantId;
        $price;
        $photo;


        foreach($merchantSubProducts as $product){

            foreach ($product->branches as $branch) {
                            
                $merchantId = $branch->merchant->id;
                $merchantName = $branch->merchant->name;
            }

        foreach ($product->prices as $price) {
                           
            if( $price->is_primary){

                $price = $price->price;
            }
                          
        }

        foreach ($product->photos as $photo) {
            if( $photo->is_primary){

                $photo = $photo->path;
            }
        }

        $this->collection[] = [

                'productId' => Obfuscate::encode($product->id),
                'merchantId' => Obfuscate::encode($merchantId),
                'merchantName' => $merchantName,
                'productName' => ucwords(str_replace('-', ' ', $product->name)),
                'desc' => $product->desc,
                'price' => number_format($price, 2, '.', ','),
                'photo' => $photo

            ];

         $this->collection2[] = [

                'productId' => Obfuscate::encode($product->id),
                'merchantId' => Obfuscate::encode($merchantId),
                'merchantName' => $merchantName,
                'productName' => ucwords(str_replace('-', ' ', $product->name)),
                'desc' => $product->desc,
                'price' => number_format($price, 2, '.', ','),
                'photo' => $photo

            ];


        }
    }

    public function decodeIds( $array ){

        $decodedIds = [];

        foreach ($array as $value) {
            
            $decodedIds[] = Obfuscate::decode($value);
        }

        return $decodedIds;
    }


    public function merchantCategoryProducts($merchantCategories){

        $products = [];

        foreach ($merchantCategories as $merchantCategory) {
            
            $total = 0;
            foreach($merchantCategory->merchantSubcategory as $merchantSub){


                   $total += $merchantSub->products->count();
                    
            }

            $products[] = [

                'merchantCatName' => ucwords(str_replace('-', ' ', $merchantCategory->name)) ,
                'merchantCatId' => Obfuscate::encode($merchantCategory->id),
                'productsCount' => $total
            ];
            
        }

        return $products;
    }
}
