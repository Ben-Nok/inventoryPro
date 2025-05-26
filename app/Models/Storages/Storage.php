<?php

namespace App\Models\Storages;

use App\Models\BaseModel;
use Database\Factories\Storages\StorageFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/**
 *
 *
 * @property string $uuid
 * @property string $name
 * @property string $location
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Collection<int, Stock> $stock
 * @method static StorageFactory factory($count = null, $state = [])
 * @method static Builder<static>|Storage newModelQuery()
 * @method static Builder<static>|Storage newQuery()
 * @method static Builder<static>|Storage query()
 * @method static Builder<static>|Storage whereCreatedAt($value)
 * @method static Builder<static>|Storage whereLocation($value)
 * @method static Builder<static>|Storage whereName($value)
 * @method static Builder<static>|Storage whereUpdatedAt($value)
 * @method static Builder<static>|Storage whereUuid($value)
 * @mixin \Eloquent
 */
class Storage extends BaseModel
{
    use HasFactory;

    protected $table = 'storages';

    protected $fillable = [
        'name',
        'location',
    ];

    public function stock(): HasMany
    {
        return $this->hasMany(Stock::class);
    }
}
