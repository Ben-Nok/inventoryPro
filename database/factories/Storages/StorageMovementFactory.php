<?php

namespace Database\Factories\Storages;

use App\Models\Products\Product;
use App\Models\Storages\Stock;
use App\Models\Storages\StorageMovement;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<StorageMovement>
 */
class StorageMovementFactory extends Factory
{

    public function definition(): array
    {
        $product = Product::factory()->create();
        $storage = Stock::factory()->create();

        return [
            'uuid' => $this->faker->uuid(),
            'storage_id' => $storage->id,
            'product_id' => $product->id,
            'movement' => $this->faker->randomElement(['in', 'out']),
            'quantity' => $this->faker->numberBetween(1, 25),
        ];
    }
}
