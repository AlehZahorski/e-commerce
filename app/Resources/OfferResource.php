<?php

namespace App\Resources;

use App\Models\Offer;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->getProduct->name,
            'image' => $this->getProduct->image,
            'productType' => $this->getProductType($this->getProduct->product_type_id),
            'isOfferDesc' => (bool)$this->is_offer_desc,
            'descShort' => $this->isOfferDesc($this->id)
                ? ($this->desc_short ?? $this->getProduct->desc_short)
                : $this->getProduct->desc_short,
            'descFull' => $this->isOfferDesc($this->id)
                ? ($this->desc_full ?? $this->getProduct->desc_full)
                : $this->getProduct->desc_full,
            'createdAt' => date("d-m-Y H:m", strtotime($this->created_at)),
            'updatedAt' => date("d-m-Y H:m", strtotime($this->updated_at))
        ];
    }

    private function isOfferDesc(int $id): bool
    {
        $isOfferDesc = Offer::query()->where('id', '=', $id)
            ->where('is_offer_desc', '=', 1)->first();

        if (!$isOfferDesc) {
            return false;
        }

        return true;
    }
}
