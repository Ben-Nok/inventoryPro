<?php

namespace App\Models\Storages;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StorageMovement extends BaseModel
{
    use HasFactory;

    protected $table = 'storage_movement';

    protected $fillable = [
        'storage_id',
        'product_id',
        'movement',
        'quantity',
    ];
}
