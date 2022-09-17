<?php

namespace Database\Seeders;

use App\Models\Governrate;
use Illuminate\Database\Seeder;

class GovernrateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $governrate = new Governrate();
        $governrate->name = 'Dakahlia';
        $governrate->country_id = 1;
        $governrate->save();
    }
}
