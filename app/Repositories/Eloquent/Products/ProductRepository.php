<?php

namespace App\Repositories\Eloquent\Products;

use App\Models\Products\Product;
use App\Repositories\Contracts\Products\ProductRepositoryInterface;
use App\Repositories\Eloquent\BaseRepository;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function __construct(Product $model) {
        parent::__construct($model);
    }

    /**
     * @param string $id
     * @return Product|null
     */
    public function productWithStackAndStorage (string $id): ?Product
    {
        $product = Product::with('stock.storage')->find($id);

        return $product;
    }
}
