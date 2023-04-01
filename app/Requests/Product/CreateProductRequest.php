<?php

namespace App\Requests\Product;

use App\Requests\RequestErrorResponser;

class CreateProductRequest extends RequestErrorResponser
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|unique:products,name',
            'image' => 'required|string|max:255',
            'product_type_id' => 'required|int|exists:product_types,id',
            'desc_short' => 'required|string|max:255',
            'desc_full' => 'required|string'
        ];
    }
}
