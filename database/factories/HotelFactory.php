<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\RoomType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hotel>
 */
class HotelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => rtrim(ucfirst(fake()->text(20)),'.'),
            'description' => fake()->sentence(),
            'city_id' => City::inRandomOrder()->first()->id,
            'rating' => mt_rand(1,5),
            'created_at' => fake()->dateTimeBetween('-20 days', '-10 days'),
            'updated_at' => fake()->dateTimeBetween('-5 days', '-1 days')
        ];
    }
}
