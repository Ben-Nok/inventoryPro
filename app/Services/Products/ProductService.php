<?php

namespace App\Services\Products;

use App\Models\Products\Product;
use App\Models\Products\ProductAlert;
use App\Models\Storages\Stock;
use App\Repositories\Contracts\Products\ProductAlertRepositoryInterface;
use App\Repositories\Contracts\Products\ProductRepositoryInterface;
use App\Repositories\Contracts\Storages\StockRepositoryInterface;
use App\Repositories\Contracts\Storages\StorageRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

readonly class ProductService
{
    public function __construct(
        private ProductRepositoryInterface      $productRepository,
        private ProductAlertRepositoryInterface $productAlertRepository,
        private StorageRepositoryInterface      $storageRepository,
        private StockRepositoryInterface        $stockRepository,
    )
    {

    }

    /**
     * @return Collection<int, Product>
     */
    public function getAllProducts(): Collection
    {
        return $this->productRepository->all();
    }

    public function store(Request $request): array|string
    {
        if ($request->has('storage')) {
            try {
                $this->storageRepository->find($request->get('storage'));
            } catch (ModelNotFoundException) {
                return 'Storage not found';
            }
        }

        $productData = [
            'name' => $request->get('productName'),
            'description' => $request->get('productDescription'),
            'sku' => $request->get('productDescription'),
        ];
        /** @var Product $product */
        $product = $this->productRepository->create($productData);

        if ($request->has('alert_at_quantity')) {
            $alertAtData = [
                'product_id' => $product->uuid,
                'alert_at_quantity' => $request->get('alert_at_quantity'),
            ];
            /** @var ProductAlert $alert */
            $alert = $this->productAlertRepository->create($alertAtData);
        }

        if ($request->has('storage')) {
            $stockData = [
                'storage_id' => $request->get('storage'),
                'product_id' => $product->uuid,
                'quantity' => $request->get('quantity'),
            ];
            /** @var Stock $stock */
            $stock = $this->stockRepository->create($stockData);
        }

        return [];
    }
}
