<?php

namespace App\Models\Products;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
