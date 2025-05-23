<?php

namespace App\Services\Storages;

use App\Models\Storages\Storage;
use App\Repositories\Contracts\Storages\StorageRepositoryInterface;
use Illuminate\Http\Request;

readonly class StorageService
{
    public function __construct(
        private StorageRepositoryInterface $storageRepository,
    )
    {

    }

    /**
     * @param Request $request
     * @return Storage|null
     */
    public function store(Request $request): ?Storage
    {
        return $this->storageRepository->create([
            'name' => $request->input('name'),
            'location' => $request->input('location'),
        ]);
    }
}
