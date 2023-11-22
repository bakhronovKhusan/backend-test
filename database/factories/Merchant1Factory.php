<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Merchant1>
 */
class Merchant1Factory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'merchant_id'  => fake()->numberBetween(1, 1000),
            'merchant_key' => Str::random(10),
            'user_id' => function () {
                return User::factory()->create()->id;
            },
        ];
    }
}
