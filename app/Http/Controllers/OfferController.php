<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseTrait;
use App\Helpers\UserAuthTrait;
use App\Requests\Offer\CreateOfferRequest;
use App\Requests\Offer\UpdateOfferRequest;
use App\Services\OfferService;
use Illuminate\Http\JsonResponse;

class OfferController extends Controller
{
    use ResponseTrait;
    use UserAuthTrait;

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
    public function store(CreateOfferRequest $request): JsonResponse
    {
        if (!$this->isUserAuth()) {
            return $this->UNAUTHORIZED('User is not logged in.');
        }

        return $this->offerService->createOfferAction($request)
            ? $this->CREATED()
            : $this->CONFLICT();
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
    public function update(UpdateOfferRequest $request, int $id): JsonResponse
    {
        if (!$this->isUserAuth()) {
            return $this->UNAUTHORIZED('User is not logged in.');
        }

        return $this->offerService->updateOfferAction($request, $id)
            ? $this->OK()
            : $this->CONFLICT();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        if (!$this->isUserAuth()) {
            return $this->UNAUTHORIZED('User is not logged in.');
        }

        return $this->offerService->deleteOfferAction($id)
            ? $this->OK()
            : $this->CONFLICT();
    }
}
