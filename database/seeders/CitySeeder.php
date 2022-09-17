<?php

namespace Database\Seeders;

use App\models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $city = new City();
        $city->name = 'mansoura';
        $city->governrate_id = 1;
        $city->save();
    }
}
