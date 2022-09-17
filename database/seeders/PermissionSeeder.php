<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'create_account' , 
            'delete_account',
            'edit_account' ,
            

        ];

        foreach ($permissions as $permission) {
            # code...
            Permission::create(['name' => $permission , 'guard_name' => 'token']);

        }
    }
}
