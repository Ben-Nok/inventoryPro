<?php

namespace App\Models\Products;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends BaseModel
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'sku',
    ];
}
