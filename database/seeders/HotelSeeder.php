<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Database\Seeder;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Hotel::factory()->count(50)->create();
    }
}
