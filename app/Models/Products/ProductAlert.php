<?php

namespace App\Models\Products;

use App\Models\BaseModel;
use Database\Factories\Products\ProductAlertFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;

/**
 *
 *
 * @property string $uuid
 * @property string $product_id
 * @property string $alert_at_quantity
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static ProductAlertFactory factory($count = null, $state = [])
 * @method static Builder<static>|ProductAlert newModelQuery()
 * @method static Builder<static>|ProductAlert newQuery()
 * @method static Builder<static>|ProductAlert query()
 * @method static Builder<static>|ProductAlert whereAlertAtQuantity($value)
 * @method static Builder<static>|ProductAlert whereCreatedAt($value)
 * @method static Builder<static>|ProductAlert whereProductId($value)
 * @method static Builder<static>|ProductAlert whereUpdatedAt($value)
 * @method static Builder<static>|ProductAlert whereUuid($value)
 * @mixin \Eloquent
 */
class ProductAlert extends BaseModel
{
    use HasFactory;

    protected $table = 'product_alert';

    protected $fillable = [
        'product_id',
        'alert_id',
        'alert_at_quantity',
    ];

}
