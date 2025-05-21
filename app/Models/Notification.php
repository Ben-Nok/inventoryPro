<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

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
