<?php

namespace Database\Factories;

use App\Models\Hotel;
use App\Models\RoomType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->randomElement($array = array('single', 'double', 'triple', 'Quad', 'Queen'), 1,true),
            'description' => fake()->sentence(),
            'room_type_id' => RoomType::inRandomOrder()->first()->id,
            'price' => fake()->numberBetween(100,500),
            'hotel_id' => Hotel::inRandomOrder()->first()->id,
            'created_at' => fake()->dateTimeBetween('-10 days', '-5 days'),
            'updated_at' => fake()->dateTimeBetween('-3 days', '-1 hour'),
        ];
    }
}
