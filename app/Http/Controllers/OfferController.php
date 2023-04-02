<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseTrait;
use App\Services\OfferService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    use ResponseTrait;

    private OfferService $offerService;

    public function __construct(OfferService $offerService)
    {
        $this->offerService = $offerService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(int $productId): JsonResponse
    {
        $offerList = $this->offerService->getOfferListByProductIdAction($productId);

        if (null === $offerList) {
            return $this->NOT_FOUND();
        }

        return $this->OK($offerList);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        $offer = $this->offerService->getOfferByIdAction($id);

        if (null === $offer) {
            return $this->NOT_FOUND();
        }

        return $this->OK($offer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
