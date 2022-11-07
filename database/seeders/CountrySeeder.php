<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param $cities
     * @return void
     */
    public function run():void
    {
        $countries = Country::factory()->count(50)->create();

        $countries->each(function ($country){
            City::factory()->state(['country_id' => $country->id])->create();
        });
    }
}
