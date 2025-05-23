<?php

namespace App\Http\Controllers\Products;

use App\Http\Resources\ProductCreateResource;
use App\Models\Products\Product;
use App\Services\Products\ProductService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\CssSelector\Exception\InternalErrorException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Throwable;
use Validator;

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
        // todo add resource
        return response()->json($this->productService->getAllProducts());
    }

    /**
     * @param Request $request
     * @return ProductCreateResource|JsonResponse
     * @throws Throwable
     */
    public function store(Request $request): ProductCreateResource|JsonResponse
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'sku' => 'required|string',
            'storage_id' => 'string',
            'quantity' => 'integer',
            'alert_at_quantity' => 'integer',
        ]);

        try {
            $product = $this->productService->store($request);
        } catch (BadRequestException $e) {
            return response()->json($e->getMessage(), 400);
        } catch (ModelNotFoundException  $e) {
            return response()->json('Storage not found', 404);
        } catch (InternalErrorException $e) {
            return response()->json($e->getMessage(), 500);
        }

        return ProductCreateResource::make($product);
    }

    /**
     * @param string $id
     * @return Product|null
     */
    public function show(string $id): ?Product
    {
        Validator::make(['id' => $id], [
            'id' => 'required|uuid',
        ]);

        //todo: add resource
        return $this->productService->show($id);
    }
}
