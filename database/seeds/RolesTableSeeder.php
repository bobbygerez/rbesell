<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Role::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $roles = [

             [ 'heirarchy' => 1, 'name' =>'System Admin'],
             [ 'heirarchy' => 2, 'name' =>'System Manager'],
             [ 'heirarchy' => 3, 'name' =>'System Finance Officer'],
             [ 'heirarchy' => 4, 'name' =>'System Auditor'],
             [ 'heirarchy' => 5, 'name' =>'System Inventory'],
             [ 'heirarchy' => 6, 'name' =>'System Cashier'],
             [ 'heirarchy' => 7, 'name' =>'System Validator'],
             [ 'heirarchy' => 8, 'name' =>'System Merchandiser'],
             [ 'heirarchy' => 9, 'name' =>'System Delivery'],
             [ 'heirarchy' => 10, 'name' =>'System CSR'],
             [ 'heirarchy' => 11, 'name' =>'System Staff'],
             [ 'heirarchy' => 12, 'name' =>'Admin'],
             [ 'heirarchy' => 13, 'name' =>'CEO'],
             [ 'heirarchy' => 14, 'name' =>'Area Manager'],
             [ 'heirarchy' => 15, 'name' =>'Branch Manager'],
             [ 'heirarchy' => 16, 'name' =>'Cashier'],
             [ 'heirarchy' => 17, 'name' =>'Validator'],
             [ 'heirarchy' => 18, 'name' =>'Merchandiser'],
             [ 'heirarchy' => 19, 'name' =>'Delivery'],
             [ 'heirarchy' => 20, 'name' =>'Customer'],
             [ 'heirarchy' => 21, 'name' =>'Beneficiary']

        ];
         

        foreach ($roles as $role) {
            
            Role::create([

                    'name' => $role['name'],
                    'heirarchy' => $role['heirarchy']
                    
                ]);
        }

    }
}
