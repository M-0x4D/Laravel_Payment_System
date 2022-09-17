<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\models\Permission;

class Role_Permission_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission =new  Permission();
        $roleId = 1;
        $permissions = [1,2,3];

        foreach ($permissions as $per) {
            # code...
            $permission->permission_role()->attach($roleId , ['permission_id' => $per ]);

        }
    }
}
