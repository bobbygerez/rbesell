<?php

namespace App\Http\Controllers\Merchant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repo\Merchant\MerchantInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repo\RegisteredBy\RegisteredByInterface;
use App\Repo\Trade\TradeInterface;

class SystemAdminMerchantController extends Controller
{
    
    protected $merchant;
    protected $trade;

	public function __construct(MerchantInterface $merchant, TradeInterface $trade){

		$this->merchant = $merchant;
        $this->trade = $trade;

	}

    public function index(){

        $request = app()->make('request');

    	$merchants  = $this->merchant
    				->with(['branches','photos'])
    				->orderBy('created_at', 'desc')
    				->get();


        $paginate = new LengthAwarePaginator($merchants->forPage($request->page, $request->per_page), $merchants->count(), $request->per_page, $request->page);

        return response()->json([

                'merchants' => $paginate

            ]);
    }

    public function edit($id){

        $merchant = $this->merchant->whereNoDecode('id', $id)
            ->with(['branches','photos', 'address.country', 'address.province', 'address.city', 'trade', 'franchisee.trade'])
            ->first();
          
        return response()->json([

                'merchant' => $merchant

            ]);

    }

    public function update($request, $id){

        return response()->json([
                'success' => true,
                'merchant' => $this->merchant->updateMerchant($request)
            ]);

    }

    public function branches(){

        $request = app()->make('request');

        $merchant = $this->merchant->findNoDecode($request->merchantId);

        return response()->json([

                'branches' => $merchant->branches

            ]);

    }

    public function search(){

        $request = app()->make('request');

        $merchants = $this->merchant->whereOperator('name', 'LIKE', '%'.$request->q.'%')->take(8)->get();
        
        $merchants = $merchants->map(function($item){

            return [

                'id' => $item->id,
                'name' => $item->name . ' (' . $item->email . ')',
                'email' => $item->email
            ];
        });
        return response()->json($merchants);        
    }

    public function autoCompleteMerchant(){

        $request = app()->make('request');

        $merchants  = $this->merchant
                    ->whereNoDecode('id', $request->id)
                    ->with(['branches','photos', 'trade.franchise', 'address.country', 'address.province', 'address.city'])
                    ->orderBy('created_at', 'desc')
                    ->get();

        $paginate = new LengthAwarePaginator($merchants->forPage($request->page, $request->per_page), $merchants->count(), $request->per_page, $request->page);   
              
        return response()->json([

                'merchants' => $paginate
            ]);
    }

    public function franchisor(){

        return response()->json(

                $this->merchant
                    ->whereNoDecode('for_franchise', 1)
                    ->with('trade')
                    ->select(['id', 'name'])
                    ->orderBy('name', 'asc')
                    ->get()

            );
        
    }

    public function contactInfo(){

        $request = app()->make('request');

        $result = $this->merchant->contactInfo($request);

        return response()->json([

                'message' => $result

            ]);
    }

    public function uploadPhotos(){

        $request = app()->make('request');

        $result = $this->merchant->photoUpload($request);

        return response()->json([

                'message' => $result,
                'success' => true

            ]);
    }

    public function removePhotos(){

        $request = app()->make('request');

        $result = $this->merchant->removePhotos($request);

        return response()->json([

                'success' => true

            ]);

    }

    public function getImagesDZ(){

        $request = app()->make('request');

        return response()->json([

                'images' => $this->merchant->getImagesDZ($request, $request->desc)
            ]);
    }
}
