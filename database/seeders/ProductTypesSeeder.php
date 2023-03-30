<?php

namespace Database\Seeders;

use App\Models\ProductType;
use Illuminate\Database\Seeder;

class ProductTypesSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            'phone',
            'computer',
            'laptop'
        ];

        foreach ($types as $type) {
            ProductType::create([
                'type' => $type
            ]);
        }
    }
}
