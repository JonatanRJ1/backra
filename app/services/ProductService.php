<?php

namespace App\Services;

use App\Models\Product;
use App\Data\ProductData;
use App\Data\ProductResponseData;
use App\Data\PaginationData;
use App\Data\GenericResponseData;
use App\Data\MetaData;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductService
{
    private static ?ProductService $instance = null;

    private function __construct() {

    }
    
    // Static method to get the singleton instance
    public static function getInstance(): ProductService
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Obtain paginated products 
     */
    public function getPaginatedProducts(): GenericResponseData
    {
        try {

            $productsQuery = Product::search(trim(request('query') ?? ''))->orderBy('id', 'desc');
            $paginator = $productsQuery->paginate(request('per_page', 10));
    
            $products = $paginator->getCollection()->map(function ($product) {
                return ProductData::from($product);
            })->toArray();
    
            $meta = new MetaData(
                current_page: $paginator->currentPage(),
                per_page: $paginator->perPage(),
                total: $paginator->total(),
                last_page: $paginator->lastPage()
            );


            return new GenericResponseData(
                status: true,
                message: 'Products retrieved successfully',
                code: 200,
                data: ['products' => $products, 'meta' => $meta]
            );
        } catch (\Exception $e) {
            return new GenericResponseData(
                status: false,
                message: 'Error retrieving products',
                code: 500,
                error: $e->getMessage()
            );
        }
    }

    /**
    * Obtain a product by its ID
    */
    public function getProductById(int $id): GenericResponseData
    {
        try {
            $product = Product::find($id);
            if (!$product) {
                return new GenericResponseData(
                    status: false,
                    message: 'Product not found',
                    code: 404
                );
            }
            return new GenericResponseData(
                status: true,
                message: 'Product retrieved successfully',
                code: 200,
                data: ProductData::from($product)
            );
        } catch (\Exception $e) {
            return new GenericResponseData(
                status: false,
                message: 'Error retrieving product',
                code: 500,
                error: $e->getMessage()
            );
        }
    }

    /**
     * Create a new product
     */
    public function createProduct(ProductData $data): GenericResponseData
    {
        try {
            $product = Product::create($data->toArray());
            return new GenericResponseData(
                status: true,
                message: 'Product created successfully',
                code: 201,
                data: ProductData::from($product)
            );
        } catch (\Exception $e) {
            return new GenericResponseData(
                status: false,
                message: 'Error creating product',
                code: 500,
                error: $e->getMessage()
            );
        }
    }

}