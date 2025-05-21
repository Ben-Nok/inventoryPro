<?php

namespace Database\Factories\Products;


use App\Models\Products\Product;
use App\Models\Products\ProductAlert;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ProductAlert>
 */
class ProductAlertFactory extends Factory
{
    protected $model = ProductAlert::class;

    public function definition(): array
    {
        return [
            'uuid' => $this->faker->uuid(),
            'product_id' => Product::factory(),
            'alert_at_quantity' => $this->faker->numberBetween(0, 50),
        ];
    }
}
