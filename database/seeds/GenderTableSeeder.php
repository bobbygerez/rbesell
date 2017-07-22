<?php

use Illuminate\Database\Seeder;
use App\Gender;

class GenderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $genders = [

        	'Male', 'Female', 'Others'
        ];

        foreach ($genders as $gender) {
        	
        	Gender::create([
        			'name' => $gender
        		]);
        }
    }
}
