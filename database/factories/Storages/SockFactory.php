<?php

namespace Database\Factories\Storages;

use App\Models\Products\Product;
use App\Models\Storages\Stock;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Stock>
 */
class SockFactory extends Factory
{
    protected $model = Stock::class;
    public function definition(): array
    {
        $product = Product::factory()->create();
        $storage = Stock::factory()->create();

        return [
            'uuid' => $this->faker->uuid(),
            'storage_id' => $product->uuid,
            'product_id' => $storage->uuid,
            'quantity' => $this->faker->numberBetween(1, 100),
        ];
    }
}
