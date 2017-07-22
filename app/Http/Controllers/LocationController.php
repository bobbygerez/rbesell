<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repo\Region\RegionInterface;


use App\Repo\Barangay\BarangayInterface;
use Obfuscate;
class LocationController extends Controller
{

    protected $country;
	protected $region;
	protected $province;
	protected $city;
	protected $barangay;

	public function __construct(RegionInterface $region, ProvinceInterface $province, CityInterface $city, BarangayInterface $barangay, CountryInterface $country){

        $this->country = $country;
		$this->region = $region;
		$this->province = $province;
		$this->city = $city;
		$this->barangay = $barangay;
	}
    
    public function countries(){

        return response()->json([

                'countries' => $this->country->orderBy('name', 'asc')->get()
            ]);

    }
    public function region(){

        $collection  = $this->region->all();

    	return response()->json([

    			'regions' => $this->region->all()
    		]);
    }


    public function regionProvinces( $regCode ){

    	return response()->json([

    			'provinces' =>  $this->province->where('regCode', $regCode)->get()
    		]);
    }

    public function provinceAll(){

    	return response()->json([

    			'provinces' => $this->province->orderBy('provDesc', 'asc')->get()
    		]);
    }

    public function cityAll(){

    	return response()->json([

    			'cities' => $this->city->all()
    		]);
    }

    public function provinceCities($provCode){

    	return response()->json([

    			'cities' => $this->city->whereNoDecode('provCode', $provCode)->get()
    		]);
    }

    public function cityBarangay( $cityCode ){

    	return response()->json([

    			'barangays' => $this->barangay->whereNoDecode('citymunCode', $cityCode)->get()
    		]);
    }
}
