<?php

use Illuminate\Database\Seeder;
use App\RegisteredBy;

class RegisteredByTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $data = [

        	'SEC', 'DTI', 'CDA', 'BSP'

        ];

        foreach ($data as $value) {
        	
        	RegisteredBy::create([

        			'name' => $value
        		]);
        }
    }
}
