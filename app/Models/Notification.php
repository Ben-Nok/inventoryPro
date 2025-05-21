<?php

namespace App\Models;

use Database\Factories\NotificationFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;

/**
 * 
 *
 * @property string $uuid
 * @property string $product_id
 * @property string $alert_id
 * @property string $type
 * @property string $message
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static NotificationFactory factory($count = null, $state = [])
 * @method static Builder<static>|Notification newModelQuery()
 * @method static Builder<static>|Notification newQuery()
 * @method static Builder<static>|Notification query()
 * @method static Builder<static>|Notification whereAlertId($value)
 * @method static Builder<static>|Notification whereCreatedAt($value)
 * @method static Builder<static>|Notification whereMessage($value)
 * @method static Builder<static>|Notification whereProductId($value)
 * @method static Builder<static>|Notification whereStatus($value)
 * @method static Builder<static>|Notification whereType($value)
 * @method static Builder<static>|Notification whereUpdatedAt($value)
 * @method static Builder<static>|Notification whereUuid($value)
 * @mixin \Eloquent
 */
class Notification extends BaseModel
{
    use HasFactory;

    protected $table = 'notifications';

    protected $fillable = [
        'product_id',
        'alert_id',
        'type',
        'message',
        'status',
    ];
}
