<?php

use Illuminate\Database\Seeder;
use App\AccessRight;
use App\Role;

class AccessRightTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $accessRights = ['create', 'read', 'update', 'delete', 'print'];

        foreach ($accessRights as $value) {
        	
        	$accessRight = AccessRight::create([

        			'name' => $value
        			
        		]);

            $roles = Role::all();

            foreach ($roles as $role) {
                
                $accessRight->roles()->attach($accessRight->id, [

                    'access_right_id' => $accessRight->id,
                    'role_id' => $role->id
                ]);
            }
            
            
        }
    }
}
