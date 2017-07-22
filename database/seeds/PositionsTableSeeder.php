<?php

use Illuminate\Database\Seeder;
use App\Position;

class PositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $positions = [

        	'Administrator',
        	'Manager',
        	'User'

        ];

        foreach ($positions as $position) {
        	
        	$position = Position::create([

        			'name' => $position

        		]);

        	for ($i=1; $i < 20; $i++) { 
        		
        		$position = Position::find($position->id);

        		$position->roles()->attach([

        			'role_id' => rand(1, 21),
        			'position_id' => $position->id
        		]);
        	}
        	

        }

    }
}
