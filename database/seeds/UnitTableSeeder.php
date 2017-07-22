<?php

use Illuminate\Database\Seeder;
use App\Unit;

class UnitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $units = [

        	'pcs', 'kgs', 'box', 'pack'
        ];

        foreach ($units as $unit) {
        	
        	Unit::create([

                    'type' => 'product',
        			'name' => $unit

        		]);
        }

         $units = [

            'g', 'kg'
        ];

        foreach ($units as $unit) {
            
            Unit::create([

                    'type' => 'weight',
                    'name' => $unit

                ]);
        }

        $units = [

            'm', 'cm', 'mm', 'in', 'ft'
        ];

        foreach ($units as $unit) {
            
            Unit::create([

                    'type' => 'length',
                    'name' => $unit

                ]);
        }
        
         $units = [

            'l', 'ml', 'gal'
        ];

        foreach ($units as $unit) {
            
            Unit::create([

                    'type' => 'volume',
                    'name' => $unit

                ]);
        }
    }
}
