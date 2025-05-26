<?php

namespace App\Http\Resources\Products;

use App\Http\Resources\Storages\StockResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductCreateResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'product' => new ProductResource($this['product']),
            'alert' => $this['alert'] ? new ProductAlertResource($this['alert']) : null,
            'stock' => $this['stock'] ? new StockResource($this['stock']) : null,
        ];
    }
}
