<?php

namespace Tests\Unit\Controllers;

use App\Http\Controllers\OfferController;
use App\Resources\OfferCollection;
use App\Services\OfferService;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Mockery;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class OfferControllerTest extends TestCase
{
    use WithFaker;

    private OfferService $offerServiceMock;
    private OfferController $offerController;

    protected function setUp(): void
    {
        parent::setUp();

        $this->offerServiceMock = Mockery::mock(OfferService::class);
        $this->offerController = new OfferController($this->offerServiceMock);
    }

    public function testIndexReturnsNotFoundResponseWhenOfferListIsNull()
    {
        $requestMock = Mockery::mock(Request::class);
        $productId = 1;
        $this->offerServiceMock->shouldReceive('getOfferListByProductIdAction')->with($requestMock, $productId)->andReturn(null);

        $response = $this->offerController->index($requestMock, $productId);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(Response::HTTP_NOT_FOUND, $response->getStatusCode());
    }

    public function testIndexReturnsResponseWhenOfferListIsNotNull()
    {
        // Act
        $request = Request::create('api/offer/123', 'GET');
        $offerServiceMock = Mockery::mock(OfferService::class);
        $offerServiceMock->shouldReceive('getOfferListByProductIdAction')->andReturn(new OfferCollection([]));
        $controller = new OfferController($offerServiceMock);
        $response = $controller->index($request, 123);
        $responseData = $response->getData();

        // Assert
        $this->assertTrue($responseData->success);
        $this->assertEquals([], $responseData->data);
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }

    public function testShowReturnsNotFoundWhenOfferIsNotFound()
    {
        $offerId = 1;
        $this->offerServiceMock
            ->shouldReceive('getOfferByIdAction')
            ->once()
            ->with($offerId)
            ->andReturnNull();

        $response = $this->offerController->show($offerId);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(Response::HTTP_NOT_FOUND, $response->getStatusCode());
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
