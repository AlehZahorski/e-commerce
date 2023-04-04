<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'image' => $this->faker->imageUrl(),
            'product_type_id' => $this->faker->numberBetween(1, 3),
            'desc_short' => $this->faker->sentence,
            'desc_full' => $this->faker->paragraph
        ];
    }
}
