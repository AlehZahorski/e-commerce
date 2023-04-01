<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseTrait;
use App\Requests\Product\CreateProductRequest;
use App\Requests\Product\UpdateProductRequest;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    use ResponseTrait;

    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $productList = $this->productService->getProductListAction();

        if (null === $productList) {
            return $this->NOT_FOUND();
        }

        return $this->OK($productList);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateProductRequest $request): JsonResponse
    {
        return $this->productService->createProduct($request)
            ? $this->CREATED()
            : $this->CONFLICT();
    }

    /**
     * Display the specified resource.
     */
    public function show(int $productId): JsonResponse
    {
        $product = $this->productService->getProductById($productId);

        if (null === $product) {
            return $this->NOT_FOUND();
        }

        return $this->OK($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, int $id): JsonResponse
    {
        return $this->productService->updateProduct($request, $id)
            ? $this->OK()
            : $this->CONFLICT();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
