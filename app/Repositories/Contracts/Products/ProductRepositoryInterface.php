<?php

namespace App\Repositories\Contracts\Products;

use App\Models\Products\Product;
use App\Repositories\Contracts\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

interface ProductRepositoryInterface extends BaseRepositoryInterface
{
    public function productWithStackAndStorage (string $id): ?Product;
}
