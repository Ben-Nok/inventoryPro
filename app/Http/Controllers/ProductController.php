<?php

namespace App\Http\Controllers;

use App\Http\Resources\Products\ProductCreateResource;
use App\Http\Resources\Products\ProductResource;
use App\Services\Products\ProductService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\CssSelector\Exception\InternalErrorException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Throwable;

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
     * @param string $id
     * @return ProductResource|JsonResponse
     * @throws ValidationException
     */
    public function show(string $id): ProductResource|JsonResponse
    {
        Validator::make(['id' => $id], [
            'id' => 'required|uuid',
        ])->validate();

        try {
            $product = $this->productService->show($id);
            return ProductResource::make($product);
        } catch (ModelNotFoundException) {
            return response()->json(['message' => 'Product not found'], 404);
        }

    }

    /**
     * @param Request $request
     * @param string $id
     * @return ProductResource|JsonResponse
     * @throws ValidationException
     */
    public function update(Request $request, string $id): ProductResource|JsonResponse
    {
        Validator::make(['id' => $id], [
            'id' => 'required|uuid',
        ])->validate();

        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'sku' => 'required|string',
        ]);

        try {
            $updated = $this->productService->update($request, $id);
            return ProductResource::make($updated);
        } catch (ModelNotFoundException) {
            return response()->json(['message' => 'Updated failed: could not find product'], 404);
        }
    }

    /**
     * @param string $id
     * @return JsonResponse
     * @throws ValidationException
     */
    public function delete(string $id): JsonResponse
    {
        Validator::make(['id' => $id], [
            'id' => 'required|uuid',
        ])->validate();

        try {
            return response()->json($this->productService->delete($id));
        } catch (ModelNotFoundException) {
            return response()->json(['message' => 'Product not found'], 404);
        } catch (BadRequestException $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        } catch (InternalErrorException $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
