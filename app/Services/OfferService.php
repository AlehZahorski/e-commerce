<?php

namespace App\Services;

use App\Models\Offer;
use App\Resources\OfferCollection;
use App\Resources\OfferResource;

class OfferService
{
    public function getOfferListByProductIdAction(int $productId): ?OfferCollection
    {
        $offerList = Offer::query()->where('product_id', '=', $productId)->get();

        if (empty($offerList)) {
            return null;
        }

        OfferCollection::withoutWrapping();

        return new OfferCollection($offerList);
    }

    public function getOfferByIdAction(int $offerId): ?OfferResource
    {
        $offer = Offer::query()
            ->where('id', '=', $offerId)->first();

        if (!$offer) {
            return null;
        }

        OfferResource::withoutWrapping();

        return new OfferResource($offer);
    }
}
