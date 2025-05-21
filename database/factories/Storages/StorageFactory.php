<?php

namespace Database\Factories\Storages;

use App\Models\Storages\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Storage>
 */
class StorageFactory extends Factory
{
    protected $model = Storage::class;
    public function definition(): array
    {
        return [
            'uuid' => $this->faker->uuid(),
            'name' => $this->faker->word(),
            'location' => $this->faker->randomNumber(5, true),
        ];
    }
}
