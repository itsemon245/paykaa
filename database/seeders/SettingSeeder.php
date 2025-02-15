<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Setting::updateOrCreate(['id' => 1], [
            'transactions' => [
                'base_commission' => 0,
                'min_withdraw_amount' => 100,
                'min_deposit_amount' => 100,
                'referral_commission' => 500,
                'min_earnable_amount' => 500,
            ],
        ]);
    }
}
