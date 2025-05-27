<?php

namespace App\Services\Inventory;

use App\Enums\MovementTypes;
use App\Models\Products\Product;
use App\Models\Storages\Stock;
use App\Repositories\Contracts\Products\ProductAlertRepositoryInterface;
use App\Repositories\Contracts\Products\ProductRepositoryInterface;
use App\Repositories\Contracts\Storages\StockRepositoryInterface;
use App\Repositories\Contracts\Storages\StorageMovementRepositoryInterface;
use App\Repositories\Contracts\Storages\StorageRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\CssSelector\Exception\InternalErrorException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Throwable;

readonly class InventoryService
{
    public function __construct(
        private ProductRepositoryInterface $productRepository,
        private ProductAlertRepositoryInterface $productAlertRepository,
        private StorageRepositoryInterface $storageRepository,
        private StockRepositoryInterface   $stockRepository,
        private StorageMovementRepositoryInterface $storageMovementRepository,
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
        $storage = false;
        if ($request->exists('storage_uuid')) {
            $storage = $this->storageRepository->find($request->input('storage_uuid'));
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

            if ($storage) {
                $stockData = [
                    'storage_uuid' => $request->input('storage_uuid'),
                    'product_uuid' => $product->uuid,
                    'quantity' => $request->input('quantity') ?? 0,
                ];
                /** @var Stock $stock */
                $stock = $this->stockRepository->create($stockData);
                // create movement log
                $this->storageMovementRepository->create([
                    'storage_uuid' => $storage->uuid,
                    'product_uuid' => $product->uuid,
                    'movement' => MovementTypes::in->name,
                    'quantity' => $stock->quantity,
                ]);

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
     * @param Request $request
     * @return array
     * @throws ModelNotFoundException
     * @throws InternalErrorException
     */
    public function movement(Request $request): array
    {
        $storageId = $request->input('storage_uuid');
        $productId = $request->input('product_uuid');
        $movement = $request->input('movement');

        // try and find storage and product, fails with ModelNotFoundException if not found
        $this->storageRepository->find($storageId);
        $this->productRepository->find($productId);

        $stock = $this->stockRepository->findStockInStorage($storageId, $productId);

        // create new stock
        if (is_null($stock)) {
            if($movement === MovementTypes::out->value) {
                throw new BadRequestException('Cant remove stock if product is not stored');
            }
            return [
                'movement' => $this->storageMovementRepository->create($request->all()),
                'stock' => $this->stockRepository->create($request->all())
            ];
        }

        $quantity = $request->input('quantity');
        $newStock = 0;
        switch ($movement) {
            case MovementTypes::out->value:
                $newStock = $stock->quantity - $quantity;
                break;
            case MovementTypes::in->value:
                $newStock = $stock->quantity + $quantity;
                break;
        }
        if($newStock < 0) {
            throw new BadRequestException('Cant remove more stock than stored product');
        }

        try {
            DB::beginTransaction();
            $movement = $this->storageMovementRepository->create($request->all());
            // delete stock entry if no stock left
            if($newStock === 0) {
                $depleted = $this->stockRepository->delete($stock->uuid);
                DB::commit();
                return [
                    'movement' => $movement,
                    'depleted' => $depleted
                ];
            }
            // else update existing stock
            $stock = $this->stockRepository->update($stock->uuid, ['quantity' => $newStock]);
            DB::commit();
            return [
                'movement' => $movement,
                'stock' => $stock,
            ];
        } catch (Exception $e) {
            DB::rollBack();
            throw new InternalErrorException('unable to save: ' . $e->getMessage(), 500);
        }
    }
}
