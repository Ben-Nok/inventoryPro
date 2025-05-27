<?php

namespace App\Services\Products;

use App\Models\Products\Product;
use App\Repositories\Contracts\Products\ProductRepositoryInterface;
use App\Repositories\Contracts\Storages\StockRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Symfony\Component\CssSelector\Exception\InternalErrorException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

readonly class ProductService
{
    public function __construct(
        private ProductRepositoryInterface $productRepository,
        private StockRepositoryInterface   $stockRepository,
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

    /**
     * @param string $id
     * @return Product|null
     * @throws ModelNotFoundException
     */
    public function show(string $id): ?Product
    {
        return $this->productRepository->productWithStockAndStorage($id);
    }

    /**
     * @param Request $request
     * @param string $id
     * @return Product|null
     * @throws ModelNotFoundException
     */
    public function update(Request $request, string $id): ?Product
    {
        return $this->productRepository->update($id, $request->all());
    }

    /**
     * @param string $id
     * @return bool
     * @throws ModelNotFoundException|BadRequestException|InternalErrorException
     */
    public function delete(string $id): bool
    {
        $product = $this->productRepository->find($id);
        $stockCount = $this->stockRepository->where('product_uuid', $id)->count();
        if ($stockCount > 0) {
            throw new BadRequestException('cannot delete product with stock', 400);
        }
        try {
            DB::beginTransaction();
            $product->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new InternalErrorException($e->getMessage());
        }
        return true;
    }
}
