<?php

namespace App\Repositories\Eloquent;

use App\Models\Products\Product;
use App\Repositories\Contracts\Products\ProductRepositoryInterface;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function __construct(Product $model) {
        parent::__construct($model);
    }
}
