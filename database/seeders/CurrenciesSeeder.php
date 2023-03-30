<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrenciesSeeder extends Seeder
{
    public function run(): void
    {
        $currencies = [
            'PLN',
            'USD',
            'EUR'
        ];

        foreach ($currencies as $currency) {
            Currency::create([
                'name' => $currency
            ]);
        }
    }
}
