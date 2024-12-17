<?php

namespace Database\Factories;

use App\Enum\Wallet\WalletTransactionType;
use App\Enum\Wallet\WalletType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Wallet>
 */
class WalletFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => fake()->randomElement(array_values(WalletType::cases())),
            'amount' => fake()->randomFloat(2, 2),
            'transaction_type' => fake()->randomElement(array_values(WalletTransactionType::cases())),
            'note' => fake()->sentence(),
            'owner_id' => 1,
            'method' => 'bkash',
            'transaction_id' => Str::random(10),
            'payment_number' => fake()->numerify('+88018########'),
        ];
    }
}
