<?php

use Illuminate\Database\Seeder;
use App\User;

class PositionUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        for ($i=0; $i < 200 ; $i++) { 
        	
        	$user = User::find(rand(1,200));
	        $user->positions()->attach($user->id, [

	        		'user_id' => $user->id,
	        		'position_id' => rand(1, 3)
	        	]);
        }
       
    }
}
