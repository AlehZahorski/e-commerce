<?php

namespace Tests\Unit\Resources;

use App\Models\Offer;
use App\Models\Product;
use App\Resources\OfferResource;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery;
use Tests\TestCase;

class OfferResourceTest extends TestCase
{
    use WithFaker;

    /**
     * Test the toArray method of the OfferResource class
     *
     * @return void
     */
    public function testToArray()
    {
        // Arrange && Act
        $product = Product::factory()->create();
        $offer = Offer::factory()->create([
            'product_id' => $product->id,
            'price' => $this->faker->randomFloat(2, 10, 100),
            'is_offer_desc' => $this->faker->boolean,
            'desc_short' => $this->faker->text(100),
            'desc_full' => $this->faker->paragraph,
        ]);

        $offerResource = new OfferResource($offer);
        $offerArray = $offerResource->toArray(request());

        // Assert
        $this->assertEquals($offer->id, $offerArray['id']);
        $this->assertEquals($product->name, $offerArray['name']);
        $this->assertEquals($product->image, $offerArray['image']);
        $this->assertEquals($offer->price, $offerArray['price']);

        Offer::where('id', $offer->id)->delete();
        Product::where('id', $product->id)->delete();
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}





