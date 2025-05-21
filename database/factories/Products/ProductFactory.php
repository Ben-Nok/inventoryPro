<?php

namespace Database\Factories\Products;

use App\Models\Products\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'uuid' => $this->faker->uuid(),
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'sku' => $this->faker->ean8()
        ];
    }
}

