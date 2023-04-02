<?php

namespace App\Models;

use App\Resources\ProductTypeResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Offer extends Model
{
    use HasFactory;

    protected $table = 'offers';

    protected $fillable = [
        'product_id',
        'price',
        'currency_id',
        'desc_short',
        'desc_full',
        'is_offer_desc'
    ];

    public function getProduct(): HasOne
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function getProductType(int $productTypeId): ?ProductTypeResource
    {
        $productType = ProductType::query()->where('id', '=', $productTypeId)->first();

        if (empty($productType)) {
            return null;
        }

        ProductTypeResource::withoutWrapping();

        return new ProductTypeResource($productType);
    }
}
