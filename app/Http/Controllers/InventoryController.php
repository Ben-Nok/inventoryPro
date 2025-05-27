<?php

namespace App\Http\Controllers;

use App\Enums\MovementTypes;
use App\Services\Inventory\InventoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;

class InventoryController extends Controller
{

    public function __construct(
        private readonly InventoryService $inventoryService
    )
    {
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
           'product_id' => 'required|uuid',
           'storage_id' => 'required|uuid',
           'movement_type' => [Rule::enum(MovementTypes::class)],
           'quantity' => 'required|integer|min:1',
        ]);

        $this->inventoryService->movement($request);

        return response()->json(true);
    }
}
