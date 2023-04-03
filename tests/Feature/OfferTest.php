<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class OfferTest extends TestCase
{
    use DatabaseTransactions;

    public function test_should_return_offer_list(): void
    {
        // Arrange
        $productId = 1;

        // Act && Assert
        $response = $this->get("/api/offer/list/{$productId}");
        $response->assertStatus(200);
    }

    public function test_should_not_return_offer_list(): void
    {
        // Arrange
        $productId = 999999;

        // Act && Assert
        $response = $this->get("/api/offer/list/{$productId}");
        $response->assertStatus(404);
    }
}
