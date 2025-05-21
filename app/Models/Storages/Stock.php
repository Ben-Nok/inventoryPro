<?php

namespace App\Models\Storages;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
