<?php

namespace App\Models\Storages;

use App\Models\BaseModel;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;

/**
 *
 *
 * @property string $uuid
 * @property string $product_id
 * @property string $storage_id
 * @property int $quantity
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder<static>|Stock newModelQuery()
 * @method static Builder<static>|Stock newQuery()
 * @method static Builder<static>|Stock query()
 * @method static Builder<static>|Stock whereCreatedAt($value)
 * @method static Builder<static>|Stock whereQuantity($value)
 * @method static Builder<static>|Stock whereStorageId($value)
 * @method static Builder<static>|Stock whereProductId($value)
 * @method static Builder<static>|Stock whereUpdatedAt($value)
 * @method static Builder<static>|Stock whereUuid($value)
 * @mixin Eloquent
 */
class Stock extends BaseModel
{
    use HasFactory;

    protected $table = 'stock';

    protected $fillable = [
        'storage_id',
        'product_id',
        'quantity',
    ];
}
