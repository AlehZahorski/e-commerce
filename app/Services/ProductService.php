<?php

namespace App\Services;

use App\Requests\Product\CreateProductRequest;
use App\Models\Product;
use App\Requests\Product\UpdateProductRequest;
use App\Resources\ProductCollection;
use App\Resources\ProductResource;

class ProductService
{
    public function getProductListAction(): ?ProductCollection
    {
        $productList = Product::all();

        if (empty($productList)) {
            return null;
        }

        ProductCollection::withoutWrapping();

        return new ProductCollection($productList);
    }

    public function getProductById(int $productId): ?ProductResource
    {
        $product = Product::query()
            ->where('id', '=', $productId)->first();

        if (!$product) {
            return null;
        }

        ProductResource::withoutWrapping();

        return new ProductResource($product);
    }

    public function createProduct(CreateProductRequest $request): bool
    {
        $newProduct = Product::create([
            'name' => $request->name,
            'image' => $request->image,
            'product_type_id' => $request->product_type_id,
            'desc_short' => $request->desc_short,
            'desc_full' => $request->desc_full
        ]);

        if (!$newProduct) {
            return false;
        }

        return true;
    }

    public function updateProduct(UpdateProductRequest $request, int $id): bool
    {
        $product = Product::query()->find($id);

        if (
            Product::query()
                ->where('id', '!=', $id)
                ->where('name', '=', $request->name)
                ->first()
        ) {
            return false;
        }

        if (!$product) {
            return false;
        }

        $product->update([
            'name' => $request->name,
            'image' => $request->image,
            'product_type_id' => $request->product_type_id,
            'desc_short' => $request->desc_short,
            'desc_full' => $request->desc_full
        ]);

        return true;
    }
}
