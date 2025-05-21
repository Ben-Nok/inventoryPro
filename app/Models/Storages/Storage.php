<?php

namespace App\Models\Storages;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Storage extends BaseModel
{
    use HasFactory;

    protected $table = 'storages';

    protected $fillable = [
        'name',
        'location',
    ];
}
