<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class RoomTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition():array
    {
        return [
            'size' => fake()->numberBetween(1,5),
            'created_at' => fake()->dateTimeBetween('-10 days', '-5 days'),
            'updated_at' => fake()->dateTimeBetween('-3 days', '-1 hour')
        ];
    }
}
