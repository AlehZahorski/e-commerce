<?php

namespace Tests\Unit\Services;

use App\Models\Offer;
use App\Requests\Offer\CreateOfferRequest;
use App\Resources\OfferResource;
use App\Services\OfferService;
use Illuminate\Http\Request;
use Mockery;
use Tests\TestCase;

class OfferServiceTest extends TestCase
{
    private OfferService $offerService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->offerService = app(OfferService::class);
    }

    public function testGetOfferListByProductIdActionReturnsNullWhenNoOffersExistForProductId()
    {
        // Arrange && Act
        $offerService = new OfferService();
        $request = new Request();
        $productId = 123;
        $result = $offerService->getOfferListByProductIdAction($request, $productId);

        // Assert
        $this->assertNull($result);
    }

    public function testGetOfferByIdActionReturnsNullWhenOfferDoesNotExist()
    {
        // Arrange && Act
        $offerService = new OfferService();
        $offerId = 123;
        $result = $offerService->getOfferByIdAction($offerId);

        // Assert
        $this->assertNull($result);
    }

    public function testGetOfferByIdActionReturnsOfferResourceWhenOfferExists()
    {
        // Arrange && Act
        $offer = Offer::factory()->create();
        $offerService = new OfferService();
        $result = $offerService->getOfferByIdAction($offer->id);

        // Assert
        $this->assertInstanceOf(OfferResource::class, $result);
        $this->assertEquals($offer->id, $result->id);
        $this->assertEquals($offer->product_id, $result->product_id);
        Offer::where('id', $offer->id)->delete();
    }

    public function testCreateOfferAction(): void
    {
        // Arrange && Act
        $requestData = [
            'product_id' => 1,
            'price' => 10,
            'currency_id' => 1,
            'desc_short' => 'Short Description',
            'desc_full' => 'Full Description',
            'is_offer_desc' => true,
        ];
        $request = new CreateOfferRequest($requestData);
        $response = $this->offerService->createOfferAction($request);

        // Assert
        $this->assertTrue($response);
        $this->assertDatabaseHas('offers', $requestData);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
