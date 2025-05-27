<?php

namespace App\Repositories\Contracts\Storages;

use App\Models\Storages\Stock;
use App\Repositories\Contracts\BaseRepositoryInterface;

interface StockRepositoryInterface extends BaseRepositoryInterface
{
    public function findStockInStorage(string $storageId, string $productId): ?Stock;
}
