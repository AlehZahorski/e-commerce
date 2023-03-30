<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
           [
               'name' => 'Realme 8',
               'image' => 'image/path/some.png',
               'product_type_id' => 1,
               'desc_short' => 'test',
               'desc_full' => 'test test'
           ],
           [
               'name' => 'Acer Orion 3000',
               'image' => 'image/path/some.png',
               'product_type_id' => 2,
               'desc_short' => 'test',
               'desc_full' => 'test test'
           ],
           [
               'name' => 'Macbook Pro 13',
               'image' => 'image/path/some.png',
               'product_type_id' => 3,
               'desc_short' => 'test',
               'desc_full' => 'test test'
           ]
        ];

        foreach ($products as $product) {
            Product::create([
                'name' => $product['name'],
                'image' => $product['image'],
                'product_type_id' => $product['product_type_id'],
                'desc_short' => $product['desc_short'],
                'desc_full' => $product['desc_full']
            ]);
        }
    }
}
