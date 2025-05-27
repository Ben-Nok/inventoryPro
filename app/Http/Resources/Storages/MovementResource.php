<?php

namespace App\Http\Resources\Storages;

use App\Models\Storages\StorageMovement;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin StorageMovement */
class MovementResource extends JsonResource
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
            'storage_uuid' => $this->storage_uuid,
            'product_uuid' => $this->product_uuid,
            'movement' => $this->movement,
            'quantity' => $this->quantity,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
