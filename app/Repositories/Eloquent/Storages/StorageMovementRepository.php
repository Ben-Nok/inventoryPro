<?php

namespace App\Repositories\Eloquent\Storages;

use App\Models\Storages\StorageMovement;
use App\Repositories\Contracts\Storages\StorageMovementRepositoryInterface;
use App\Repositories\Eloquent\BaseRepository;

class StorageMovementRepository extends BaseRepository implements StorageMovementRepositoryInterface
{
    public function __construct(StorageMovement $model)
    {
        parent::__construct($model);
    }
}
