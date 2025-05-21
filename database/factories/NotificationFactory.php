<?php

namespace Database\Factories;

use App\Models\Notification;
use App\Models\Products\Product;
use App\Models\Products\ProductAlert;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Notification>
 */
class NotificationFactory extends Factory
{
    protected $model = Notification::class;

    public function definition(): array
    {
        $product = Product::factory()->create();
        $alert = ProductAlert::factory()->create(['product_id' => $product->uuid]);

        return [
            'uuid' => $this->faker->uuid(),
            'product_id' => $product->uuid,
            'alert_id' => $alert->uuid,
            'type' => 'product_alert',
            'message' => $this->faker->sentence(),
            'status' => $this->faker->randomElement(['unread', 'read', 'resolved']),
        ];
    }
}
