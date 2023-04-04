<?php

namespace Database\Factories;

use App\Models\Offer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Offer>
 */
class OfferFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => fake()->numberBetween(1,3),
            'price' => fake()->numberBetween(199,999),
            'currency_id' => 1,
            'desc_short' => fake()->text(100),
            'desc_full' => fake()->text,
            'is_offer_desc' => fake()->boolean
        ];
    }
}
