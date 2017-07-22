<?php

use Illuminate\Database\Seeder;
use App\OwnershipType;

class OwnershipTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $data = ['Sole proprietor', 'General Partnership', 'Limited Partnership', 'Corporation', 'Cooperative'];

        foreach ($data as $value) {
        	
        	OwnershipType::create([
        			'name' => $value
        		]);
        }
    }
}
