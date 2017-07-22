<?php

use Illuminate\Database\Seeder;
use App\Policy;
use App\User;

class PolicyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $policies = [

        	'add', 'edit', 'delete', 'approve', 'view', 'print', 'publish'

        ];

        foreach ($policies as $policy) {
        	
        	$policy = Policy::create([

        			'name' => $policy

        		]);

            for ($i= 1; $i < 10; $i++) { 
                
                $user = User::find($i);


                $user->policies()->attach($i, [

                        'policy_id' => $policy->id,
                        'policeable_id' => $i,
                        'policeable_type' => 'App\User',
                        'user_id' => $i

                    ]);
            }

        }
    }
}
