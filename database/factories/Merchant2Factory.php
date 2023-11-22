<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Merchant2>
 */
class Merchant2Factory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'app_id'  => fake()->numberBetween(1, 100),
            'app_key' => Str::random(10),
            'user_id' => function () {
                return User::factory()->create()->id;
            },
        ];
    }
}
