<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'owner' , 
            'admin',
            'editor' ,
            'normal'

        ];

        foreach ($roles as $role) {
            # code...
            Role::create(['name' => $role , 'guard_name' => 'api']);

        }
    }
}
