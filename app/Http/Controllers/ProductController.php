<?php

namespace App\Http\Controllers;

use App\Data\ProductData;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\CreateProductRequest;

class ProductController extends Controller
{
    private ProductService $productService;
    
    public function __construct()
    {
        // singleton instance of ProductService
        $this->productService = ProductService::getInstance();
    }
    
    /**
     * obtain paginated products 
    */
    public function index(Request $request): JsonResponse
    {
        return response()->json($this->productService->getPaginatedProducts());
    }

    /**
     * Obtain a product by its ID
     */ 
    public function show(int $id): JsonResponse
    {
        return response()->json($this->productService->getProductById($id));
    }

    /**
     * Store a new product
     */
    public function store(Request $request, CreateProductRequest $createProductRequest, ProductData $productData): JsonResponse
    {
        return response()->json($this->productService->createProduct($productData));
    }

    /**
     * Delete a product by its ID
     */
    public function destroy(int $id): JsonResponse
    {
        return response()->json($this->productService->deleteProduct($id));
    }
     
}