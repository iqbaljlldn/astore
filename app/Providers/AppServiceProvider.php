<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interface\CategoryRepositoryInterface;
use App\Repositories\CategoryRepository;
use App\Services\CategoryService;
use App\Interface\CustomersRepositoryInterface;
use App\Repositories\CustomersRepository;
use App\Services\CustomersService;
use App\Interface\ProductsRepositoryInterface;
use App\Repositories\ProductsRepository;
use App\Services\ProductsService;
use App\Interface\LogRepositoryInterface;
use App\Repositories\LogRepository;
use App\Services\LogService;
use App\Interface\ProductGalleryRepositoryInterface;
use App\Repositories\ProductGalleryRepository;
use App\Services\ProductGalleryService;
use App\Interface\SalesRepositoryInterface;
use App\Repositories\SalesRepository;
use App\Services\SalesService;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(CategoryService::class, function ($app) {
            return new CategoryService($app->make(CategoryRepositoryInterface::class));
        });
        $this->app->bind(CustomersRepositoryInterface::class, CustomersRepository::class);
        $this->app->bind(CustomersService::class, function ($app) {
            return new CustomersService($app->make(CustomersRepositoryInterface::class));
        });
        $this->app->bind(ProductsRepositoryInterface::class, ProductsRepository::class);
        $this->app->bind(ProductsService::class, function ($app) {
            return new ProductsService($app->make(ProductsRepositoryInterface::class));
        });
        $this->app->bind(LogRepositoryInterface::class, LogRepository::class);
        $this->app->bind(LogService::class, function ($app) {
            return new LogService($app->make(LogRepositoryInterface::class));
        });
        $this->app->bind(ProductGalleryRepositoryInterface::class, ProductGalleryRepository::class);
        $this->app->bind(ProductGalleryService::class, function ($app) {
            return new ProductGalleryService($app->make(ProductGalleryRepositoryInterface::class));
        });
        $this->app->bind(SalesRepositoryInterface::class, SalesRepository::class);
        $this->app->bind(SalesService::class, function ($app) {
            return new SalesService($app->make(SalesRepositoryInterface::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
    }
}
