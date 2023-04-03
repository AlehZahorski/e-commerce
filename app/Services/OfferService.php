<?php

namespace App\Services;

use App\Models\Offer;
use App\Requests\Offer\CreateOfferRequest;
use App\Requests\Offer\UpdateOfferRequest;
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

    public function createOfferAction(CreateOfferRequest $request): bool
    {
        // todo auth check but maybe be better check it on controller

        $newOffer = Offer::create([
            'product_id' => $request->product_id,
            'price' => $request->price,
            'currency_id' => $request->currency_id,
            'desc_short' => $request->desc_short,
            'desc_full' => $request->desc_full,
            'is_offer_desc' => $request->is_offer_desc
        ]);

        if (!$newOffer) {
            return false;
        }

        return true;
    }

    public function updateOfferAction(UpdateOfferRequest $request, int $id): bool
    {
        // todo auth check but maybe be better check it on controller

        $offer = Offer::query()->find($id);

        if (!$offer) {
            return false;
        }

        $offer->update([
            'product_id' => $request->product_id,
            'price' => $request->price,
            'currency_id' => $request->currency_id,
            'desc_short' => $request->desc_short,
            'desc_full' => $request->desc_full,
            'is_offer_desc' => $request->is_offer_desc
        ]);

        return true;
    }

    public function deleteOfferAction(int $id): bool
    {
        // todo auth check but maybe be better check it on controller

        $offer = Offer::query()
            ->where('id', '=', $id)->first();

        if (!$offer) {
            return false;
        }

        $offer->delete();

        return true;
    }
}
