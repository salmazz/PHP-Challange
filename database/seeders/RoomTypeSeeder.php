<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\RoomType;
use Illuminate\Database\Seeder;

class RoomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() :void
    {
        RoomType::factory()->create(['size' => 1, 'name' => 'Single']);
        RoomType::factory()->create(['size' => 2, 'name' => 'Double']);
        RoomType::factory()->create(['size' => 3, 'name' => 'Triple']);
    }
}
