<?php

namespace App\Services\Storages;

use App\Models\Storages\Storage;
use App\Repositories\Contracts\Storages\StockRepositoryInterface;
use App\Repositories\Contracts\Storages\StorageRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

readonly class StorageService
{
    public function __construct(
        private StorageRepositoryInterface $storageRepository,
        private StockRepositoryInterface $stockRepository,
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
        return $this->storageRepository->update($id, $request->all());
    }

    /**
     * @param string $id
     * @return bool
     * @throws ModelNotFoundException|BadRequestException
     */
    public function delete(string $id): bool
    {
        $storage = $this->storageRepository->find($id);
        $stocks = $this->stockRepository->where('storage_uuid', $id)->count();
        if($stocks > 0) {
            throw new BadRequestException('Cannot delete Storage: Storage is not empty');
        }
        $storage->delete();
        return true;
    }
}
