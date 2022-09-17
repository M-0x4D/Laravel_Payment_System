<?php

namespace Database\Seeders;

use App\models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $country = new Country();
        $country->name = 'Egypt';
        $country->save();
    }
}
