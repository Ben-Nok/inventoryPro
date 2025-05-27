<?php

namespace App\Http\Resources\Inventory;

use App\Http\Resources\Products\ProductResource;
use App\Http\Resources\Storages\StockResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InventoryProductResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        return [
            'product' => new ProductResource($this['product']),
            'quantity_in_storage' => $this['quantity_in_storage'],
            'storage_locations' => StockResource::collection($this['storage_locations']),
        ];
    }
}
