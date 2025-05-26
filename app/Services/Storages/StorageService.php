<?php

namespace App\Services\Storages;

use App\Models\Storages\Storage;
use App\Repositories\Contracts\Storages\StorageRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

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

    /**
     * @return Collection<int,Storage>
     */
    public function index(): Collection
    {
        return $this->storageRepository->all();
    }

    /**
     * @param string $id
     * @return Storage|null
     * @throws ModelNotFoundException
     */
    public function show(string $id): ?Storage
    {
        return $this->storageRepository->find($id);
    }

    /**
     * @param Request $request
     * @param string $id
     * @return Storage|null
     * @throws ModelNotFoundException
     */
    public function update(Request $request, string $id): ?Storage
    {
        return $this->storageRepository->update($id, [$request->all()]);
    }
}
