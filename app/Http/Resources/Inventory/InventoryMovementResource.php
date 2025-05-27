<?php

namespace App\Http\Resources\Inventory;

use App\Http\Resources\Storages\MovementResource;
use App\Http\Resources\Storages\StockResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InventoryMovementResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'stock' => new StockResource($this['stock']),
            'movement' => new MovementResource($this['movement']),
        ];
    }
}
