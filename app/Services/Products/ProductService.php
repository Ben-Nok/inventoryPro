<?php

namespace App\Services\Products;

use App\Models\Products\Product;
use App\Models\Storages\Stock;
use App\Repositories\Contracts\Products\ProductAlertRepositoryInterface;
use App\Repositories\Contracts\Products\ProductRepositoryInterface;
use App\Repositories\Contracts\Storages\StockRepositoryInterface;
use App\Repositories\Contracts\Storages\StorageRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Symfony\Component\CssSelector\Exception\InternalErrorException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Throwable;

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
     * Saves a new Product with an optional, initial stock and storage location.
     *
     * @param Request $request
     * @return array|string
     * @throws InternalErrorException|BadRequestException|ModelNotFoundException
     * @throws Throwable
     */
    public function store(Request $request): array|string
    {
        if (!$request->exists('storage_uuid')) {
            $this->storageRepository->find($request->input('storage_uuid'));
        }
        if ($request->exists('quantity') && empty($request->input('storage_uuid'))) {
            throw new BadRequestException('no storage given', 400);
        }

        try {
            DB::beginTransaction();
            $productData = [
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'sku' => $request->input('sku'),
            ];
            /** @var Product $product */
            $product = $this->productRepository->create($productData);

            $alertAtData = [
                'product_uuid' => $product->uuid,
                'alert_at_quantity' => $request->input('alert_at_quantity') ?? 0,
            ];

            $alert = $this->productAlertRepository->create($alertAtData);
            $stock = null;

            if ($request->exists('storage_uuid')) {
                $stockData = [
                    'storage_uuid' => $request->input('storage_uuid'),
                    'product_uuid' => $product->uuid,
                    'quantity' => $request->input('quantity'),
                ];
                /** @var Stock $stock */
                $stock = $this->stockRepository->create($stockData);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new InternalErrorException('unable to save: ' . $e->getMessage(), 500);
        }

        return [
            'product' => $product,
            'alert' => $alert,
            'stock' => $stock,
        ];
    }

    /**
     * @return Collection<int, Product>
     */
    public function getAllProducts(): Collection
    {
        return $this->productRepository->all();
    }

    /**
     * @param string $id
     * @return Product|null
     */
    public function show(string $id): ?Product
    {
        return $this->productRepository->productWithStackAndStorage($id);
    }
}
