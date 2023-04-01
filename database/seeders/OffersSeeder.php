<?php

namespace Database\Seeders;

use App\Models\Currency;
use App\Models\Offer;
use Illuminate\Database\Seeder;

class OffersSeeder extends Seeder
{
    public function run(): void
    {
        $offers = [
            [
                'product_id' => 1,
                'price' => 800.00,
                'currency_id' => 1,
                'desc_short' => null,
                'desc_full' => null
            ],
            [
                'product_id' => 1,
                'price' => 130.00,
                'currency_id' => 2,
                'desc_short' => null,
                'desc_full' => null
            ],
            [
                'product_id' => 1,
                'price' => 125.00,
                'currency_id' => 3,
                'desc_short' => null,
                'desc_full' => null
            ],
            [
                'product_id' => 2,
                'price' => 5000.00,
                'currency_id' => 1,
                'desc_short' => 'test',
                'desc_full' => 'test test test'
            ],
            [
                'product_id' => 2,
                'price' => 1300.00,
                'currency_id' => 2,
                'desc_short' => null,
                'desc_full' => 'test test test test'
            ],
            [
                'product_id' => 2,
                'price' => 1250.00,
                'currency_id' => 3,
                'desc_short' => null,
                'desc_full' => null
            ],
            [
                'product_id' => 3,
                'price' => 8200.00,
                'currency_id' => 1,
                'desc_short' => 'null test',
                'desc_full' => null
            ],
            [
                'product_id' => 3,
                'price' => 2000.00,
                'currency_id' => 2,
                'desc_short' => null,
                'desc_full' => 'null test'
            ],
            [
                'product_id' => 3,
                'price' => 1950.00,
                'currency_id' => 3,
                'desc_short' => null,
                'desc_full' => null
            ]
        ];

        foreach ($offers as $offer) {
            Offer::create([
                'product_id' => $offer['product_id'],
                'price' => $offer['price'],
                'currency_id' => $offer['currency_id'],
                'desc_short' => $offer['desc_short'],
                'desc_full' => $offer['desc_full']
            ]);
        }
    }
}
