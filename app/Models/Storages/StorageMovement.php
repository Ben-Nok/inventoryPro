<?php

namespace App\Models\Storages;

use App\Models\BaseModel;
use Barryvdh\LaravelIdeHelper\Eloquent;
use Database\Factories\Storages\StorageMovementFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;

/**
 *
 *
 * @property string $uuid
 * @property string $product_uuid
 * @property string $storage_uuid
 * @property string $movement
 * @property int $quantity
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static StorageMovementFactory factory($count = null, $state = [])
 * @method static Builder<static>|StorageMovement newModelQuery()
 * @method static Builder<static>|StorageMovement newQuery()
 * @method static Builder<static>|StorageMovement query()
 * @method static Builder<static>|StorageMovement whereCreatedAt($value)
 * @method static Builder<static>|StorageMovement whereMovement($value)
 * @method static Builder<static>|StorageMovement whereProductId($value)
 * @method static Builder<static>|StorageMovement whereQuantity($value)
 * @method static Builder<static>|StorageMovement whereStorageId($value)
 * @method static Builder<static>|StorageMovement whereUpdatedAt($value)
 * @method static Builder<static>|StorageMovement whereUuid($value)
 * @mixin Eloquent
 */
class StorageMovement extends BaseModel
{
    use HasFactory;

    protected $table = 'storage_movements';

    protected $fillable = [
        'storage_uuid',
        'product_uuid',
        'movement',
        'quantity',
    ];
}
