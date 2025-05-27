<?php

namespace App\Http\Resources\Storages;

use Illuminate\Http\Resources\Json\JsonResource;

class StorageListResource extends JsonResource
{
    /**
     * @param $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'storages' => StorageResource::collection($this->whenLoaded('storages')),
        ];
    }
}
