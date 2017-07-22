<?php

use Illuminate\Database\Seeder;
use App\Branch;

class BranchUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        for ($i=0; $i < 300; $i++) { 
        	
        	$branch = Branch::find(rand(1, 30));
        	$branch->users()->attach([

        			'user_id' => rand(1, 30),
        			'branch_id' => rand(1, 30)
        		]);
        }
        

    }
}
