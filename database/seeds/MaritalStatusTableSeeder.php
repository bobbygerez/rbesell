<?php

use Illuminate\Database\Seeder;
use App\MaritalStatus;

class MaritalStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mStatus = [

        	'Single', 'Married', 'Widowed', 'Separated',
        	'Divorced', 'Others'
        ];

        foreach ($mStatus as $value) {
        	
        	MaritalStatus::create([

        			'name' => $value
        			
        		]);
        }
    }
}
