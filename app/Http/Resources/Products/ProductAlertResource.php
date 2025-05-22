<?php

namespace App\Http\Resources\Products;

use App\Models\Products\ProductAlert;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin ProductAlert */
class ProductAlertResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->uuid,
            'productId' => $this->product_id,
            'alertAtQuantity' => $this->alert_at_quantity,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];
    }
}
