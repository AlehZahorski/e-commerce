<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'image',
        'product_type_id',
        'desc_short',
        'desc_full'
    ];

    public function getProductType(): HasOne
    {
        return $this->hasOne(ProductType::class, 'id', 'product_type_id');
    }

    public function getOfferCount(int $id): int
    {
        return Offer::query()->where('product_id', '=', $id)->get()->count();
    }
}
