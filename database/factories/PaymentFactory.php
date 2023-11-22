<?php

namespace Database\Factories;

use App\Models\Merchant1;
use App\Models\Merchant2;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randomMerchant = rand(1, 2);
        return [
            'user_id' => function () {
                return User::factory()->create()->id;
            },
            'merchant_id' => function () use ($randomMerchant) {
                return ($randomMerchant==1 ? Merchant1::factory()->create()->id : Merchant2::factory()->create()->id);

            },
            'type' => function () use ($randomMerchant) {
                return $randomMerchant;
            },
            'amount' => fake()->numberBetween(500, 10000)*100,
            'status' => fake()->randomElement(['new', 'pending', 'completed', 'expired', 'rejected']),
        ];
    }
}
