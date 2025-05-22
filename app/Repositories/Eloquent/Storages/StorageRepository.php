<?php

namespace App\Repositories\Eloquent\Storages;

use App\Models\Storages\Storage;
use App\Repositories\Contracts\Storages\StorageRepositoryInterface;
use App\Repositories\Eloquent\BaseRepository;

class StorageRepository extends BaseRepository implements StorageRepositoryInterface
{
    public function __construct(Storage $model)
    {
        parent::__construct($model);
    }
}
