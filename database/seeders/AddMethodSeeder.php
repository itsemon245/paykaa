<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = [
            'Bitcoin',
            'Ethereum',
            'Litecoin',
            'Ripple',
            'Web Money',
            'PayPal',
            'Cash App',
            'Mobile Banking',
            'Bkash',
            'Nagad',
        ];
        foreach ($names as $name) {
            \App\Models\AddMethod::create([
                'name' => $name,
            ]);
        }
    }
}
