<?php

namespace App\Services;

use App\Enums\FilterEnum;
use App\Enums\SortEnum;
use App\Models\Offer;
use App\Models\Product;
use App\Requests\Product\CreateProductRequest;
use App\Requests\Product\UpdateProductRequest;
use App\Resources\ProductCollection;
use App\Resources\ProductResource;
use Illuminate\Http\Request;

class ProductService
{
    public function getProductListAction(Request $request)
    {
        $productList = Product::query();

        if (empty($productList->get())) {
            return null;
        }

        if (SortEnum::Name->value === $request->get(SortEnum::Name->value)) {
            $productList->orderBy('name');
        }

        $this->filterByName($request, $productList);

        ProductCollection::withoutWrapping();

        return new ProductCollection($productList->get());
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
        $product = Product::query()
            ->where('id', '=', $id)->first();

        if (!$product) {
            return false;
        }

        $offer = Offer::query()->where('product_id', '=', $id)->first();

        if ($offer) {
            return false;
        }

        $product->delete();

        return true;
    }

    private function filterByName(Request $request, $productList): void
    {
        $filterName = $request->get(FilterEnum::Name->value);

        if ($filterName) {
            $productList->where('name', 'LIKE', "%{$filterName}%");
        }
    }
}
