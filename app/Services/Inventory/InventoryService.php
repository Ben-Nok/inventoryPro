<?php

namespace App\Services\Inventory;

use App\Models\Storages\Storage;
use App\Repositories\Contracts\Products\ProductRepositoryInterface;
use App\Repositories\Contracts\Storages\StockRepositoryInterface;
use App\Repositories\Contracts\Storages\StorageRepositoryInterface;
use Illuminate\Http\Request;

readonly class InventoryService
{
    public function __construct(
        private ProductRepositoryInterface $productRepository,
        private StorageRepositoryInterface $storageRepository,
        private StockRepositoryInterface   $stockRepository,
    )
    {

    }

    public function movement(Request $request)
    {
        $storageId = $request->input('storage_id');
        $productId = $request->input('product_id');
        $storage = $this->storageRepository->find($storageId);
        $product = $this->productRepository->find($productId);


    }
}
