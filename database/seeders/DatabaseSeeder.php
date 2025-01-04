<?php

namespace Database\Seeders;

use App\Enum\UserType;
use App\Enum\Wallet\WalletTransactionType;
use App\Enum\Wallet\WalletType;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Wallet;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password'=> \Hash::make('12345678'),
            'type'=> UserType::Admin->value,
        ]);
        User::factory()->create([
            //make the id in microseconds
            'id'=> now()->format('ymd'),
            'name' => 'Test User',
            'email' => 'test@mail.com',
            'password'=> \Hash::make('12345678'),
        ]);
        User::factory(10)->create([
        ]);
        Wallet::factory(100)->create([
            'transaction_type'=> WalletTransactionType::DEPOSIT->value,
            'type' => WalletType::CREDIT->value,
        ]);
        $this->call([
            AddMethodSeeder::class,
        ]);
    }
}
