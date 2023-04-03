<?php

namespace App\Services;

use App\Models\Offer;
use App\Models\Product;
use App\Requests\Product\CreateProductRequest;
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

    public function getProductByIdAction(int $productId): ?ProductResource
    {
        $product = Product::query()
            ->where('id', '=', $productId)->first();

        if (!$product) {
            return null;
        }

        ProductResource::withoutWrapping();

        return new ProductResource($product);
    }

    public function createProductAction(CreateProductRequest $request): bool
    {
        // todo auth check but maybe be better check it on controller

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

    public function updateProductAction(UpdateProductRequest $request, int $id): bool
    {
        // todo auth check but maybe be better check it on controller

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

    public function deleteProductAction(int $id): bool
    {
        // todo auth check but maybe be better check it on controller

        $product = Product::query()
            ->where('id', '=', $id)->first();

        if (!$product) {
            return false;
        }

        $offer = Offer::query()->where('product_id','=',$id)->first();

        if ($offer) {
            return false;
        }

        $product->delete();

        return true;
    }
}
