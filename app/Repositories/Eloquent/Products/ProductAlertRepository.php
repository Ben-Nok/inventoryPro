<?php

namespace App\Repositories\Eloquent\Products;

use App\Models\Products\ProductAlert;
use App\Repositories\Contracts\Products\ProductAlertRepositoryInterface;
use App\Repositories\Eloquent\BaseRepository;

class ProductAlertRepository extends BaseRepository implements ProductAlertRepositoryInterface
{
    public function __construct(ProductAlert $model)
    {
        parent::__construct($model);
    }
}
