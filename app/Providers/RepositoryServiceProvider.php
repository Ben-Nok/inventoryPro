<?php

namespace App\Providers;

use App\Repositories\Contracts\BaseRepositoryInterface;
use App\Repositories\Contracts\NotificationRepositoryInterface;
use App\Repositories\Contracts\Products\ProductAlertRepositoryInterface;
use App\Repositories\Contracts\Products\ProductRepositoryInterface;
use App\Repositories\Contracts\Storages\StockRepositoryInterface;
use App\Repositories\Contracts\Storages\StorageMovementRepositoryInterface;
use App\Repositories\Contracts\Storages\StorageRepositoryInterface;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Eloquent\NotificationRepository;
use App\Repositories\Eloquent\Products\ProductAlertRepository;
use App\Repositories\Eloquent\Products\ProductRepository;
use App\Repositories\Eloquent\Storages\StockRepository;
use App\Repositories\Eloquent\Storages\StorageMovementRepository;
use App\Repositories\Eloquent\Storages\StorageRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Base Repository
        $this->app->bind(BaseRepositoryInterface::class, BaseRepository::class);
        // Products
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(ProductAlertRepositoryInterface::class, ProductAlertRepository::class);
        // Storages
        $this->app->bind(StorageRepositoryInterface::class, StorageRepository::class);
        $this->app->bind(StorageMovementRepositoryInterface::class, StorageMovementRepository::class);
        $this->app->bind(StockRepositoryInterface::class, StockRepository::class);
        // Notifications
        $this->app->bind(NotificationRepositoryInterface::class, NotificationRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
