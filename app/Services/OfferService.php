<?php

namespace App\Services;

use App\Enums\FilterEnum;
use App\Enums\SortEnum;
use App\Models\Offer;
use App\Requests\Offer\CreateOfferRequest;
use App\Requests\Offer\UpdateOfferRequest;
use App\Resources\OfferCollection;
use App\Resources\OfferResource;
use Illuminate\Http\Request;

class OfferService
{
    public function getOfferListByProductIdAction(Request $request, int $productId): ?OfferCollection
    {
        $offerList = Offer::query()->where('product_id', '=', $productId);

        if ($offerList->get()->isEmpty()) {
            return null;
        }

        if (SortEnum::Price->value === $request->get('sort')) {
            $offerList->orderBy('price');
        }

        $this->filterByPrice($request, $offerList);

        OfferCollection::withoutWrapping();

        return new OfferCollection($offerList->get());
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
        $offer = Offer::query()
            ->where('id', '=', $id)->first();

        if (!$offer) {
            return false;
        }

        $offer->delete();

        return true;
    }

    private function filterByPrice(Request $request, $offerList): void
    {
        if ($this->isMaxPriceLowerThanMinPrice($request)) {
            return;
        }
        $this->filterByMinPrice($request, $offerList);
        $this->filterByMaxPrice($request, $offerList);
    }

    private function filterByMinPrice(Request $request, $offerList): void
    {
        $filterName = $request->get(FilterEnum::MinPrice->value);

        $minPrice = (int)$filterName;

        if ($minPrice) {
            $offerList->where('price', '>=', $minPrice);
        }
    }

    private function filterByMaxPrice(Request $request, $offerList): void
    {
        $filterName = $request->get(FilterEnum::MaxPrice->value);

        $maxPrice = (int)$filterName;

        if ($maxPrice) {
            $offerList->where('price', '<=', $maxPrice);
        }
    }

    private function isMaxPriceLowerThanMinPrice(Request $request): bool
    {
        if ($request->get(FilterEnum::MinPrice->value) > $request->get(FilterEnum::MaxPrice->value)) {
            return true;
        }

        return false;
    }
}
