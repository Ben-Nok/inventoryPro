<?php

namespace App\Http\Controllers\Products;

use App\Services\Products\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProductController extends Controller
{
    public function __construct(
        private readonly ProductService $productService,
    )
    {

    }

    /**
     * @return JsonResponse All products as a json response
     */
    public function index(): JsonResponse
    {
        return response()->json($this->productService->getAllProducts());
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'sku' => 'required|string',
            'storage_id' => 'string',
            'quantity' => 'integer',
            'alert_at_quantity' => 'integer',
        ]);

        $product = $this->productService->store($request);

        return response()->json($product);
    }
}
