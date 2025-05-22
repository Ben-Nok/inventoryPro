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
}
