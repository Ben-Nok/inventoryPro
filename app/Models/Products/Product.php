<?php

namespace App\Models\Products;

use App\Models\BaseModel;
use App\Models\Storages\Stock;
use Database\Factories\Products\ProductFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 *
 *
 * @property string $uuid
 * @property string $name
 * @property string $description
 * @property string $sku
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static ProductFactory factory($count = null, $state = [])
 * @method static Builder<static>|Product newModelQuery()
 * @method static Builder<static>|Product newQuery()
 * @method static Builder<static>|Product query()
 * @method static Builder<static>|Product whereCreatedAt($value)
 * @method static Builder<static>|Product whereDescription($value)
 * @method static Builder<static>|Product whereName($value)
 * @method static Builder<static>|Product whereSku($value)
 * @method static Builder<static>|Product whereUpdatedAt($value)
 * @method static Builder<static>|Product whereUuid($value)
 * @mixin \Eloquent
 */
class Product extends BaseModel
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'sku',
    ];

    /**
     * @return HasMany
     */
    public function stock(): HasMany
    {
        return $this->hasMany(Stock::class);
    }
}
