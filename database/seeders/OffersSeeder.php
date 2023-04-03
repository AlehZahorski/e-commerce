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
                'price' => 799.00,
                'currency_id' => 1,
                'desc_short' => null,
                'desc_full' => null
            ],
            [
                'product_id' => 1,
                'price' => 741.00,
                'currency_id' => 1,
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
                'price' => 4999.99,
                'currency_id' => 1,
                'desc_short' => null,
                'desc_full' => 'test test test test'
            ],
            [
                'product_id' => 2,
                'price' => 4321.00,
                'currency_id' => 1,
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
                'price' => 7999.99,
                'currency_id' => 1,
                'desc_short' => null,
                'desc_full' => 'null test'
            ],
            [
                'product_id' => 3,
                'price' => 6574.99,
                'currency_id' => 1,
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
