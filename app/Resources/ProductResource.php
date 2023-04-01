<?php

namespace App\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->image,
            'productType' => new ProductTypeResource($this->getProductType),
            'descShort' => $this->desc_short,
            'descFull' => $this->desc_full,
            'offerCount' => $this->getOfferCount($this->id),
            'createdAt' => date("d-m-Y H:m", strtotime($this->created_at)),
            'updatedAt' => date("d-m-Y H:m", strtotime($this->updated_at))
        ];
    }
}
