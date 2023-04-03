<?php

namespace App\Requests\Offer;

use App\Requests\RequestErrorResponser;

class UpdateOfferRequest extends RequestErrorResponser
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'product_id' => 'required|int|exists:products,id',
            'price' => 'required|int|min:1',
            'currency_id' => 'required|int|exists:currencies,id',
            'desc_short' => 'nullable|string|max:255',
            'desc_full' => 'nullable|string',
            'is_offer_desc' => 'required|bool'
        ];
    }
}
