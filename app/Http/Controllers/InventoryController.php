<?php

namespace App\Http\Controllers;

use App\Enums\MovementTypes;
use App\Http\Resources\Inventory\InventoryMovementResource;
use App\Http\Resources\Products\ProductCreateResource;
use App\Http\Resources\Storages\StockResource;
use App\Models\Products\Product;
use App\Models\Storages\Storage;
use App\Services\Inventory\InventoryService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;
use Symfony\Component\CssSelector\Exception\InternalErrorException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Throwable;

class InventoryController extends Controller
{

    public function __construct(
        private readonly InventoryService $inventoryService
    )
    {
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
            $product = $this->inventoryService->store($request);
        } catch (BadRequestException $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        } catch (ModelNotFoundException) {
            return response()->json(['message' => 'Could not save: storage not found'], 404);
        } catch (InternalErrorException $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }

        return ProductCreateResource::make($product);
    }

    /**
     * @param Request $request
     * @return InventoryMovementResource|JsonResponse
     */
    public function movement(Request $request): InventoryMovementResource|JsonResponse
    {
        $request->validate([
           'product_uuid' => 'required|uuid',
           'storage_uuid' => 'required|uuid',
           'movement' => ['required', Rule::enum(MovementTypes::class)],
           'quantity' => 'required|integer|min:1',
        ]);

        try {
            $movement = $this->inventoryService->movement($request);

            if(array_key_exists('depleted' ,$movement)) {
                return response()->json([
                    'movement' => $movement['movement'],
                    'message' => 'stock has been depleted',
                ]);
            }

            return InventoryMovementResource::make($movement);
        } catch (ModelNotFoundException $e) {
            $model = $e->getModel();
            $message = $e->getMessage();

            if($model === Storage::class) {
                $message = 'could not change stock: storage not found';
            } elseif ($model === Product::class) {
                $message = 'could not change stock: storage not found';
            }
            return response()->json(['message' => $message]);
        } catch (BadRequestHttpException $e) {
            return response()->json(['message' => $e->getMessage()]);
        } catch (InternalErrorException $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
