<?php

namespace App\Repositories\Eloquent\Storages;

use App\Models\Storages\Stock;
use App\Repositories\Contracts\Storages\StockRepositoryInterface;
use App\Repositories\Eloquent\BaseRepository;

class StockRepository extends BaseRepository implements StockRepositoryInterface
{
    public function __construct(Stock $model)
    {
        parent::__construct($model);
    }

    /**
     * @param string $storageId
     * @param string $productId
     * @return null|Stock
     */
    public function findStockInStorage(string $storageId, string $productId): ?Stock
    {
        /** @var Stock $stock */
        $stock =  $this->model->newQuery()
            ->where('storage_uuid', '=', $storageId)
            ->where('product_uuid', '=', $productId)
            ->first();

        return $stock;
    }
}
